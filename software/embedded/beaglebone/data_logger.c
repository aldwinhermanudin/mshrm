#include <unistd.h>
#include <stdio.h>
#include <stdlib.h>
#include <sys/ioctl.h>
#include <fcntl.h>
#include <termios.h>
#include <sys/time.h>
#include <string.h>
#include <mysql.h>
#define UID_SIZE 8
#define WRITE_SIZE 2048
#define READ_SIZE 2048

// ###################################### DECLARE MYSQL VARIABLE ################################################ //
MYSQL 		*mysql_server;
MYSQL_RES 	*mysql_result;
MYSQL_ROW 	mysql_row;
char		database_data[5][READ_SIZE];
char 		*server;
char 		*user;
char 		*password;
char		*database;
int 		sqlConnect		(MYSQL *connection,char * server_location,char * user_admin,char * password_admin,char * database_server);
int 		sqlQuery		(MYSQL *connection, const char *sql_query);
int 		sqlSearch		(MYSQL *connection, MYSQL_RES *result, MYSQL_ROW row_data, char* uid, int uid_row_number);
int 		sqlFindUID		(MYSQL *connection, MYSQL_RES *result, MYSQL_ROW row_data, const char *sql_query, char* uid, int uid_row_number);
void 		sqlLogin		(char* server_location,char* user_data,char* user_password,char* database_name);
void 		clearIOQueue	();
// ###################################### DECLARE MYSQL VARIABLE ################################################ //

// ###################################### DECLARE SERIAL VARIABLE ################################################ //

const char*	portACM         = "/dev/ttyACM0";
char 		bufferRead[READ_SIZE];
char 		bufferWrite[WRITE_SIZE];
int			fd;		 // File descriptor for serial port
int 		serialStart	(const char* portname, speed_t baud);
void 		serialRead	(int dataRead);
void 		serialWrite	(const char* data_out, int data_size);
// ###################################### DECLARE SERIAL VARIABLE ################################################ //

int main(){
	int serial_open_status = serialStart(portACM, B9600);
	
	if (serial_open_status){
		printf("\nArduino Connect Successful\n");
	}
	else {
		
		printf("\nArduino Connect failed\n");
		return -1;
	}
	
	sqlLogin("localhost","root","hermanudin","mshrm_client");
	mysql_server = mysql_init(NULL);
	sqlConnect(mysql_server, server, user, password, database);
	
	const char *uid_sql_query = "SELECT * FROM employee_uid";
	char insertUID[256];

	while(1){
		clearIOQueue();
		serialRead(READ_SIZE);
		printf("We received %s\n",bufferRead);
		int found = sqlFindUID(mysql_server,mysql_result,mysql_row,uid_sql_query,bufferRead,3);
		if (found){
			printf("Belongs to %s\n",database_data[1]);
			printf("We found something\n");
			
			// upload log to database
			sprintf(insertUID,"INSERT INTO work_log (uid) VALUES ('%s')",database_data[2]);
			printf("Send data to database.\n");
			sqlQuery(mysql_server,insertUID);
			
			// send to serial accepted
			printf("Wait 7 Seconds\n");
			sleep(7);
			printf("Print ok to Serial\n");
			serialWrite("2a12e8a5",8);
		}
		
		else if (!found){
			printf("We did not found something\n");
			// send to serial error
		}
		/* close connection */
	}
	close(fd);
	mysql_close(mysql_server);
}

void clearIOQueue(){
	tcflush(fd, TCIOFLUSH);
	usleep(10000);
}
int serialStart(const char* portname, speed_t baud){
	// Open the serial port as read/write, not as controlling terminal, and
	//   don't block the CPU if it takes too long to open the port.
	fd = open(portname, O_RDWR | O_NOCTTY);
		
	if (fd == -1) {
      return 0;
	}
	
	/* wait for the Arduino to reboot */
	//usleep(3500000);
	
	struct termios toptions;	// struct to hold the port settings
	
	// Fetch the current port settings
	tcgetattr(fd, &toptions);
	
	// Set Input and Output BaudRate
	cfsetispeed(&toptions, baud);
	cfsetospeed(&toptions, baud);
	
	// Set up the frame information.
	toptions.c_cflag &= ~PARENB;	// no parity
	toptions.c_cflag &= ~CSTOPB;	// one stop bit
	toptions.c_cflag &= ~CSIZE;		// clear frame size info
	toptions.c_cflag |= CS8;		// 8 bit frames
	
	// c_cflag contains a few important things- CLOCAL and CREAD, to prevent
	// this program from "owning" the port and to enable receipt of data.
	// Also, it holds the settings for number of data bits, parity, stop bits,
	// and hardware flow control.
	toptions.c_cflag |= CREAD ;
	toptions.c_cflag |= CLOCAL;
	
	/* no hardware flow control */
	toptions.c_cflag &= ~CRTSCTS;
	 
	/* disable input/output flow control, disable restart chars */
	toptions.c_iflag &= ~(IXON | IXOFF | IXANY);
	 
	/*
	ICRNL
	: map CR to NL (otherwise a CR input on the other computer
	will not terminate input)
	otherwise make device raw (no other input processing)
	*/
	toptions.c_iflag = ICRNL;
	 
	 /* disable canonical input, disable echo,
	 disable visually erase chars,
	 disable terminal-generated signals */
	 toptions.c_lflag = ICANON;
	 /* disable output processing */
	 toptions.c_oflag =  ~OPOST;
	 
	// Now that we've populated our options structure, let's push it back to the
	//   system.
	tcsetattr(fd, TCSANOW, &toptions);
	
	usleep(1000000);
	
	// Flush the input and output buffer one more time.
	tcflush(fd, TCIOFLUSH);
	return 1;
}

void serialRead(int dataRead){
	// Now, let's wait for an input from the serial port.
	clearIOQueue();
	fcntl(fd, F_SETFL, 0); // block until data comes in
	read(fd, bufferRead, dataRead);
	bufferRead[strlen(bufferRead)-1] = '\0';
}

void serialWrite(const char* data_out, int data_size){
	clearIOQueue();
	sprintf(bufferWrite,"%s",data_out);
	int n = write(fd, bufferWrite, data_size);
	if (n < 0)
		fputs("write() failed!\n", stderr);
}


int sqlConnect(MYSQL *connection,char * server_location,char * user_admin,char * password_admin,char * database_server){
	
	/* Connect to database */
	if (!mysql_real_connect(connection, server_location, user_admin, password_admin, database_server, 0, NULL, 0)) {
		fprintf(stderr, "%s\n", mysql_error(connection));
		return(-1);
	}
	
	else {
		printf("Database Connection Successful\n");
		return(0);
	}
}

int sqlQuery(MYSQL *connection, const char *sql_query){
	
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
	
	while ((row_data = mysql_fetch_row(result)) != NULL){
		
		if (strcmp(uid,row_data[uid_row_number]) == 0){
			//printf("%s \n", row_data[1]);
			strcpy(database_data[0], row_data[0]);
			strcpy(database_data[1], row_data[1]);
			strcpy(database_data[2], row_data[2]);
			strcpy(database_data[3], row_data[3]);
			strcpy(database_data[4], row_data[4]);			
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


/*
* Arduino Example

void setup() {
	// initialize both serial ports:
	Serial.begin(9600);
	pinMode(A0, INPUT);
}

void loop() {
	// read from port 1, send to port 0:
	if (Serial.available()) {
		String inByte = Serial.readString();
		delay(3000);
		Serial.print("2a22e8d5");
		
	}
	
	if(digitalRead(A0)){
		Serial.print("2a12e8d5");
		delay(5000);
	}
	
}

*/
