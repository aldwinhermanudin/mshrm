void serialFlush() {
  while (Serial.available()) Serial.read();
}

uint32_t validate(uint8_t command) {
  bool received = false, started = false;
  uint32_t start = millis();
  input = "";
  
  while (!received && ((millis() - start) < 10000)) {
    updateTime();
    while (Serial.available()) {
      updateTime();
      char in = Serial.read();
      if (in == ':') started = true;
      if ((in != '\n') && (in != '\r') && started) input += in;
      if ((in == ';') && (started)) {
        received = true;
        started = false;
        break;
      }
    }
  }
  
  if (received) {
    if (input.charAt(0) == ':') {
      if (input.charAt(2) == '1') {
        for (uint8_t i = 4; i < input.length() - 1; i++) extractedValue += input.charAt(i);
        if (command == 0) {
          lcd.setCursor(7, 150);
          lcd.print("Nama: ");
          lcd.print(extractedValue);
          lcd.setCursor(7, 290);
          lcd.print("Absen Sukses, Terima Kasih");
          delay(2000);
          lcd.setCursor(7, 150);
          lcd.print("                                                    ");
          lcd.setCursor(7, 290);
          lcd.print("  Silahkan Tap Jari Anda  ");
          extractedValue = "";
          return 0;
        } else if (command == 1) {
          uint32_t ret = extractedValue.toInt();
          extractedValue = "";
          return ret;
        }
      } else {
        if (command == 0) return -2;
        else return -1;
      }
    } else return -1;
  } else return -1;
}
