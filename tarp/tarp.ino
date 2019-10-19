int s1=0;
int s2=0;
int c=0;

int ld1=10;
int ld2=10;

int first_trig=0;
int first_rel=0;
int a=0;
int b=0;

void setup()
{
  Serial.begin(9600);
  pinMode(A0,INPUT);
  pinMode(A1,INPUT);
}

void loop()
{
  delay(1000);
  s1 = analogRead(A0);
  s2 = analogRead(A1);

while((s1<ld1)&&(s2<ld2))
{
    s1=analogRead(A0);
    s2=analogRead(A1);
    delay(100);
}
  
first_trig=1;
//Serial.println("xxxxxxxxxxxxxxxxxxxxxxxxxxx");

if (s1>ld1)
{
  a=1;
  //Serial.println("a1");
}

else if (s2>ld2)
{
  a=2;
  //Serial.println("a2");

}

while(1)
{
  s1 = analogRead(A0);
  s2 = analogRead(A1);
  
  if((s1>ld1)&&(s2>ld2))
  {
    Serial.println("S");
    break;
  }
}

while((s1>ld1)&&(s2>ld2))
{
   s1 = analogRead(A0);
   s2 = analogRead(A1);
   delay(100);
}

first_rel=1;



if(s1<ld1)
{
  b=1;
  //Serial.println("b1");
}
else if(s2<ld2)
{
  b=2;
 //Serial.println("b2");
}
while(1)
{
  s1 = analogRead(A0);
  s2 = analogRead(A1);
 
  if((s1<ld1)&&(s2<ld2))
    break;
}

if(first_trig==first_rel)
{
  //Serial.println("zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz");
  
  if((a==1)&&(b==1))  
    Serial.println("Out");
  
  else if((a==2)&&(b==2))
    Serial.println("In");
  
  else
  {
     while((s1>ld1)||(s2>ld2))
     {
        s1 = analogRead(A0);
        s2 = analogRead(A1);
        if((s1<ld1)&&(s2<ld2))
          break;
      }
    
    Serial.println("R");
  }
}

a=0;
b=0;

}
