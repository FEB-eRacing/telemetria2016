function mensagemOperadores(mensagem) {
	var centro = document.createElement('center');
	centro.innerHTML = mensagem;
	document.getElementById('dialog').appendChild(document.createElement('br'));
	document.getElementById('dialog').appendChild(centro);
	$("#dialog").dialog("option","title","Mensagem" );
	$("#dialog").dialog("option","height", 120 );
	$("#dialog").dialog("option","width", 350 );
	$("#dialog").dialog("option","position", { my: "center top", at: "center top", of: window } );
	$("#dialog").dialog("open");
}
function mudaNomeOperador(cod,nome) {
	$.post( "includes/sql.php",{acao:"mudaNomeOperador",cod:cod,nome:nome},function( mensagem ) {
		mensagemOperadores(mensagem);
	});
}
function mudaUsuario(cod,usuario) {
	$.post( "includes/sql.php",{acao:"mudaUsuarioOperador",cod:cod,usuario:usuario},function( mensagem ) {
		mensagemOperadores(mensagem);
	});
}
function mudaAcesso(cod,acesso) {
	$.post( "includes/sql.php",{acao:"mudaAcessoOperador",cod:cod,acesso:acesso},function( mensagem ) {
		mensagemOperadores(mensagem);
	});
}
function mudaSenha(cod) {
	var centro = document.createElement('center');
	var br = document.createElement('br');
	var senha = document.createElement('input');
	senha.setAttribute('type','password');
	senha.setAttribute('id','senha'+cod);
	senha.setAttribute('class','ui-state-default ui-corner-all');
	var p = document.createElement('p');
	p.setAttribute('align','center');
	p.setAttribute('class','button');
	var mudar = document.createElement('button');
	mudar.setAttribute('onClick','novaSenha('+cod+')');
	mudar.innerHTML = 'Mudar';
	p.appendChild(mudar);
	centro.appendChild(document.createElement('br'));
	centro.appendChild(senha);
	centro.appendChild(br);
	centro.appendChild(p);
	document.getElementById('dialog').appendChild(centro);
	$("#dialog").dialog("option","title","Mudar senha" );
	$("#dialog").dialog("option","height", 180 );
	$("#dialog").dialog("option","width", 350 );
	$("#dialog").dialog("option","position", { my: "center top", at: "center top", of: window } );
	$("#dialog").dialog("open");
	$( "button",".button").button();
}
function novaSenha(cod) {
	var senha = document.getElementById('senha'+cod).value;
	$("#dialog").dialog("close");
	$.post( "includes/sql.php",{acao:"mudaSenhaOperador",cod:cod,senha:senha},function( mensagem ) {
		mensagemOperadores(mensagem);
	});
}
function confirmaExclusao(cod) {
	var centro = document.createElement('center');
	var div = document.createElement('span');
	div.setAttribute('align','center');
	div.setAttribute('class','button');
	var excluir = document.createElement('button');
	excluir.setAttribute('onClick','exclui('+cod+')');
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
	$("#dialog").dialog("option","title","Tem certeza?" );
	$("#dialog").dialog("option","height", 140 );
	$("#dialog").dialog("option","width", 300 );
	$("#dialog").dialog("option","position", { my: "center top", at: "center top", of: window } );
	$("#dialog").dialog("open");
	$( "button",".button").button();
}
function exclui(cod) {
	$("#dialog").dialog("close");
	$.post( "includes/sql.php",{acao:"excluiOperador",cod:cod},function( mensagem ) {
		mensagemOperadores(mensagem);
		if(mensagem=='Operador exclu&iacute;do com sucesso.')
			document.getElementById(cod).parentElement.removeChild(document.getElementById(cod));
	});
}
function incluir() {
	$.post( "includes/sql.php",{acao:"selecionaTipoAcessoOperador"},function( dados ) {
		var table = document.getElementById("operadores");
		var row = table.insertRow(0);
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);
		var cell5 = row.insertCell(4);
		cell1.setAttribute('style','text-align:center;padding:1');
		cell1.setAttribute('class','bordaAcimaAbaixo bordaEsquerda');
		cell2.setAttribute('style','text-align:center;padding:1');
		cell2.setAttribute('class','bordaAcimaAbaixo');
		cell3.setAttribute('style','text-align:center;padding:1');
		cell3.setAttribute('class','bordaAcimaAbaixo');
		cell4.setAttribute('class','bordaAcimaAbaixo');
		cell5.setAttribute('class','bordaAcimaAbaixo bordaDireita');
		var nome = document.createElement('input');
		nome.setAttribute('class','form-control');
		nome.setAttribute('type','text');
		nome.setAttribute('placeholder','Nome');
		var usuario = document.createElement('input');
		usuario.setAttribute('class','form-control');
		usuario.setAttribute('type','text');
		usuario.setAttribute('placeholder','Usuário');
		var acesso = document.createElement('select');
		acesso.setAttribute('class','selectmenu');
		var arr = JSON.parse(dados);
		for(i = 0; i < arr.length; i++) {
			var option = document.createElement('option');
			option.setAttribute('value',arr[i].COD);
			option.innerHTML = arr[i].VAL;
			acesso.appendChild(option);
		}
		var ul = document.createElement('ul');
		ul.setAttribute('id','icons');
		ul.setAttribute('class','ui-widget ui-helper-clearfix');
		ul.setAttribute('onClick','novoOperador(this.parentElement.parentElement)');
		var li = document.createElement('li');
		li.setAttribute('class','ui-state-default ui-corner-all');
		li.setAttribute('title','Cadastrar');
		ul.appendChild(li);
		var span = document.createElement('span');
		span.setAttribute('class','ui-icon ui-icon-plus');
		li.appendChild(span);
		var ul2 = document.createElement('ul');
		ul2.setAttribute('id','icons');
		ul2.setAttribute('class','ui-widget ui-helper-clearfix');
		ul2.setAttribute('onClick','cancelaNovoOperador(this.parentElement.parentElement)');
		var li2 = document.createElement('li');
		li2.setAttribute('class','ui-state-default ui-corner-all');
		li2.setAttribute('title','Cancelar');
		ul2.appendChild(li2);
		var span2 = document.createElement('span');
		span2.setAttribute('class','ui-icon ui-icon-close');
		li2.appendChild(span2);
		cell1.appendChild(nome);
		cell2.appendChild(usuario);
		cell3.appendChild(acesso);
		cell4.appendChild(ul);
		cell5.appendChild(ul2);
		$( ".selectmenu" ).selectmenu({
			width: 180
		});
	});
}
function novoOperador(linha) {
	var nome = linha.childNodes[0].childNodes[0].value;
	var usuario = linha.childNodes[1].childNodes[0].value;
	var acesso = linha.childNodes[2].childNodes[0].value;
	$.post( "includes/sql.php",{acao:"novoOperador",nome:nome,usuario:usuario,acesso:acesso},function( data ) {
		mensagemOperadores(data.RESPOSTA);
		if(data.SEQUENCIA>0) {
			linha.id = data.SEQUENCIA;
			linha.childNodes[0].childNodes[0].setAttribute('onChange','mudaNomeOperador(\''+data.SEQUENCIA+'\',this.value);');
			linha.childNodes[1].childNodes[0].setAttribute('onChange','mudaUsuario(\''+data.SEQUENCIA+'\',this.value);');
			linha.childNodes[3].removeChild(linha.childNodes[3].firstChild);
			linha.childNodes[4].removeChild(linha.childNodes[4].firstChild);
			var ul = document.createElement('ul');
			ul.setAttribute('id','icons');
			ul.setAttribute('class','ui-widget ui-helper-clearfix');
			ul.setAttribute('onClick','mudaSenha(\''+data.SEQUENCIA+'\')');
			var li = document.createElement('li');
			li.setAttribute('class','ui-state-default ui-corner-all');
			li.setAttribute('title','Mudar senha');
			ul.appendChild(li);
			var span = document.createElement('span');
			span.setAttribute('class','ui-icon ui-icon-key');
			li.appendChild(span);
			var ul2 = document.createElement('ul');
			ul2.setAttribute('id','icons');
			ul2.setAttribute('class','ui-widget ui-helper-clearfix');
			ul2.setAttribute('onClick','confirmaExclusao(\''+data.SEQUENCIA+'\')');
			var li2 = document.createElement('li');
			li2.setAttribute('class','ui-state-default ui-corner-all');
			li2.setAttribute('title','Excluir');
			ul2.appendChild(li2);
			var span2 = document.createElement('span');
			span2.setAttribute('class','ui-icon ui-icon-trash');
			li2.appendChild(span2);
			linha.childNodes[3].appendChild(ul);
			linha.childNodes[4].appendChild(ul2);
			$( ".selectmenu" ).selectmenu({
				width: 180,
				change: function( event, ui ) {
					mudaAcesso(this.parentElement.parentElement.id,this.value);
				}
			});
		} else {
			$("#dialog").dialog("option","height", 140 );
		}
	}, "json");
	
}
function cancelaNovoOperador(linha) {
	linha.parentElement.removeChild(linha);
}