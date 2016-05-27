#include "include/mshrm_mysql.h"

int main() {
	
	setSQLConfiguration();
	
	char main_query[MAX_QUERY_BYTE] = "SELECT * FROM employee_uid where verified=1";
	
	while(1){
		sprintf(main_query, "SELECT * FROM employee_uid where verified=1");
		if(sqlQueryCheck(local_main_connection, main_query)){
			MYSQL_RES *result; 
			MYSQL_ROW row_data;
			
			sqlFetchData(local_main_connection,main_query,&result);
			printf("\nChecking for invalid UID\n");
			int invalid_uid = 0;
			while ((row_data = mysql_fetch_row(result)) != NULL){
				
				sprintf(main_query, "SELECT * FROM employee_data where uid='%s'", row_data[0]);
				int found = sqlQueryCheck(server_main_connection,main_query);
				if (found){
					printf("ID of %s verified\n", row_data[0]);
					
				}
					
				else if (!found){
					printf("ID of %s does not exist\n", row_data[0]);
					strcpy(sql_fetched_data[invalid_uid][0], row_data[0]);
					invalid_uid++;
					// send to serial error
				}			
			}
			
			mysql_free_result(result);
			printf("Invalid UID %d\n", invalid_uid);
			while(invalid_uid > 0){
				char delete_data_query[MAX_QUERY_BYTE];
				printf("Deleting %s\n", sql_fetched_data[invalid_uid-1][0]);
				sprintf(delete_data_query,"DELETE FROM employee_uid where uid='%s'",sql_fetched_data[invalid_uid-1][0]);
				sqlQuery(local_main_connection,delete_data_query);	
				invalid_uid--;
			}
			sleep(3);
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
