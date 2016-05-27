#include "include/mshrm_mysql.h"

int main() {
	
	setSQLConfiguration();
	
	char unverified_employee_query[MAX_QUERY_BYTE] = "SELECT * FROM employee_uid where verified=0 LIMIT 1";
	char main_query[MAX_QUERY_BYTE] = "SELECT * FROM employee_data";
	
	while(1){
		if(sqlQueryCheck(local_main_connection, unverified_employee_query)){
			
			int total_receive = sqlFetchDataToArray(local_main_connection, unverified_employee_query , 1, 5);
			printFetchedData(1,5);
			
			sprintf(main_query, "SELECT * FROM employee_data where uid='%s'",sql_fetched_data[0][0]);
			int found = sqlQueryCheck(server_main_connection,main_query);
			
			if (found){
				printf("\nfound something\n");
				char buffer_uid[SQL_CELL_SIZE];
				strcpy(buffer_uid, sql_fetched_data[0][0]);
				sprintf(main_query, "SELECT * FROM employee_data where uid='%s'",buffer_uid);
				sqlFetchDataToArray(server_main_connection, main_query , 1, 3);
				sprintf(main_query, "UPDATE employee_uid SET name='%s', short_name='%s', verified=1 where uid='%s'",sql_fetched_data[0][1],sql_fetched_data[0][2],buffer_uid);
				sqlQuery(local_main_connection, main_query);
			}
			
			else {
				sprintf(main_query,"DELETE FROM employee_uid where uid='%s'",sql_fetched_data[0][0]);
				sqlQuery(local_main_connection, main_query);
				printf("\nUID of %s Deleted\n", sql_fetched_data[0][0]);
				printf("\ndidn't found something\n");
			}
			//usleep(10000);
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
