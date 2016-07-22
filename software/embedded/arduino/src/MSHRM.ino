#include <SoftwareSerial.h>
#include <Adafruit_Fingerprint.h>
#include <TFT_HX8357.h>
#include <DS3231.h>
#include <Keypad.h>

char keys[4][3] = {
  {'1', '2', '3'},
  {'4', '5', '6'},
  {'7', '8', '9'},
  {'*', '0', '#'}
};

//Config 1 : lurus hadap atas
byte rowPins[4] = {8, 7, 6, 5};
byte colPins[3] = {4, 3, 2};

//Config 2 : lurus hadap bawah
//byte rowPins[ROWS] = {2, 3, 4, 5};
//byte colPins[COLS] = {6, 7, 8};

DS3231  rtc(SDA, SCL);
TFT_HX8357 lcd = TFT_HX8357();
Keypad keypads = Keypad( makeKeymap(keys), rowPins, colPins, 4, 3 );
Adafruit_Fingerprint finger = Adafruit_Fingerprint(&Serial3);

String input = "";
String passIn = "";
String extractedValue = "";
String inputNIP = "";

void setup() {
  Serial.begin(9600);
  finger.begin(57600);

  if (!finger.verifyPassword()) {
    Serial.println("Fingerprint : ERROR");
    while (1);
  }

  rtc.begin();

  lcd.init();
  lcd.setRotation(1);
  lcd.fillScreen(TFT_BLACK);
  lcd.setTextColor(TFT_WHITE, TFT_BLACK);
  updateTime();
  lcd.setCursor(225, 17);
  lcd.print("PT.Mitra Siaga");
  lcd.setCursor(7, 290);
  lcd.print("  Silahkan Tap Jari Anda  ");
}

