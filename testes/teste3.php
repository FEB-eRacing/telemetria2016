
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highstock Example</title>

		<script type="text/javascript" src="js/jquery.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function() {
	var datas = $( ".datas" ).toArray();
	var teste = $( ".teste" ).toArray();
	var data = new Array();
	for(var i = 0;i < teste.length; i++) {
		 data[i] = new Array();
		 partes = datas[i].value.split("-");
		 data[i][0] = Date.UTC(parseInt(partes[0]),parseInt(partes[1])-1,parseInt(partes[2]),parseInt(partes[3]),parseInt(partes[4]),parseInt(partes[5]));
		 data[i][1] = parseInt(teste[i].value);
	}
	var chart = $('#container').highcharts('StockChart', {
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: {
                second: '%d/%m/%Y<br/>%H:%M:%S',
                minute: '%d/%m/%Y<br/>%H:%M',
                hour: '%d/%m/%Y<br/>%H:%M',
                day: '%Y<br/>%d/%m',
                week: '%Y<br/>%d/%m',
                month: '%m/%Y',
                year: '%Y'
            }
        },
		title : {
			text : 'Velocidade'
		},
        rangeSelector: {
            enabled: false
        },
		credits: {
            enabled: false
        },
		scrollbar : {
			enabled : false
		},
		series : [{
			name : 'Velocidade',
			data : data,
            type: 'spline',
			tooltip: {
				valueDecimals: 1
			}
		}]
	});
});

		</script>
	</head>
	<body>
<script src="js/highstock.js"></script>
<?php
date_default_timezone_set('America/Sao_Paulo');
for($i=0;$i<10;$i++) {
	echo "<input type=\"hidden\" class=\"datas\" value=\"".date("Y-m-d-H-i-s", strtotime("-".(9-$i)." seconds"))."\" />";
	echo "<input type=\"hidden\" class=\"teste\" value=\"".rand(1,9)."\" />";
}
?>

<div id="container" style="height: 400px; min-width: 310px"></div>
	</body>
<span id="teste1"></span>