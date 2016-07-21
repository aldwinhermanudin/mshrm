#include <Keypad.h>
#include <LiquidCrystal.h>
#include <Adafruit_Fingerprint.h>
#include <SoftwareSerial.h>
#include <Servo.h> 

#define MAX_TEMPLATE_NUMBER 500
char dari_bintang_ke = 'v';
char dari_pagar_ke = 'l';

const byte ROWS = 4; //four rows
const byte COLS = 3; //three columns
char keys[ROWS][COLS] = {
  {
    '1','2','3'                          }
  ,
  {
    '4','5','6'                          }
  ,
  {
    '7','8','9'                          }
  ,
  {
    '*','0','#'                          }
};
byte rowPins[ROWS] = { 
  34, 32, 30, 28}; //connect to the row pinouts of the keypad
byte colPins[COLS] = { 
  26, 24,22}; //connect to the column pinouts of the keypad

Adafruit_Fingerprint finger = Adafruit_Fingerprint(&Serial3);
Keypad keypad = Keypad( makeKeymap(keys), rowPins, colPins, ROWS, COLS );
LiquidCrystal lcd(12, 11, 4, 5, 6, 7);

int main_menu = 0 ;
char key;
int state = 1;
String nip_input;
int template_start_number = 1;


// Servo Control
Servo myservo;  // create servo object to control a servo 
                // a maximum of eight servo objects can be created 
 
int pos = 0;    // variable to store the servo position 
int led_merah = A6;
int led_hijau = A7;
// Servo Control

// ###################################### DECLARE PROTOCOL VARIABLE ################################################ //
#define READ_SIZE 2048
#define PAYLOAD_SIZE 		2048
#define STATUS_CODE_SIZE 	12
int		decodeMessage		(char* data_input);
char	messageStatus		[STATUS_CODE_SIZE];
char	messagePayload		[PAYLOAD_SIZE];
char	responseMessage		[READ_SIZE];
char    messageInput            [READ_SIZE];
// ###################################### DECLARE PROTOCOL VARIABLE ################################################ //


void setup(){
    myservo.attach(44);  // attaches the servo on pin 9 to the servo object 
    pinMode(led_merah, OUTPUT); 
    pinMode(led_hijau, OUTPUT); 
  Serial.begin(9600);
  keypad.addEventListener(keypadEvent); // Add an event listener for this keypad  // set up the LCD's number of columns and rows: 
  finger.begin(57600);

  if (finger.verifyPassword()) {
    Serial.println("Found fingerprint sensor!");
  } 
  else {
    Serial.println("Did not find fingerprint sensor :(");
    while (1);
  }

  lcd.begin(16, 2);
  lcd.clear();
}

void loop(){

  if (key == '4'){
    main_menu--;
  }
  else if (key == '6'){
    main_menu++; 
  }
  if(main_menu < 0){
    main_menu = 0;
  }
  else if (main_menu > 3){
    main_menu = 3; 
  }

  waitKeypad();
  if (main_menu == 0){
    lcd.clear();
    printMenu(0);
    scanKeypad();
    if (key == '#'){
      printMenu(2);
      waitKeypad();
      inputNIP();
      waitKeypad();
      scanKeypad();
      if (key == '#'){
        fingerScanMenu(); 
      }      
    }
  }

  else if (main_menu == 1){
    lcd.clear();
    printMenu(1);
    scanKeypad();
    if (key == '#'){
      checkFingerMenu();
    }
  }

  else if (main_menu == 2){
    lcd.clear();
    printMenu(28);
    scanKeypad();
    if (key == '#'){
      setTemplateNumberMenu();
    }  
  }

  else if (main_menu == 3){
    lcd.clear();
    printMenu(31);
    scanKeypad();
    if (key == '#'){
      printMenu(30);
      lcd.setCursor(11,1);
      lcd.print(template_start_number);
    } 
    waitKeypad();
    scanKeypad(); 
  }
}

void scanKeypad(){
  do{
    key = keypad.getKey();
  }
  while( state == 1); 
}

