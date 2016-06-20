/*************************************************** 
  This is an example sketch for our optical Fingerprint sensor

  Designed specifically to work with the Adafruit BMP085 Breakout 
  ----> http://www.adafruit.com/products/751

  These displays use TTL Serial to communicate, 2 pins are required to 
  interface
  Adafruit invests time and resources providing this open source code, 
  please support Adafruit and open-source hardware by purchasing 
  products from Adafruit!

  Written by Limor Fried/Ladyada for Adafruit Industries.  
  BSD license, all text above must be included in any redistribution
 ****************************************************/

#include <Adafruit_Fingerprint.h>
#include <SoftwareSerial.h>

uint8_t id;

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
  while (!Serial);  // For Yun/Leo/Micro/Zero/...
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
  Serial.println();
  Serial.println("Menu :");
  Serial.println("1 : Enroll Finger");
  Serial.println("2 : Save to SD");
  Serial.println("3 : Save to Flash");
  int menu = readnumber();
  if (menu  == 1){
      Serial.println("Ready to enroll a fingerprint! Please Type in the ID # you want to save this finger as...");
      id = readnumber();
      Serial.print("Enrolling ID #");
      Serial.println(id);
      getFingerprintEnroll();
  }
  else if (menu == 2 ){
     Serial.print("Enter Template number : ");
      int template_num = readnumber();
      uploadFingerpintTemplate(template_num);
  }
  else if (menu == 3 ){
     Serial.println("Enter input Template number : ");
      int in_template = readnumber();
     Serial.println("Enter output Template number : ");
      int out_template = readnumber();
      transferTemplate(in_template, out_template);
  }
  
  else{
        Serial.println("Error Dude");
  }

}

uint8_t getFingerprintEnroll() {

  int p = -1;
  Serial.print("Waiting for valid finger to enroll as #"); Serial.println(id);
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
  Serial.print("ID "); Serial.println(id);
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
  Serial.print("Creating model for #");  Serial.println(id);
  
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
  
  Serial.print("ID "); Serial.println(id);
  p = finger.storeModel(id);
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


uint8_t uploadFingerpintTemplate(uint16_t id_in)
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
  uint32_t starttime = millis();
  while ((index < 512) && ((millis() - starttime) < 1000))
  {
    if (Serial3.available())
    {
      templateBuffer[index] = Serial3.read();
      index++;
    }
  }
  
  Serial.print(index); Serial.println(" bytes reads");
  
  int data_flag;
  //dump entire templateBuffer.  This prints out 16 lines of 16 bytes
  for (int count= 0; count < 23; count++)
  {
    for (int i = 0; i < 23; i++)
    {
      data_flag = count*23+i;
      if((data_flag) == 512) {
        Serial.println();
        Serial.print("Bytes Saved : ");
        Serial.print((count*23+i));
        break;
      }
      Serial.print("0x");
      Serial.print(templateBuffer[data_flag], HEX);
      Serial.print(", ");
    }
    
    if((data_flag) == 512) {
        break;
      }
    Serial.println();
  }
}

uint8_t transferTemplate(uint16_t id_in,uint16_t id_out)
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
  while ((index < 512))
  {
    if (Serial3.available())
    {
      templateBuffer[index] = Serial3.read();
      index++;
    }
  }
  
  Serial.print(index); Serial.println(" bytes reads");
  
  delay(3000);
  
  p = finger.downBuffer();
  switch (p) {
    case FINGERPRINT_OK:
      Serial.print("ready to transfer the following data packet :"); Serial.println(p);
      break;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.print("error when receiving package :"); Serial.println(p);
      return p;
    case FINGERPRINT_PACKETRESPONSEFAIL:
      Serial.print("fail to receive the following data packages : "); Serial.println(p);
      return p;
    default:
      Serial.print("Unknown error "); Serial.println(p);
      return p;
  }
  
  if (p == FINGERPRINT_OK){
      index=0;
      while ((index < 512))
      {
          Serial3.write(templateBuffer[index]);
          index++;
      }
      
      Serial.println("Transfer done");
  }
  
  delay(3000);
  
  p = finger.storeModel(id_out);
  
  if (p == FINGERPRINT_OK) {
    Serial.println("Stored! in Template " + id_out);
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


