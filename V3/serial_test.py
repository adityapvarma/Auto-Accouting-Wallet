import serial
s=serial.Serial('/dev/ttyACM0',9600)
s.flushInput()

while True:
    if s.in_waiting:
        text=s.readline().decode('utf8').strip()
        print(text)
