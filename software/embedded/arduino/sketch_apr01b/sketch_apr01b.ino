#include <Keypad.h>
#include <LiquidCrystal.h>
#include <Adafruit_Fingerprint.h>
#include <SoftwareSerial.h>
#include <SD.h>
#define MAX_TEMPLATE_NUMBER 500
char dari_bintang_ke = 'v';
char dari_pagar_ke = 'l';

const byte ROWS = 4; //four rows
const byte COLS = 3; //three columns
char keys[ROWS][COLS] = {
  {
    '1','2','3'                    }
  ,
  {
    '4','5','6'                    }
  ,
  {
    '7','8','9'                    }
  ,
  {
    '*','0','#'                    }
};
byte rowPins[ROWS] = { 
  34, 32, 30, 28}; //connect to the row pinouts of the keypad
byte colPins[COLS] = { 
  26, 24,22}; //connect to the column pinouts of the keypad

Adafruit_Fingerprint finger = Adafruit_Fingerprint(&Serial3);
Keypad keypad = Keypad( makeKeymap(keys), rowPins, colPins, ROWS, COLS );
LiquidCrystal lcd(12, 11, 4, 5, 6, 7);
File myFile;

int main_menu = 0 ;
char key;
int state = 1;
String nip_input;
int template_start_number = 1;

void setup(){
  Serial.begin(9600);
  keypad.addEventListener(keypadEvent); // Add an event listener for this keypad  // set up the LCD's number of columns and rows: 
  finger.begin(57600);

  if (!SD.begin(53)) {
    Serial.println("initialization failed!");
  }
  Serial.println("initialization done.");

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
  if ( template_start_number == 0){
    template_start_number = 1;
  }
  lcd.setCursor(11,1);
  lcd.print(template_start_number);
  delay(4000);

}

void checkFingerMenu(){

  while (key != '*'){
    int result = getFingerprintIDez();
    if(result != -1)
    {
      printMenu(26);
      lcd.setCursor(11,1);
      lcd.print(result);
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

      if (getFingerprintEnroll(template_start_number) == FINGERPRINT_OK){
        delay(1000);
        if (uploadFingerpintTemplate(template_start_number,nip_input.c_str(), info_jari) == FINGERPRINT_OK){
          delay(2000);
          template_start_number++;
          if (template_start_number > MAX_TEMPLATE_NUMBER){
            template_start_number = 1;
          }
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
    lcd.print("|     Scan");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|    Finger");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }
  else if( menu == 1){
    lcd.setCursor(0, 0);
    lcd.print("|     Check");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|    Finger");
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
    lcd.print("|    ID Not ");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|     Found");
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
  Serial.print("Found ID #"); 
  Serial.print(finger.fingerID); 
  Serial.print(" with confidence of "); 
  Serial.println(finger.confidence);
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

  // open the file. note that only one file can be open at a time,
  // so you have to close this one before opening another.

  myFile = SD.open("MSHRM.txt", FILE_WRITE);

  // if the file opened okay, write to it:
  if (myFile) {
    Serial.print("Writing UID : ");
    Serial.println(uid_up);
    myFile.print("\n\n#########################\n");
    myFile.print("Employee UID : ");
    myFile.print(uid_up);
    myFile.println("Finger Info  : " + finger_info);
    myFile.print("#########################\n\n");
    index = 0;
    while ((index < 512)){
      myFile.println(templateBuffer[index]);
      index++;  
    }
    myFile.close();
    printMenu(24);
    Serial.println("done.");
    return FINGERPRINT_OK;
  } 
  else {
    // if the file didn't open, print an error:
    printMenu(25);
    Serial.println("error opening MSHRM.txt");
    return FINGERPRINT_PACKETRECIEVEERR;
  }
}


