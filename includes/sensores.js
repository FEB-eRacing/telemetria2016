function dialogSensores(titulo,height,width) {
	$("#dialog").dialog("option","title",titulo );
	$("#dialog").dialog("option","height", height );
	$("#dialog").dialog("option","width", width );
	$("#dialog").dialog("option","position", { my: "center top", at: "center top", of: window } );
	$("#dialog").dialog("open");
}
function mostraDialogCarregando() {
	$( "#dialog" ).dialog( "close" );
	centro = document.createElement('center');
	centro.appendChild(document.createElement('br'));
	centro.innerHTML += "<img src='includes/carregando.gif' />";
	document.getElementById('dialog').appendChild(centro);
	dialogSensores('Carregando',120,300);
}
function salvaSensor(cod) {
	var valSensor = document.getElementById('valSensor').value;
	var valUnidade = document.getElementById('valUnidade').value;
	var valCodigo = document.getElementById('valCodigo').value;
	var valFrequencia = document.getElementById('valFrequencia').value;
	var valMaximo = document.getElementById('valMaximo').value;
	var valMinimo = document.getElementById('valMinimo').value;
	var valFtrans = document.getElementById('valFtrans').value;
	var valTipo = document.getElementById('valTipo').value;
	var tipoAcessoSensor = document.getElementById('tipoAcessoSensor');
	var int = 0;
	var checkeds = new Array();
	for(var i=0;i<tipoAcessoSensor.childNodes.length;i++) {
		if(tipoAcessoSensor.childNodes[i].checked) {
			checkeds[int] = tipoAcessoSensor.childNodes[i].value;
			int++;
		}
	}
	if(cod>0)
		$.post( "includes/sql.php",{acao:"updateSensor",
									cod:cod,
									valSensor:valSensor,
									valUnidade:valUnidade,
									valCodigo:valCodigo,
									valFrequencia:valFrequencia,
									valMaximo:valMaximo,
									valMinimo:valMinimo,
									valFtrans:valFtrans,
									valTipo:valTipo,
									'checkeds[]':checkeds
									},function( dados ) {
			var arr = JSON.parse(dados);
			if(arr[0].resposta=='Sensor alterado com sucesso.') {
				document.getElementById(cod).childNodes[0].childNodes[0].childNodes[1].childNodes[0].innerHTML = valCodigo;
				document.getElementById(cod).childNodes[0].childNodes[0].childNodes[2].childNodes[0].innerHTML = valSensor;
			}
			$("#dialog").dialog("close");
			var centro = document.createElement('center');
			centro.appendChild(document.createElement('br'));
			centro.innerHTML += arr[0].resposta;
			document.getElementById('dialog').appendChild(centro);
			dialogSensores('Aviso',120,300);
		});
	else
		$.post( "includes/sql.php",{acao:"insertSensor",
									valSensor:valSensor,
									valUnidade:valUnidade,
									valCodigo:valCodigo,
									valFrequencia:valFrequencia,
									valMaximo:valMaximo,
									valMinimo:valMinimo,
									valFtrans:valFtrans,
									valTipo:valTipo,
									'checkeds[]':checkeds
									},function( dados ) {
			var arr = JSON.parse(dados);
			var resposta = arr[0].resposta;
			if(resposta=='Sensor cadastrado com sucesso.') {
				var cod = arr[0].cod;
				var tabela = document.getElementById('sensores');
				var linha = tabela.insertRow(0);
				linha.setAttribute('id',cod);
				var celula1 = linha.insertCell(0);
				celula1.setAttribute('style','text-align:center;padding:1');
				var div  = '<div class="input-group">';
					div += 		'<span class="input-group-addon">';
					div += 			'<input type="checkbox" CHECKED  onClick="ativaOuDesativaSensor(this.checked,'+cod+')" />';
					div += 		'</span>';
					div += 		'<span class="input-group-addon"><div style="width:40px">'+valCodigo+'</div></span>';
					div += 		'<span class="input-group-addon"><div style="width:400px">'+valSensor+'</div></span>';
					div += 		'<div class="input-group-btn">';
					div += 			'<button class="btn btn-default btn-lg" type="button" title="Editar" onClick="editarSensor('+cod+')">';
					div += 				'<span class="ui-icon ui-icon-pencil">';
					div += 				'</span>';
					div += 			'</button>';
					div += 			'<button class="btn btn-default btn-lg" type="button" title="Excluir" onClick="confirmaExclusaoSensor('+cod+')">';
					div += 				'<span class="ui-icon ui-icon-trash">';
					div += 				'</span>';
					div += 			'</button>';
					div += 		'</div>';
					div += '</div>';
				celula1.innerHTML = div;
			}
			$("#dialog").dialog("close");
			var centro = document.createElement('center');
			centro.appendChild(document.createElement('br'));
			centro.innerHTML += resposta;
			document.getElementById('dialog').appendChild(centro);
			dialogSensores('Aviso',120,300);
		});
}
function telaDeEdicaoDeSensor(titulo,cod) {
	mostraDialogCarregando();
	$.post( "includes/sql.php",{acao:"selecionaDadosSensor",cod:cod},function( dados ) {
		var arr = JSON.parse(dados);
		var valSensor = arr[0].valSensor;
		var valUnidade = arr[0].valUnidade;
		var valCodigo = arr[0].valCodigo;
		var valFrequencia = arr[0].valFrequencia;
		var valMaximo = arr[0].valMaximo;
		var valMinimo = arr[0].valMinimo;
		var valFtrans = arr[0].valFtrans;
		var valTipo = arr[0].valTipo;
		$.post( "includes/sql.php",{acao:"selecionaTipoAcessoOperadorSensor",cod:cod},function( dados ) {
			var centro = document.createElement('center');
			var tabela = document.createElement('tabela');
			centro.appendChild(tabela);
			
			var sensor = document.createElement('input');
			sensor.setAttribute('class','ui-state-default ui-corner-all');
			sensor.setAttribute('type','text');
			sensor.setAttribute('style','width:300px');
			sensor.setAttribute('maxlength','100');
			sensor.setAttribute('id','valSensor');
			sensor.setAttribute('value',valSensor);
			var unidade = document.createElement('input');
			unidade.setAttribute('class','ui-state-default ui-corner-all');
			unidade.setAttribute('type','text');
			unidade.setAttribute('style','width:300px');
			unidade.setAttribute('maxlength','30');
			unidade.setAttribute('id','valUnidade');
			unidade.setAttribute('value',valUnidade);
			var codigo = document.createElement('input');
			codigo.setAttribute('class','ui-state-default ui-corner-all');
			codigo.setAttribute('type','number');
			codigo.setAttribute('style','width:300px');
			codigo.setAttribute('maxlength','4');
			codigo.setAttribute('min','0');
			codigo.setAttribute('max','9999');
			codigo.setAttribute('id','valCodigo');
			codigo.setAttribute('value',valCodigo);
			var frequencia = document.createElement('input');
			frequencia.setAttribute('class','ui-state-default ui-corner-all');
			frequencia.setAttribute('type','number');
			frequencia.setAttribute('style','width:300px');
			frequencia.setAttribute('maxlength','4');
			frequencia.setAttribute('min','0');
			frequencia.setAttribute('max','9999');
			frequencia.setAttribute('id','valFrequencia');
			frequencia.setAttribute('value',valFrequencia);
			var maximo = document.createElement('input');
			maximo.setAttribute('class','ui-state-default ui-corner-all');
			maximo.setAttribute('type','number');
			maximo.setAttribute('style','width:300px');
			maximo.setAttribute('maxlength','4');
			maximo.setAttribute('min','0');
			maximo.setAttribute('max','9999');
			maximo.setAttribute('id','valMaximo');
			maximo.setAttribute('value',valMaximo);
			var minimo = document.createElement('input');
			minimo.setAttribute('class','ui-state-default ui-corner-all');
			minimo.setAttribute('type','number');
			minimo.setAttribute('style','width:300px');
			minimo.setAttribute('maxlength','4');
			minimo.setAttribute('min','0');
			minimo.setAttribute('max','9999');
			minimo.setAttribute('id','valMinimo');
			minimo.setAttribute('value',valMinimo);
			var fTrans = document.createElement('input');
			fTrans.setAttribute('class','ui-state-default ui-corner-all');
			fTrans.setAttribute('type','text');
			fTrans.setAttribute('style','width:300px');
			fTrans.setAttribute('maxlength','100');
			fTrans.setAttribute('id','valFtrans');
			fTrans.setAttribute('value',valFtrans);
			var linha1 = document.createElement('tr');
			tabela.appendChild(linha1);
			var cel1 = document.createElement('td');
			cel1.setAttribute('style','text-align:right');
			linha1.appendChild(cel1);
			cel1.appendChild(document.createElement('br'));
			cel1.innerHTML += 'Sensor:&nbsp;';
			cel1.appendChild(sensor);
			cel1.appendChild(document.createElement('br'));
			cel1.innerHTML += 'Unidade:&nbsp;';
			cel1.appendChild(unidade);
			cel1.appendChild(document.createElement('br'));
			cel1.innerHTML += 'C&oacute;digo:&nbsp;';
			cel1.appendChild(codigo);
			cel1.appendChild(document.createElement('br'));
			cel1.innerHTML += 'Frequ&ecirc;ncia:&nbsp;';
			cel1.appendChild(frequencia);
			cel1.appendChild(document.createElement('br'));
			cel1.innerHTML += 'M&aacute;ximo:&nbsp;';
			cel1.appendChild(maximo);
			cel1.appendChild(document.createElement('br'));
			cel1.innerHTML += 'M&iacute;nimo:&nbsp;';
			cel1.appendChild(minimo);
			cel1.appendChild(document.createElement('br'));
			cel1.innerHTML += 'Fun&ccedil;&atilde;o transf:&nbsp;';
			cel1.appendChild(fTrans);
			cel1.appendChild(document.createElement('br'));
			cel1.appendChild(document.createElement('br'));
			
			var tipoSensor = document.createElement('select');
			tipoSensor.setAttribute('class','selectmenu');
			tipoSensor.setAttribute('id','valTipo');
			var opcao1 = document.createElement('option');
			opcao1.setAttribute('value','1');
			if(valTipo==1)
				opcao1.setAttribute('selected','selected');
			opcao1.innerHTML = 'Anal&oacute;gico';
			tipoSensor.appendChild(opcao1);
			var opcao1 = document.createElement('option');
			opcao1.setAttribute('value','2');
			if(valTipo==2)
				opcao1.setAttribute('selected','selected');
			opcao1.innerHTML = 'Digital';
			tipoSensor.appendChild(opcao1);
			var linha2 = document.createElement('tr');
			tabela.appendChild(linha2);
			var cel2 = document.createElement('td');
			cel2.setAttribute('style','text-align:center');
			linha2.appendChild(cel2);
			cel2.appendChild(tipoSensor);
			cel2.appendChild(document.createElement('br'));
			cel2.appendChild(document.createElement('br'));
			
			var span = document.createElement('span');
			span.setAttribute('id','tipoAcessoSensor');
			var arr = JSON.parse(dados);
			for(i = 0; i < arr.length; i++) {
				var label = document.createElement('label');
				label.setAttribute('for','acesso'+arr[i].COD);
				label.innerHTML = arr[i].VAL;
				var input = document.createElement('input');
				input.setAttribute('type','checkbox');
				if(arr[i].SEL==1)
					input.setAttribute('checked','checked');
				input.setAttribute('id','acesso'+arr[i].COD);
				input.setAttribute('value',arr[i].COD);
				input.setAttribute('class','checkbox');
				span.appendChild(label);
				span.appendChild(input);
				//if(i%2==1)
				//	span.appendChild(document.createElement('br'));
				//else
					span.innerHTML += '&nbsp;';
			}
			cel2.appendChild(span);
			if(i%2==0)
				cel2.appendChild(document.createElement('br'));
			else {
				cel2.appendChild(document.createElement('br'));
				cel2.appendChild(document.createElement('br'));
			}
			
			var span = document.createElement('span');
			span.setAttribute('align','center');
			span.setAttribute('class','button');
			//span.setAttribute('onClick','alert(\'teste\')');
			var salvar = document.createElement('button');
			salvar.setAttribute('onClick','salvaSensor('+cod+')');
			salvar.innerHTML = 'Salvar';
			span.appendChild(salvar);
			var linha3 = document.createElement('tr');
			tabela.appendChild(linha3);
			var cel3 = document.createElement('td');
			cel3.setAttribute('style','text-align:center');
			linha3.appendChild(cel3);
			cel3.appendChild(span);
			
			$("#dialog").dialog("close");
			document.getElementById('dialog').appendChild(centro);
			dialogSensores(titulo,550,550);
			
			$( ".selectmenu" ).selectmenu({
				width: 180
			});
			$( "button",".button").button();
			$( ".checkbox" ).checkboxradio();
		});
	});
}

