double radian_to_pi[101] = { 
0,
0.0628319,
0.125664,
0.188496,
0.251327,
0.314159,
0.376991,
0.439823,
0.502655,
0.565487,
0.628319,
0.69115,
0.753982,
0.816814,
0.879646,
0.942478,
1.00531,
1.06814,
1.13097,
1.19381,
1.25664,
1.31947,
1.3823,
1.44513,
1.50796,
1.5708,
1.63363,
1.69646,
1.75929,
1.82212,
1.88496,
1.94779,
2.01062,
2.07345,
2.13628,
2.19911,
2.26195,
2.32478,
2.38761,
2.45044,
2.51327,
2.57611,
2.63894,
2.70177,
2.7646,
2.82743,
2.89027,
2.9531,
3.01593,
3.07876,
3.14159,
3.20442,
3.26726,
3.33009,
3.39292,
3.45575,
3.51858,
3.58142,
3.64425,
3.70708,
3.76991,
3.83274,
3.89557,
3.95841,
4.02124,
4.08407,
4.1469,
4.20973,
4.27257,
4.3354,
4.39823,
4.46106,
4.52389,
4.58673,
4.64956,
4.71239,
4.77522,
4.83805,
4.90088,
4.96372,
5.02655,
5.08938,
5.15221,
5.21504,
5.27788,
5.34071,
5.40354,
5.46637,
5.5292,
5.59203,
5.65487,
5.7177,
5.78053,
5.84336,
5.90619,
5.96903,
6.03186,
6.09469,
6.15752,
6.22035,
6.28319};

double sin_value[101] = { 
0,
0.0627906,
0.125334,
0.187382,
0.248689,
0.309017,
0.368124,
0.425779,
0.481754,
0.535827,
0.587786,
0.637424,
0.684547,
0.728969,
0.770513,
0.809017,
0.844328,
0.876306,
0.904826,
0.929778,
0.951057,
0.968583,
0.982287,
0.992114,
0.998026,
1,
0.998027,
0.992115,
0.982288,
0.968584,
0.951055,
0.929776,
0.904827,
0.876307,
0.84433,
0.80902,
0.770511,
0.728968,
0.684547,
0.637426,
0.587789,
0.535823,
0.481752,
0.425779,
0.368126,
0.30902,
0.248685,
0.187378,
0.125332,
0.0627913,
2.65359e-06,
-0.062786,
-0.125337,
-0.187383,
-0.24869,
-0.309015,
-0.368121,
-0.425783,
-0.481756,
-0.535827,
-0.587784,
-0.637422,
-0.684544,
-0.728971,
-0.770514,
-0.809017,
-0.844327,
-0.876305,
-0.904829,
-0.929777,
-0.951057,
-0.968583,
-0.982287,
-0.992115,
-0.998027,
-1,
-0.998027,
-0.992115,
-0.982288,
-0.968582,
-0.951056,
-0.929777,
-0.904828,
-0.876309,
-0.844326,
-0.809016,
-0.770513,
-0.728969,
-0.684549,
-0.637428,
-0.587783,
-0.535826,
-0.481754,
-0.425781,
-0.368128,
-0.309013,
-0.248688,
-0.187381,
-0.125335,
-0.062794,
4.69282e-06};

double cos_value[101] = { 
1,
0.998027,
0.992115,
0.982287,
0.968583,
0.951057,
0.929777,
0.904827,
0.876307,
0.844328,
0.809017,
0.770513,
0.728969,
0.684547,
0.637424,
0.587785,
0.535826,
0.481755,
0.425782,
0.36812,
0.309014,
0.248689,
0.187382,
0.125336,
0.062795,
-3.67321e-06,
-0.0627923,
-0.125333,
-0.187379,
-0.248686,
-0.309021,
-0.368127,
-0.42578,
-0.481753,
-0.535824,
-0.587781,
-0.637427,
-0.684548,
-0.728968,
-0.770512,
-0.809015,
-0.84433,
-0.876308,
-0.904827,
-0.929776,
-0.951055,
-0.968584,
-0.982288,
-0.992115,
-0.998027,
-1,
-0.998027,
-0.992114,
-0.982287,
-0.968583,
-0.951057,
-0.929778,
-0.904825,
-0.876305,
-0.844328,
-0.809018,
-0.770515,
-0.728972,
-0.684545,
-0.637423,
-0.587786,
-0.535829,
-0.481757,
-0.425776,
-0.368123,
-0.309017,
-0.248691,
-0.187385,
-0.125329,
-0.0627877,
1.01962e-06,
0.0627897,
0.125331,
0.187377,
0.248693,
0.309019,
0.368124,
0.425778,
0.48175,
0.53583,
0.587787,
0.637424,
0.684546,
0.728967,
0.77051,
0.809019,
0.844329,
0.876306,
0.904826,
0.929775,
0.951058,
0.968584,
0.982287,
0.992115,
0.998027,
1};

// the setup routine runs once when you press reset:
void setup() {
  // initialize serial communication at 9600 bits per second:
  Serial.begin(9600);
}
  unsigned long startMillis;
  unsigned long stopMillis;
  double y_function;
// the loop routine runs over and over again forever:
void loop() {  
  
 // ################ Program 1 ################ 
  startMillis = millis();
  for(int i = 0; i < 1000; i++){
    for (int j = 0; j <=100; j++){
      y_function = sin(radian_to_pi[i]) + cos(radian_to_pi[i]);
    }
  }
  stopMillis = millis();
  Serial.print("Waktu Program 1 ");
  Serial.print(stopMillis - startMillis);
  Serial.println(" milliseconds");
  // ################ Program 1 ################ 
  
  // ################ Program 2 ################   
  startMillis = millis();
  for(int i = 0; i < 1000; i++){
    for (int j = 0; j <=100; j++){
      y_function = sin_value[i] + cos_value[i];
    }
  }
  stopMillis = millis();
  Serial.print("Waktu Program 2 ");
  Serial.print(stopMillis - startMillis);
  Serial.println(" milliseconds");
  // ################ Program 2 ################ 

  Serial.println();
  Serial.println();
  delay(1000);        // delay in between reads for stability
}
