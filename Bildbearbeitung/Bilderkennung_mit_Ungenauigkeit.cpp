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
   RGBBitmap bmObj, bmMaske, bmVgl;
   //bmObj.readFromFile("Objekte.bmp");
   //bmMaske.readFromFile("Maskeug.bmp");
   bmObj.readFromFile("Manapi_Klein.bmp");
   bmMaske.readFromFile("Manapi_Ohr_Kunst.bmp");

   bmObj.copyToTImage(Image1);
   bmMaske.copyToTImage(Image4);

   bmVgl.setSize(bmObj.getWidth(),bmObj.getHeight());

   unsigned char r,g,b;
   TGColor c,cm;
   double fehler;
   double fehlerbest=100;


   for(int y=0; y<bmObj.getHeight()-bmMaske.getHeight();y++)
   {


      for(int x=0; x<bmObj.getWidth()-bmMaske.getWidth();x++)
      {

            fehler=0;

            for(int yi=0; yi<bmMaske.getHeight();yi++)
            {

               for(int xi=0; xi<bmMaske.getWidth();xi++)
               {
                  bmObj.getPixel(x+xi,y+yi,r,g,b);
                  c.setRGB(r,g,b);

                  bmMaske.getPixel(xi,yi,r,g,b);
                  cm.setRGB(r,g,b);


                     fehler+=abs(c.getGrey()-cm.getGrey());


               }
            }
            fehler=fehler/(bmMaske.getHeight()*bmMaske.getWidth());
            bmVgl.setPixel(x,y,fehler,fehler,fehler);


            TGString s;




            if(fehler<fehlerbest) //V
            {
               fehlerbest=fehler;

               bmObj.copyToTImage(Image2);
               Image2->Canvas->Rectangle(x,y,x+bmMaske.getWidth(),y+bmMaske.getHeight());


               Application->ProcessMessages();
               s = s + x + " " + y + " " + fehler;
               RichEdit1->Lines->Add(s.c_str());
            }
            



      }
   }


   bmVgl.copyToTImage(Image3);

}
//---------------------------------------------------------------------------

