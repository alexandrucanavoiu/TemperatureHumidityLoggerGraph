# Temperature Humidity Logger Graph

## Description
The Humidity and Temperature are displayed in a nice format. You can access the data using a browser.
Possibility to configure humidity limits (high and low) to sensors. If sensor reading for humidity is outside the set limit boundaries, email warning is sent to.

## ScreenShots
[![ScreenShot 1](https://raw.githubusercontent.com/alexandrucanavoiu/TemperatureHumidityLoggerGraph/master/screenshot/dashboard.png "ScreenShot 1")](https://raw.githubusercontent.com/alexandrucanavoiu/TemperatureHumidityLoggerGraph/master/screenshot/dashboard.pn)
[![ScreenShot 2](https://raw.githubusercontent.com/alexandrucanavoiu/TemperatureHumidityLoggerGraph/master/screenshot/search.png "ScreenShot 1")](https://raw.githubusercontent.com/alexandrucanavoiu/TemperatureHumidityLoggerGraph/master/screenshot/search.png)

### Components needed to create a Humidity & Temperature Sensor with Raspberry Pi 3
*	1 x Raspberry Pi 3 + Power supply for the pi + SD memory card
*	2 x Sensor  DHT22
*	2 x 4.7 kOhm resistors
*	Lan cable

### Scheme
![Scheme](https://www.marketingromania.ro/github/humidityandtemp/0.jpg)

### Step 1: ( install apache + php on raspberry )

```
 sudo apt-get install apt-transport-https -y
 sudo apt-get install apache2 libapache2-mod-php -y
 sudo /etc/init.d/apache2 restart 
 sudo chown -R www-data:pi /var/www/html/
 sudo chmod -R 770 /var/www/html/
 ```

### Step 2:  Download Webiste / Sensor Library / DHT22-TemperatureLogger

```
 cd /home/pi/
 git clone https://github.com/alexandrucanavoiu/TemperatureHumidityLoggerGraph --branch v2.0
 cd TemperatureHumidityLoggerGraph
```
### Step 3: Modify the config of DHT22-TemperatureLogger
Go in DHT22-TemperatureLogger folder and edit config.json where you need to modify:

```

{
"mysql":[{
        "host":"localhost",
        "user":"temperatures",  // user of db mysql
        "password":"temperatures",  // password of db user
        "database":"temperatures" // db name
        }],
"sensors":[{
        "sensor1":"Senzor1",  // name of sensor 1
        "sensor2":"Senzor2" // name of sensor 2
        }],
"triggerlimits":[{
        "sensor1lowlimit":"15", // minimum threshold of temperature alert for sensor 1
        "sensor2lowlimit":"15",  // minimum threshold of temperature alert for sensor 2
        "sensor1highlimit":"25", // maximum threshold of temperature alert for sensor 1
        "sensor2highlimit":"25" // maximum threshold of temperature alert for sensor 2
        }],
"humiditytriggers":[{
        "sensor1_humidity_low_limit":"30", // minimum threshold of humidity alert for sensor 1
        "sensor1_humidity_high_limit":"60",  // maximum threshold of humidity alert for sensor 1
        "sensor2_humidity_low_limit":"30",  // minimum threshold of humidity alert for sensor 2
        "sensor2_humidity_high_limit":"60"  // maximum threshold of humidity alert for sensor 2
        }],
"sensorgpios":[{
        "gpiosensor1":"22",
        "gpiosensor2":"23"
        }],
"mailinfo":[{
        "senderaddress":" myemail@gmail.com",
        "receiveraddress":" myemail@gmail.com",
        "username":"myemail@gmail.com",
        "password":"passwordemail",
        "subjectmessage":"Info from temperature logger",
        "subjectwarning":"Warning from temperature logger"
        }],
"sqlBackupDump":[{
        "backupDumpEnabled":"y",
        "backupHour":"23"
        }],
"connectionCheck":[{
        "connectionCheckEnabled":"y",
        "connectionCheckDay":"5",
        "connectionCheckHour":"23"
        }],
"sensortype":"22",
"sensoramount":"2",
"sqlbackuppath":"/home/pi/TemperatureHumidityLoggerGraph/DHT22-TemperatureLogger/Backups/",
"adafruitpath":"/home/pi/TemperatureHumidityLoggerGraph/Adafruit_Python_DHT/examples/AdafruitDHT.py"

```


### Step 4 Mysql
* Create a user “temperature” with password “1234567890” in mysql 
* Import from TemperatureHumidityLoggerGraph/html the sql “temperatures.sql”

For security reason please change the password 1234567890 to other more strong and edit the files:
*	TemperatureHumidityLoggerGraph/html/.env
*	TemperatureHumidityLoggerGraph/DHT22-TemperatureLogger/

### Step 5: Create symlink for html to www folder
```
 $ ln -s /home/pi/TemperatureHumidityLoggerGraph/html /var/www/html/graph
 $ cd /var/www/html/graph
 $ composer update
 $ php artisan key:generate
```

 Now you can access the Graphic Page with : http://192.168.0.99/graph where the IP is the IP of your Raspberry Pi.

Access info:
Username: temperature@example.org
Password: 1234567890

### Step 6: Add in crontab to update the db with temperature and humidity every 1 min.

```
 * * * * * python /home/pi/TemperatureHumidityLoggerGraph/DHT22-TemperatureLogger/DHT22logger.py
 ```

