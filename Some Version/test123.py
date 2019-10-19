from picamera import PiCamera
from time import sleep

camera=PiCamera()

a=input("Enter Currency")
for i in range(30):
    camera.capture(a+str(i)+".jpg")
    sleep(0.1)
    print(i)

print('done')
