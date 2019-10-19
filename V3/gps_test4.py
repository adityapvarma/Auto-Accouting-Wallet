import serial
import pynmea2

def parseGPS(strr):
    if strr.find('GGA') > 0:
        msg = pynmea2.parse(strr)
        print("Timestamp: %s -- Lat: %s %s -- Lon: %s %s -- Altitude: %s %s" % (msg.timestamp,msg.lat,msg.lat_dir,msg.lon,msg.lon_dir,msg.altitude,msg.altitude_units))

serialPort = serial.Serial("/dev/ttyAMA0", 9600, timeout=0.5)

while True:
    strr = serialPort.readline().decode("utf8").strip()
    parseGPS(strr)