void waitKeypad(){
  do{
    key = keypad.getKey();
  }
  while( state == 0); 
}

void setTemplateNumberMenu(){

  printMenu(29);
  lcd.setCursor(11,1);
  waitKeypad();
  String int_input;
  for(int i = 0; i < 3 ; i++){
    scanKeypad();
    if (key == '*' || key == '#'){
      key = '0';
    }

    lcd.print(key);
    int_input += key;
    waitKeypad();
  }
  printMenu(30);
  template_start_number = int_input.toInt();
  if ( template_start_number == 0 || template_start_number > MAX_TEMPLATE_NUMBER){
    template_start_number = 1;
  }
  lcd.setCursor(11,1);
  lcd.print(template_start_number);
  delay(4000);

}

void checkFingerMenu(){

  while (key != '*'){
    digitalWrite(led_merah, HIGH);    // turn the LED off by making the voltage LOW
    int result = getFingerprintIDez();
    if(result != -1)
    {
      //printMenu(26);
      //lcd.setCursor(11,1);
      //lcd.print(result);

      Serial.print(":00,");
      Serial.print(result);
      Serial.println(";");
      boolean messageReceived = false;
      while (!messageReceived){        
        if(readInput()){
          if(decodeMessage(messageInput) == 0){
            //Serial.println(messageStatus);
            //Serial.println(messagePayload);
            lcd.clear();
            lcd.setCursor(0, 0);
            lcd.print("|    Welcome ");
            lcd.setCursor(15, 0);
            lcd.print("|");
            lcd.setCursor(0,1);
            lcd.print("|    ");
            lcd.print(messagePayload);
            lcd.setCursor(15,1);
            lcd.print("|"); 
            digitalWrite(led_merah, LOW);    // turn the LED off by making the voltage LOW
            digitalWrite(led_hijau, HIGH);   // turn the LED on (HIGH is the voltage level)          // wait for a second
            runServo(10000);
            digitalWrite(led_hijau, LOW);    // turn the LED off by making the voltage LOW
            messageReceived = true;    
          }
          else{
            //Serial.println(messageInput);
          }  
        }              
      }
    }
    else {

      printMenu(27);
    }
    key = keypad.getKey();  
    if ((state == 0 && key == '*') || (state == 2 && key == '*')){
      break; 
    }
  }  
}

boolean readInput(){

  int i = 0;
  while (Serial.available() > 0) {
    messageInput[i] = Serial.read();
    i++;
    // increase this to increase word scan
    delay(50);
  }
  if ( i > 0){
    messageInput[i+1] = '\0';
    return true;
  }
  return false;
}

void inputNIP(){
  nip_input = "";
  lcd.setCursor(4,1);
  for(int i = 0; i < 8 ; i++){
    scanKeypad();
    if (key == '*'){
      key = dari_bintang_ke;
    }
    else if (key == '#'){
      key = dari_pagar_ke;
    }
    lcd.print(key);
    nip_input += key;
    waitKeypad();
  }
}

void fingerScanMenu(){
  lcd.clear();
  waitKeypad();
  int sub_menu = 0;
  while (key != '*'){
    if (key == '4'){
      sub_menu--;
    }
    else if (key == '6'){
      sub_menu++; 
    }
    if(sub_menu < 0){
      sub_menu = 0;
    }
    else if (sub_menu > 5){
      sub_menu = 5; 
    }
    printMenu(sub_menu + 4);
    if (key == '#'){
      String info_jari;
      if ( sub_menu == 0){
        info_jari = "Tengah Kiri";
      }
      else if ( sub_menu == 1){
        info_jari = "Telunjuk Kiri";
      }
      else if ( sub_menu == 2){
        info_jari = "Jempol Kiri";
      }
      else if ( sub_menu == 3){
        info_jari = "Jempol Kanan";
      }
      else if ( sub_menu == 4){
        info_jari = "Telunjuk Kanan";
      }
      else if ( sub_menu == 5){
        info_jari = "Tengah Kanan";
      }

      if (template_start_number > MAX_TEMPLATE_NUMBER){
        template_start_number = 1;
      }

      if (getFingerprintEnroll(template_start_number) == FINGERPRINT_OK){
        delay(1000);
        if (uploadFingerpintTemplate(template_start_number,nip_input.c_str(), info_jari) == FINGERPRINT_OK){
          delay(2000);
          template_start_number++;
        }
        else{
          delay(2000);
        }

      }
      else{
        delay(2000);
      }
    }
    waitKeypad();
    scanKeypad();
  }

}

