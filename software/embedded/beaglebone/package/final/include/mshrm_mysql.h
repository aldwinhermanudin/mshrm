#include <mysql.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#define ROW_SIZE		32
#define COLUMN_SIZE 	12
#define SQL_CELL_SIZE 	2048
#define MAX_QUERY_BYTE 	512
#define MAX_EMPLOYEE 	512

MYSQL 	*server_main_connection;
char 	*server_ip;
char 	*server_user;
char 	*server_password;
char 	*server_database;

MYSQL 	*local_main_connection;
char 	*local_ip;
char 	*local_user;
char 	*local_password;
char 	*local_database;

char 	sql_fetched_data	[ROW_SIZE][COLUMN_SIZE][SQL_CELL_SIZE];

void 	setSQLConfiguration	();
void 	sqlServerLogin		(char* server_location,char* server_user_data,char* server_user_password,char* server_database_name);
void 	sqlLocalLogin		(char* local_location,char* local_user_data,char* local_user_password,char* local_database_name);
int 	sqlAutoReconnect	(MYSQL *connection, int reconnect_status);
int 	sqlConnect			(MYSQL *connection,char * server_location,char * user_admin,char * password_admin,char * database_server);
int 	sqlQuery			(MYSQL *connection, const char *sql_query);
int 	sqlQueryCheck		( MYSQL *connection, const char *sql_query);
void 	sqlFetchData		( MYSQL *connection, const char *sql_query, MYSQL_RES **result);
int 	sqlFetchDataToArray	( MYSQL *connection, const char *sql_query, int total_row_to_fetch, int total_column);
void 	printFetchedData	(int row, int column);


void setSQLConfiguration(){
	
	// MySQL Database configuration
	// IP Address, Username, Password, Database Name
	sqlServerLogin("182.253.220.50","remote_3","RemotePasswordUser1XXX98738243","remote_database_3");
	sqlLocalLogin("localhost","root","hermanudin","mshrm_client");
	server_main_connection = mysql_init(NULL);
	local_main_connection = mysql_init(NULL);
	
	sqlAutoReconnect(server_main_connection,1);
	sqlAutoReconnect(local_main_connection,1);
	
	sqlConnect(server_main_connection, server_ip, server_user, server_password, server_database);
	sqlConnect(local_main_connection, local_ip, local_user, local_password, local_database);
		
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

void sqlFetchData( MYSQL *connection, const char *sql_query, MYSQL_RES **result){
	sqlQuery(connection, sql_query);
	*result = mysql_use_result(connection);
}

int sqlFetchDataToArray( MYSQL *connection, const char *sql_query, int total_row_to_fetch, int total_column){
	MYSQL_RES *result; 
	MYSQL_ROW row_data;
	int found_state = 0,i = 0,j = 0;
	sqlQuery(connection, sql_query);
	result = mysql_use_result(connection);
	
	while ((row_data = mysql_fetch_row(result)) != NULL && i < total_row_to_fetch){
		
		for (j = 0; j < total_column; j++){
			strcpy(sql_fetched_data[i][j],row_data[j]);
		}
		i++;
		found_state = 1;
	}

	mysql_free_result(result);
	
	if (found_state){
		return i;
	}
	return found_state;
}

void printFetchedData(int row, int column){
	int i = 0;
	int j = 0;
	
	for (j = 0 ; j < row; j++){
		for (i = 0 ; i < column; i++){
			printf("%s ",sql_fetched_data[j][i]);
		}
		printf("\n");
	}
}
