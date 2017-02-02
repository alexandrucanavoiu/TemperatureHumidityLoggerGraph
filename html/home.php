<?php

	require_once("session.php");
	
	require_once("class.user.php");
	$auth_user = new USER();
	
	
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	
	include 'dbvars.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="style.css" type="text/css"  />
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="lib/jquery.js"></script> 
<script  type="text/javascript" src="lib/highcharts.js"></script> 
<script  type="text/javascript" src="lib/grid-light.js"></script> 
<title>DataCenter Room Status</title>
</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">DataCenter Room Status</a>
        </div>

		<?php include_once('menu.php'); ?>
		
      </div>
    </nav>


    <div class="clearfix"></div>
    	
    
<div class="container-fluid" style="margin-top:80px;">
	
    <div class="container">
    
            
        <p class="h4"></p> 
       
<?php
		$sql = "SELECT * FROM temperaturedata WHERE `sensor` = 'Senzor1' ORDER BY id DESC LIMIT 1";
		$prep = $pdo->prepare($sql);
		$prep->execute();
		$sensor1 = $prep->fetchAll();
		
		$sql = "SELECT * FROM temperaturedata WHERE `sensor` = 'Senzor2' ORDER BY id DESC LIMIT 1";
		$prep = $pdo->prepare($sql);
		$prep->execute();
		$sensor2 = $prep->fetchAll();
		?>

		<div class="sensor-full">
<div class="sensor">
<div class="sensor-1">
<div class="info-sensor"><div class="sensor-img">Info Sensor #1</div></div>
<div class="grup-th">
<div class="info-temp"><div class="temp-img">Temperature: <span><?php echo $sensor1[0]['temperature'];?> °C</span></div></div>
<div class="info-hum"><div class="hum-img">Humidity: <span><?php echo $sensor1[0]['humidity'];?> %</span></div></div>
</div>
<div class="info-date"><?php echo $sensor1[0]['dateandtime']; ?></div>
</div>
</div>


<div class="sensor">
<div class="sensor-1">
<div class="info-sensor"><div class="sensor2-img">Info Sensor #2</div></div>
<div class="grup-th">
<div class="info-temp"><div class="temp-img">Temperature: <span><?php echo $sensor2[0]['temperature'];?> °C</span></div></div>
<div class="info-hum"><div class="hum-img">Humidity: <span><?php echo $sensor2[0]['humidity'];?> %</span></div></div>
</div>
<div class="info-date"><?php echo $sensor2[0]['dateandtime']; ?></div>
</div>
</div>
</div>


<div>
<p class="title-24">The Graph of the last 24 hours<p>
</div>

    <div id="container1"></div> 





    <div id="container"></div> 
        
    <p class="blockquote-reverse" style="margin-top:200px;">
   </a>
    </p>
    
    </div>

</div>

<script src="bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">

$(function () {
   $.getJSON( 'data24.php', function (data) {    

        $('#container').highcharts({
            chart: {
                zoomType: 'x'
            },
            title: {
                text: 'Humidity'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                        'Pinch the chart to zoom in' : 'Pinch the chart to zoom in'
            },
        tooltip: {
            shared: true
        },
            xAxis: {
                categories: data[0]['data']  
                },                           
yAxis: [{ 

            title: {
                text: 'Humidity',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },

            min : 30,
            max : 60,
            tooltip: {
                valueSuffix: ' %'
            },          
            labels: {
                format: '{value} %',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            }

        }, { 

            title: {
                text: 'Humidity',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            },
            min : 30,
            max : 60,
            tooltip: {
                valueSuffix: '%',
            },
            opposite: true,
            labels: {
                format: '{value} %',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            }

        }],
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -100,
                    y: 0,
                    floating: true,
                    borderWidth: 0
                },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                type: 'spline',
                name: 'Humidity Sensor 1',
                yAxis: 0,
                tooltip: {
                valueSuffix: ' %'
            },              
                data: data[2].data   
            }, {
                type: 'spline',
                name: 'Humidity Sensor 2',
                yAxis: 1,
                tooltip: {
                valueSuffix: ' %'   
            },
                data: data[5].data   
            }]
        });
    });
});




$(function () {
    $.getJSON( 'data24.php',  function (data) {  

        $('#container1').highcharts({         
            chart: {
                zoomType: 'x'                 
            },
            title: {
                text: 'temperature'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                        'Pinch the chart to zoom in' : 'Pinch the chart to zoom in'
            },
        tooltip: {                               
            shared: true
        }, 
        
        // le xAxis
            xAxis: {
                categories: data[0]['data']   
                },                          
                
                
            yAxis: [{ 

            title: {
                text: 'temperature',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },

            min : 15,
            max : 30,
            tooltip: {
                valueSuffix: ' °C'
            },          
            labels: {
                format: '{value} °C',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            }

        }, { 

            title: {
                text: 'temperature',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            },
            min : 15,
            max : 30,
            tooltip: {
                valueSuffix: '°C',
            },
            opposite: true,
            labels: {
                format: '{value} °C',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            }

        }],
                legend: {                           
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -100,
                    y: 0,
                    floating: true,
                    borderWidth: 0
                },
            plotOptions: {                        
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{                              
                type: 'spline',
                name: 'Temperature Sensor 1',
                yAxis: 0,
                tooltip: {
                valueSuffix: ' °C'
            },              
                data: data[1].data  
            }, {
                type: 'spline',
                name: 'Temperature Sensor 2',
                yAxis: 1,
                tooltip: {
                valueSuffix: ' °C'
            },
                data: data[4].data 
            }]
        });
    });
});
        





</script>
</body>
</html>