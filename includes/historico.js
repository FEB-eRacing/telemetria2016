function atualizaGraficos(x,y) {
	//alert('x: ' + x + ', y2: ' + y);
}
$(function() {
	//var numeroSensores = document.getElementById('numeroSensores').value;
	//var datas = $( ".datas" ).toArray();
	//var propriedadesSensor = new Array();
	//var seriesSensor = new Array();
	//for(var i = 0;i<numeroSensores;$i++) {
	//	var sensor = document.getElementById('sensor'+i).value;alert(sensor)
	//	var unidade = document.getElementById('unidade'+i).value;
	//	var maximo = parseInt(document.getElementById('maximo'+i).value);
	//	var minimo = parseInt(document.getElementById('minimo'+i).value);
	//	
	//	var dados = $( ".dados"+i ).toArray();
	//	var data = new Array();
	//	for(var j = 0;j < dados.length; j++) {
	//		data[j] = new Array();
	//		partes = datas[j].value.split("-");
	//		data[j][0] = Date.UTC(parseInt(partes[0]),parseInt(partes[1])-1,parseInt(partes[2]),parseInt(partes[3]),parseInt(partes[4]),parseInt(partes[5]));
	//		data[j][1] = parseInt(dados[j].value);
	//	}
	//	 
	//	seriesSensor.push({
	//		name: sensor,
	//		data : data,
    //        type: 'spline',
	//		tooltip: {
	//			valueDecimals: 0
	//		}
	//	});
	//	propriedadesSensor.push({
	//		title: {
	//			text: sensor
	//		},
	//		tickPositions: [minimo, (maximo-minimo)/4, (maximo-minimo)*2/4, (maximo-minimo)*3/4, maximo]
	//	});
	//}
	////var data = new Array();
	////var data2 = new Array();
	////for(var i = 0;i < teste.length; i++) {
	////	 data[i] = new Array();
	////	 data2[i] = new Array();
	////	 partes = datas[i].value.split("-");
	////	 data[i][0] = Date.UTC(parseInt(partes[0]),parseInt(partes[1])-1,parseInt(partes[2]),parseInt(partes[3]),parseInt(partes[4]),parseInt(partes[5]));
	////	 data[i][1] = parseInt(teste[i].value);
	////	 data2[i][0] = Date.UTC(parseInt(partes[0]),parseInt(partes[1])-1,parseInt(partes[2]),parseInt(partes[3]),parseInt(partes[4]),parseInt(partes[5]));
	////	 data2[i][1] = eval(parseInt(teste[i].value)*3);
	////}
	//
	//var chart = $('#container-historico').highcharts('StockChart', {
    //    xAxis: {
    //        type: 'datetime',
    //        dateTimeLabelFormats: {
    //            second: '%d/%m/%Y<br/>%H:%M:%S',
    //            minute: '%d/%m/%Y<br/>%H:%M',
    //            hour: '%d/%m/%Y<br/>%H:%M',
    //            day: '%Y<br/>%d/%m',
    //            week: '%Y<br/>%d/%m',
    //            month: '%m/%Y',
    //            year: '%Y'
    //        }
    //    },
	//	title : {
	//		text : 'Historico'
	//	},
    //    rangeSelector: {
    //        enabled: false
    //    },
	//	credits: {
    //        enabled: false
    //    },
	//	scrollbar : {
	//		enabled : false
	//	},
	//	yAxis: propriedadesSensor,
	//	//yAxis: [{
	//	//	lineWidth: 1,
	//	//	opposite: false,
	//	//	title: {
	//	//		text: 'Velocidade'
	//	//	},
	//	//	tickPositions: [0, 50, 100, 150, 200]
	//	//}, {
	//	//	lineWidth: 1,
	//	//	opposite: true,
	//	//	title: {
	//	//		text: 'Rotação'
	//	//	},
	//	//	tickPositions: [0, 1000, 2000, 3000, 4000]
	//	//}, {
	//	//	lineWidth: 1,
	//	//	opposite: true,
    //    //    offset: 80,
    //    //    tickLength: 10,
    //    //    tickWidth: 1,
	//	//	title: {
	//	//		text: 'Temperatura'
	//	//	},
	//	//	tickPositions: [0, 1000, 2000, 3000, 4000]
	//	//}],
    //    plotOptions: {
    //        series: {
    //            point: {
    //                events: {
    //                    mouseOver: function () {
    //                        //atualizaGraficos(this.x,this.y);
    //                    }
    //                }
    //            },
    //            events: {
    //                mouseOut: function () {
    //                }
    //            }
    //        }
    //    },
	//	series : seriesSensor
	//	//series : [{
	//	//	name : 'Velocidade',
	//	//	data : data,
    //    //    type: 'spline',
	//	//	tooltip: {
	//	//		valueDecimals: 1
	//	//	}
	//	//}, {
	//	//	name : 'Rotação',
	//	//	data : data2,
    //    //    type: 'spline',
	//	//	tooltip: {
	//	//		valueDecimals: 1
	//	//	}
	//	//}]
	//});
});