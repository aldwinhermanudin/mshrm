void updateTime() {
  uint8_t hh, mm, ss;
  byte omm = 99, oss = 99;
  byte xcolon = 0;
  int  xsecs = 0;
  int xpos = 0;
  int ypos = 10;
  int ysecs = ypos;
  
  Time  times = rtc.getTime();
  ss = times.sec;
  mm = times.min;
  hh = times.hour;
  
  lcd.setTextSize(1);  
  
  if (omm != mm) {
    omm = mm;
    if (hh < 10) xpos += lcd.drawChar('0', xpos, ypos, 6);
    xpos += lcd.drawNumber(hh, xpos, ypos, 6);
    xcolon = xpos;
    xpos += lcd.drawChar(':', xpos, ypos, 6);
    if (mm < 10) xpos += lcd.drawChar('0', xpos, ypos, 6);
    xpos += lcd.drawNumber(mm, xpos, ypos, 6);
    xsecs = xpos;
  }
  
  if (oss != ss) {
    oss = ss;
    xpos = xsecs;
    if (ss % 2) {
      lcd.setTextColor(0x39C4, TFT_BLACK);
      lcd.drawChar(':', xcolon, ypos, 6);
      xpos += lcd.drawChar(':', xsecs, ysecs, 6);
      lcd.setTextColor(TFT_WHITE, TFT_BLACK);
    } else {
      lcd.drawChar(':', xcolon, ypos, 6);
      xpos += lcd.drawChar(':', xsecs, ysecs, 6);
    }
    if (ss < 10) xpos += lcd.drawChar('0', xpos, ysecs, 6);
    lcd.drawNumber(ss, xpos, ysecs, 6);
  }
  
  lcd.setTextSize(3);
}
