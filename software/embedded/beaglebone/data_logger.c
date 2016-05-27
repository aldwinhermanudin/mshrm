#include <stdio.h>
#include "include/mshrm_mysql.h"
#include "include/mshrm_communication.h"
// TODO : Not sure if need a checking on when querying to remote server
int main(){
	
	serialConnect(portACM, B9600);
	setSQLConfiguration();
	char main_query[MAX_QUERY_BYTE];
	
	while(1){
		clearIOQueue();	
		serialRead(READ_SIZE);
		printf("\nWe received\t: %s\n",bufferRead);
		
		if (decodeMessage(bufferRead) != 0){
			serialWriteErrorMessage("Incorrect message format");
			printf("Incorrect message format\n");
			continue;
		} 
		
		else { 
			printf("Message Status\t: %s\n",messageStatus);
			printf("Message Payload\t: %s\n\n",messagePayload);
			
			if (strcmp(messageStatus, "00") == 0){
				printf ("Looking for the '.' character in \"%s\"...\n",messagePayload);
				char decoded_payload_messages[7][32];
				int dot_location[6];
				int valid_format = 0;
				int i = 0;
				char * pch;
				pch=strchr(messagePayload,'.');
				while (pch!=NULL){
					printf ("found at %ld\n",(pch-messagePayload));
					dot_location[i] = (pch-messagePayload);
					pch=strchr(pch+1,'.');
					i++;
					valid_format++;
				}
				
				if (valid_format != 6){
					serialWriteErrorMessage("Incorrect payload format");
					printf("Incorrect payload format\n");
					continue;
				}
									
				strncpy(decoded_payload_messages[0], &messagePayload[0], dot_location[0]);
				decoded_payload_messages[0][dot_location[0]] = '\0';
				for(i=1;i <= 5; i++){
					strncpy(decoded_payload_messages[i], &messagePayload[dot_location[i-1]+1],dot_location[i]-dot_location[i-1]-1);
					decoded_payload_messages[i][dot_location[i]-dot_location[i-1]-1] = '\0';
				}
				strncpy(decoded_payload_messages[6], &messagePayload[dot_location[5]+1], 2);
				decoded_payload_messages[6][2] = '\0';
				
				sprintf(main_query, "SELECT * FROM employee_uid where flash_id='%s'",decoded_payload_messages[0]);
				int found = sqlQueryCheck(local_main_connection,main_query);
				if (found){
					sqlFetchDataToArray(local_main_connection,main_query,1,5);
					printf("We found something\n");
					printf("Belongs to %s\n",sql_fetched_data[0][1]);
					
					// Upload log to database
					char local_timestamp[32];
					sprintf(local_timestamp, "%s-%s-%s %s:%s:%s",decoded_payload_messages[3],decoded_payload_messages[2],decoded_payload_messages[1],decoded_payload_messages[4],decoded_payload_messages[5],decoded_payload_messages[6]);
					sprintf(main_query,"INSERT INTO work_log (uid,timestamp) VALUES ('%s','%s')",sql_fetched_data[0][0],local_timestamp);
					printf("Uploading %s and %s to Local Database\n", sql_fetched_data[0][0],local_timestamp);
					sqlQuery(local_main_connection,main_query);
					
					// Sending OK message to serial port
					printf("Sending OK message\n");
					serialWriteSuccessMessage(sql_fetched_data[0][2]);
				}
				
				else if (!found){
					serialWriteErrorMessage(":02,ID Not Found;");
					printf("We did not found something\n");
					// send to serial error
				}				
			}
			
			else if (strcmp(messageStatus, "01") == 0){
				sprintf(main_query, "SELECT * from device_information where configuration='admin_password'");
				int found = sqlQueryCheck(local_main_connection, main_query);
				if (found){
					sqlFetchDataToArray(local_main_connection, main_query , 1, 3);
					
					// Sending OK message to serial port
					printf("Sending OK message\n");
					serialWriteSuccessMessage(sql_fetched_data[0][2]);
				}
				
				else {
					serialWriteErrorMessage(":02,Not Found;");
					printf("We did not found something\n");
					// send to serial error
				}				
			}
			
			else if (strcmp(messageStatus, "03") == 0){
				
				sprintf(main_query, "SELECT * from employee_uid");
				int found = sqlQueryCheck(local_main_connection, main_query);
				if (found){
					int flash_id_total = sqlFetchDataToArray(local_main_connection, main_query , MAX_EMPLOYEE, 5);
					int i = 0;
					int flash_id[MAX_EMPLOYEE];
					for(i = 0; i < flash_id_total; i++){
						flash_id[i] = atoi(sql_fetched_data[i][3]);
					}
					int available_flash_id = findMissing(flash_id, flash_id_total);
					char available_flash_id_in_char[8];
					printf("Available Flash ID is %d ", available_flash_id);	
					// Sending OK message to serial port
					printf("Sending OK message\n");
					sprintf(available_flash_id_in_char,"%d",available_flash_id);
					serialWriteSuccessMessage(available_flash_id_in_char);
				}
				
				else {
					serialWriteErrorMessage(":02,Not Found;");
					printf("We did not found something\n");
					// send to serial error
				}
			}
			
			else if (strcmp(messageStatus, "04") == 0){
				printf ("Looking for the '.' character in \"%s\"...\n",messagePayload);
				char decoded_payload_messages[2][32];
				int dot_location;
				char * pch;
				pch=strchr(messagePayload,'.');
				if (pch!=NULL){
					printf ("found at %ld\n",(pch-messagePayload));
					dot_location = (pch-messagePayload);
				}
				
				else {
					serialWriteErrorMessage("Incorrect payload format");
					printf("Incorrect payload format\n");
					continue;
				}
									
				strncpy(decoded_payload_messages[0], messagePayload, dot_location);
				decoded_payload_messages[0][dot_location] = '\0';
				strcpy(decoded_payload_messages[1], &messagePayload[dot_location+1]);
				
				sprintf(main_query,"INSERT INTO employee_uid (flash_id, uid) VALUES ('%s','%s')",decoded_payload_messages[0],decoded_payload_messages[1]);
				printf("Inserting data : %s %s\n", decoded_payload_messages[0],decoded_payload_messages[1]);
				sqlQuery(local_main_connection,main_query);
				serialWriteSuccessMessage("OK");
			}
			
			else{
				serialWriteErrorMessage("Unknown Code");
				printf("Unknown Code\n");
				continue;
			}
		}
	}
	close(fd);
	mysql_close(local_main_connection);
	mysql_close(server_main_connection);
}