void loop() {
  bool justReceived = false;
  char key = keypads.getKey();
  uint16_t state = getFinger();

  updateTime();

  if (state != 2000) {
    if ((state == 9000) && (justReceived == false)) {
      lcd.setCursor(55, 150);
      lcd.print(" Jari Tidak Ditemukan");
      lcd.setCursor(7, 290);
      lcd.print("    Silahkan Coba Lagi    ");
      delay(2000);
      lcd.setCursor(7, 150);
      lcd.print("                                                    ");
      lcd.setCursor(7, 290);
      lcd.print("  Silahkan Tap Jari Anda  ");
    } else {
      lcd.setCursor(7, 290);
      lcd.print("  Sedang Diproses.......  ");
      justReceived = true;
      serialFlush();
      Serial.flush();
      Serial.print(":00,");
      Serial.print(state);
      Serial.print(".");
      Serial.print(rtc.getAllStr());
      Serial.println(";");
      uint32_t res = validate(0);
      if (res == -1) {
        lcd.setCursor(7, 290);
        lcd.print("    Silahkan Coba Lagi    ");
        delay(2000);
        lcd.setCursor(7, 290);
        lcd.print("  Silahkan Tap Jari Anda  ");
      } else if (res == -2) {
        deleteFingerprint(state);
        lcd.setCursor(7, 290);
        lcd.print("   Data Tidak Ditemukan   ");
        delay(2000);
        lcd.setCursor(7, 290);
        lcd.print("  Silahkan Tap Jari Anda  ");
      }
    }
  }

  if (key) {
    if (key == '#') {
      lcd.setCursor(7, 150);
      lcd.print(" Password: ");
      lcd.setCursor(7, 290);
      lcd.print(" * : Batal         # : OK ");
      passIn = "";
      uint8_t sp = 0;
      uint32_t xTime = millis();
      while (1) {
        if ((millis() - xTime) >= 10000) {
          lcd.setCursor(7, 150);
          lcd.print("                                              ");
          lcd.setCursor(7, 290);
          lcd.print("  Silahkan Tap Jari Anda  ");
          break;
        }
        updateTime();
        key = keypads.getKey();
        if (key) {
          if (key == '*') {
            lcd.setCursor(7, 150);
            lcd.print("                                              ");
            lcd.setCursor(7, 290);
            lcd.print("  Silahkan Tap Jari Anda  ");
            break;
          } else if (key == '#') {
            if (sp == 0) {
              lcd.setCursor(7, 150);
              lcd.print("                                              ");
              lcd.setCursor(7, 290);
              lcd.print("  Silahkan Tap Jari Anda  ");
              break;
            }
            lcd.setCursor(7, 150);
            lcd.print("                                              ");
            lcd.setCursor(7, 290);
            lcd.print("  Sedang Diproses.......  ");
            serialFlush();
            Serial.flush();
            Serial.println(":01,MINTAPASSWORD;");
            uint32_t res = validate(1);
            if (res == -1) {
              lcd.setCursor(7, 150);
              lcd.print("                                              ");
              lcd.setCursor(7, 290);
              lcd.print("    Silahkan Coba Lagi    ");
              delay(2000);
              lcd.setCursor(7, 290);
              lcd.print("  Silahkan Tap Jari Anda  ");
              break;
            }
            if (passIn.toInt() == res) {
              serialFlush();
              Serial.flush();
              Serial.println(":03,MINTAID;");
              res = validate(1);
              if (res == -1) {
                lcd.setCursor(7, 150);
                lcd.print("                                                    ");
                lcd.setCursor(7, 290);
                lcd.print("    Silahkan Coba Lagi    ");
                delay(2000);
                lcd.setCursor(7, 290);
                lcd.print("  Silahkan Tap Jari Anda  ");
                break;
              }
              inputNIP = "";
              xTime = millis();
              sp = 0;
              lcd.setCursor(7, 150);
              lcd.print(" NIP :                    ");
              lcd.setCursor(7, 290);
              lcd.print(" * : Batal/Hapus   # : OK ");
              int8_t statusNIP = -2;
              while ((millis() - xTime) < 30000) {
                updateTime();
                char key = keypads.getKey();
                if (key) {
                  if (key == '#') {
                    if (sp == 0) {
                      statusNIP = 0;
                      inputNIP = "";
                      break;
                    }
                    else {
                      statusNIP = 1;
                      break;
                    }
                  } else if (key == '*') {
                    if (sp > 0) {
                      lcd.setCursor(120 + (sp * 20), 150);
                      lcd.print(" ");
                      sp--;
                      inputNIP.remove(inputNIP.length() - 1);
                    } else {
                      statusNIP = -1;
                      break;
                    }
                  } else {
                    sp++;
                    if (sp < 16) {
                      lcd.setCursor(120 + (sp * 20), 150);
                      lcd.print(key);
                    }
                    inputNIP += key;
                  }
                }
              }
              if (statusNIP == -1) {
                lcd.setCursor(7, 150);
                lcd.print("                          ");
                lcd.setCursor(7, 290);
                lcd.print("  Silahkan Tap Jari Anda  ");
                break;
              }
              lcd.setCursor(7, 150);
              lcd.print("     Simpan Sidik Jari    ");
              uint8_t id = res;
              uint8_t storing = enrollFinger(id);
              if (storing == FINGERPRINT_OK) {
                serialFlush();
                Serial.flush();
                Serial.print(":04,");
                Serial.print(id);
                Serial.print(".");
                Serial.print(inputNIP);
                Serial.println(";");
                lcd.setCursor(7, 150);
                lcd.print("                          ");
                lcd.setCursor(7, 290);
                lcd.print(" Berhasil, Lepaskan Jari! ");
                delay(2000);
              } else {
                lcd.setCursor(7, 150);
                lcd.print("                          ");
                lcd.setCursor(7, 290);
                lcd.print("Gagal! Silahkan Coba Lagi!");
                delay(2000);
              }
            } else {
              lcd.setCursor(7, 150);
              lcd.print("      Password Salah      ");
              lcd.setCursor(7, 290);
              lcd.print("    Silahkan Coba Lagi    ");
              delay(2000);
              lcd.setCursor(7, 150);
              lcd.print("                          ");
            }
            lcd.setCursor(7, 290);
            lcd.print("  Silahkan Tap Jari Anda  ");
            break;
          } else {
            sp++;
            lcd.setCursor(175 + (sp * 20), 150);
            lcd.print("*");
            passIn += key;
          }
        }
      }
    }
  }
}
