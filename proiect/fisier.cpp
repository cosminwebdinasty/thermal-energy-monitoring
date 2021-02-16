#include <iostream>
#include <cmath>
#include <cstring>
#include<string.h>
#include<stdlib.h>
#include<windows.h>
#include<stdio.h>
#include<iomanip>

void SetColor(int ForgC);

void SetColor(int ForgC)
{
     WORD wColor;
     

     HANDLE hStdOut = GetStdHandle(STD_OUTPUT_HANDLE);
     CONSOLE_SCREEN_BUFFER_INFO csbi;
    

     if(GetConsoleScreenBufferInfo(hStdOut, &csbi))
     {
          
          wColor = (csbi.wAttributes & 0xF0) + (ForgC & 0x0F);
          SetConsoleTextAttribute(hStdOut, wColor);
     }
     return;
}

const double tmin =5;  //Limita minima a intervaluli (temperatura minima)
const double tmax =37; //Limita maxima a intervalului (temperatura maxima)

using namespace std;

class apartenenta //Clasa abstracta ce contine fc. pura
{
protected :
	double mstg, mdrp; //Membru stang, membru drept
	char*  termen;  //Denumire termen lingvistic fuzzy

public:
	apartenenta(){}; //Constructorul clasei (putea fi generat automat in mod implicit daca nu era declarat)

	virtual ~apartenenta(){  //Destructorul clasei (este virtual intrucat clasa este abstracta)
		delete [] termen;
		termen=NULL;
		}

	virtual void setInterval(double l,double r)
	{
		mstg=l;
		mdrp=r;
	}

        virtual void setCentru( double dL=0,double dR=0)=0;


	virtual void setNumeFunc(const char* s)
	{
	  termen = new char[strlen(s)+1];
	  strcpy(termen,s);
	}

	bool inInterval(double t)
	{
		if((t>=mstg)&&(t<=mdrp)) return true; else return false;
	}


    void getTermen() const
	{
		cout<<termen<<endl;
	}

	virtual double getValue(double t)=0;
};


class fcTrapez : public apartenenta
{
private:
	double stgcentru, drpcentru;

public:
    void
	setCentru(double dL, double dR)
	{
		stgcentru=dL; drpcentru=dR;
	}

	double
	getValue(double t)
	{
		if(t<=mstg)
	       return 0;
		else if(t<stgcentru)
			return (t-mstg)/(stgcentru-mstg);
		else if(t<=drpcentru)
			return 1.0;
		else if(t<mdrp)
			return (mdrp-t)/(mdrp-drpcentru);
		else
		    return 0;
	}
};

int main(void)
{
	apartenenta *FuzzySet[7];

	FuzzySet[0] = new fcTrapez; //Fuzzy set 0:{5,6,...,15}-> Foarte rece
    FuzzySet[1] = new fcTrapez; //Fuzzy set 1:{13,14,...17}-> Rece
    FuzzySet[2] = new fcTrapez; //Fuzzy set 2:{16,17,...,20}-> Mediu
    FuzzySet[3] = new fcTrapez; //Fuzzy set 3:{19,20,...,23}-> Confortabil
    FuzzySet[4] = new fcTrapez; //Fuzzy set 4:{21,22,...,25}-> Cald
    FuzzySet[5] = new fcTrapez; //Fuzzy set 5:{24,25,...,28)-> Foarte cald
    FuzzySet[6] = new fcTrapez; //Fuzzy set 6:{26,27,...,37}-> Fierbinte

	FuzzySet[0]->setInterval(3,15);
	FuzzySet[0]->setCentru(5,13);
	FuzzySet[0]->setNumeFunc("foarte_rece");

	FuzzySet[1]->setInterval(13,17);
	FuzzySet[1]->setCentru(14,16);
	FuzzySet[1]->setNumeFunc("rece");

	FuzzySet[2]->setInterval(16,20);
	FuzzySet[2]->setCentru(17,19);
	FuzzySet[2]->setNumeFunc("mediu");

	FuzzySet[3]->setInterval(19,23);
	FuzzySet[3]->setCentru(20,22);
	FuzzySet[3]->setNumeFunc("confortabil");

	FuzzySet[4]->setInterval(22,26);
	FuzzySet[4]->setCentru(23,25);
	FuzzySet[4]->setNumeFunc("cald");

	FuzzySet[5]->setInterval(25,29);
	FuzzySet[5]->setCentru(26,28);
	FuzzySet[5]->setNumeFunc("foarte_cald");

	FuzzySet[6]->setInterval(27,40);
	FuzzySet[6]->setCentru(29,37);
	FuzzySet[6]->setNumeFunc("fierbinte");


    
	double val;
   
   while(1)
	{
	  cout<<"\nValoarea temperaturii: ";
	  cin>>val;

      if(val<tmin) continue;
	  if(val>tmax) continue;

      for(int i=0; i<7; i++)
	  {
		 cout<<"\nPunctul="<<val<<endl;

		 if(FuzzySet[i]->inInterval(val))
			 cout<<"Se afla in interval!";
		 else
			 cout<<"Nu se afla in interval!";
		 cout<<endl;

         cout<<"Numele functiei de apartenenta este:"<<endl;
		 FuzzySet[i]->getTermen();
		 cout<<"Valoarea functiei de apartenenta este=";

		 cout<<FuzzySet[i]->getValue(val);
         cout<<endl;
	  }
    cout<<endl;
    system("pause");
    system("cls");


    string t;

    std::cout << std::setw(20) << std::right << "_____________________________________________________" << std::endl;
    std::cout << std::setw(20) << std::right << "|  1)  | 2) |  3) |     4)    | 5) |  6)  |    7)   |" << std::endl;
    std::cout << std::setw(20) << std::right << "|foarte|rece|mediu|confortabil|cald|foarte|fierbinte|" << std::endl;
    std::cout << std::setw(20) << std::right << "| rece |    |     |           |    | cald |         |" << std::endl;
    std::cout << std::setw(20) << std::right << "|______|____|_____|___________|____|______|_________|" << std::endl;
    cout<<endl;
    cin>>t;

    cout<<endl;
    cout<<endl;


    SetColor(1);
    if((t=="foarte_rece")||(t=="1"))
        cout<<"\n Consum minim";


    else if((t=="rece")||(t=="2"))
    {
        SetColor(9);
        cout<<"\n Consum foarte mic";

    }

    else if((t=="mediu")||(t=="3"))
	{
        SetColor(11);
        cout<<"\n Consum redus";


    }

    else if((t=="confortabil")||(t=="4"))
    {
        SetColor(10);
        cout<<"\n Consum mediu";
    }

    else if((t=="cald")||(t=="5"))
    {
        SetColor(14);
        cout<<"\n Consum mare";
    }

    else if((t=="foarte_cald")||(t=="6"))
    {
        SetColor(12);
        cout<<"\n Consum foarte mare";
    }

    else if((t=="fierbinte")||(t=="7"))
    {
        SetColor(4);
        cout<<"\n Consum maxim";
    }
     else if((t=="exit")||(t=="x"))
    {
        cout<<"\n Iesire";
       return EXIT_SUCCESS;
       return 0;
    }



    cout<<endl;
    cout<<endl;
    system("pause");
    system("cls");
    SetColor(15);

	}

}
