<?php
error_reporting(0);
ini_set("display_errors", 0 );
require_once('../includes/conectar.php');
$usuario = $_POST["usuario"];
$senha = $_POST["senha"];
if (!$mysqli) {
    echo "<body onLoad=\"$('#dialog-conexao').dialog('open');\">";
} else {
	$senha = md5($senha);
	$result = $mysqli->query("SELECT OPR_AC_IN FROM operador WHERE OPR_US_VC='".$usuario."' AND OPR_SN_VC='".$senha."'");
	if($result->num_rows==1) {
		ob_start();
		session_start();
		$row = $result->fetch_assoc();
		$_SESSION['nome_usuario'] = $usuario;
		$_SESSION['senha_usuario'] = $senha;
		$_SESSION['acesso_usuario'] = $row["OPR_AC_IN"];
		echo "<body onLoad=\"window.location.href ='../.';\">";
	} else {
		echo "<body onLoad=\"$('#dialog-senha').dialog('open');\">";
	}
}
echo "<script src=\"../js/jquery.js\"></script>";
echo "<script src=\"../js/jquery-ui.js\"></script>";
echo "<link href=\"../css/jquery-ui.css\" rel=\"stylesheet\">";
echo "<link rel=\"shortcut icon\" href=\"../includes/fr.ico\">";
echo "<script type=\"text/javascript\">";
echo 	"$(function(){";
echo 		"$( \"#dialog-conexao\" ).dialog({";
echo 			"modal: true,";
echo 			"width: 450,";
echo 			"height: 205,";
echo 			"autoOpen: false,";
echo 			"buttons: {";
echo 				"Ok: function() {";
echo 					"$( this ).dialog( \"close\" );";
echo 					"window.location.href ='../';";
echo 				"}";
echo 			"}";
echo 		"});";
echo 		"$(\"#dialog-conexao\").dialog({close: function() {window.location.href ='../.';}});";
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
echo 		"$(\"#dialog-senha\").dialog({close: function() {window.location.href ='../.';}});";
echo 	"});";
echo "</script>";
echo "<head>";
echo 	"<title>";
echo 		"FEB RACING";
echo 	"</title>";
echo "</head>";
echo "<link rel=\"shortcut icon\" href=\"../includes/fr.ico\">";
echo "<div id=\"dialog-conexao\" title=\"Aviso\">";
echo 	"<p>";
echo 		"N&atilde;o h&aacute; conex&atilde;o com o banco de dados.";
echo 	"</p>";
echo "</div>";
echo "<div id=\"dialog-senha\" title=\"Aviso\">";
echo 	"<p>";
echo 		"Usu&aacute;rio ou senha incorretos.";
echo 	"</p>";
echo "</div>";
echo "</body>";
$mysqli->close();
?>