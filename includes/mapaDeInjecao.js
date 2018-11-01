function incluirOuEditarEstrategia(cod) {
	document.getElementById('operacoesEstrategiasMotor').innerHTML = loading;
	$.post( 'includes/cadModEstrategiasMotor.php',{cod:cod},function( mensagem ) {
		document.getElementById('operacoesEstrategiasMotor').innerHTML = mensagem;
		geraGrafico3DMapa('Inj');
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
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
	});
}
function estrategiaEscolhida(EST_MOT_IN_ID) {
	$.post( 'includes/sql.php',{acao:"estrategiaEscolhida",EST_MOT_IN_ID:EST_MOT_IN_ID},function( mensagem ) {
		dialogEstrategias('Mensagem',120,400,'<br /><center>'+mensagem+'</center>');
	});
}
function dialogEstrategiasMotor(titulo,height,width,mensagem) {
	document.getElementById("dialog-estrategiaMotor").innerHTML = mensagem;
	$("#dialog-estrategiaMotor").dialog("option","title",titulo );
	$("#dialog-estrategiaMotor").dialog("option","height", height );
	$("#dialog-estrategiaMotor").dialog("option","width", width );
	$("#dialog-estrategiaMotor").dialog("option","position", { my: "center top", at: "center top", of: window } );
	$("#dialog-estrategiaMotor").dialog("open");
}
function dialogEstrategias(titulo,height,width,mensagem) {
	document.getElementById("dialog-estrategia").innerHTML = mensagem;
	$("#dialog-estrategia").dialog("option","title",titulo );
	$("#dialog-estrategia").dialog("option","height", height );
	$("#dialog-estrategia").dialog("option","width", width );
	$("#dialog-estrategia").dialog("option","position", { my: "center top", at: "center top", of: window } );
	$("#dialog-estrategia").dialog("open");
}
function salvarEstrategia() {
	var verificarPreenchimento = document.getElementsByClassName('verificarPreenchimento');
	var todosPreenchidos = true;
	for(var i=0;i<verificarPreenchimento.length&&todosPreenchidos;i++)
		if(!verificarPreenchimento[i].value)
			todosPreenchidos = false;
	if(todosPreenchidos) {
		var enderecoROMMapaInj = new Array();
		var enderecoROMMapaIgn = new Array();
		var enderecoROMMapaLamb = new Array();
		var enderecoROMParametros = new Array();
		var valMapaInj = new Array();
		var valMapaIgn = new Array();
		var valMapaLamb = new Array();
		var valMapaParametros = new Array();
		for(i=1;i<122;i++) {
			enderecoROMMapaInj.push(verificarPreenchimento[i].name)
			valMapaInj.push(parseFloat(verificarPreenchimento[i].value)*10)
		}
		for(i=122;i<243;i++) {
			enderecoROMMapaIgn.push(verificarPreenchimento[i].name)
			valMapaIgn.push(verificarPreenchimento[i].value)
		}
		for(i=243;i<364;i++) {
			enderecoROMMapaLamb.push(verificarPreenchimento[i].name)
			valMapaLamb.push(verificarPreenchimento[i].value)
		}
		for(i=364;i<verificarPreenchimento.length;i++) {
			enderecoROMParametros.push(verificarPreenchimento[i].name)
			if(verificarPreenchimento[i].name==364
			|| verificarPreenchimento[i].name==365
			|| verificarPreenchimento[i].name==366
			|| verificarPreenchimento[i].name==367
			|| verificarPreenchimento[i].name==368
			|| verificarPreenchimento[i].name==369
			|| verificarPreenchimento[i].name==370
			|| verificarPreenchimento[i].name==374)
				valMapaParametros.push(parseInt(parseFloat(verificarPreenchimento[i].value)*10))
			else if(verificarPreenchimento[i].name==363)
				valMapaParametros.push(parseInt(parseInt(verificarPreenchimento[i].value)/100))
			else
				valMapaParametros.push(verificarPreenchimento[i].value)
		}
		$.post( 'includes/sql.php',{acao:"salvarEstrategia",
									EST_MOT_NOM_VC:verificarPreenchimento[0].value,
									'enderecoROMMapaInj[]':enderecoROMMapaInj,
									'valMapaInj[]':valMapaInj,
									'enderecoROMMapaIgn[]':enderecoROMMapaIgn,
									'valMapaIgn[]':valMapaIgn,
									'enderecoROMMapaLamb[]':enderecoROMMapaLamb,
									'valMapaLamb[]':valMapaLamb,
									'enderecoROMParametros[]':enderecoROMParametros,
									'valMapaParametros[]':valMapaParametros},function( mensagem ) {
			dialogEstrategiasMotor('Mensagem',120,400,'<br /><center>'+mensagem+'</center>');
			if(mensagem=='Cadastro efetuado com sucesso.')
				abrirPagina('includes/mapaDeInjecao.php');
		});
	} else
		dialogEstrategiasMotor('Mensagem',120,400,'<br /><center>Todas os campos devem estar preenchidos.</center>');
}
function validarValorGenerico(minimo,maximo,casasDecimais,obj,cod) {
	var valor = obj.value;
	if((valor>=minimo && valor<=maximo) && valor) {
		valor = Math.round(valor*(Math.pow(10,casasDecimais)))/(Math.pow(10,casasDecimais));
		obj.value = valor;
		atualizaParametroEstrategiaMotor(Math.round(valor*(Math.pow(10,casasDecimais))),obj.name,cod,obj);
	} else {
		obj.value = '';
		obj.focus();
	}
}
function validaValorMapaInj(obj,cod) {
	var valor = obj.value;
	if((valor>=0 && valor<=20) && valor) {
		obj.value = parseFloat(Math.round(valor*10)/10);
		geraGrafico3DMapa('Inj');
		atualizaParametroEstrategiaMotor(Math.round(valor*10),obj.name,cod,obj);
	} else {
		obj.value = '';
		obj.style.backgroundColor = 'rgb(255,255,255)';
		obj.style.color = 'rgb(0,0,0)';
		obj.focus();
	}
}
function validaValorMapaIgn(obj,cod) {
	var valor = obj.value;
	if((valor>=0 && valor<=120) && valor) {
		obj.value = parseInt(Math.round(valor));
		geraGrafico3DMapa('Ign');
		atualizaParametroEstrategiaMotor(valor,obj.name,cod,obj);
	} else {
		obj.value = '';
		obj.style.backgroundColor = 'rgb(255,255,255)';
		obj.style.color = 'rgb(0,0,0)';
		obj.focus();
	}
}
function validaValorMapaLamb(obj,cod) {
	var valor = obj.value;
	if((valor>=0 && valor<=1) && valor) {
		obj.value = parseInt(Math.round(valor));
		geraGrafico3DMapa('Lamb');
		atualizaParametroEstrategiaMotor(valor,obj.name,cod,obj);
	} else {
		obj.value = '';
		obj.style.backgroundColor = 'rgb(255,255,255)';
		obj.style.color = 'rgb(0,0,0)';
		obj.focus();
	}
}
function atualizaNomeEstrategiaMotor(valor,cod) {
	if(cod>0) {
		if(valor)
			$.post( 'includes/sql.php',{acao:"atualizaNomeEstrategiaMotor",
										EST_MOT_NOM_VC:valor,
										cod:cod},function( mensagem ) {
				if(mensagem!='Atualizado com sucesso.')
					dialogEstrategiasMotor('Mensagem',120,400,'<br /><center>'+mensagem+'</center>');
				else
					document.getElementById('estrategia'+cod).childNodes[0].childNodes[0].childNodes[1].value = valor;
			});
		else
			dialogEstrategiasMotor('Mensagem',120,400,'<br /><center>Não é possível alterar o nome da estratégia para nulo.</center>');
	}
}
function atualizaParametroEstrategiaMotor(valor,endereco,cod,obj) {
	if(cod>0) {
		$.post( 'includes/sql.php',{acao:"atualizaParametroEstrategiaMotor",
									PAR_MOT_VAL_IN:valor,
									PAR_MOT_END_IN:endereco,
									EST_MOT_IN_ID:cod},function( mensagem ) {
			if(mensagem!='Atualizado com sucesso.') {
				dialogEstrategiasMotor('Mensagem',120,400,'<br /><center>'+mensagem+'</center>');
				obj.focus();
			}
		});
	}
}
function geraGrafico3DMapa(tipo) {
	var graficoMapa = document.getElementById('graficoMapa'+tipo);
	var dados = new Array();
	var valor;
	var maximo;
	var minimo;
	for(var i=0;i<11;i++) {
		dados[i] = new Array();
		for(var j=0;j<11;j++) {
			valor = document.getElementById('celulaMapa'+tipo+i+'-'+j).value;
			if(!valor)
				valor = 0;
			dados[i][j] = parseFloat(valor);
			if(i==0 && j==0) {
				maximo = dados[i][j];
				minimo = dados[i][j];
			}
			if(dados[i][j]>maximo)
				maximo = dados[i][j];
			if(dados[i][j]<minimo)
				minimo = dados[i][j];
		}
	}
	for(var i=0;i<11;i++)
		for(var j=0;j<11;j++) {
			valor = document.getElementById('celulaMapa'+tipo+i+'-'+j).value;
			if(valor) {
				if(maximo==minimo)
					document.getElementById('celulaMapa'+tipo+i+'-'+j).style.backgroundColor = 'rgb(180,180,180)';
				else if(valor<(maximo+minimo)/2)
					document.getElementById('celulaMapa'+tipo+i+'-'+j).style.backgroundColor = 'rgb(0,'+parseInt(eval(255-255*(maximo-valor)/(maximo-minimo)))+',255)';
				else if(valor>(maximo+minimo)/2)
					document.getElementById('celulaMapa'+tipo+i+'-'+j).style.backgroundColor = 'rgb(255,'+parseInt(eval(255-255*(valor-minimo)/(maximo-minimo)))+',0)';
				else
					document.getElementById('celulaMapa'+tipo+i+'-'+j).style.backgroundColor = 'rgb(180,180,180)';
				document.getElementById('celulaMapa'+tipo+i+'-'+j).style.color = 'rgb(255,255,255)';
			} else {
				document.getElementById('celulaMapa'+tipo+i+'-'+j).style.backgroundColor = 'rgb(255,255,255)';
				document.getElementById('celulaMapa'+tipo+i+'-'+j).style.color = 'rgb(0,0,0)';
			}
		}
	
	var data = [{
       x: [0,1000,2000,3000,4000,5000,6000,7000,8000,9000,10000],
       y: [0,10,20,30,40,50,60,70,80,90,100],
       z: dados,
       type: 'surface'
    }];
  
	var layout = {
		autosize: false,
		width: 500,
		height: 500,
		margin: {
			l: 65,
			r: 50,
			b: 10,
			t: 10,
		}
	};
	Plotly.newPlot(graficoMapa, data, layout, {displayModeBar: false});
}
function confirmaExclusaoEstrategia(cod) {
	var centro = document.createElement('center');
	var div = document.createElement('span');
	div.setAttribute('align','center');
	div.setAttribute('class','button');
	var excluir = document.createElement('button');
	excluir.setAttribute('onClick','excluiEstrategia('+cod+')');
	excluir.innerHTML = 'Excluir';
	div.appendChild(excluir);
	div.innerHTML += '&nbsp;&nbsp;&nbsp;';
	var div2 = document.createElement('span');
	div2.setAttribute('align','center');
	div2.setAttribute('class','button');
	var cancelar = document.createElement('button');
	cancelar.setAttribute('onClick','$("#dialog-estrategia").dialog("close");');
	cancelar.innerHTML = 'Cancelar';
	div2.appendChild(cancelar);
	centro.appendChild(document.createElement('br'));
	centro.appendChild(div);
	centro.appendChild(div2);
	document.getElementById('dialog-estrategia').appendChild(centro);
	$("#dialog-estrategia").dialog("option","title","Tem certeza?" );
	$("#dialog-estrategia").dialog("option","height", 140 );
	$("#dialog-estrategia").dialog("option","width", 300 );
	$("#dialog-estrategia").dialog("option","position", { my: "center top", at: "center top", of: window } );
	$("#dialog-estrategia").dialog("open");
	$( "button",".button").button();
}
function excluiEstrategia(cod) {
	$("#dialog-estrategia").dialog("close");
	$.post( "includes/sql.php",{acao:"excluiEstrategia",cod:cod},function( mensagem ) {
		dialogEstrategias('Mensagem',120,400,'<br /><center>'+mensagem+'</center>');
		if(mensagem=='Estratégia excluída com sucesso.') {
			document.getElementById('estrategia'+cod).parentElement.removeChild(document.getElementById('estrategia'+cod));
			document.getElementById('operacoesEstrategiasMotor').innerHTML = '';
		}
	});
}