#include "MeineApp.h"
#include "App_Base.h"

MeineApp::MeineApp(App_Base* eineAppBase,int p1, int p2, int p3, int p4)
 : ArduinoApp(eineAppBase)
{
  t=0;
  pin1=p1;
  pin2=p2;
  pin3=p3;
  pin4=p4;
  a=pin4;
}

void MeineApp::appSetup()
{
  t= meineAppBase->setTimerInterrupt(200000);
  pinMode(6,OUTPUT);
  pinMode(7,OUTPUT);
  pinMode(8,OUTPUT);
  pinMode(9,OUTPUT);
}

void MeineApp::appLoop()
{

}

bool MeineApp::appEvent(int idEvent)
{
  if(idEvent==t)
  {
    digitalWrite(pin1,0);
    digitalWrite(pin2,0);
    digitalWrite(pin3,0);
    digitalWrite(pin4,0);
    if(a==pin4)
    {
      a=pin1;
    }
    else if(a==pin1)
    {
      a=pin2;
    }
    else if(a==pin2)
    {
      a=pin3;
    }
    else if(a==pin3)
    {
      a=pin4;
    }


    digitalWrite(a,1);

  }
  else
  {
    return false;
  }
}
