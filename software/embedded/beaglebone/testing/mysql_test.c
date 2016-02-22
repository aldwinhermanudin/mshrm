/* Simple C program that connects to MySQL Database server*/
#include <mysql.h>
#include <stdio.h>

int main() {
   MYSQL *conn;
   MYSQL_RES *res;
   MYSQL_ROW row;
   char *find = "2015-12-22 13:25:56";
   char *server = "localhost";
   char *user = "root";
   char *password = "hermanudin"; /* set me first */
   char *database = "proyek_akhir";
   conn = mysql_init(NULL);
   /* Connect to database */
   if (!mysql_real_connect(conn, server,
         user, password, database, 0, NULL, 0)) {
      fprintf(stderr, "%s\n", mysql_error(conn));
      return(1);
   }
   /* send SQL query */
   if (mysql_query(conn, "SELECT * FROM class_log")) {
      fprintf(stderr, "%s\n", mysql_error(conn));
      return(1);
   }
   res = mysql_use_result(conn);
   /* output table name */
   find = "2015-12-22 13:26:08";
   printf("MySQL Tables in mysql database:\n");
   while ((row = mysql_fetch_row(res)) != NULL){
   
		if (strcmp(find,row[3]) == 0){
			printf("%s \n", row[0]);
		}
   }
   
   /* close connection */
   mysql_free_result(res);
   mysql_close(conn);
}
