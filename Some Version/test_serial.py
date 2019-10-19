#Driver Code:
import serial
s=serial.Serial('/dev/ttyACM0',9600)
s.flushInput()


text=''
while True:
    print(s.readline().decode('utf8').strip())


    
