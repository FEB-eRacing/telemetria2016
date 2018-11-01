<?php
error_reporting(0);
ini_set("display_errors", 0 );
require_once('../includes/conectar.php');
SESSION_start();
$acesso = $_SESSION["acesso_usuario"];
echo "<div id=\"dialog\" title=\"Sensor\">";
echo "</div>";
echo "<style>";
echo 	".bordaAcimaAbaixo {";
echo 		"border-top-style: groove;";
echo 		"border-bottom-style: groove;";
echo 		"border-width: 1px;";
echo 	"}";
echo 	".bordaDireita {";
echo 		"border-right-style: groove;";
echo 	"}";
echo 	".bordaEsquerda {";
echo 		"border-left-style: groove;";
echo 	"}";
echo "</style>";
echo "<center>";
echo 	"<br />";
if($acesso==1) {
	echo "<button onClick=\"incluirSensor()\" class=\"btn btn-primary\">";
	echo 	"Novo";
	echo "</button>";
	echo "<br />";
	echo "<br />";
}
echo 	"<table id=\"sensores\">";
if($acesso!=1)
	$restricaoDeAcesso = ',tipo_acesso_operador_sensor ta
					 WHERE ta.SENS_IN_ID = s.SENS_IN_ID
					   AND ta.TIP_AC_IN_ID = 1 ';
$result = $mysqli->query("SELECT s.SENS_IN_ID,
								 s.SENS_VAL_VC,
								 s.SENS_COD_IN,
								 s.SENS_ATV_BT
							FROM sensores s".$restricaoDeAcesso."
						ORDER BY s.SENS_COD_IN");
while($row = $result->fetch_assoc()) {
	echo 	"<tr id = ".$row["SENS_IN_ID"].">";
	//echo 		"<td style=\"text-align:center;padding:1\" class=\"bordaAcimaAbaixo bordaEsquerda\">";
	//echo 			"<label for=\"checkbox".$row["SENS_IN_ID"]."\">";
	//echo 				"<input id=\"checkbox".$row["SENS_IN_ID"]."\" class=\"checkbox\" type=\"checkbox\" ";
	//if($row["SENS_ATV_BT"]==1)
	//	echo 			"CHECKED";
	//echo 				" onClick=\"ativaOuDesativaSensor(this.checked,".$row["SENS_IN_ID"].")\" />";
	//echo 			"</label>";
	//echo 		"</td>";
	//echo 		"<td style=\"text-align:center;padding:1\" class=\"bordaAcimaAbaixo\">";
	//echo 			"<input class=\"form-control\" style=\"text-align:center\" readonly type=\"text\" size=\"4\" value=\"".utf8_encode($row["SENS_COD_IN"])."\" />";
	//echo 		"</td>";
	//echo 		"<td style=\"text-align:center;padding:1\" class=\"bordaAcimaAbaixo\">";
	//echo 			"<input class=\"form-control\" readonly type=\"text\" size=\"40\" value=\"".utf8_encode($row["SENS_VAL_VC"])."\" />";
	//echo 		"</td>";
	//echo 		"<td style=\"text-align:center;padding:1\" class=\"bordaAcimaAbaixo\">";
	//echo 			"<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\" onClick=\"editarSensor('".$row["SENS_IN_ID"]."')\">";
	//echo 				"<li class=\"ui-state-default ui-corner-all\" title=\"Editar\">";
	//echo 					"<span class=\"ui-icon ui-icon-pencil\">";
	//echo 					"</span>";
	//echo 				"</li>";
	//echo 			"</ul>";
	//echo 		"</td>";
	//echo 		"<td style=\"text-align:center;padding:1\" class=\"bordaAcimaAbaixo bordaDireita\">";
	//echo 			"<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\" onClick=\"confirmaExclusaoSensor('".$row["SENS_IN_ID"]."')\">";
	//echo 				"<li class=\"ui-state-default ui-corner-all\" title=\"Excluir\">";
	//echo 					"<span class=\"ui-icon ui-icon-trash\">";
	//echo 					"</span>";
	//echo 				"</li>";
	//echo 			"</ul>";
	//echo 		"</td>";
	echo 		"<td style=\"text-align:center;padding:1\">";
    echo 			"<div class=\"input-group\">";
    echo 				"<span class=\"input-group-addon\">";
    echo 					"<input type=\"checkbox\" aria-label=\"".$row["SENS_IN_ID"]."\" ";
	if($row["SENS_ATV_BT"]==1)
		echo 				"CHECKED";
	echo 					"  onClick=\"ativaOuDesativaSensor(this.checked,".$row["SENS_IN_ID"].")\" />";
    echo 				"</span>";
    echo 				"<span class=\"input-group-addon\"><div style=\"width:40px\">".utf8_encode($row["SENS_COD_IN"])."</div></span>";
    echo 				"<span class=\"input-group-addon\"><div style=\"width:400px\">".utf8_encode($row["SENS_VAL_VC"])."</div></span>";
	if($acesso==1) {
		echo 			"<div class=\"input-group-btn\">";
		echo 				"<button class=\"btn btn-default btn-lg\" type=\"button\" title=\"Editar\" onClick=\"editarSensor('".$row["SENS_IN_ID"]."')\">";
		echo 					"<span class=\"ui-icon ui-icon-pencil\">";
		echo 					"</span>";
		echo 				"</button>";
		echo 				"<button class=\"btn btn-default btn-lg\" type=\"button\" title=\"Excluir\" onClick=\"confirmaExclusaoSensor('".$row["SENS_IN_ID"]."')\">";
		echo 					"<span class=\"ui-icon ui-icon-trash\">";
		echo 					"</span>";
		echo 				"</button>";
		echo 			"</div>";
	}
    echo 			"</div>";
	echo 		"</td>";
	echo 	"</tr>";
}
echo 	"</table>";
echo "</center>";
?>