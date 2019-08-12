//---------------------------------------------------------------------------

#include <vcl.h>
#pragma hdrstop

#include "Unit1.h"
#include "RGBBitmap.h"
#include "RGBBild.h"
#include "Histogramm.h"
//---------------------------------------------------------------------------
#pragma package(smart_init)
#pragma resource "*.dfm"
TForm1 *Form1;
//---------------------------------------------------------------------------
__fastcall TForm1::TForm1(TComponent* Owner)
        : TForm(Owner)
{
   bmQuell = new RGBBitmap();
   bmZiel  = new RGBBitmap();
   bmHisto = new RGBBitmap();
   Histo = new Histogramm();

   bmHisto->setSize(500,100);

   helligkeit = 0;
   kontrast   = 1;
}
//---------------------------------------------------------------------------

void __fastcall TForm1::ButtonLadenClick(TObject *Sender)
{
   bmQuell->readFromFile("Manapi_Klein.bmp");
   bmZiel->copyFrom(bmQuell);
   bmZiel->copyToTImage(ImageBild);
}
//---------------------------------------------------------------------------

void __fastcall TForm1::TrackBarHelligkeitChange(TObject *Sender)
{
   LabelHelligkeit->Caption = TrackBarHelligkeit->Position;
   helligkeit = TrackBarHelligkeit->Position;
}
//---------------------------------------------------------------------------
void __fastcall TForm1::TrackBarKontrastChange(TObject *Sender)
{
   LabelKontrast->Caption = TrackBarKontrast->Position;
   kontrast = TrackBarKontrast->Position;
   kontrast /= 100;
}
//---------------------------------------------------------------------------

void __fastcall TForm1::ButtonRechnenClick(TObject *Sender)
{

   int hoehe = bmQuell->getHeight();
   int breite = bmQuell->getWidth();
   unsigned char r,g,b;
   double dr,dg,db;


   bmZiel->setSize(breite,hoehe);
   for(int y=0;y<=hoehe;y++)
   {
      for(int x=0;x<=breite;x++)
      {
         bmQuell->getPixel(x,y,r,g,b);
         dr = r;
         dg = g;
         db = b;

         dr = (dr-128)*kontrast+128+helligkeit;
         dg = (dg-128)*kontrast+128+helligkeit;
         db = (db-128)*kontrast+128+helligkeit;
   
         if(dr>255) dr=255;
         if(dg>255) dg=255;
         if(db>255) db=255;
         if(dr<0) dr=0;
         if(dg<0) dg=0;
         if(db<0) db=0;


         bmZiel->setPixel(x,y,dr,dg,db);
      }
   }

   Histo->calculate(bmZiel);
   Histo->paint(bmHisto);
   bmHisto->copyToTImage(ImageHistogramm);
   bmZiel->copyToTImage(ImageBild);
}
//---------------------------------------------------------------------------

void __fastcall TForm1::ButtonSpeichernClick(TObject *Sender)
{
   bmZiel->writeToFile("ziel.bmp");
   bmZiel->copyToTImage(ImageBild);
}
//---------------------------------------------------------------------------



