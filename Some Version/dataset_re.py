#Driver Code V1
import cv2
'''
from sklearn.cluster import KMeans
import numpy as np
import matplotlib.pyplot as plt
'''
import serial

from picamera import PiCamera
from time import sleep

camera=PiCamera()

s=serial.Serial('/dev/ttyACM0',9600)
s.flushInput()
print('test')
text=''
a=input("Enter Note:")

print("Starting")
while True:
    #print(s.readline().decode('utf8')[:-1])
    if s.in_waiting:
        text=s.readline().decode('utf8').strip()
        print(text)
        print(type(text))
        #Start Cycle
        if text=="S":
            print("Inside")
            for i in range(40):
                camera.capture(a+'_test_img_'+str(i)+'.jpg')
                print(a+'_test_img_'+str(i)+'.jpg')
                #tester('test_img.jpg')
            print("Done")
            a=input("Enter Note:")

            
        
        
        

        
