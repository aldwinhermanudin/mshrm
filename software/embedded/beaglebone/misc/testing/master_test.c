#include <mysql.h>
#include <stdio.h>
#define UID_SIZE 8

MYSQL *mysql_server;
MYSQL_RES *mysql_result;
MYSQL_ROW mysql_row;
char *server;
char *user;
char *password;
char *database;
char find_uid[UID_SIZE];


int sqlConnect(MYSQL *connection,char * server_location,char * user_admin,char * password_admin,char * database_server);
int sqlQuery(MYSQL *connection, const char *sql_query);
int sqlSearch( MYSQL *connection, MYSQL_RES *result, MYSQL_ROW row_data, char* uid, int uid_row_number);
int sqlFindUID( MYSQL *connection, MYSQL_RES *result, MYSQL_ROW row_data, const char *sql_query, char* uid, int uid_row_number);
void sqlLogin(char* server_location,char* user_data,char* user_password,char* database_name);


int main() {
	
	sqlLogin("localhost","root","hermanudin","proyek_akhir");
	mysql_server = mysql_init(NULL);
	sqlConnect(mysql_server, server, user, password, database);
	
	const char *uid_sql_query = "SELECT * FROM user_uid";	
	char target_uid[UID_SIZE] = "2a12e8d5";	
	int found = sqlFindUID(mysql_server,mysql_result,mysql_row,uid_sql_query,target_uid,2);
	
	if (found){
		printf("We found something\n");
		// send to serial accepted
		// upload log to database
	}
	
	else if (!found){
		printf("We did not found something\n");
		// send to serial error
	}
	
	/* close connection */
	mysql_close(mysql_server);
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

int sqlFindUID( MYSQL *connection, MYSQL_RES *result, MYSQL_ROW row_data, const char *sql_query, char* uid, int uid_row_number){
	sqlQuery(connection,sql_query);
	return sqlSearch(connection,result,row_data,uid,uid_row_number);	
}

void sqlLogin(char* server_location,char* user_data,char* user_password,char* database_name){
	
	server = server_location;
	user = user_data;
	password = user_password; 
	database = database_name;
}