function incluirSensor() {
	telaDeEdicaoDeSensor('Cadastro',0);
}
function editarSensor(cod) {
	telaDeEdicaoDeSensor('Cadastro',cod);
}
function ativaOuDesativaSensor(atv,cod) {
	$.post( "includes/sql.php",{acao:"ativaOuDesativaSensor",
								atv:atv,
								cod:cod
								},function( mensagem ) {
		$("#dialog").dialog("close");
		mensagemOperadores(mensagem);
	});
}
function excluiSensor(cod) {
	$.post( "includes/sql.php",{acao:"excluiSensor",
								cod:cod
								},function( mensagem ) {
		$("#dialog").dialog("close");
		mensagemOperadores(mensagem);
		if(mensagem=='Sensor exclu&iacute;do com sucesso.')
			document.getElementById(cod).parentElement.removeChild(document.getElementById(cod));
	});
}
function confirmaExclusaoSensor(cod) {
	var centro = document.createElement('center');
	var div = document.createElement('span');
	div.setAttribute('align','center');
	div.setAttribute('class','button');
	var excluir = document.createElement('button');
	excluir.setAttribute('onClick','excluiSensor('+cod+')');
	excluir.innerHTML = 'Excluir';
	div.appendChild(excluir);
	div.innerHTML += '&nbsp;&nbsp;&nbsp;';
	var div2 = document.createElement('span');
	div2.setAttribute('align','center');
	div2.setAttribute('class','button');
	var cancelar = document.createElement('button');
	cancelar.setAttribute('onClick','$("#dialog").dialog("close");');
	cancelar.innerHTML = 'Cancelar';
	div2.appendChild(cancelar);
	centro.appendChild(document.createElement('br'));
	centro.appendChild(div);
	centro.appendChild(div2);
	document.getElementById('dialog').appendChild(centro);
	dialogSensores("Tem certeza?",140,300);
	$( "button",".button").button();
}