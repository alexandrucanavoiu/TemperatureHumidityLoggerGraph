<?php

	require_once("session.php");
	
	require_once("class.user.php");
	$auth_user = new USER();
	
	
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="style.css" type="text/css"  />
<link rel="stylesheet" href="lib/jquery-ui.css">
<link rel="stylesheet" href="lib/jquery-ui-timepicker-addon.css">
<script type="text/javascript" src="lib/jquery.js"></script> 
<script src="lib/jquery-ui.js"></script>
<script src="lib/jquery-ui-timepicker-addon.js"></script>
<script src="lib/highcharts.js"></script> 
<script src="lib/grid-light.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
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
    
            
        <p class="h4">Search by Data and Time</p> 
<div class="search-graph">
<div class="datastart">Date Start: <input type="text" id="datepicker1"></div>
<div class="datafinish">Date End: <input type="text" id="datepicker2"></div>
<div class="submit-search"><a href="#" id="js--submit" class="btn btn-primary">Submit</a></div>
</div>


    <div id="container1"></div> 





    <div id="container"></div> 

<script type='text/javascript'>


	$("#js--submit").on("click", function(e){
		var error = false;
		var msg = "";

		if($("#datepicker1").val().length !== 19 || $("#datepicker2").val().length !== 19){
			msg += "Wrong Date / Time Format! \n";
			error = true;

		}
		

		if(error){
			alert(msg);
			e.preventDefault();
			$('html, body').stop().animate({scrollTop: $("#messagebox").offset().top - 150}, 400);
			return false;
		}
	});
	
</script>


<script>
$(function() {
	
	var ONE_DAY = 1000 * 60 * 60 * 24;
    var ONE_HOUR = 1000 * 60 * 60;
    var ONE_MINUTE = 1000 * 60;


	
	
     $( "#datepicker1" ).datetimepicker({
			dateFormat: "yy-mm-dd",
			timeFormat: "HH:mm:ss"
		 });
	 $( "#datepicker2" ).datetimepicker({
		dateFormat: "yy-mm-dd",
		timeFormat: "HH:mm:ss"
	 });
	 
	 $("body").on("click", "#js--submit", function(){
		 var datestart = $( "#datepicker1" ).val();
		 var datefinish = $( "#datepicker2" ).val();
		 
		 	 

	$.getJSON( 'data.php', { datestart: datestart, datefinish: datefinish }, function (data) {    

			
        $('#container').highcharts({
            chart: {
                zoomType: 'x'
            },
            title: {
                text: 'humidity'
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
                text: 'humidity',
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

        }, { // Second yAxis

            title: {
                text: 'humidity',
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
	 
	 
});




</script>

    <p class="blockquote-reverse" style="margin-top:200px;">
   </a>
    </p>
    
    </div>

</div>

<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>