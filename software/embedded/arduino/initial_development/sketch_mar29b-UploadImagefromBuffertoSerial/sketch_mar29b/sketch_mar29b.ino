/*************************************************** 
  This is an example sketch for our optical Fingerprint sensor

  Adafruit invests time and resources providing this open source code, 
  please support Adafruit and open-source hardware by purchasing 
  products from Adafruit!

  Written by Limor Fried/Ladyada for Adafruit Industries.  
  BSD license, all text above must be included in any redistribution
 ****************************************************/


#include <Adafruit_Fingerprint.h>
#include <SoftwareSerial.h>

uint32_t getImageFile();

// pin #2 is IN from sensor (GREEN wire)
// pin #3 is OUT from arduino  (WHITE wire)
//SoftwareSerial mySerial(2, 3);


Adafruit_Fingerprint finger = Adafruit_Fingerprint(&Serial3);

void setup()  
{
  
  Serial.begin(57600);
  Serial.println("Adafruit finger detect test");

  // set the data rate for the sensor serial port
  finger.begin(57600);
  
  if (finger.verifyPassword()) {
    Serial.println("Found fingerprint sensor!");
  } else {
    Serial.println("Did not find fingerprint sensor :(");
    while (1);
  }
  Serial.println("Waiting for valid finger...");
  

}

void loop()
{
    getImageFile();
    delay(1);  
}

uint32_t getImageFile()
{
 uint8_t p = finger.getImage();
  switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image taken");
      break;
    case FINGERPRINT_NOFINGER:
      Serial.println("No finger detected");
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      return p;
    case FINGERPRINT_IMAGEFAIL:
      Serial.println("Imaging error");
      return p;
    default:
      Serial.println("Unknown error");
      return p;
  }
  
  // OK success!
  p = finger.upImage();
  switch (p) {
    case FINGERPRINT_OK:
      Serial.print("image "); Serial.print("is"); Serial.println(" transferring");
      break;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.print("error receiving "); Serial.print("packet");
      break;
    case FINGERPRINT_UPLOADFAIL:
      Serial.print("error uploading "); Serial.print("packet");
      break;
   default:
      Serial.print("Unknown error "); Serial.println(p);
      return p;
  }
  
  delay(6);
  uint16_t templateBuffer[256];
  memset(templateBuffer, 0xff, 256);  //zero out template buffer
  int index=0;
  uint32_t starttime = millis();
  while ((index < 256) && ((millis() - starttime) < 1000))
  {
    if (Serial3.available())
    {
      templateBuffer[index] = Serial3.read();
      index++;
    }
  }
  
  Serial.print(index); Serial.println(" bytes read");
  
  //dump entire templateBuffer.  This prints out 16 lines of 16 bytes
  for (int count= 0; count < 256; count++)
  {
    for (int i = 0; i < 256; i++)
    {
      Serial.print("0x");
      Serial.print(templateBuffer[count*256+i], HEX);
      Serial.print(", ");
    }
    Serial.println();
  }
}


