uint8_t enrollFinger(uint16_t id) {
  uint8_t p = -1;
  lcd.setCursor(7, 290);
  lcd.print("Silahkan Tempel Jadi Anda");
  
  while (p != FINGERPRINT_OK) {
    updateTime();
    p = finger.getImage();
    switch (p) {
      case FINGERPRINT_PACKETRECIEVEERR:
        return -1;
        break;
      case FINGERPRINT_IMAGEFAIL:
        return -1;
        break;
    }
  }
  
  p = finger.image2Tz(1);
  if (p != FINGERPRINT_OK) return -1;
  
  lcd.setCursor(7, 290);
  lcd.print(" Silahkan Lepas Jadi Anda ");
  delay(2000);
  
  p = 0;
  while (p != FINGERPRINT_NOFINGER) {
    updateTime();
    p = finger.getImage();
  }
  
  p = -1;
  lcd.setCursor(7, 290);
  lcd.print(" Tempelkan Jari yang Sama ");
  
  while (p != FINGERPRINT_OK) {
    updateTime();
    p = finger.getImage();
    switch (p) {
      case FINGERPRINT_PACKETRECIEVEERR:
        return -1;
        break;
      case FINGERPRINT_IMAGEFAIL:
        return -1;
        break;
    }
  }
  
  p = finger.image2Tz(2);
  if (p != FINGERPRINT_OK) return -1;
  
  p = finger.createModel();
  if (p != FINGERPRINT_OK) return -1;
  
  p = finger.storeModel(id);
  if (p != FINGERPRINT_OK) return -1;
  else return p;
}

uint16_t getFinger() {
  uint8_t p = finger.getImage();
  if (p != FINGERPRINT_OK) return p * 1000;
  
  p = finger.image2Tz();
  if (p != FINGERPRINT_OK)  return p * 1000;
  
  p = finger.fingerFastSearch();
  if (p != FINGERPRINT_OK)  return p * 1000;
  else return finger.fingerID;
}

uint8_t deleteFingerprint(uint8_t id) {
  uint8_t p = -1;
  p = finger.deleteModel(id);
  if (p == FINGERPRINT_OK) return p;
  else return -1;
}
