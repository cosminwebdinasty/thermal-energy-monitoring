import serial 
import MySQLdb

db = MySQLdb.connect(host="localhost",    # your host, usually localhost
                     user="root",         # your username
                     passwd="",  # your password
                     db="proiect")        # name of the data base



#Deschide cursor catre BD
cursor = db.cursor()

device = 'COM3' #Portul corespunzator la care este conectat Arduino
try:
  print "Incercare...",device
  arduino = serial.Serial('COM3', 9600) 
except: 
  print "Nu s-a putut realiza conexiunea!",device    
 
try: 
  data = arduino.readline()  #Citeste date de la Arduino
  pieces = data.split("\t")  #Separare date prin tab
  #Inserare date in BD
  try:
    cursor.execute("INSERT INTO datesenzor (temperatura,energia) VALUES (%s,%s)", (pieces[0],pieces[1]))
    db.commit() #Executa inserarea
    cursor.close()  #Inchide cursor
  except MySQLdb.IntegrityError:
    print "Nu s-au putut introduce date"
  finally:
    cursor.close()  #Inchide cursor in caz de esec
except:
  print "Nu s-au putut prelua date de la Arduino!"
