


$(function () {
    $.getJSON('fulldata.php', function (data) {  

        $('#container1').highcharts({          
            chart: {
                zoomType: 'x'                 
            },
            title: {
                text: 'Temperature'
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
                
                // Premier yAxis
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

        }, { // Second yAxis

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
                name: 'Temperature Senzor 1',
                yAxis: 0,
                tooltip: {
                valueSuffix: ' °C'
            },              
                data: data[1].data     
            }, {
                type: 'spline',
                name: 'Temperature Senzor 2',
                yAxis: 1,
                tooltip: {
                valueSuffix: ' °C'
            },
                data: data[4].data    
            }]
        });
    });
});
        


