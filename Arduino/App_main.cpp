#include "App_main.h"
#include <Arduino.h>

// Beim Programmstart vor dem Booten
App_main::App_main()
{
  //
  // Hier nichts schreiben!
  //
}

// Beim Programmstart nach dem Booten
void App_main::appSetup()
{
  button = setPinInterrupt(12, INPUT_PULLUP, TRIGGER_DN);
  pinMode(6,OUTPUT);
  swapPin(8);
}

// Nach appSetup und dann immer ca 15000 mal pro Sekunde
void App_main::appLoop()
{
}

// Hier werden Ereignisse bearbeitet
void App_main::appEvent(int idEvent)
{
  if (idEvent==button)
  {
    timer = setTimerInterrupt(500000);
    z=0;
    uebergabe = 0xCC;
    maske = 128;
  }

  if (idEvent==timer)
  {
    if(z==0)
    {
      digitalWrite(6,1);
      delay(10);
      digitalWrite(6,0);
    }
    else if(z%2!=0)
    {
      if((uebergabe&maske)>0)
      {
        digitalWrite(6,1);
      }
      else
      {
        digitalWrite(6,0);
      }
      maske=maske>>1;
      Serial.println(maske);
      Serial.println(uebergabe);
      swapPin(8);
    }

    z++;
  }
}
