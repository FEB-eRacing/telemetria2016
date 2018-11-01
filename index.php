﻿<?php
SESSION_start();
if(isset($_SESSION["nome_usuario"]))
	$usuario = $_SESSION["nome_usuario"];
if(isset($_SESSION["senha_usuario"]))
	$senha = $_SESSION["senha_usuario"];
if(isset($_SESSION["acesso_usuario"]))
	$acesso = $_SESSION["acesso_usuario"];
error_reporting(0);
ini_set(“display_errors”, 0 );
require_once('includes/conectar.php');
if (mysqli_connect_errno())
	echo "<center>Erro ao conectar no banco de dados: " . mysqli_connect_error()."</center>";
if($usuario && $senha) {
	$result = $mysqli->query("SELECT OPR_IN_ID,OPR_NM_VC,OPR_AC_IN FROM operador WHERE OPR_US_VC='".$usuario."' AND OPR_SN_VC='".$senha."'");
	if($result->num_rows==1)
		$logado = true;
	else
		$logado = false;
} else
	$logado = false;
echo "<link type=\"text/css\" href=\"css/jquery-ui.css\" rel=\"stylesheet\">";
echo "<link type=\"text/css\" href=\"css/jquery-ui.structure.css\" rel=\"stylesheet\">";
echo "<link type=\"text/css\" href=\"css/jquery-ui.theme.css\" rel=\"stylesheet\" />";
echo "<link type=\"text/css\" href=\"css/estilos.css\" rel=\"stylesheet\" />";
echo "<link href=\"css/bootstrap.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "<script type=\"text/javascript\" src=\"js/jquery.js\"></script>";
echo "<script type=\"text/javascript\" src=\"js/jquery-ui.js\"></script>";
echo "<link rel=\"shortcut icon\" href=\"includes/fr.ico\">";
echo "<style type=\"text/css\">";
echo 	"ul#icons {margin: 0; padding: 0; text-align:center;}";
echo 	"ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}";
echo 	"ul#icons span.ui-icon {float: left; margin: 0 4px;}";
echo "</style>";
echo "<meta charset=\"utf-8\">";
echo "<title>";
echo 	"FEB RACING";
echo "</title>";
if($logado) {
	if($acesso) {
		$row = $result->fetch_assoc();
		echo "<link type=\"text/css\" href=\"css/jquery-filestyle.css\" rel=\"stylesheet\" />";
		echo "<script type=\"text/javascript\" src=\"includes/ajax.js\"></script>";
		echo "<script type=\"text/javascript\" src=\"includes/operadores.js\"></script>";
		echo "<script type=\"text/javascript\" src=\"includes/sensores.js\"></script>";
		//echo "<script type=\"text/javascript\" src=\"js/bibliotecaAjax.js\"></script>";
		//echo "<script type=\"text/javascript\" src=\"includes/graficos.js\"></script>";
		echo "<script type=\"text/javascript\" src=\"js/highstock.js\"></script>";
		echo "<script type=\"text/javascript\" src=\"js/highcharts.js\"></script>";
		echo "<script type=\"text/javascript\" src=\"js/highcharts-more.js\"></script>";
		echo "<script type=\"text/javascript\" src=\"js/solid-gauge.src.js\"></script>";
		echo "<script type=\"text/javascript\" src=\"js/jquery-filestyle.js\"></script>";
		//echo "<script type=\"text/javascript\" src=\"includes/historico.js\"></script>";
		//echo "<script type=\"text/javascript\" src='javascript/SurfacePlot.js'></script>";
		//echo "<script type=\"text/javascript\" src='javascript/ColourGradient.js'></script>";
		//echo "<script type=\"text/javascript\" src='javascript/jsapi.js'></script>";
		echo "<script type=\"text/javascript\" src='includes/mapaDeInjecao.js'></script>";
		echo "<script type=\"text/javascript\" src=\"js/transition.js\"></script>";
		echo "<script type=\"text/javascript\" src=\"js/tab.js\"></script>";
		echo "<script type=\"text/javascript\" src=\"js/dropdown.js\"></script>";
		echo "<script type=\"text/javascript\" src=\"js/affix.js\"></script>";
		echo "<script type=\"text/javascript\" src=\"js/plotly-latest.min.js\"></script>";
		echo "<script>";
		echo 	"$(function() {";
		echo 		"$( \"#dialog-operador\" ).dialog({";//Mudar Senha Operador
		echo 			"autoOpen: false,";
		echo 			"height: 595,";
		echo 			"width: 1250,";
		echo 			"modal: true,";
		echo 			"close: function() {";
		echo 				"var div = document.getElementById('dialog-operador');";
		echo 				"if ( div.hasChildNodes() ) {";
		echo 					"while ( div.childNodes.length >= 1 ) {";
		echo 						"div.removeChild( div.firstChild );";
		echo 					"}";
		echo 				"}";
		echo 			"}";
		echo 		"});";
		echo 		"$('#tabGraficoDashboard').tab('show');";
		echo 		"abrirPaginaDashBoardGrafico('includes/dashBoardGraficos.php');";
		echo 	"});";
		echo "</script>";
		echo "<body>";
		echo "<div id=\"dialog-operador\" title=\"Operador\">";
		echo "</div>";
		echo "<ul class=\"nav nav-tabs\">";
		echo 	"<li id=\"tempoReal\" class=\"dropdown\">";
		echo 		"<a href=\"#\" class=\"dropdown-toggle\" id=\"dropdownTempoReal\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">";
		echo 			"Tempo Real";
		echo 			"<b class=\"caret\">";
		echo 			"</b>";
		echo 		"</a>";
		echo 		"<ul class=\"dropdown-menu\" aria-labelledby=\"dropdownTempoReal\">";
		echo 			"<li>";
		echo 				"<a id=\"tabGraficoDashboard\" href=\"#conteudo\" onClick=\"abrirPaginaDashBoardGrafico('includes/dashBoardGraficos.php');\" data-toggle=\"tab\">";
		echo 					"Gráficos";
		echo 				"</a>";
		echo 			"</li>";
		echo 			"<li>";
		echo 				"<a href=\"#conteudo\" onClick=\"abrirPaginaDashBoardPonteiro('includes/dashBoardPonteiros.php');\" data-toggle=\"tab\">";
		echo 					"Ponteiros";
		echo 				"</a>";
		echo 			"</li>";
		echo 		"</ul>";
		echo 	"</li>";
		echo 	"<li id=\"historico\" class=\"dropdown\">";
		echo 		"<a href=\"#\" class=\"dropdown-toggle\" id=\"dropdownHistorico\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">";
		echo 			"Histórico";
		echo 			"<b class=\"caret\">";
		echo 			"</b>";
		echo 		"</a>";
		echo 		"<ul class=\"dropdown-menu\" aria-labelledby=\"dropdownHistorico\">";
		echo 			"<li>";
		echo 				"<a href=\"#conteudo\" onClick=\"abrirPaginaHistorico('includes/historico.php');\" data-toggle=\"tab\">";
		echo 					"Gráficos";
		echo 				"</a>";
		echo 			"</li>";
		echo 		"</ul>";
		echo 	"</li>";
		echo 	"<li id=\"administracao\" class=\"dropdown\">";
		echo 		"<a href=\"#\" class=\"dropdown-toggle\" id=\"dropdownAdministracao\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">";
		echo 			"Administração";
		echo 			"<b class=\"caret\">";
		echo 			"</b>";
		echo 		"</a>";
		echo 		"<ul class=\"dropdown-menu\" aria-labelledby=\"dropdownAdministracao\">";
		if($acesso==1 || $acesso==2) {
			echo 		"<li>";
			echo 			"<a href=\"#conteudo\" onClick=\"abrirPagina('includes/mapaDeInjecao.php');\" data-toggle=\"tab\">";
			echo 				"Configurações do motor";
			echo 			"</a>";
			echo 		"</li>";
		}
		echo 			"<li>";
		echo 				"<a href=\"#conteudo\" onClick=\"abrirPagina('includes/sensores.php');\" data-toggle=\"tab\">";
		echo 					"Sensores";
		echo 				"</a>";
		echo 			"</li>";
		//echo 			"<li>";
		//echo 				"<a href=\"#conteudo\" onClick=\"abrirPagina('includes/pistas.php');\" data-toggle=\"tab\">";
		//echo 					"Pistas";
		//echo 				"</a>";
		//echo 			"</li>";
		if($acesso==1) {
			echo 		"<li>";
			echo 			"<a href=\"#conteudo\" onClick=\"abrirPagina('includes/operadores.php');\" data-toggle=\"tab\">";
			echo 				"Operadores";
			echo 			"</a>";
			echo 		"</li>";
		}
		echo 		"</ul>";
		echo 	"</li>";
		echo 	"<span style=\"float: right;padding-top: 4;padding-right: 4;\">";
		echo 		"<table>";
		echo 			"<tr>";
		echo 				"<td>";
		echo 					"<span style=\"font-size:larger;\">";
		echo 						$row["OPR_NM_VC"];
		echo 					"</span>";
		echo 				"</td>";
		echo 				"<td style=\"padding-left:10;\">";
		echo 					"<button onClick=\"mudaSenha('".$row["OPR_IN_ID"]."');\" class=\"btn btn-primary\">";
		echo 						"Alterar Senha";
		echo 					"</button>";
		echo 				"</td>";
		echo 				"<td style=\"padding-left:4;\">";
		echo 					"<button onClick=\"location.href='includes/destroiSessao.php'\" class=\"btn btn-primary\">";
		echo 						"Sair";
		echo 					"</button>";
		echo 				"</td>";
		echo 			"</tr>";
		echo 		"</table>";
		echo 	"</span>";
		echo "</ul>";
		//echo 	"<div id=\"tabs\">";
		//echo 		"<ul>";
		//echo 			"<li>";
		//echo 				"<a href=\"#conteudo\" onClick=\"abrirPaginaDashBoard('includes/dashBoard.php')\">";
		//echo 					"DashBoard";
		//echo 				"</a>";
		//echo 			"</li>";
		//echo 			"<li>";
		//echo 				"<a href=\"#conteudo\" onClick=\"abrirPaginaHistorico('includes/historico.php')\">";
		//echo 					"Hist&oacute;rico";
		//echo 				"</a>";
		//echo 			"</li>";
		//if($acesso==1) {
		//	echo 		"<li>";
		//	echo 			"<a href=\"#conteudo\" onClick=\"abrirPagina('includes/mapaDeInjecao.php')\">";
		//	echo 				"Mapas";
		//	echo 			"</a>";
		//	echo 		"</li>";
		//	echo 		"<li>";
		//	echo 			"<a href=\"#conteudo\" onClick=\"abrirPagina('includes/sensores.php')\">";
		//	echo 				"Sensores";
		//	echo 			"</a>";
		//	echo 		"</li>";
		//	echo 		"<li>";
		//	echo 			"<a href=\"#conteudo\" onClick=\"abrirPagina('includes/pistas.php')\">";
		//	echo 				"Pistas";
		//	echo 			"</a>";
		//	echo 		"</li>";
		//	echo 		"<li>";
		//	echo 			"<a href=\"#conteudo\" onClick=\"abrirPagina('includes/operadores.php')\">";
		//	echo 				"Operadores";
		//	echo 			"</a>";
		//	echo 		"</li>";
		//}
		//echo 			"<span style=\"float: right;\">";
		//echo 				"<button onClick=\"location.href='includes/destroiSessao.php'\">";
		//echo 					"Sair";
		//echo 				"</button>";
		//echo 			"</span>";
		//echo 		"</ul>";
		//echo 	"</div>";
		echo 		"<div id=\"conteudo\">";
		echo 		"</div>";
		echo "</body>";
	} else {
		session_destroy();
		echo "<script type=\"text/javascript\">";
		echo 	"$(function(){";
		echo 		"$( \"#dialog-senha\" ).dialog({";
		echo 			"modal: true,";
		echo 			"width: 350,";
		echo 			"height: 205,";
		echo 			"autoOpen: false,";
		echo 			"buttons: {";
		echo 				"Ok: function() {";
		echo 					"$( this ).dialog( \"close\" );";
		echo 				"}";
		echo 			"}";
		echo 		"});";
		echo 		"$(\"#dialog-senha\").dialog({close: function() {window.location.href ='./.';}});";
		echo 	"});";
		echo "</script>";
		echo "<div id=\"dialog-senha\" title=\"Aviso\">";
		echo 	"<p>";
		echo 		"Usu&aacute;rio ou senha incorretos.";
		echo 	"</p>";
		echo "</div>";
		echo "<body onLoad=\"$('#dialog-senha').dialog('open');\"></body>";
	}
} else {
	echo "<div style=\"position: fixed;top: 50%;left: 50%;transform: translate(-50%, -50%);\">";
	echo 	"<center>";
	echo 		"<img src=\"images/logo.jpg\">";
	echo 	"</center>";
	echo "</div>";
	echo "<div style=\"position: fixed;top: 50%;left: 50%;transform: translate(-50%, -50%);\">";
	echo 	"<div style=\" padding: 0.4em; position: relative;\">";
	echo 		"<body onLoad=\"document.getElementById('usuario').focus();\">";
	echo 			"<form method=\"post\" action=\"validacao/\"><br />";
	echo 				"<center>";
	echo 					"<div style=\"width:70%;\">";
	echo 						"<input type=\"text\" placeholder=\"Usuário\" class=\"form-control\" name=\"usuario\" id=\"usuario\">";
	echo 					"</div>";
	echo					"<br />";
	echo 					"<div style=\"width:70%;\">";
	echo 						"<input type=\"password\" placeholder=\"Senha\" class=\"form-control\" name=\"senha\">";
	echo 					"</div>";
	echo 				"</center>";
	echo 				"<br />";
	echo 				"<center>";
	echo 					"<input type=\"submit\" value=\"Entrar\" style=\"text-align: center;\" class=\"btn btn-default\" />";
	echo 				"</center>";
	echo 			"</form>";
	echo 		"</body>";
	echo 	"</div>";
	echo "</div>";
}
$mysqli->close();
?>