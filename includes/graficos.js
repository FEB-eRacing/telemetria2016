$(function () {
	$(document).ready(function() {
		Highcharts.setOptions({
			global: {
				useUTC: false
			}
		});
	
		var chart;
		
		$('#container-mapa').highcharts({
			chart: {
				type: 'bubble',
				plotBorderWidth: 1,
				plotBackgroundImage: 'imagens/pista.png'
			},
			title: {
				text: ''
			},
			exporting: {
				enabled: false
			},
			credits: {
				enabled: false
			},
			legend: {
				enabled: false
			},
			tooltip: {
				enabled: false
			},
			yAxis: {
				title: {
					text: ''
				},
				floor: 0,
				tickWidth: 0,
				max: 100,
				tickmarkPlacement: 'on',
				minTickInterval: 100,
				labels: {
					enabled: false
				}
			},
			xAxis: {
				floor: 0,
				max: 100,
				tickWidth: 0,
				minRange: 100,
				tickmarkPlacement: 'on',
				minTickInterval: 100,
				labels: {
					enabled: false
				}
			},
			
			plotOptions: {
				bubble: {
					//minSize: 3,
					//maxSize: 50,
					zMin: 0,
					zMax: 100
				},
			},
		
			series: [{
				data: [[79,62,1]],
				color: '#cccccc',
				marker: {
					fillOpacity:1
				},
			}]
		
		});
		$('#container-forcaG').highcharts({
			chart: {
				type: 'bubble',
				plotBorderWidth: 1,
				plotBackgroundImage: 'http://3.bp.blogspot.com/_7EjrZ1HgTpw/S9ti5aho5tI/AAAAAAAAASs/P-B1SKDkYJs/s1600/5.PNG'
			},
			title: {
				text: ''
			},
			exporting: {
				enabled: false
			},
			credits: {
				enabled: false
			},
			legend: {
				enabled: false
			},
			tooltip: {
				enabled: false
			},
			yAxis: {
				title: {
					text: ''
				},
				floor: 0,
				tickWidth: 0,
				max: 100,
				tickmarkPlacement: 'on',
				minTickInterval: 100,
				labels: {
					enabled: false
				}
			},
			xAxis: {
				floor: 0,
				max: 100,
				tickWidth: 0,
				minRange: 100,
				tickmarkPlacement: 'on',
				minTickInterval: 100,
				labels: {
					enabled: false
				}
			},
			plotOptions: {
				bubble: {
					//minSize: 3,
					//maxSize: 50,
					zMin: 0,
					zMax: 100
				}
			},
			series: [{
				data: [[79,60,1]],
				color: '#ffffff',
				marker: {
					fillOpacity:1
				},
			}]
		});
		var gaugeOptions = {
		
			chart: {
				type: 'solidgauge'
			},
			
			title: null,
			
			pane: {
				center: ['50%', '85%'],
				size: '100%',
				startAngle: -90,
				endAngle: 90,
				background: {
					backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
					innerRadius: '60%',
					outerRadius: '100%',
					shape: 'arc'
				}
			},
	
			tooltip: {
				enabled: false
			},
			
			// the value axis
			yAxis: {
				stops: [
					[0.1, '#55BF3B'], // green
					[0.5, '#DDDF0D'], // yellow
					[0.9, '#DF5353'] // red
				],
				lineWidth: 0,
				minorTickInterval: null,
				tickPixelInterval: 400,
				tickWidth: 0,
				title: {
					y: -70
				},
				labels: {
					y: 16
				}        
			},
			
			plotOptions: {
				solidgauge: {
					dataLabels: {
						y: 5,
						borderWidth: 0,
						useHTML: true
					}
				}
			}
		};
		$('#container-velocidade').highcharts(Highcharts.merge(gaugeOptions, {
			yAxis: {
				min: 0,
				max: 200,
				title: {
					text: 'Velocidade'
				}       
			},
	
			credits: {
				enabled: false
			},
		
			series: [{
				name: 'Velocidade',
				data: [0],
				dataLabels: {
					format: '<div style="text-align:center"><span style="font-size:25px;color:' + 
						((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' + 
						'<span style="font-size:12px;color:silver">km/h</span></div>'
				},
				tooltip: {
					valueSuffix: ' km/h'
				}
			}]
		
		}));
		$('#container-velocidadeXtempo').highcharts({
			chart: {
				type: 'spline',
				animation: Highcharts.svg, // don't animate in old IE
				marginRight: 10
			},
			title: {
				text: 'Velocidade'
			},
			credits: {
				enabled: false
			},
			xAxis: {
				type: 'datetime',
				tickPixelInterval: 150
			},
			yAxis: {
				plotLines: [{
					value: 0,
					width: 1,
					color: '#808080'
				}],
				tickPositions: [0, 50, 100, 150, 200]
			},
			tooltip: {
				formatter: function() {
						return '<b>'+ this.series.name +'</b><br/>'+
						Highcharts.dateFormat('%d/%m/%Y %H:%M:%S', this.x) +'<br/>'+
						Highcharts.numberFormat(this.y, 2);
				}
			},
			legend: {
				enabled: false
			},
			exporting: {
				enabled: false
			},
			plotOptions: {
				spline: {
					lineWidth: 4,
					states: {
						hover: {
							lineWidth: 5
						}
					},
					marker: {
						enabled: false
					},
					pointInterval: 3600000, // one hour
					pointStart: Date.UTC(2009, 9, 6, 0, 0, 0)
				}
			},
			series: [{
				name: 'Velocidade',
				data: (function() {
					var data = [],
						time = (new Date()).getTime(),
						i;
	    
					for (i = -19; i <= 0; i++) {
						data.push({
							x: time + i * 1000,
							y: 0
						});
					}
					return data;
				})()
			}]
		});
		$('#container-rotacao').highcharts(Highcharts.merge(gaugeOptions, {
			yAxis: {
				min: 0,
				max: 5,
				title: {
					text: 'RPM'
				}       
			},
			credits: {
				enabled: false
			},
		
			series: [{
				name: 'RPM',
				data: [0],
				dataLabels: {
					format: '<div style="text-align:center"><span style="font-size:25px;color:' + 
						((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y:.1f}</span><br/>' + 
						'<span style="font-size:12px;color:silver">* 1000 / min</span></div>'
				},
				tooltip: {
					valueSuffix: ' revoluções/min'
				}      
			}]
		
		}));
		$('#container-rotacaoXtempo').highcharts({
			chart: {
				type: 'spline',
				animation: Highcharts.svg,
				marginRight: 10
			},
			title: {
				text: 'Rotação do motor'
			},
			credits: {
				enabled: false
			},
			xAxis: {
				type: 'datetime',
				tickPixelInterval: 150
			},
			yAxis: {
				plotLines: [{
					value: 0,
					width: 1,
					color: '#808080'
				}],
				tickPositions: [0, 1000, 2000, 3000, 4000]
			},
			tooltip: {
				formatter: function() {
						return '<b>'+ this.series.name +'</b><br/>'+
						Highcharts.dateFormat('%d/%m/%Y %H:%M:%S', this.x) +'<br/>'+
						Highcharts.numberFormat(this.y, 2);
				}
			},
			legend: {
				enabled: false
			},
			exporting: {
				enabled: false
			},
			plotOptions: {
				spline: {
					lineWidth: 4,
					states: {
						hover: {
							lineWidth: 5
						}
					},
					marker: {
						enabled: false
					},
					pointInterval: 3600000, // one hour
					pointStart: Date.UTC(2009, 9, 6, 0, 0, 0)
				}
			},
			series: [{
				name: 'rotação',
				data: (function() {
					var data = [],
						time = (new Date()).getTime(),
						i;
	
					for (i = -19; i <= 0; i++) {
						data.push({
							x: time + i * 1000,
							y: 0
						});
					}
					return data;
				})()
			}]
		});
		$('#container-rotacaoEVelocidadeXtempo').highcharts({
			chart: {
				type: 'spline',
				animation: Highcharts.svg,
				marginRight: 200
			},
			title: {
				text: ''
			},
			credits: {
				enabled: false
			},
			xAxis: {
				type: 'datetime',
				tickPixelInterval: 150
			},
			yAxis: [{
				lineWidth: 1,
				title: {
					text: 'Velocidade'
				},
				tickPositions: [0, 50, 100, 150, 200]
			}, {
				lineWidth: 1,
				opposite: true,
				title: {
					text: 'Rotação'
				},
				tickPositions: [0, 1000, 2000, 3000, 4000]
			}, {
				lineWidth: 1,
				opposite: true,
				offset: 70,
				tickLength: 10,
				tickWidth: 1,
				title: {
					text: 'Temperatura'
				},
				tickPositions: [0, 25, 50, 75, 100]
			}],
			tooltip: {
				formatter: function() {
						return '<b>'+ this.series.name +'</b><br/>'+
						Highcharts.dateFormat('%d/%m/%Y %H:%M:%S', this.x) +'<br/>'+
						Highcharts.numberFormat(this.y, 2);
				}
			},
			exporting: {
				enabled: false
			},
			plotOptions: {
				spline: {
					lineWidth: 4,
					states: {
						hover: {
							lineWidth: 5
						}
					},
					marker: {
						enabled: false
					},
					pointInterval: 3600000, // one hour
					pointStart: Date.UTC(2009, 9, 6, 0, 0, 0)
				}
			},
			tooltip: {
				valueDecimals: 0
			},
			series: [{
				name: 'Velocidade',
				yAxis: 0,
				data: (function() {
					var data = [],
						time = (new Date()).getTime(),
						i;
	
					for (i = -19; i <= 0; i++) {
						data.push({
							x: time + i * 1000,
							y: 0
						});
					}
					return data;
				})()
			}, {
				name: 'Rotação',
				yAxis: 1,
				data: (function() {
					var data = [],
						time = (new Date()).getTime(),
						i;
	
					for (i = -19; i <= 0; i++) {
						data.push({
							x: time + i * 1000,
							y: 0
						});
					}
					return data;
				})()        
			}, {
				name: 'Temperatura',
				yAxis: 2,
				data: (function() {
					var data = [],
						time = (new Date()).getTime(),
						i;
	
					for (i = -19; i <= 0; i++) {
						data.push({
							x: time + i * 1000,
							y: 0
						});
					}
					return data;
				})()        
			}]
		});
		var i = 0;
		var coordenadas = [[79,62,1],[81,60,1],[83,58,1],[85,56,1],[87,54,1],[89,52,1],[91,50,1],[92,48,1],[93,46,1],
							[93,44,1],[92,42,1],[91,40,1],[89,38,1],[87,36,1],[85,34,1],[84,32,1],[82,30,1],[80,28,1],
							[78,26,1],[77,24,1],[75,22,1],[74,20,1],[72,18,1],[70,16,1],[69,14,1],[67,12,1],[65,10,1],
							[63,9,1],[61,8,1],[59,7.5,1],[57,7,1],[55,6.5,1],[51,6.1,1],[46,5.6,1],[41,5.2,1],[36,4.8,1],
							[30,4.5,1],[26,4.2,1],[22,4.1,1],[18,4,1],[15,4,1],[13,4.2,1],[11,4.4,1],[9.5,6,1],[8.5,8,1],
							[7.5,10,1],[7.5,13,1],[7.5,17,1],[7.5,22,1],[7.5,27,1],[7.5,32,1],[7.6,37,1],[7.6,42,1],[7.6,47,1],
							[7.7,52,1],[7.7,57,1],[7.7,62,1],[7.7,67,1],[7.7,72,1],[7.8,77,1],[7.8,82,1],[7.8,87,1],[7.9,89,1],
							[8.6,91,1],[9.9,93,1],[12,95,1],[15,96,1],[18,96,1],[23,96,1],[28,96,1],[33,96,1],[38,96,1],[43,96,1],
							[46,96,1],[48,94,1],[50,92,1],[52,90,1],[54,88,1],[56,86,1],[58,84,1],[60,82,1],[62,80,1],[64,78,1],
							[66,76,1],[68,74,1],[70,72,1],[72,70,1],[74,68,1],[77,64,1]];
		setInterval(function () {
			if(!(document.getElementById("erro").hasChildNodes())) {
				var velocidade = document.getElementById('velocidade').value;
				var chart = $('#container-velocidade').highcharts();
				if (chart) {
					chart.series[0].points[0].update(parseInt(velocidade));
				}
				var chart = $('#container-velocidadeXtempo').highcharts();
				if (chart) {
					var x = (new Date()).getTime(), // current time
						y = parseInt(velocidade);
					chart.series[0].addPoint([x, y], true, true);
				}
				var contagiro = document.getElementById('contagiro').value;
				chart = $('#container-rotacao').highcharts();
				if (chart) {
					chart.series[0].points[0].update(parseFloat(contagiro/1000));
				}
				chart = $('#container-rotacaoXtempo').highcharts();
				if (chart) {
					var x = (new Date()).getTime(),
						y = parseInt(contagiro);
					chart.series[0].addPoint([x, y], true, true);
				}
				var chart = $('#container-mapa').highcharts();
				if (chart) {
					chart.series[0].points[0].update(coordenadas[i]);
					i++;
					if(i==coordenadas.length) {
						i=0;
					}
				}
				var chart = $('#container-forcaG').highcharts();
				var forcaGX = document.getElementById('forcaGX').value;
				var forcaGY = document.getElementById('forcaGY').value;
				if (chart) {
					//chart.series[0].points[0].update([parseInt(Math.random()*100),parseInt(Math.random()*100),1]);
					chart.series[0].points[0].update([parseInt(forcaGX),parseInt(forcaGY),1]);
				}
				chart = $('#container-rotacaoEVelocidadeXtempo').highcharts();
				if (chart) {
					var x = (new Date()).getTime(),
						y1 = parseInt(velocidade);
						y2 = parseInt(contagiro);
					chart.series[0].addPoint([x, y1], true, true);
					chart.series[1].addPoint([x, y2], true, true);
					chart.series[2].addPoint([x, eval(y1/3)], true, true);
				}
			}
		}, 1000);
	});
});

function requererDados() {
	var url="includes/sql.php?inf=coletar";
	requisicaoHTTP('GET',url,true);
}
var t = setInterval('requererDados()',500);

function trataDados() {
	var info = "";
	var meuXML = ajax.responseXML;
	if(meuXML) {
		var raiz = meuXML.documentElement;
		var nodos;
		var cod;
		if(raiz.hasChildNodes()) {
			nodos = raiz.childNodes;
			for(var i=0; i<nodos.length ; i++) {
				if(nodos[i].hasChildNodes()) {
					var name = nodos[i].nodeName;
					if(name) {
						if(name=="velocidade") {
							velocidade = nodos[i].firstChild.nodeValue;
							if(velocidade) {
								document.getElementById('velocidade').value = velocidade;
							}
						}
						if(name=="contagiro") {
							contagiro = nodos[i].firstChild.nodeValue;
							if(contagiro) {
								document.getElementById('contagiro').value = contagiro;
							}
						}
						if(name=="tempo") {
							tempo = nodos[i].firstChild.nodeValue;
							if(tempo) {
								document.getElementById('tempo').value = tempo;
							}
						}
						if(name=="posicaoX") {
							posicaoX = nodos[i].firstChild.nodeValue;
							if(posicaoX) {
								document.getElementById('posicaoX').value = posicaoX;
							}
						}
						if(name=="posicaoY") {
							posicaoY = nodos[i].firstChild.nodeValue;
							if(posicaoY) {
								document.getElementById('posicaoY').value = posicaoY;
							}
						}
						if(name=="forcaGX") {
							forcaGX = nodos[i].firstChild.nodeValue;
							if(forcaGX) {
								document.getElementById('forcaGX').value = forcaGX;
							}
						}
						if(name=="forcaGY") {
							forcaGY = nodos[i].firstChild.nodeValue;
							if(forcaGY) {
								document.getElementById('forcaGY').value = forcaGY;
							}
						}
						if(name=="resposta") {
							resposta = nodos[i].firstChild.nodeValue;
							if(resposta) {
								alert(resposta);
							}
						}
					} else {
						document.getElementById("erro").innerHTML = '<font color="red"><b>Problema na comunica\u00e7\u00e3o com o carro.</b></font>';
					}
				}
			}
		}
		if(document.getElementById("erro").hasChildNodes()) {
			document.getElementById("erro").removeChild(document.getElementById("erro").childNodes[0]);
		}
	} else {
		document.getElementById("erro").innerHTML = '<font color="red"><b>Problema na comunica\u00e7\u00e3o com o carro.</b></font>';
	}
}