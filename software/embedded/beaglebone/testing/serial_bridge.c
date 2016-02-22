#include <unistd.h>
#include <stdio.h>
#include <stdlib.h>
#include <sys/ioctl.h>
#include <fcntl.h>
#include <termios.h>
#include <sys/time.h>
#include <string.h>

// ID = 8 Bytes 
#define READ_SIZE 8	// in byte

/*
	serialStart(portACM, B9600,READ_SIZE);
	while(1){
		serialRead(READ_SIZE);
		printf("You entered: %s\n", bufferRead);
	}	
	serialWrite("hermanudin1234123412asdf",24);
	
  close(fd);
	*/

// ###################################### DECLARE VARIABLE ################################################ //

const char*      portACM         = "/dev/ttyACM2";
char 			 bufferRead[READ_SIZE];
char 			 bufferWrite[48];
int 			 fd;		 // File descriptor for serial port
void serialStart(const char* portname, speed_t baud, int data);
void serialRead(int dataRead);
void serialWrite(const char* data_out, int data_size);
// ###################################### DECLARE VARIABLE ################################################ //

int main(){
	serialStart(portACM, B9600,READ_SIZE);
	while(1){
		serialRead(READ_SIZE);
		printf("You entered: %s\n", bufferRead);
	}	
	//serialWrite("hermanudin1234123412asdf",24);
	close(fd);
}

void serialStart(const char* portname, speed_t baud, int data){
	// Open the serial port as read/write, not as controlling terminal, and
	//   don't block the CPU if it takes too long to open the port.
	fd = open(portname, O_RDWR | O_NOCTTY );
	
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
	
	// disable hardware flow control
	// toptions.c_cflag &= ~CRTSCTS;
	
	// enabled Canonical input. Canonical input is line-oriented
	toptions.c_iflag |= (ICANON | ECHO | ECHOE);
	
	// disabled output processing. Raw data sent.
	//toptions.c_oflag &= ~OPOST;
	
	toptions.c_cc[VMIN] = data; //minimum data received
	toptions.c_cc[VTIME] = 0;	// time to wait
	
	// Now that we've populated our options structure, let's push it back to the
	//   system.
	tcsetattr(fd, TCSANOW, &toptions);
	
	usleep(1000000);
	
	// Flush the input and output buffer one more time.
	tcflush(fd, TCIOFLUSH);
}

void serialRead(int dataRead){
	// Now, let's wait for an input from the serial port.
	fcntl(fd, F_SETFL, 0); // block until data comes in   
	read(fd, bufferRead, dataRead);
}

void serialWrite(const char* data_out, int data_size){
	
	sprintf(bufferWrite,"%s\r\n",data_out);
	int n = write(fd, bufferWrite, data_size+3);
	if (n < 0)
		fputs("write() of 4 bytes failed!\n", stderr);
}
