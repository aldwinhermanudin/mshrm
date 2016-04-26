#include <mysql.h>
#include <stdio.h>
#define UID_SIZE 8
#define UID_COLUMN 1
#define TIMESTAMP_COLUMN 2
#define MAX_QUERY_BYTE 512
/* table column
 * 	0 	 1	 	   2
 * no	uid	   timestamp 
 * 
 */
 
 
MYSQL *server_main_connection;
char *server_ip;
char *server_user;
char *server_password;
char *server_database;

MYSQL *local_main_connection;
char *local_ip;
char *local_user;
char *local_password;
char *local_database;

char row_local_result[3][256];

int sqlConnect(MYSQL *connection,char * server_location,char * user_admin,char * password_admin,char * database_server);
int sqlQuery(MYSQL *connection, const char *sql_query);
int sqlSearch( MYSQL *connection, MYSQL_RES *result, MYSQL_ROW row_data, char* uid, int uid_row_number);
int sqlDataUpload(MYSQL *local_connection, MYSQL *server_connection, const char *sql_query);
int sqlDataUploadCheck( MYSQL *local_connection, MYSQL *server_connection, const char *sql_query);
int sqlFindUID( MYSQL *connection, MYSQL_RES *result, MYSQL_ROW row_data, const char *sql_query, char* uid, int uid_row_number);
void sqlServerLogin(char* server_location,char* server_user_data,char* server_user_password,char* server_database_name);
void sqlLocalLogin(char* local_location,char* local_user_data,char* local_user_password,char* local_database_name);
int sqlAutoReconnect(MYSQL *connection, int reconnect_status);
int sqlQueryCheck( MYSQL *connection, const char *sql_query);

int main() {
	
	sqlServerLogin("localhost","root","hermanudin","anssip");
	sqlLocalLogin("localhost","root","hermanudin","proyek_akhir");
	server_main_connection = mysql_init(NULL);
	local_main_connection = mysql_init(NULL);
	
	sqlAutoReconnect(server_main_connection,1);
	sqlAutoReconnect(local_main_connection,1);
	
	sqlConnect(server_main_connection, server_ip, server_user, server_password, server_database);
	sqlConnect(local_main_connection, local_ip, local_user, local_password, local_database);
	
	char upload_query[MAX_QUERY_BYTE] = "SELECT * FROM class_log LIMIT 1";			
	char upload_check_query[MAX_QUERY_BYTE];
	while(1){
		
		if(sqlQueryCheck(local_main_connection, "SELECT * FROM class_log LIMIT 1")){
				
			// upload to remote server
			int upload_status = sqlDataUpload(local_main_connection, server_main_connection,upload_query);
			
			// check if data is uploaded, then delete the data in the local server
			sprintf(upload_check_query,"SELECT * FROM class_log where card_uid='%s' AND timestamp='%s'",row_local_result[UID_COLUMN],row_local_result[TIMESTAMP_COLUMN]);
			int upload_check = sqlDataUploadCheck(local_main_connection, server_main_connection,upload_check_query);
			
			// check for successful upload
			if (upload_status && upload_check){
				
				printf("%s %s",row_local_result[UID_COLUMN],row_local_result[TIMESTAMP_COLUMN]);
				printf("\nUpload Success");
				printf("\nWait 0.01s.\n");
				usleep(10000);
			}
			
			else {
				// wait 5 minutes until next try
				printf("\nConnection Error.");
				printf("\nWait for 5 minutes until next try.\n");
				sleep(300);
			}
		}
		
		else {
			printf("\nTable empty.");
			printf("\nWait for 5 minutes until next try.\n");
			sleep(300);
		}
	}
	
	mysql_close(server_main_connection);
	mysql_close(local_main_connection);
}



int sqlConnect(MYSQL *connection,char * server_location,char * user_admin,char * password_admin,char * database_server){
	
	/* Connect to database */
	if (!mysql_real_connect(connection, server_location, user_admin, password_admin, database_server, 0, NULL, 0)) {
		fprintf(stderr, "%s\n", mysql_error(connection));
		return(-1);
	}
	
	else {
		printf("Connection Successful\n");
		return(0);
	}	
}

