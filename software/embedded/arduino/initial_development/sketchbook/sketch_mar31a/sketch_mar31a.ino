#include <Keypad.h>
#include <LiquidCrystal.h>
#include <Adafruit_Fingerprint.h>
#include <SoftwareSerial.h>

uint8_t getFingerprintEnroll();

Adafruit_Fingerprint finger = Adafruit_Fingerprint(&Serial3);

const byte rows = 4; //four rows
const byte cols = 3; //three columns
char keys[rows][cols] = {
  {'1','2','3'},
  {'4','5','6'},
  {'7','8','9'},
  {'#','0','*'}
};
byte rowPins[rows] = {34, 32, 30, 28}; //connect to the row pinouts of the keypad
byte colPins[cols] = {26, 24, 22}; //connect to the column pinouts of the keypad
Keypad keypad = Keypad( makeKeymap(keys), rowPins, colPins, rows, cols );

// initialize the library with the numbers of the interface pins
LiquidCrystal lcd(12, 11, 4, 5, 6, 7);


void setup(){
  Serial.begin(9600);
  keypad.setHoldTime(1000); //set keypad holdtime
  // set up the LCD's number of columns and rows: 
  lcd.begin(16, 2);
  
  // set the data rate for the sensor serial port
  finger.begin(57600);
  if (finger.verifyPassword()) {
    lcd.setCursor(0, 0);
    lcd.print("Found fingerprint sensor!");
    delay(1000);
  } else {
    lcd.setCursor(0, 0);
    Serial.println("Did not find fingerprint sensor :(");
    while (1);
  }
  lcd.clear();
}

void loop(){
  
  
  // set the cursor to column 0, line 1
  // (note: line 1 is the second row, since counting begins with 0):
  lcd.setCursor(0, 0);
  lcd.print("1.Scan Finger");
  lcd.setCursor(0, 1);
  lcd.print("2.Match Finger");
  char key = keypad.getKey();
  
  if (key == '1')
  {
    int statuss = 1;
    while (statuss == 1)
    {
    lcd.setCursor(0, 0);
    lcd.clear();
    lcd.print("Masukkan NIP..!");
    char arrayNIP[8];
      for (int i=0; i<8; i++)
      {
        char key = keypad.waitForKey();
        if (key == '*')
        {
          key = 'v';
        }
        else if (key == '#')
        {
          key = 'm';
        }
        
        lcd.setCursor(i, 1);
        lcd.print(key);
        arrayNIP[i] = key;
      }
      
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Are you sure?");
    lcd.setCursor(0, 1);
    lcd.print("NIP:");
    lcd.setCursor(4, 1);
      
      for (int i=0; i<sizeof(arrayNIP); i++)
      {
          lcd.print(arrayNIP[i]);
          lcd.setCursor(i+5, 1);
      }
    key = keypad.getKey();
    
    while (keypad.getState() != HOLD)
    {
      key = keypad.getKey();
    }
    if (keypad.getState() == HOLD && key == '5')
    {
        lcd.clear();
        lcd.setCursor(0, 0);
        lcd.print("Letakkan Jari!");
        delay(2000);
        while (!  getFingerprintEnroll() ); //ambil sidikjari
    }
     
  }
  
  
  if (key != NO_KEY){
    lcd.print(key);
  }
  
  
} 

}

//proses ambil sidikjari
uint8_t getFingerprintEnroll() {

  int p = -1;
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Letakkan Jari");
  lcd.setCursor(0, 1);
  lcd.print("ID# ");
       for (int i=0; i<sizeof(arrayNIP); i++)
      {
          lcd.print(arrayNIP[i]);
          lcd.setCursor(i+4, 1);
      } 
  
  while (p != FINGERPRINT_OK) {
    p = finger.getImage();
    switch (p) {
    case FINGERPRINT_OK:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Image taken");
      break;
    case FINGERPRINT_NOFINGER:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("..........");
      break;
    case FINGERPRINT_PACKETRECIEVEERR:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Comm Error");
      break;
    case FINGERPRINT_IMAGEFAIL:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Imaging error");
      break;
    default:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Unknown error");
      break;
    }
  }
  
  delay(500);
  // OK success!
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Proses Data...");
  delay(500);
     

  p = finger.image2Tz(1);
  switch (p) {
    case FINGERPRINT_OK:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Image converted");
      break;
    case FINGERPRINT_IMAGEMESS:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Image messy");
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Comm Error");
      return p;
    case FINGERPRINT_FEATUREFAIL:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("No finger Feature");
      return p;
    case FINGERPRINT_INVALIDIMAGE:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("No finger Feature");
      return p;
    default:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("No finger Feature");
      return p;
  }
  
  delay(1000);
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Angkat Jari");
  delay(2000);
  p = 0;
  while (p != FINGERPRINT_NOFINGER) {
    p = finger.getImage();
  }
  lcd.setCursor(0, 1);
  lcd.print("ID# ");
       for (int i=0; i<sizeof(arrayNIP); i++)
      {
          lcd.print(arrayNIP[i]);
          lcd.setCursor(i+4, 1);
      } 
  delay(500);
  p = -1;
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Taruh Jari Lagi");
  while (p != FINGERPRINT_OK) {
    p = finger.getImage();
    switch (p) {
    case FINGERPRINT_OK:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Image Taken");
      break;
    case FINGERPRINT_NOFINGER:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("....");
      break;
    case FINGERPRINT_PACKETRECIEVEERR:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Comm Error");
      break;
    case FINGERPRINT_IMAGEFAIL:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Image Error");
      break;
    default:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Unknown Error");
      break;
    }
  }

  // OK success!
  delay(500);

  p = finger.image2Tz(2);
  switch (p) {
    case FINGERPRINT_OK:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Image Converted");
      break;
    case FINGERPRINT_IMAGEMESS:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Image Messy");
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Comm error");
      return p;
    case FINGERPRINT_FEATUREFAIL:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("No Feature");
      return p;
    case FINGERPRINT_INVALIDIMAGE:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("No Feature");
      return p;
    default:
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Unknown Error");
      return p;
  }
  
  
  // OK converted!
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Creating model #");
  lcd.setCursor(0, 1);
       for (int i=0; i<sizeof(arrayNIP); i++)
      {
          lcd.print(arrayNIP[i]);
          lcd.setCursor(i, 1);
      } 
  delay(500);
  p = finger.createModel();
  if (p == FINGERPRINT_OK) {
    
    lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("MATCH!");
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Comm Error");
    return p;
  } else if (p == FINGERPRINT_ENROLLMISMATCH) {
    lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Not Match!");
    return p;
  } else {
    lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Unknown Error");
    return p;
  }   
  
  ///PrintID
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Store model #");
  lcd.setCursor(0, 1);
       for (int i=0; i<sizeof(arrayNIP); i++)
      {
          lcd.print(arrayNIP[i]);
          lcd.setCursor(i, 1);
      } 
  delay(500);
  p = finger.storeModel(id);
  if (p == FINGERPRINT_OK) {
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Stored!");
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Comm Error");
    return p;
  } else if (p == FINGERPRINT_BADLOCATION) {\
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Cant Store");
    return p;
  } else if (p == FINGERPRINT_FLASHERR) {
    lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Error Writing");
    return p;
  } else {
    lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Unknown Error");
    return p;
  }   
}
