#include <unistd.h>
#include <sys/ioctl.h>
#include <fcntl.h>
#include <termios.h>
#include <sys/time.h>

// ###################################### DECLARE SERIAL VARIABLE ################################################ //
#define WRITE_SIZE 2048
#define READ_SIZE 2048

const char*	portACM     	= "/dev/ttyACM2";
char 		bufferRead		[READ_SIZE];
char 		bufferWrite		[WRITE_SIZE];
int			fd;	
int 		serialStart		(const char* portname, speed_t baud);
void 		serialRead		(int dataRead);
void 		serialWrite		(const char* data_out, int data_size);
int			serialConnect	(const char* portname, speed_t baud);
void 		clearIOQueue	();
// ###################################### DECLARE SERIAL VARIABLE ################################################ //

// ###################################### DECLARE PROTOCOL VARIABLE ################################################ //
#define PAYLOAD_SIZE 				2048
#define STATUS_CODE_SIZE 			12

int		decodeMessage				(char* data_input);
char	messageStatus				[STATUS_CODE_SIZE];
char	messagePayload				[PAYLOAD_SIZE];
char	responseMessage				[READ_SIZE];
void 	serialWriteErrorMessage		(const char * error_message);
void	serialWriteSuccessMessage	(const char * success_message);
void 	swap						(int *a, int *b);
int 	segregate 					(int arr[], int size);
int 	findMissingPositive			(int arr[], int size);
int 	findMissing					(int arr[], int size);
// ###################################### DECLARE PROTOCOL VARIABLE ################################################ //

void clearIOQueue(){
	tcflush(fd, TCIOFLUSH);
	usleep(50000);
}

int serialStart(const char* portname, speed_t baud){
	// Open the serial port as read/write, not as controlling terminal, and
	// don't block the CPU if it takes too long to open the port.
	fd = open(portname, O_RDWR | O_NOCTTY);
		
	if (fd == -1) {
      return 0;
	}
	
	/* wait for the Arduino to reboot */
	usleep(3500000);
	
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
	char* nl_remover = strchr(bufferRead,'\n');
	bufferRead[nl_remover-bufferRead] = '\0';
}

void serialWrite(const char* data_out, int data_size){
	clearIOQueue();
	sprintf(bufferWrite,"%s",data_out);
	int n = write(fd, bufferWrite, data_size);
	if (n < 0)
		fputs("write() failed!\n", stderr);
}

int serialConnect(const char* portname, speed_t baud){
	
	int serial_open_status = serialStart(portACM, B9600);
	
	if (serial_open_status){
		printf("\nArduino connection successful\n");
		return 0;
	}
	else {
		
		printf("\nArduino connection failed\n");
		return -1;
	}
}

void serialWriteErrorMessage(const char * error_message){
	sprintf(responseMessage, ":02,%s;", error_message);
	serialWrite(responseMessage,strlen(responseMessage));
}

void serialWriteSuccessMessage(const char * success_message){
	sprintf(responseMessage, ":01,%s;", success_message);
	serialWrite(responseMessage,strlen(responseMessage));
}
	
int decodeMessage(char* data_input){
	// consider adding this to clear message
	memset(messageStatus,'\0',STATUS_CODE_SIZE);
    memset(messagePayload,'\0',PAYLOAD_SIZE);
	
	char * pointer_to_status_code = strchr(data_input,':');
	if (pointer_to_status_code == NULL)
		return -1;	
	else 
		pointer_to_status_code += 1;
	strncpy(messageStatus, pointer_to_status_code, 2);
	
	char * pointer_to_payload = strchr(data_input,',');
	if (pointer_to_payload == NULL)
		return -2;
	else
		pointer_to_payload += 1;
	strcpy(messagePayload, pointer_to_payload);	
	
	//also consider this to copy payload data
	int end_of_message_location = strchr(messagePayload,';') - messagePayload;
	//int end_of_message_location = strlen(messagePayload) - 1;
	messagePayload[end_of_message_location] = '\0';
	return 0;
}

/* Utility to swap to integers */
void swap(int *a, int *b)
{
    int temp;
    temp = *a;
    *a   = *b;
    *b   = temp;
}
 
/* Utility function that puts all non-positive (0 and negative) numbers on left 
  side of arr[] and return count of such numbers */
int segregate (int arr[], int size)
{
    int j = 0, i;
    for(i = 0; i < size; i++)
    {
       if (arr[i] <= 0)  
       {
           swap(&arr[i], &arr[j]);
           j++;  // increment count of non-positive integers
       }
    }
 
    return j;
}
 
/* Find the smallest positive missing number in an array that contains
  all positive integers */
int findMissingPositive(int arr[], int size)
{
  int i;
 
  // Mark arr[i] as visited by making arr[arr[i] - 1] negative. Note that 
  // 1 is subtracted because index start from 0 and positive numbers start from 1
  for(i = 0; i < size; i++)
  {
    if(abs(arr[i]) - 1 < size && arr[abs(arr[i]) - 1] > 0)
      arr[abs(arr[i]) - 1] = -arr[abs(arr[i]) - 1];
  }
 
  // Return the first index value at which is positive
  for(i = 0; i < size; i++)
    if (arr[i] > 0)
      return i+1;  // 1 is added becuase indexes start from 0
 
  return size+1;
}
 
/* Find the smallest positive missing number in an array that contains
  both positive and negative integers */
int findMissing(int arr[], int size)
{
   // First separate positive and negative numbers
   int shift = segregate (arr, size);
 
   // Shift the array and call findMissingPositive for
   // positive part
   return findMissingPositive(arr+shift, size-shift);
}
