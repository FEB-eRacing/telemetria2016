var ajax;
var dadosUsuario;

function requisicaoHTTP(tipo,url,assinc) {
	if(window.XMLHttpRequest) {   //  Mozilla, Safari, ...
		ajax = new XMLHttpRequest();
	} else if(window.ActiveXObject) { // IE
		ajax = new ActiveXObject("Msxl2.XMLHTTP");
		if(!ajax) {
			ajax = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	if(ajax) {
		iniciaRequisicao(tipo,url,assinc);
	} else {
		alert("Seu navegador não possui suporte a essa aplicação.");
	}
}
function iniciaRequisicao(tipo,url,boll) {
	ajax.onreadystatechange=trataResposta;
	ajax.open(tipo,url,boll);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=ISO-8859-1");
	ajax.setRequestHeader("Encoding","ISO-8859-1");
	//ajax.overrideMimeType("text/XML"); /* usado somente no Mozilla */
	ajax.send(dadosUsuario);
}
function enviaDados(url) {
	criaQueryString();
	requisicaoHTTP("POST",url,true);
}
function criaQueryString() {
	dadosUsuario="";
	var frm = document.forms[0];
	var numElementos = frm.elements.length;
	for(var i=0;i<numElementos;i++) {
		if(i<numElementos-1) {
			dadosUsuario += frm.elements[i].name+"="+encodeURIComponent(frm.elements[i].value)+"&";
		} else {
			dadosUsuario += frm.elements[i].name+"="+encodeURIComponent(frm.elements[i].value);
		}
	}
}
function trataResposta() {
	if(ajax.readyState == 4) {
		if(ajax.status == 200) {
			trataDados();
		} else {
			if(!(document.getElementById("erro").hasChildNodes())) {
				document.getElementById("erro").innerHTML = '<font color="red"><b>Problema na comunica\u00e7\u00e3o com o carro.</b></font>';
			}
		}
	}
}