var count = 0;
var coordenadas = [[22.737298,47.534347,1],[22.737631,47.534053,1],[22.737821,47.533886,1],[22.738014,47.533741,1],
					[22.738332,47.533883,1],[22.738683,47.534069,1],[22.738757,47.534409,1],[22.738781,47.534747,1],
					[22.738341,47.534826,1],[22.737861,47.534864,1],[22.737314,47.534886,1],[22.737221,47.534439,1]];
var load;
var dashBoard;
var loading = "<br /><center><div class='loader'></div></center>";
function atualizaDadosDashboardGrafico() {
	//$('#container-mapa').highcharts().series[0].points[0].update([parseFloat(-100*(coordenadas[count][1]-47.533557)/(47.534997-47.533557)+100),
	//															parseFloat(-100*(coordenadas[count][0]-22.737139)/(22.738836-22.737139)+100),
	//															coordenadas[count][2]]);
	//count++;
	//if(count==coordenadas.length)
	//	count=0;
	
	var x = document.getElementsByClassName("listaIdSensores");
	var id = new Array();
	var maximo = new Array();
	var minimo = new Array();
	var aleatorio = new Array();
	var valores = new Array();
	for (var i = 0; i < x.length; i++)
		id[i] = x[i].value;
	$.post( "includes/sql.php",{acao:"aquisitaDadosDashboard",'ids[]':id},function( dados ) {
		var arr = JSON.parse(dados);
		var data = (new Date()).getTime();
		for(i = 0; i < arr.length; i++) {
			//alert(arr[i].DAD_DATA_DT);
			//alert(new Date().getTime());
			if(arr[i].DAD_VAL_IN)
				$('#container-tempo').highcharts().series[i].addPoint([data,parseFloat(eval(arr[i].DAD_VAL_IN))],true,true,false);
			else
				$('#container-tempo').highcharts().series[i].addPoint([data,-1],true,true,false);
		}
	});
}
function atualizaDadosDashboardPonteiro() {
	//$('#container-mapa').highcharts().series[0].points[0].update([parseFloat(-100*(coordenadas[count][1]-47.533557)/(47.534997-47.533557)+100),
	//															parseFloat(-100*(coordenadas[count][0]-22.737139)/(22.738836-22.737139)+100),
	//															coordenadas[count][2]]);
	//count++;
	//if(count==coordenadas.length)
	//	count=0;
	
	var x = document.getElementsByClassName("container");
	var id = new Array();
	var maximo = new Array();
	var minimo = new Array();
	var aleatorio = new Array();
	for (var i = 0; i < x.length; i++)
		id[i] = x[i].id.split("-")[1];
	$.post( "includes/sql.php",{acao:"aquisitaDadosDashboard",'ids[]':id},function( dados ) {
		var arr = JSON.parse(dados);
		var data = (new Date()).getTime();
		for(i = 0; i < arr.length; i++) {
			arr[i].DAD_VAL_IN = parseFloat(eval(arr[i].DAD_VAL_IN));
			if(arr[i].DAD_VAL_IN>=0)
				$('#'+x[i].id).highcharts().series[0].points[0].update(arr[i].DAD_VAL_IN);
			else
				$('#'+x[i].id).highcharts().series[0].points[0].update(null);
		}
	});
}
function abrirPagina(url) {
	clearInterval(dashBoard);
	if(load) {
		load.abort();
		load = null;
	}
	document.getElementById("conteudo").innerHTML = loading;
	load = $.post( url,function( mensagem ) {
		document.getElementById('conteudo').innerHTML = mensagem;
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		$( "#dialog" ).dialog({
			autoOpen: false,
			height: 595,
			width: 1250,
			modal: true,
			close: function() {
				var div = document.getElementById('dialog');
				if ( div.hasChildNodes() ) {
					while ( div.childNodes.length >= 1 ) {
						div.removeChild( div.firstChild );
					}
				}
			}
		});
		$( ".dialog" ).dialog({
			autoOpen: false,
			height: 120,
			width: 550,
			modal: true,
			close: function() {
				while ( this.childNodes.length > 0 ) 
					this.removeChild( this.firstChild );
			}
		});
		$( ".selectmenu" ).selectmenu({
			width: 180,
			change: function( event, ui ) {
				mudaAcesso(this.parentElement.parentElement.id,this.value);
			}
		});
		$( "button",".button").button();
		$( ".checkbox" ).checkboxradio();
		$(":file").jfilestyle({buttonText: "Imagem"});
		$( ".accordion" ).accordion();
	});
}
function abrirPaginaDashBoardGrafico(url) {
	clearInterval(dashBoard);
	if(load) {
		load.abort();
		load = null;
	}
	document.getElementById("conteudo").innerHTML = loading;
	load = $.post( url,function( mensagem ) {
		document.getElementById('conteudo').innerHTML = mensagem;
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		$( "#dialog" ).dialog({
			autoOpen: false,
			height: 595,
			width: 1250,
			modal: true,
			close: function() {
				var div = document.getElementById('dialog');
				if ( div.hasChildNodes() ) {
					while ( div.childNodes.length >= 1 ) {
						div.removeChild( div.firstChild );
					}
				}
			}
		});
		
		//$('#container-mapa').highcharts({
		//	chart: {
		//		type: 'bubble',
		//		plotBorderWidth: 1,
		//		plotBackgroundImage: 'imagens/pista1Cortada.png'
		//	},
		//	title: {
		//		text: ''
		//	},
		//	exporting: {
		//		enabled: false
		//	},
		//	credits: {
		//		enabled: false
		//	},
		//	legend: {
		//		enabled: false
		//	},
		//	tooltip: {
		//		enabled: false
		//	},
		//	yAxis: {
		//		title: {
		//			text: ''
		//		},
		//		floor: 0,
		//		tickWidth: 0,
		//		max: 100,
		//		tickmarkPlacement: 'on',
		//		minTickInterval: 100,
		//		labels: {
		//			enabled: false
		//		}
		//	},
		//	xAxis: {
		//		floor: 0,
		//		max: 100,
		//		tickWidth: 0,
		//		minRange: 100,
		//		tickmarkPlacement: 'on',
		//		minTickInterval: 100,
		//		labels: {
		//			enabled: false
		//		}
		//	},
		//	
		//	plotOptions: {
		//		bubble: {
		//			//minSize: 3,
		//			//maxSize: 50,
		//			zMin: 0,
		//			zMax: 100
		//		},
		//	},
		//
		//	series: [{
		//		data: [[1,99,1]],
		//		color: '#cccccc',
		//		marker: {
		//			fillOpacity:1
		//		},
		//	}]
		//
		//});
		var chart;
		var x = document.getElementsByClassName("listaIdSensores");
		var sensores = new Array();
		var unidades = new Array();
		var maximos = new Array();
		var minimos = new Array();
		for (var i = 0; i < x.length; i++) {
			var id = x[i].value;
			var sensor = document.getElementById('sensor'+id).value;
			var unidade = document.getElementById('unidade'+id).value;
			var maximo = parseInt(document.getElementById('maximo'+id).value);
			var minimo = parseInt(document.getElementById('minimo'+id).value);
			sensores[i] = sensor;
			unidades[i] = unidade;
			maximos[i] = maximo;
			minimos[i] = minimo;
		}
		var id = new Array();
		var sensor = new Array();
		var propriedadesSensor = new Array();
		for(var count=0;count<x.length;count++) {
			sensor.push({
				name: document.getElementById('sensor'+x[count].value).value,
				yAxis:count,
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
			});
			propriedadesSensor.push({
				title: {
					text: sensores[count]
				},
				tickPositions: [minimos[count], (maximos[count]-minimos[count])/4, (maximos[count]-minimos[count])*2/4, (maximos[count]-minimos[count])*3/4, maximos[count]],
				visible: false
			});
		}
		$('#container-tempo').highcharts({
			chart: {
				type: 'spline',
				animation: Highcharts.svg,
				marginRight: 10
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
			yAxis:propriedadesSensor,
			tooltip: {
				valueDecimals: 0,
				formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					Highcharts.dateFormat('%H:%M:%S', this.x) +'<br/>'+
					Highcharts.numberFormat(this.y, 0);
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
					}
				}
			},
			series: sensor
		});
		dashBoard = setInterval(atualizaDadosDashboardGrafico,500);
	});
}
function abrirPaginaDashBoardPonteiro(url) {
	clearInterval(dashBoard);
	if(load) {
		load.abort();
		load = null;
	}
	document.getElementById("conteudo").innerHTML = loading;
	load = $.post( url,function( mensagem ) {
		document.getElementById('conteudo').innerHTML = mensagem;
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		$( "#dialog" ).dialog({
			autoOpen: false,
			height: 595,
			width: 1250,
			modal: true,
			close: function() {
				var div = document.getElementById('dialog');
				if ( div.hasChildNodes() ) {
					while ( div.childNodes.length >= 1 ) {
						div.removeChild( div.firstChild );
					}
				}
			}
		});
		
		//$('#container-mapa').highcharts({
		//	chart: {
		//		type: 'bubble',
		//		plotBorderWidth: 1,
		//		plotBackgroundImage: 'imagens/pista1Cortada.png'
		//	},
		//	title: {
		//		text: ''
		//	},
		//	exporting: {
		//		enabled: false
		//	},
		//	credits: {
		//		enabled: false
		//	},
		//	legend: {
		//		enabled: false
		//	},
		//	tooltip: {
		//		enabled: false
		//	},
		//	yAxis: {
		//		title: {
		//			text: ''
		//		},
		//		floor: 0,
		//		tickWidth: 0,
		//		max: 100,
		//		tickmarkPlacement: 'on',
		//		minTickInterval: 100,
		//		labels: {
		//			enabled: false
		//		}
		//	},
		//	xAxis: {
		//		floor: 0,
		//		max: 100,
		//		tickWidth: 0,
		//		minRange: 100,
		//		tickmarkPlacement: 'on',
		//		minTickInterval: 100,
		//		labels: {
		//			enabled: false
		//		}
		//	},
		//	
		//	plotOptions: {
		//		bubble: {
		//			//minSize: 3,
		//			//maxSize: 50,
		//			zMin: 0,
		//			zMax: 100
		//		},
		//	},
		//
		//	series: [{
		//		data: [[1,99,1]],
		//		color: '#cccccc',
		//		marker: {
		//			fillOpacity:1
		//		},
		//	}]
		//
		//});
		Highcharts.setOptions({
			global: {
				useUTC: false
			}
		});
		var chart;
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
		var x = document.getElementsByClassName("container");
		var sensores = new Array();
		var unidades = new Array();
		var maximos = new Array();
		var minimos = new Array();
		for (var i = 0; i < x.length; i++) {
			var id = x[i].id.split("-")[1];
			var sensor = document.getElementById('sensor'+id).value;
			var unidade = document.getElementById('unidade'+id).value;
			var maximo = parseInt(document.getElementById('maximo'+id).value);
			var minimo = parseInt(document.getElementById('minimo'+id).value);
			sensores[i] = sensor;
			unidades[i] = unidade;
			maximos[i] = maximo;
			minimos[i] = minimo;
			$('#'+x[i].id).highcharts(Highcharts.merge(gaugeOptions, {
				yAxis: {
					min: minimo,
					max: maximo,
					title: {
						text: sensor
					}       
				},
				credits: {
					enabled: false
				},
				series: [{
					name: sensor,
					data: [minimo],
					dataLabels: {
						format: '<div style="text-align:center"><span style="font-size:25px;color:' + 
							((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' + 
							'<span style="font-size:12px;color:silver">'+unidade+'</span></div>'
					},
					tooltip: {
						valueSuffix: ' '+unidade
					}
				}]
			}));
		}
		dashBoard = setInterval(atualizaDadosDashboardPonteiro,500);
	});
}
function abrirPaginaHistorico(url) {
	clearInterval(dashBoard);
	if(load) {
		load.abort();
		load = null;
	}
	document.getElementById("conteudo").innerHTML = loading;
	load = $.post( url,function( mensagem ) {
		document.getElementById('conteudo').innerHTML = mensagem;
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		$( "#dialog" ).dialog({
			autoOpen: false,
			height: 595,
			width: 1250,
			modal: true,
			close: function() {
				var div = document.getElementById('dialog');
				if ( div.hasChildNodes() ) {
					while ( div.childNodes.length >= 1 ) {
						div.removeChild( div.firstChild );
					}
				}
			}
		});
		
		//
		var numeroSensores = document.getElementById('numeroSensores').value;
		var datas = $( ".datas" ).toArray();
		var propriedadesSensor = new Array();
		var seriesSensor = new Array();
		for(var i = 0;i<numeroSensores;i++) {
			var sensor = document.getElementById('sensor'+i).value;
			var unidade = document.getElementById('unidade'+i).value;
			var maximo = parseInt(document.getElementById('maximo'+i).value);
			var minimo = parseInt(document.getElementById('minimo'+i).value);
			
			var dados = $( ".dados"+i ).toArray();
			var data = new Array();
			for(var j = 0;j < datas.length; j++) {
				data[j] = new Array();
				var partes = datas[j].value.split("-");
				data[j][0] = Date.UTC(parseInt(partes[0]),parseInt(partes[1])-1,parseInt(partes[2]),parseInt(partes[3]),parseInt(partes[4]),parseInt(partes[5]));
				if(dados[j].value)
					data[j][1] = parseFloat(eval(dados[j].value));
				else
					data[j][1] = 0;
			}
			
			seriesSensor.push({
				name: sensor,
				data : data,
				type: 'spline',
				tooltip: {
					valueDecimals: 0
				}
			});
			propriedadesSensor.push({
				title: {
					text: sensor
				},
				tickPositions: [minimo, (maximo-minimo)/4, (maximo-minimo)*2/4, (maximo-minimo)*3/4, maximo],
				visible: false
			});
		}
		$('#container-historico').highcharts('StockChart', {
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
			rangeSelector: {
				enabled: false
			},
			credits: {
				enabled: false
			},
			scrollbar : {
				enabled : false
			},
			yAxis: propriedadesSensor,
			plotOptions: {
				series: {
					point: {
						events: {
							mouseOver: function () {
								//atualizaGraficos(this.x,this.y);
							}
						}
					},
					events: {
						mouseOut: function () {
						}
					}
				}
			},
			tooltip: {
				formatter: function () {
					var s = '<b>' + Highcharts.dateFormat('%d/%m/%Y %H:%M:%S', this.x) + '</b>';
					$.each(this.points, function () {
						s += '<br/><span style="color:'+this.series.color+'">'+this.series.name+'</span>: ';
						s += '<b>' + Highcharts.numberFormat(this.y, 0) + '</b>';
					});
					return s;
				}
			},
			series : seriesSensor
		});
	});
}