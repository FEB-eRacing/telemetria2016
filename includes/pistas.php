<?php
//error_reporting(0);
//ini_set("display_errors", 0 );
//require_once('../includes/conectar.php');
//$result = $mysqli->query("SELECT SENS_IN_ID,SENS_VAL_VC FROM SENSORES order by SENS_VAL_VC");
//echo "<div id=\"dialog\" title=\"Sensor\">";
//echo "</div>";
//echo "<center>";
//echo 	"<span align=\"center\" class=\"button\">";
//echo 		"<button onClick=\"incluirSensor()\">";
//echo 			"Novo";
//echo 		"</button>";
//echo 	"</span>";
//echo 	"<br />";
//echo 	"<table id=\"sensores\">";
//while($row = $result->fetch_assoc()) {
//	echo 	"<tr id = ".$row["SENS_IN_ID"].">";
//	echo 		"<td style=\"text-align:right\">";
//	echo 			"<input class=\"ui-state-default ui-corner-all\" readonly type=\"text\" size=\"40\" value=\"".utf8_encode($row["SENS_VAL_VC"])."\" />";
//	echo 		"</td>";
//	echo 		"<td>";
//	echo 			"<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\" onClick=\"editarSensor('".$row["SENS_IN_ID"]."')\">";
//	echo 				"<li class=\"ui-state-default ui-corner-all\" title=\"Editar\">";
//	echo 					"<span class=\"ui-icon ui-icon-pencil\">";
//	echo 					"</span>";
//	echo 				"</li>";
//	echo 			"</ul>";
//	echo 		"</td>";
//	echo 		"<td>";
//	echo 			"<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\" onClick=\"confirmaExclusaoSensor('".$row["SENS_IN_ID"]."')\">";
//	echo 				"<li class=\"ui-state-default ui-corner-all\" title=\"Excluir\">";
//	echo 					"<span class=\"ui-icon ui-icon-trash\">";
//	echo 					"</span>";
//	echo 				"</li>";
//	echo 			"</ul>";
//	echo 		"</td>";
//	echo 	"</tr>";
//}
//echo 	"</table>";
//echo "</center>";
?>
<br />
<center>
	<input type="file" class="jfilestyle" data-buttonText="Imagem" />
</center>