int sqlQuery(MYSQL *connection, const char *sql_query){
	
	/* send SQL query */
	if (mysql_query(connection, sql_query)) {
		fprintf(stderr, "%s\n", mysql_error(connection));
		return -1;
	}
	
	else {
		
		return 0;
	}
}

int sqlSearch( MYSQL *connection, MYSQL_RES *result, MYSQL_ROW row_data, char* uid, int uid_row_number){
	int found_state = 0;
	result = mysql_use_result(connection);
	/* output table name */
	while ((row_data = mysql_fetch_row(result)) != NULL){
		
		if (strcmp(uid,row_data[uid_row_number]) == 0){
			//printf("%s \n", row_data[1]);
			found_state = 1;
		}
	}
	
	mysql_free_result(result);
	return found_state;
	
}

int sqlQueryCheck( MYSQL *connection, const char *sql_query){
	MYSQL_RES *result; 
	MYSQL_ROW row_data;
	sqlQuery(connection, sql_query);
	int found_state = 0;
	result = mysql_use_result(connection);
	/* output table name */
	if ((row_data = mysql_fetch_row(result)) != NULL){
			found_state = 1;
	}
	
	mysql_free_result(result);
	return found_state;
	
}

// missing code to re-check if upload success
int sqlDataUpload( MYSQL *local_connection, MYSQL *server_connection, const char *sql_query){
	
	MYSQL_RES *result;
	MYSQL_ROW row_data;
	// SQL Query to get local data, use SELECT * FROM user_uid LIMIT 1 to limit to only 1 data fetched
	sqlQuery(local_connection,sql_query);
	char insert_data_query[MAX_QUERY_BYTE];
	int row_exist;
	result = mysql_use_result(local_connection);
	
	if((row_data = mysql_fetch_row(result)) != NULL){
		
		// SQL query to insert data to main server
		sprintf(row_local_result[UID_COLUMN],"%s",row_data[UID_COLUMN]);
		sprintf(row_local_result[TIMESTAMP_COLUMN],"%s",row_data[TIMESTAMP_COLUMN]);
		
		// SQL query to insert data to main server
		sprintf(insert_data_query,"INSERT INTO class_log (card_uid,timestamp) VALUES ('%s','%s')",row_data[UID_COLUMN], row_data[TIMESTAMP_COLUMN]);
		sqlQuery(server_connection,insert_data_query);
		row_exist = 1;
	}
	
	else{
		
		row_exist = 0;
	}
	
	mysql_free_result(result);
	return row_exist;
}

// missing code to re-check if upload success
int sqlDataUploadCheck( MYSQL *local_connection, MYSQL *server_connection, const char *sql_query){
	MYSQL_RES *result;
	MYSQL_ROW row_data;

	// SQL Query to get local data, use SELECT * FROM user_uid LIMIT 1 to limit to only 1 datta fetched
	sqlQuery(server_connection,sql_query);
	int found_state = 0;
	char delete_data_query[MAX_QUERY_BYTE];
	result = mysql_use_result(server_connection);
	
	if((row_data = mysql_fetch_row(result)) != NULL){
		found_state = 1;
		sprintf(delete_data_query,"DELETE FROM class_log where card_uid='%s' AND timestamp='%s'",row_data[UID_COLUMN], row_data[TIMESTAMP_COLUMN]);
		sqlQuery(local_connection,delete_data_query);
	}
	mysql_free_result(result);
	return found_state;
}

int sqlFindUID( MYSQL *connection, MYSQL_RES *result, MYSQL_ROW row_data, const char *sql_query, char* uid, int uid_row_number){
	sqlQuery(connection,sql_query);
	return sqlSearch(connection,result,row_data,uid,uid_row_number);	
}

void sqlServerLogin(char* server_location,char* server_user_data,char* server_user_password,char* server_database_name){
	
server_ip		=	server_location;
server_user		=	server_user_data;
server_password	=	server_user_password;
server_database	=	server_database_name;
}

void sqlLocalLogin(char* local_location,char* local_user_data,char* local_user_password,char* local_database_name){
	
local_ip		=	local_location;
local_user		=	local_user_data;
local_password	=	local_user_password;
local_database	=	local_database_name;
}

int sqlAutoReconnect(MYSQL *connection, int reconnect_status){
	
	my_bool reconnect = reconnect_status;
	return mysql_options(connection, MYSQL_OPT_RECONNECT, &reconnect);
}
