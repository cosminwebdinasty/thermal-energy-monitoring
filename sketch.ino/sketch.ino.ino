#include "dht.h"
#define DHTPIN 0
dht DHT;

#include "dht.h"
#include<math.h>
#define dht_apin A0 //Pinul la care este conectat senzorul
//#define delt 60.00 //Valoare data de modelul radiatorului folosit
#define expRad 1.3 //Valoarea exponentului radiatorului (furnizat de fisa tehnica)
#define qn 1000 //Puterea nominala este de regula 1kW

float c,tn,tp,f,enDeg;
float f1;

void setup(){
  Serial.begin(9600);
  delay(500);//Asteapta pentru a permite incarcarea sistemului
  delay(1000);//Asteapta inainte sa acceseze senzorul;

  DHT.read11(dht_apin);
//Calculul C-value conform standardului EN 442
/*    Serial.println("Valoarea c:");
    c=1-(DHT.temperature-refer)/(delt-refer);
    Serial.println(c);
    Serial.println("\n");
*/ 
}

void loop(){
  DHT.read11(dht_apin);

//(75/60/20°C)n - Temperatura nominala conform TiSoft
    tn=((75+65)/2)-DHT.temperature;
   

//(50/40/20°C)c. - Temperatura de proiectare a radiatorului conform TiSoft
    tp=((50+40)/2)-DHT.temperature;

//Factorul de conversie al radiatorului
    f1=tn/tp;
    f=pow(f1,expRad);

//Valoarea finala a energiei degajate de radiator
    enDeg=qn*f;


  float t = DHT.temperature; //Temperatura
  float e = enDeg; //Energia
 
  // Verificare date senzor
  if (isnan(t) || isnan(e)) {
    Serial.println("Nu s-a putut citi de la senzor");
  } else {  //Daca s-a citit corect de la senzor
    Serial.print(t);     //Temperatura
    Serial.print(" \t"); //tab
    Serial.println(e);   //Energia
    delay(1000);
  }
}
