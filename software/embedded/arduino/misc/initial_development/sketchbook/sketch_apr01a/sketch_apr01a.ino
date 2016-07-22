/* @file HelloKeypad.pde
|| @version 1.0
|| @author Alexander Brevig
|| @contact alexanderbrevig@gmail.com
||
|| @description
|| | Demonstrates the simplest use of the matrix Keypad library.
|| #
*/
#include <Keypad.h>
#include <LiquidCrystal.h>
#include <Adafruit_Fingerprint.h>
#include <SoftwareSerial.h>

const byte ROWS = 4; //four rows
const byte COLS = 3; //three columns
char keys[ROWS][COLS] = {
  {'1','2','3'},
  {'4','5','6'},
  {'7','8','9'},
  {'*','0','#'}
};
byte rowPins[ROWS] = {34, 32, 30, 28}; //connect to the row pinouts of the keypad
byte colPins[COLS] = {26, 24,22}; //connect to the column pinouts of the keypad

Keypad keypad = Keypad( makeKeymap(keys), rowPins, colPins, ROWS, COLS );
// initialize the library with the numbers of the interface pins
LiquidCrystal lcd(12, 11, 4, 5, 6, 7);

void setup(){
  Serial.begin(9600);
  keypad.addEventListener(keypadEvent); // Add an event listener for this keypad  // set up the LCD's number of columns and rows: 
  lcd.begin(16, 2);
  lcd.clear();
}
  int main_menu = 0 ;
  char key;
  int state = 1;
  String nip_input;
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
  else if (main_menu > 1){
    main_menu = 1; 
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
       fingerScanMenu();
    }
  }
  else if (main_menu == 1){
    lcd.clear();
    printMenu(1);
    scanKeypad();
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
          
        }
        waitKeypad();
        scanKeypad();
  }
  
}

void inputNIP(){
  nip_input = "";
  lcd.setCursor(2,1);
  for(int i = 0; i < 8 ; i++){
    scanKeypad();
    lcd.print(key);
    nip_input += key;
    waitKeypad();
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


void printMenu(int menu){
  lcd.clear(); 
  if( menu == 0){
    lcd.setCursor(0, 0);
    lcd.print("|");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("| Scan Finger");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }
  else if( menu == 1){
    lcd.setCursor(0, 0);
    lcd.print("|");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("| Check Finger");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }
  
   else if( menu == 2){
    lcd.setCursor(0, 0);
    lcd.print("|  Input NIP");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|");
    lcd.setCursor(15,1);
    lcd.print("|"); 
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
    lcd.print("|Tengah");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|Kiri");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }
  
  else if( menu == 5){
    lcd.setCursor(0, 0);
    lcd.print("|Telunjuk");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|Kiri");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }
  
  else if( menu == 6){
    lcd.setCursor(0, 0);
    lcd.print("|Jempol");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|Kiri");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }
  
  else if( menu == 7){
    lcd.setCursor(0, 0);
    lcd.print("|Jempol");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|Kanan");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }
  
  else if( menu == 8){
    lcd.setCursor(0, 0);
    lcd.print("|Telunjuk");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|Kanan");
    lcd.setCursor(15,1);
    lcd.print("|"); 
  }
  
  else if( menu == 9){
    lcd.setCursor(0, 0);
    lcd.print("|Tengah");
    lcd.setCursor(15, 0);
    lcd.print("|");
    lcd.setCursor(0,1);
    lcd.print("|Kanan");
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

uint8_t readnumber(void) {
  uint8_t num = 0;
  boolean validnum = false; 
  while (1) {
    while (! Serial.available());
    char c = Serial.read();
    if (isdigit(c)) {
       num *= 10;
       num += c - '0';
       validnum = true;
    } else if (validnum) {
      return num;
    }
  }
}