void printMenu(int menu){
  lcd.clear(); 
  if( menu == 0){
    lcd.setCursor(0, 0);
    lcd.print("|     Add");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|    Finger");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }
  else if( menu == 1){
    lcd.setCursor(0, 0);
    lcd.print("|    Absence");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|    Checker");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu == 28){
    lcd.setCursor(0, 0);
    lcd.print("| Set Template");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|    Number");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu == 2){
    lcd.setCursor(0, 0);
    lcd.print("|  Input  NIP");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|###");
    lcd.setCursor(12,1);
    lcd.print("###|"); 
  }

  else if( menu == 3){
    lcd.setCursor(0, 0);
    lcd.print("|  Input NIP");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  // Menu Finger dari 4 - 9
  else if( menu == 4){
    lcd.setCursor(0, 0);
    lcd.print("|    Tengah");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|     Kiri");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu == 5){
    lcd.setCursor(0, 0);
    lcd.print("|   Telunjuk");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|     Kiri");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu == 6){
    lcd.setCursor(0, 0);
    lcd.print("|    Jempol");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|     Kiri");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu == 7){
    lcd.setCursor(0, 0);
    lcd.print("|    Jempol");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|     Kanan");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu == 8){
    lcd.setCursor(0, 0);
    lcd.print("|   Telunjuk");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|     Kanan");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu == 9){
    lcd.setCursor(0, 0);
    lcd.print("|    Tengah");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|     Kanan");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu == 10){
    lcd.setCursor(0, 0);
    lcd.print("|    Letakan");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|     Jari");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu == 11){
    lcd.setCursor(0, 0);
    lcd.print("|     Scan");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|   Berhasil");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu == 12){
    lcd.setCursor(0, 0);
    lcd.print("|     Scan");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|    Error");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu == 13){
    lcd.setCursor(0, 0);
    lcd.print("|    Konversi");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|    Berhasil");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu == 14){
    lcd.setCursor(0, 0);
    lcd.print("|    Konversi");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|     Gagal");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu == 15){
    lcd.setCursor(0, 0);
    lcd.print("|     Angkat");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|      Jari");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu == 16){
    lcd.setCursor(0, 0);
    lcd.print("|     Model");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|    Berhasil");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu == 17){
    lcd.setCursor(0, 0);
    lcd.print("|     Model");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|     Error");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }  

  else if( menu == 18){
    lcd.setCursor(0, 0);
    lcd.print("|     Store");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|    Berhasil");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu == 19){
    lcd.setCursor(0, 0);
    lcd.print("|    Store");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|    Error");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu ==20){
    lcd.setCursor(0, 0);
    lcd.print("|     Load");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|   Berhasil");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu == 21){
    lcd.setCursor(0, 0);
    lcd.print("|     Load");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|    Gagal");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }
  else if( menu == 22){
    lcd.setCursor(0, 0);
    lcd.print("|    Template");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|    Berhasil");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }
  else if( menu == 23){
    lcd.setCursor(0, 0);
    lcd.print("|    Template");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|     Gagal");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }
  else if( menu == 24){
    lcd.setCursor(0, 0);
    lcd.print("|   Save SD");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|   Berhasil");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu == 25){
    lcd.setCursor(0, 0);
    lcd.print("|   Save SD");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|    Gagal");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu == 26){
    lcd.setCursor(0, 0);
    lcd.print("|    ID Found");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("| Number : ");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

  else if( menu == 27){
    lcd.setCursor(0, 0);
    lcd.print("|   Put Valid ");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|    Finger");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }
  // 28 is below menu 1
  else if( menu == 29){
    lcd.setCursor(0, 0);
    lcd.print("| Template ");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("| Number : ");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }
  else if( menu == 30){
    lcd.setCursor(0, 0);
    lcd.print("| Number Set ");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|   to   : ");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }
  else if( menu == 31){
    lcd.setCursor(0, 0);
    lcd.print("| Check Current");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|   Template ");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }

}

// Taking care of some special events.
void keypadEvent(KeypadEvent key){
  switch (keypad.getState()){
  case PRESSED:
    state = 0;
    break;

  case RELEASED:
    state = 1;
    break;

  case HOLD:
    state = 2;
    break;
  }
}

int getFingerprintIDez() {
  uint8_t p = finger.getImage();
  if (p != FINGERPRINT_OK)  return -1;

  p = finger.image2Tz();
  if (p != FINGERPRINT_OK)  return -1;

  p = finger.fingerFastSearch();
  if (p != FINGERPRINT_OK)  return -1;

  // found a match!
  //  Serial.print("Found ID #"); 
  //  Serial.println(finger.fingerID); 
  //  Serial.print(" with confidence of "); 
  //  Serial.println(finger.confidence);
  return finger.fingerID; 
}

uint8_t getFingerprintEnroll(int id_in) {

  int p = -1;
  Serial.print("Waiting for valid finger to enroll as #"); 
  Serial.println(id_in);
  printMenu(10);
  while (p != FINGERPRINT_OK) {
    p = finger.getImage();
    switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image taken");
      printMenu(11);
      break;
    case FINGERPRINT_NOFINGER:
      Serial.println(".");
      printMenu(10);
      break;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      printMenu(12);
      break;
    case FINGERPRINT_IMAGEFAIL:
      Serial.println("Imaging error");
      printMenu(12);
      break;
    default:
      Serial.println("Unknown error");
      printMenu(12);
      break;
    }
  }

  // OK success!

  p = finger.image2Tz(1);
  switch (p) {
  case FINGERPRINT_OK:
    printMenu(13);
    Serial.println("Image converted");
    break;
  case FINGERPRINT_IMAGEMESS:
    Serial.println("Image too messy");
    printMenu(14);
    return p;
  case FINGERPRINT_PACKETRECIEVEERR:
    Serial.println("Communication error");
    printMenu(14);
    return p;
  case FINGERPRINT_FEATUREFAIL:
    Serial.println("Could not find fingerprint features");
    printMenu(14);
    return p;
  case FINGERPRINT_INVALIDIMAGE:
    Serial.println("Could not find fingerprint features");
    printMenu(14);
    return p;
  default:
    Serial.println("Unknown error");
    printMenu(14);
    return p;
  }

  printMenu(15);
  Serial.println("Remove finger");
  delay(2000);
  p = 0;
  while (p != FINGERPRINT_NOFINGER) {
    p = finger.getImage();
  }
  Serial.print("ID "); 
  Serial.println(id_in);
  p = -1;
  printMenu(10);
  Serial.println("Place same finger again");
  while (p != FINGERPRINT_OK) {
    p = finger.getImage();
    switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image taken");
      printMenu(11);
      break;
    case FINGERPRINT_NOFINGER:
      Serial.print(".");
      printMenu(10);
      break;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      printMenu(12);
      break;
    case FINGERPRINT_IMAGEFAIL:
      Serial.println("Imaging error");
      printMenu(12);
      break;
    default:
      Serial.println("Unknown error");
      printMenu(12);
      break;
    }
  }

  // OK success!

  p = finger.image2Tz(2);
  switch (p) {
  case FINGERPRINT_OK:
    printMenu(13);
    Serial.println("Image converted");
    break;
  case FINGERPRINT_IMAGEMESS:
    printMenu(14);
    Serial.println("Image too messy");
    return p;
  case FINGERPRINT_PACKETRECIEVEERR:
    printMenu(14);
    Serial.println("Communication error");
    return p;
  case FINGERPRINT_FEATUREFAIL:
    printMenu(14);
    Serial.println("Could not find fingerprint features");
    return p;
  case FINGERPRINT_INVALIDIMAGE:
    printMenu(14);
    Serial.println("Could not find fingerprint features");
    return p;
  default:
    printMenu(14);
    Serial.println("Unknown error");
    return p;
  }

  // OK converted!
  Serial.print("Creating model for #");  
  Serial.println(id_in);

  p = finger.createModel();
  if (p == FINGERPRINT_OK) {
    Serial.println("Prints matched!");
    printMenu(16);
  } 
  else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    Serial.println("Communication error");
    printMenu(17);
    return p;
  } 
  else if (p == FINGERPRINT_ENROLLMISMATCH) {
    Serial.println("Fingerprints did not match");
    printMenu(17);
    return p;
  } 
  else {
    Serial.println("Unknown error");
    printMenu(17);
    return p;
  } 

  Serial.print("ID "); 
  Serial.println(id_in);
  p = finger.storeModel(id_in);
  if (p == FINGERPRINT_OK) {
    Serial.println("Stored!");
    printMenu(18);
    return p;
  } 
  else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    Serial.println("Communication error");
    printMenu(19);
    return p;
  } 
  else if (p == FINGERPRINT_BADLOCATION) {
    Serial.println("Could not store in that location");
    printMenu(19);
    return p;
  } 
  else if (p == FINGERPRINT_FLASHERR) {
    Serial.println("Error writing to flash");
    printMenu(19);
    return p;
  } 
  else {
    Serial.println("Unknown error");
    printMenu(19);
    return p;
  }   

}

uint8_t uploadFingerpintTemplate(uint16_t id_in, const char * uid_up, String finger_info)
{
  uint8_t p = finger.loadModel(id_in);
  switch (p) {
  case FINGERPRINT_OK:
    printMenu(20);
    Serial.print("template "); 
    Serial.print(id_in); 
    Serial.println(" loaded");
    break;
  case FINGERPRINT_PACKETRECIEVEERR:
    printMenu(21);
    Serial.println("Communication error");
    return p;
  default:
    printMenu(21);
    Serial.print("Unknown error "); 
    Serial.println(p);
    return p;
  }

  // OK success!

  p = finger.getModel();
  switch (p) {
  case FINGERPRINT_OK:
    printMenu(22);
    Serial.print("template "); 
    Serial.print(id_in); 
    Serial.println(" transferring");
    break;
  default:
    printMenu(23);
    Serial.print("Unknown error "); 
    Serial.println(p);
    return p;
  }

  uint8_t templateBuffer[512];
  memset(templateBuffer, 0xff, 512);  //zero out template buffer
  int index=0;
  //  uint32_t starttime = millis();
  while ((index < 512))
  {
    if (Serial3.available())
    {
      templateBuffer[index] = Serial3.read();
      index++;
    }
  }

  Serial.print(index); 
  Serial.println(" bytes reads");
  return p;
}

int decodeMessage(char* data_input){
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

  int end_of_message_location = strchr(messagePayload,';') - messagePayload;
  messagePayload[end_of_message_location] = '\0';
  return 0;
}

void runServo(int time_delay){
  
   for(pos = 0; pos < 180; pos += 1)  // goes from 0 degrees to 180 degrees 
  {                                  // in steps of 1 degree 
    myservo.write(pos);              // tell servo to go to position in variable 'pos' 
    delay(15);                       // waits 15ms for the servo to reach the position 
  } 
  delay(time_delay);
  for(pos = 180; pos>=1; pos-=1)     // goes from 180 degrees to 0 degrees 
  {                                
    myservo.write(pos);              // tell servo to go to position in variable 'pos' 
    delay(15);                       // waits 15ms for the servo to reach the position 
  } 
 
  
}
