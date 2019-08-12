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

void __fastcall TForm1::Button1Click(TObject *Sender)
{
   RGBBitmap bm;
   bm.setSize(100,100);
   bm.fillRGB(0x0000FF);
   bm.drawLine(0,0,10,10,0xFF00FF,3);
   bm.setPixel(12,12, 0xFF, 0,    0   );
   bm.setPixel(16,12, 0,    0xFF, 0   );
   bm.setPixel(20,12, 0,    0,    0xFF);
   bm.copyToTImage(Image1);
}
//---------------------------------------------------------------------------

void __fastcall TForm1::Button2Click(TObject *Sender)
{
   RGBBitmap bmQuell, bmZiel;
   bmQuell.setSize(33,33);
   bmQuell.fillRandom();

   int x=5;
   int y=10;

   bmQuell.drawLine( 0, y, x+1, y,   0x00FF00);
   bmQuell.drawLine( x, 0, x, y+1,   0x00FF00);

   bmQuell.copyToTImage(Image1);

   bmZiel.copyFromTImage(Image1, x, y);
   bmZiel.copyToTImage(Image2);

   RGBBild b;
   b.getRGBBitmap()->copyFrom(&bmQuell);
   b.meResize(400,400);
   //b.getRGBBitmap()->copyToTImage(Image3);

   TGColor c;
}
//---------------------------------------------------------------------------

void __fastcall TForm1::Button3Click(TObject *Sender)
{
   RGBBild bildQuell;
   bildQuell.getRGBBitmap()->readFromFile("ClusterQuell.bmp");
   bildQuell.getRGBBitmap()->copyToTImage(Image1);
//   bildQuell.segmentieren(...);
}
//---------------------------------------------------------------------------

void __fastcall TForm1::Button4Click(TObject *Sender)
{
   RGBBitmap bmQuell, bmZiel;
   bmQuell.readFromFile("Manapi_Klein.bmp");
   bmQuell.addNoise(5);
   bmZiel.setSize(bmQuell.getWidth(),bmQuell.getHeight());

   int deltaR;
   int deltaG;
   int deltaB;
   int filterw = 80;   //klein=empfindlich
   unsigned char r,g,b;
   TGColor c, cv, cn, cvgl;


   for(int y=0; y<bmQuell.getHeight();y++)
   {

      for(int x=1; x<bmQuell.getWidth()-1;x++)
      {

         bmQuell.getPixel(x,y,r,g,b);
         c.setRGB(r,g,b);
         bmQuell.getPixel(x+1,y,r,g,b);
         cv.setRGB(r,g,b);
         bmQuell.getPixel(x-1,y,r,g,b);
         cn.setRGB(r,g,b);

         cvgl.setRGB((cv.getR()+cn.getR())/2,(cv.getG()+cn.getG())/2,(cv.getB()+cn.getB())/2);

         deltaR=abs(sqrt(c.getR()*c.getR()))-(sqrt(cvgl.getR()*cvgl.getR()));
         deltaG=abs(sqrt(c.getG()*c.getG()))-(sqrt(cvgl.getG()*cvgl.getG()));
         deltaB=abs(sqrt(c.getB()*c.getB()))-(sqrt(cvgl.getB()*cvgl.getB()));


         if(deltaR>filterw||deltaG>filterw||deltaB>filterw)
         {
            bmZiel.setPixel(x,y,cvgl.getRGB());
         }
         else
         {
            bmZiel.setPixel(x,y,c.getRGB());
         }
         int temp=(deltaR+deltaG+deltaB)/3;
         if(temp>245)
         {
            bmZiel.setPixel(x,y,c.getRGB());
         }


      }

   }

   bmQuell.copyToTImage(Image1);
   bmZiel.copyToTImage(Image2);

}
//---------------------------------------------------------------------------

