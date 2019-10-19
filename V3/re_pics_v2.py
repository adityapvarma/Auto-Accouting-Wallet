import serial

from picamera import PiCamera
from time import sleep


camera=PiCamera()

s=serial.Serial('/dev/ttyACM0',9600)
s.flushInput()

text=''

#Global Vars used
note_val=0

print("Starting")
a=input("Enter Currency ")
while True:
    #print(s.readline().decode('utf8')[:-1])
    if s.in_waiting:
        text=s.readline().decode('utf8').strip()
        print(text)
        #print(type(text))
        #Start Cycle

        if text=="S":
            
            #print("Inside")
            for i in range(20):
                camera.capture(str(a)+"_"+str(i)+".jpg")
                print(i)

            print("Waiting")
            dcn=s.readline().decode('utf8').strip()
            while dcn not in ['In','Out']:
                dcn=s.readline().decode('utf8').strip()

            print("Yeah! Outside the loop!")
            #print("Note Detected!(Hopefully)")
            print(dcn)
            '''
            if dcn=="In":
                pass
                #Query for In
                #c.execute("insert into testtable(SNo,In,Out,Location,Timestamp) values (%s,%s,%s,%s,%s);",(sno_last+1,note_val,0,null,default))
                #db.commit()
                
            elif dcn=="Out":
                pass
                #Query for Out
                #c.execute("insert into testtable(SNo,In,Out,Location,Timestamp) values (%s,%s,%s,%s,%s);",(sno_last+1,0,note_val,null,default))
                #db.commit()

            else:
                pass
            '''
            


