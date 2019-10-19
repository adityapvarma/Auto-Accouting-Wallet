#Driver Code V1
import cv2
from sklearn.cluster import KMeans
import numpy as np
import matplotlib.pyplot as plt

import serial

from picamera import PiCamera
from time import sleep

import MySQLdb as mdb

db=mdb.connect(host="localhost", user="root", passwd='', db='tarpdb')
c=db.cursor()

camera=PiCamera()

s=serial.Serial('/dev/ttyACM0',9600)
s.flushInput()



text=''

#Global Vars used
note_val=0

#Note Det Part

class DominantColors:

    CLUSTERS = None
    IMAGE = None
    COLORS = None
    LABELS = None
    
    def __init__(self, image, clusters=3):
        self.CLUSTERS = clusters
        self.IMAGE = image
        
    def dominantColors(self):
    
        #read image
        img = cv2.imread(self.IMAGE)
        
        #convert to rgb from bgr
        img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
                
        #reshaping to a list of pixels
        img = img.reshape((img.shape[0] * img.shape[1], 3))
        
        #save image after operations
        self.IMAGE = img
        
        #using k-means to cluster pixels
        kmeans = KMeans(n_clusters = self.CLUSTERS)
        kmeans.fit(img)
        
        #the cluster centers are our dominant colors.
        self.COLORS = kmeans.cluster_centers_
        
        #save labels
        self.LABELS = kmeans.labels_
        
        #returning after converting to integer from float
        return self.COLORS.astype(int)

def limits(l,m,n,o,p,q,r):
    l = [[],[],[]]
    for i in range(m,n+1):
        l[0].append(i)
    for j in range(o,p+1):
        l[1].append(j)
    for k in range(q,r+1):
        l[2].append(k)
    return l

ten = []
ten = limits(ten, 95,105, 110,120, 115,125 )
#twenty = []
#twenty = limits(twenty,100,130,110,120,140,125)
fifty = []
fifty = limits(fifty, 100,130, 120,140, 65,105 )
#cent = []
#cent = limits(cent,95,105,110,120,115,125)
two = []
two = limits(two, 100,120, 105,120, 100,135 )
five = []
five = limits(five, 100,115, 119,130, 105,130 )
#twok = []
#twok = limits(twok,95,105,110,120,115,125)

def tester(img):
    global note_val
    #create dataset from test image
    clusters = 1
    dc = DominantColors(img, clusters) 
    colors = dc.dominantColors()

    #create list from RGB values
    test_l = []
    test_l.append(colors[0][0])
    test_l.append(colors[0][1])
    test_l.append(colors[0][2])
    print(test_l)

    #compare test data with threshold values
    if (test_l[0] in ten[0]) and (test_l[1] in ten[1]) and (test_l[2] in ten[2]):
        print("10")
        note_val=10
    #elif (test_l[0] in twenty[0]) and (test_l[1] in twenty[1]) and (test_l[2] in twenty[2]):
        #print("20")
    elif (test_l[0] in fifty[0]) and (test_l[1] in fifty[1]) and (test_l[2] in fifty[2]):
        print("50")
        note_val=50
    #elif (test_l[0] in cent[0]) and (test_l[1] in cent[1]) and (test_l[2] in cent[2]):
        #print("100")
    elif (test_l[0] in five[0]) and (test_l[1] in five[1]) and (test_l[2] in five[2]):
        print("500")
        note_val=500
    elif (test_l[0] in two[0]) and (test_l[1] in two[1]) and (test_l[2] in two[2]):
        print("200")
        note_val=200
    #elif (test_l[0] in twok[0]) and (test_l[1] in twok[1]) and (test_l[2] in twok[2]):
        #print("2000")
    else:
        print("NA")
        note_val='NA'


print("Starting")
while True:
    #print(s.readline().decode('utf8')[:-1])
    if s.in_waiting:
        text=s.readline().decode('utf8').strip()
        print(text)
        #print(type(text))
        #Start Cycle
        if text=="S":
            print("Inside")
            camera.capture('test_img.jpg')

            print("Waiting")
            while not s.in_waiting:
                dcn=s.readline().decode('utf8').strip()

            tester('test_img.jpg')

            c.execute("Select SNo from testtable;")
            c.fetchall()
            sno_l=[]
            for i in c:
                sno_l.append(i)
            sno_last=sno_l[-1][0]

            if dcn=="In":
                #Query for In
                c.execute("insert into testtable(SNo,In,Out,Location,Timestamp) values (%s,%s,%s,%s,%s);",(sno_last+1,note_val,0,null,default))
                db.commit()
                
            elif dcn=="Out":
                #Query for Out
                c.execute("insert into testtable(SNo,In,Out,Location,Timestamp) values (%s,%s,%s,%s,%s);",(sno_last+1,0,note_val,null,default))
                db.commit()

            else:
                pass


            
            
            
        
        
        

        
