//---------------------------------------------------------------------------
#include "math.h"
#include <vcl.h>
#pragma hdrstop

#include "Unit1.h"
#include "RGBBitmap.h"
#include "RGBBild.h"
#include "TGColor.h"
//---------------------------------------------------------------------------
#pragma package(smart_init)
#pragma resource "*.dfm"
TForm1 *Form1;


//---------------------------------------------------------------------------
__fastcall TForm1::TForm1(TComponent* Owner)
        : TForm(Owner)
{

}
//---------------------------------------------------------------------------




void __fastcall TForm1::Button4Click(TObject *Sender)
{
   RGBBitmap bmObj, bmMaske, bmAusg, bmAusg2;

   bmObj.readFromFile("Manapi_Klein.bmp");
   bmMaske.readFromFile("Gauss.bmp");

   bmObj.copyToTImage(Image1);

   bmAusg.setSize(bmObj.getWidth(),bmObj.getHeight());
   bmAusg2.setSize(bmObj.getWidth(),bmObj.getHeight());

   //Gauss berechnen
   int gr=29;   //29
   bmMaske.setSize(gr,gr);
   bmMaske.setPixel(gr/2,gr/2,0x000000);
   double a,wert;
   double abstand0=sqrt((0-gr/2)*(0-gr/2)+(0-gr/2)*(0-gr/2));
   double normierung=-log10l(0.1)/(abstand0*abstand0);
   for(int y=0; y<bmMaske.getHeight();y++)
   {

      for(int x=0; x<bmMaske.getWidth();x++)
      {
         a=sqrt((x-bmMaske.getWidth()/2)*(x-bmMaske.getWidth()/2)+(y-bmMaske.getHeight()/2)*(y-bmMaske.getHeight()/2));
         wert=exp(-a*a*normierung)*255;
         bmMaske.setPixel(x,y,wert,wert,wert);
      }
   }

   bmMaske.copyToTImage(Image4);

   unsigned char r,g,b,rm,gm,bm;
   double sumr,sumg,sumb;
   int sumMaske=0;

   //Schleife für Summe Maske
   for(int y=0; y<bmMaske.getHeight();y++)
   {


      for(int x=0; x<bmMaske.getWidth();x++)
      {

         sumMaske+=bmMaske.getPixelGreyValue(x,y);
      }

   }

   for(int y=0; y<bmObj.getHeight()-bmMaske.getHeight();y++)
   {


      for(int x=0; x<bmObj.getWidth()-bmMaske.getWidth();x++)
      {
            sumr=0;
            sumb=0;
            sumg=0;


            for(int yi=0; yi<bmMaske.getHeight();yi++)
            {

               for(int xi=0; xi<bmMaske.getWidth();xi++)
               {


                  bmObj.getPixel(x+xi,y+yi,r,g,b);
                  bmMaske.getPixel(xi,yi,rm,gm,bm);

                  sumr+=r*rm;
                  sumg+=g*gm;
                  sumb+=b*bm;

               }
            }

            sumr=sumr/sumMaske;
            sumg=sumg/sumMaske;
            sumb=sumb/sumMaske;

            bmAusg.setPixel(x+bmMaske.getWidth()/2,y+bmMaske.getHeight()/2,sumr,sumg,sumb);
            bmAusg2.setPixel(x+bmMaske.getWidth()/2,y+bmMaske.getHeight()/2,(sumr+sumg+sumb)/3,(sumr+sumg+sumb)/3,(sumr+sumg+sumb)/3);
      }
   }

   bmAusg.copyToTImage(Image2);
   bmAusg2.copyToTImage(Image3);
   bmMaske.copyToTImage(Image4);

}
//---------------------------------------------------------------------------


