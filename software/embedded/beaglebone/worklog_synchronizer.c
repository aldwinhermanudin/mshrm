#include "include/mshrm_mysql.h"

#define UID_COLUMN 1
#define TIMESTAMP_COLUMN 2
int sqlDataUpload(MYSQL *local_connection, MYSQL *server_connection, const char *sql_query);
int sqlDataUploadCheck( MYSQL *local_connection, MYSQL *server_connection, const char *sql_query);

int main() {
	
	setSQLConfiguration();
	
	char upload_query[MAX_QUERY_BYTE] = "SELECT * FROM work_log LIMIT 1";			
	char upload_check_query[MAX_QUERY_BYTE];
	while(1){
		
		if(sqlQueryCheck(local_main_connection, "SELECT * FROM work_log LIMIT 1")){
				
			// upload to remote server
			int upload_status = sqlDataUpload(local_main_connection, server_main_connection,upload_query);
			
			// check if data is uploaded, then delete the data in the local server
			sprintf(upload_check_query,"SELECT * FROM work_log where uid='%s' AND timestamp='%s'",sql_fetched_data[0][UID_COLUMN],sql_fetched_data[0][TIMESTAMP_COLUMN]);
			int upload_check = sqlDataUploadCheck(local_main_connection, server_main_connection,upload_check_query);
			
			// check for successful upload
			if (upload_status && upload_check){
				
				printf("%s %s",sql_fetched_data[0][UID_COLUMN],sql_fetched_data[0][TIMESTAMP_COLUMN]);
				printf("\nUpload Success");
				printf("\nWait 0.01s.\n");
				//usleep(10000);
				sleep(5);
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
		sprintf(sql_fetched_data[0][UID_COLUMN],"%s",row_data[UID_COLUMN]);
		sprintf(sql_fetched_data[0][TIMESTAMP_COLUMN],"%s",row_data[TIMESTAMP_COLUMN]);
		
		// SQL query to insert data to main server
		sprintf(insert_data_query,"INSERT INTO work_log (uid,timestamp) VALUES ('%s','%s')",row_data[UID_COLUMN], row_data[TIMESTAMP_COLUMN]);
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
		sprintf(delete_data_query,"DELETE FROM work_log where uid='%s' AND timestamp='%s'",row_data[UID_COLUMN], row_data[TIMESTAMP_COLUMN]);
		sqlQuery(local_connection,delete_data_query);
	}
	mysql_free_result(result);
	return found_state;
}
