


$(function () {
    $.getJSON('fulldata.php', function (data) {    

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

        }, { // Second yAxis

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
       


