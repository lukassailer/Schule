#include "ServoApp.h"
#include "App_Base.h"

ServoApp::ServoApp(App_Base* eineAppBase) :ArduinoApp(eineAppBase)
{

}

void ServoApp::appSetup()
{
  t=meineAppBase->setTimerInterrupt(1500);
  ti=meineAppBase->setTimerInterrupt(20000);
  deg=(180/180.0)*2000.0+500.0; //TEST
};

void ServoApp::appLoop()
{

};

void ServoApp::setdeg(double d)
{
  deg=(d/180.0)*2000.0+500.0;
}


bool ServoApp::appEvent(int idEvent)
{
  if (deg!=0)
  {

    if (idEvent==ti)
    {
      digitalWrite(5,1);
      meineAppBase->restartTimerInterrupt(t,deg,1);
    }

    if (idEvent==t)
    {
      digitalWrite(5,0);
      return true;
    }
    else
    {
      return false;
    }

  }
};
