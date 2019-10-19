import h5py
import numpy as np
import os
import glob
import cv2
from matplotlib import pyplot
from sklearn.model_selection import train_test_split, cross_val_score
from sklearn.model_selection import KFold, StratifiedKFold
from sklearn.metrics import confusion_matrix, accuracy_score, classification_report
from sklearn.ensemble import RandomForestClassifier
from sklearn.externals import joblib

import serial

from picamera import PiCamera
from time import sleep


camera=PiCamera()

s=serial.Serial('/dev/ttyACM0',9600)
s.flushInput()

text=''

#Global Vars used
note_val=0


#
#
#Note Det
#
#

# feature-descriptor-1: Hu Moments
def fd_hu_moments(image):
    image = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
    feature = cv2.HuMoments(cv2.moments(image)).flatten()
    return feature

# feature-descriptor-2: Color Histogram
def fd_histogram(image, mask=None):
    # convert the image to HSV color-space
    image = cv2.cvtColor(image, cv2.COLOR_BGR2HSV)
    # compute the color histogram
    hist  = cv2.calcHist([image], [0, 1, 2], None, [bins, bins, bins], [0, 256, 0, 256, 0, 256])
    # normalize the histogram
    cv2.normalize(hist, hist)
    # return the histogram
    return hist.flatten()

# fixed-sizes for image
fixed_size = tuple((500, 500))

# path to training data
train_path = "dataset/train"

# no.of.trees for Random Forests
num_trees = 100

# bins for histogram
bins = 8

# train_test_split size
test_size = 0.10

# seed for reproducing same results
seed = 9

# get the training labels
train_labels = os.listdir(train_path)

# sort the training labels
train_labels.sort()
#del(train_labels[0]) #delete only if extra folder in list
#print(train_labels)

# empty lists to hold feature vectors and labels
global_features = []
labels = []

i, j = 0, 0
k = 0

# num of images per class
images_per_class = 9

# create all the machine learning models
models = []
models.append(('RF', RandomForestClassifier(n_estimators=num_trees, random_state=9)))

# variables to hold the results and names
results = []
names = []
scoring = "accuracy"

# import the feature vector and trained labels
h5f_data = h5py.File('output/data.h5', 'r')
h5f_label = h5py.File('output/labels.h5', 'r')

global_features_string = h5f_data['dataset_1']
global_labels_string = h5f_label['dataset_1']

global_features = np.array(global_features_string)
global_labels = np.array(global_labels_string)

h5f_data.close()
h5f_label.close()

# split the training and testing data
(trainDataGlobal, testDataGlobal, trainLabelsGlobal, testLabelsGlobal) = train_test_split(np.array(global_features),
                                                                                          np.array(global_labels),
                                                                                          test_size=test_size,
                                                                                          random_state=seed)
# filter all the warnings
import warnings
warnings.filterwarnings('ignore')

# 10-fold cross validation
for name, model in models:
    kfold = KFold(n_splits=10, random_state=7)
    cv_results = cross_val_score(model, trainDataGlobal, trainLabelsGlobal, cv=kfold, scoring=scoring)
    results.append(cv_results)
    names.append(name)
    msg = "%s: %f (%f)" % (name, cv_results.mean(), cv_results.std())
    #print(msg)
    
    
#-----------------------------------
# TESTING OUR MODEL
#-----------------------------------

# to visualize results
import matplotlib.pyplot as plt

# create the model - Random Forests
clf  = RandomForestClassifier(n_estimators=100, random_state=9)

# fit the training data to the model
clf.fit(trainDataGlobal, trainLabelsGlobal)

# path to test data
test_path = "dataset/test"

def detect():
    det_val=[]
    for i in l_names:
        image = cv2.imread(i)

        # resize the image
        image = cv2.resize(image, fixed_size)

        ####################################
        # Global Feature extraction
        ####################################
        fv_hu_moments = fd_hu_moments(image)
        fv_histogram  = fd_histogram(image)

        ###################################
        # Concatenate global features
        ###################################
        global_feature = np.hstack([fv_histogram, fv_hu_moments])

        # predict label of test image
        prediction = clf.predict(global_feature.reshape(1,-1))[0]    

        # show predicted label on image
        #cv2.putText(image, train_labels[prediction], (20,30), cv2.FONT_HERSHEY_SIMPLEX, 1.0, (0,255,255), 3)
        
        # display the output image
        #plt.imshow(cv2.cvtColor(image, cv2.COLOR_BGR2RGB))
        #plt.show()

        # print the predicted denomination

        #print(file," ",train_labels[prediction])
        #return(train_labels[prediction])
        det_val.append(train_labels[prediction])

    unq=[]
    for i in det_val:
        if i not in unq:
            unq.append(i)
    mx=0
    val=0

    for i in unq:
        if det_val.count(i)>mx:
            mx=det_val.count(i)
            val=i

    print(det_val)
    return val
            
    


#
#
#End of Note Det
#
#

l_names=[]

for i in range(3):
    l_names.append('test_img_'+str(i)+'.jpg')

print("Starting")
while True:
    #print(s.readline().decode('utf8')[:-1])
    if s.in_waiting:
        text=s.readline().decode('utf8').strip()
        print(text)
        #print(type(text))
        #Start Cycle

        if text=="S":
            
            #print("Inside")
            for i in l_names:
                camera.capture(i)

            print("Waiting")
            dcn=s.readline().decode('utf8').strip()
            while dcn not in ['In','Out']:
                dcn=s.readline().decode('utf8').strip()

            print("Yeah! Outside the loop!")
            note_val=detect()
            #print("Note Detected!(Hopefully)")
            print(note_val,dcn)
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
            


