<?php
error_reporting(0);
ini_set("display_errors", 0 );
require_once('../includes/conectar.php');
$result = $mysqli->query("SELECT EST_MOT_IN_ID,
								 EST_MOT_NOM_VC,
								 EST_MOT_ATV_IN
							FROM estrategia_motor
						ORDER BY EST_MOT_NOM_VC");
echo "<div id=\"dialog-estrategia\" class=\"dialog\" title=\"Estratégia\">";
echo "</div>";
echo "<style>";
echo 	".bordaAcimaAbaixo {";
echo 		"border-top-style: groove;";
echo 		"border-bottom-style: groove;";
echo 		"border-width: 1px;";
echo 	"}";
echo 	".bordaAcima {";
echo 		"border-top-style: groove;";
echo 		"border-width: 1px;";
echo 	"}";
echo 	".bordaAbaixo {";
echo 		"border-bottom-style: groove;";
echo 		"border-width: 1px;";
echo 	"}";
echo 	".bordaDireita {";
echo 		"border-right-style: groove;";
echo 		"border-width: 1px;";
echo 	"}";
echo 	".bordaEsquerda {";
echo 		"border-left-style: groove;";
echo 		"border-width: 1px;";
echo 	"}";
echo "</style>";
echo "<center>";
echo 	"<br />";
echo 	"<button onClick=\"incluirOuEditarEstrategia(0)\" class=\"btn btn-primary\">";
echo 		"Nova Estratégia";
echo 	"</button>";
echo 	"<br />";
if($result->num_rows>0)
	echo "<br />";
echo 	"<table id=\"estrategiasCadastradas\">";
while($row = $result->fetch_assoc()) {
	echo 	"<tr id=\"estrategia".$row["EST_MOT_IN_ID"]."\">";
	echo 		"<td style=\"text-align:center;padding:1\">";
    echo 			"<div class=\"input-group\">";
    echo 				"<span class=\"input-group-addon\">";
    echo 					"<input type=\"radio\" name=\"estrategiaEscolhida\" aria-label=\"".$row["EST_MOT_IN_ID"]."\" ";
	if($row["EST_MOT_ATV_IN"]==1)
		echo 				"CHECKED";
	echo 					" onClick=\"estrategiaEscolhida(".$row["EST_MOT_IN_ID"].")\" />";
    echo 				"</span>";
	echo 				"<input class=\"form-control\" style=\"text-align:center\" readonly type=\"text\" size=\"20\" value=\"".utf8_encode($row["EST_MOT_NOM_VC"])."\" aria-label=\"".$row["EST_MOT_IN_ID"]."\" />";
    echo 				"<div class=\"input-group-btn\">";
    echo 					"<button class=\"btn btn-default btn-lg\" type=\"button\" title=\"Editar\" onClick=\"incluirOuEditarEstrategia('".$row["EST_MOT_IN_ID"]."')\">";
	echo 						"<span class=\"ui-icon ui-icon-pencil\">";
	echo 						"</span>";
    echo 					"</button>";
    echo 					"<button class=\"btn btn-default btn-lg\" type=\"button\" title=\"Excluir\" onClick=\"confirmaExclusaoEstrategia('".$row["EST_MOT_IN_ID"]."')\">";
	echo 						"<span class=\"ui-icon ui-icon-trash\">";
	echo 						"</span>";
    echo 					"</button>";
    echo 				"</div>";
    echo 			"</div>";
	echo 		"</td>";
	echo 	"</tr>";
}
echo 	"</table>";
echo 	"<br />";
echo 	"<div id='operacoesEstrategiasMotor'>";
echo 	"</div>";
echo "</center>";
?>