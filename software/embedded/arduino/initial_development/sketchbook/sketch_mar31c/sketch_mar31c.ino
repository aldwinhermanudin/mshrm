#include <Adafruit_Fingerprint.h>
#include <SoftwareSerial.h>
#include <SD.h>

File myFile;
uint8_t getFingerprintEnroll();

// Software serial for when you dont have a hardware serial port
// pin #2 is IN from sensor (GREEN wire)
// pin #3 is OUT from arduino  (WHITE wire)
// On Leonardo/Micro/Yun, use pins 8 & 9. On Mega, just grab a hardware serialport 
//SoftwareSerial mySerial(2, 3);
Adafruit_Fingerprint finger = Adafruit_Fingerprint(&Serial3);

// On Leonardo/Micro or others with hardware serial, use those! #0 is green wire, #1 is white
//Adafruit_Fingerprint finger = Adafruit_Fingerprint(&Serial1);

void setup()  
{
  delay(500);
  
  Serial.begin(9600);
  Serial.println("Adafruit Fingerprint sensor enrollment");

  // set the data rate for the sensor serial port
  finger.begin(57600);
  
  if (finger.verifyPassword()) {
    Serial.println("Found fingerprint sensor!");
  } else {
    Serial.println("Did not find fingerprint sensor :(");
    while (1);
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

void loop()                     // run over and over again
{
      String uid;
      Serial.println("Ready to enroll a fingerprint! Please Type in the ID # you want to save this finger as...");
      while(!Serial.available());
      while(Serial.available()){
        uid = Serial.readString();
      }      
      getFingerprintEnroll(1);
      uploadFingerpintTemplate(1,uid.c_str());
}

uint8_t getFingerprintEnroll(int id_in) {

  int p = -1;
  Serial.print("Waiting for valid finger to enroll as #"); Serial.println(id_in);
  while (p != FINGERPRINT_OK) {
    p = finger.getImage();
    switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image taken");
      break;
    case FINGERPRINT_NOFINGER:
      Serial.println(".");
      break;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      break;
    case FINGERPRINT_IMAGEFAIL:
      Serial.println("Imaging error");
      break;
    default:
      Serial.println("Unknown error");
      break;
    }
  }

  // OK success!

  p = finger.image2Tz(1);
  switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image converted");
      break;
    case FINGERPRINT_IMAGEMESS:
      Serial.println("Image too messy");
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      return p;
    case FINGERPRINT_FEATUREFAIL:
      Serial.println("Could not find fingerprint features");
      return p;
    case FINGERPRINT_INVALIDIMAGE:
      Serial.println("Could not find fingerprint features");
      return p;
    default:
      Serial.println("Unknown error");
      return p;
  }
  
  Serial.println("Remove finger");
  delay(2000);
  p = 0;
  while (p != FINGERPRINT_NOFINGER) {
    p = finger.getImage();
  }
  Serial.print("ID "); Serial.println(id_in);
  p = -1;
  Serial.println("Place same finger again");
  while (p != FINGERPRINT_OK) {
    p = finger.getImage();
    switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image taken");
      break;
    case FINGERPRINT_NOFINGER:
      Serial.print(".");
      break;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      break;
    case FINGERPRINT_IMAGEFAIL:
      Serial.println("Imaging error");
      break;
    default:
      Serial.println("Unknown error");
      break;
    }
  }

  // OK success!

  p = finger.image2Tz(2);
  switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image converted");
      break;
    case FINGERPRINT_IMAGEMESS:
      Serial.println("Image too messy");
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      return p;
    case FINGERPRINT_FEATUREFAIL:
      Serial.println("Could not find fingerprint features");
      return p;
    case FINGERPRINT_INVALIDIMAGE:
      Serial.println("Could not find fingerprint features");
      return p;
    default:
      Serial.println("Unknown error");
      return p;
  }
  
  // OK converted!
  Serial.print("Creating model for #");  Serial.println(id_in);
  
  p = finger.createModel();
  if (p == FINGERPRINT_OK) {
    Serial.println("Prints matched!");
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    Serial.println("Communication error");
    return p;
  } else if (p == FINGERPRINT_ENROLLMISMATCH) {
    Serial.println("Fingerprints did not match");
    return p;
  } else {
    Serial.println("Unknown error");
    return p;
  }   
  
  Serial.print("ID "); Serial.println(id_in);
  p = finger.storeModel(id_in);
  if (p == FINGERPRINT_OK) {
    Serial.println("Stored!");
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    Serial.println("Communication error");
    return p;
  } else if (p == FINGERPRINT_BADLOCATION) {
    Serial.println("Could not store in that location");
    return p;
  } else if (p == FINGERPRINT_FLASHERR) {
    Serial.println("Error writing to flash");
    return p;
  } else {
    Serial.println("Unknown error");
    return p;
  }   
}


uint8_t uploadFingerpintTemplate(uint16_t id_in, const char * uid_up)
{
 uint8_t p = finger.loadModel(id_in);
  switch (p) {
    case FINGERPRINT_OK:
      Serial.print("template "); Serial.print(id_in); Serial.println(" loaded");
      break;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      return p;
    default:
      Serial.print("Unknown error "); Serial.println(p);
      return p;
  }

  // OK success!

  p = finger.getModel();
  switch (p) {
    case FINGERPRINT_OK:
      Serial.print("template "); Serial.print(id_in); Serial.println(" transferring");
      break;
   default:
      Serial.print("Unknown error "); Serial.println(p);
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
  
  Serial.print(index); Serial.println(" bytes reads");
  
  if (!SD.begin(53)) {
    Serial.println("initialization failed!");
    return -1;
  }
  Serial.println("initialization done.");
  
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
    myFile.print("#########################\n\n");
        index = 0;
        while ((index < 512)){
          myFile.println(templateBuffer[index]);
          index++;  
      }
    myFile.close();
    Serial.println("done.");
  } else {
    // if the file didn't open, print an error:
    Serial.println("error opening MSHRM.txt");
  }
}


