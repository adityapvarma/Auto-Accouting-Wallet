from picamera import PiCamera
from time import sleep

camera=PiCamera()

for i in range(10):
    camera.capture(str(i)+".jpg")
    sleep(0.5)

print('done')
