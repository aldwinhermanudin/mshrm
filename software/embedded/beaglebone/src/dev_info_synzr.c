#include "include/mshrm_mysql.h"

int main() {
	
	setSQLConfiguration();
	
	char main_query[MAX_QUERY_BYTE] = "SELECT * FROM device_information";
	
	while(1){
		sprintf(main_query,"SELECT * FROM device_information");
		if(sqlQueryCheck(server_main_connection, main_query)){
			MYSQL_RES *result; 
			MYSQL_ROW row_data;
			
			sqlFetchData(server_main_connection,main_query,&result);
			printf("\nSyncing to Main Server\n");
			
			while ((row_data = mysql_fetch_row(result)) != NULL){
					
				printf("Syncing for %s\n", row_data[1]);
				sprintf(main_query,"UPDATE device_information SET value='%s' where configuration='%s'",row_data[2], row_data[1]);
				sqlQuery(local_main_connection,main_query);			
			}
			
			mysql_free_result(result);
			printf("\nWait for an hour until next try.\n");
			sleep(3600);
			//return 0; // make this program only run once for using cron
		}
		
		else {
			printf("\nTable empty.");
			printf("\nWait for an hour until next try.\n");
			sleep(3600);
			//return 0; // make this program only run once for using cron
		}		
	}
	
	mysql_close(server_main_connection);
	mysql_close(local_main_connection);
}
