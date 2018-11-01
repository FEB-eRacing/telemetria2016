<?php
error_reporting(0);
ini_set("display_errors", 0 );
SESSION_start();
$acesso = $_SESSION["acesso_usuario"];
require_once('../includes/conectar.php');
echo "<div id=\"dialog\" title=\"Aviso\">";
echo "</div>";
$result = $mysqli->query("SELECT s.SENS_IN_ID,
								 s.SENS_VAL_VC,
								 s.SENS_UNID_VC,
								 s.SENS_MAX_IN,
								 s.SENS_MIN_IN
							FROM SENSORES s,
								 TIPO_ACESSO_OPERADOR_SENSOR a
						   WHERE a.SENS_IN_ID = s.SENS_IN_ID
							 AND a.TIP_AC_IN_ID = ".$acesso."
							 AND s.SENS_ATV_BT = 1
						ORDER BY s.SENS_VAL_VC");
echo "<center>";
echo 	"<table id=\"graficos\">";
$i=0;
while($row = $result->fetch_assoc()) {
	if($i%4==0)
		echo "<tr>";
	echo 		"<td>";
	echo 			"<input type=\"hidden\" value=\"".utf8_encode($row["SENS_VAL_VC"])."\" id=\"sensor".$row["SENS_IN_ID"]."\" />";
	echo 			"<input type=\"hidden\" value=\"".utf8_encode($row["SENS_UNID_VC"])."\" id=\"unidade".$row["SENS_IN_ID"]."\" />";
	echo 			"<input type=\"hidden\" value=\"".utf8_encode($row["SENS_MAX_IN"])."\" id=\"maximo".$row["SENS_IN_ID"]."\" />";
	echo 			"<input type=\"hidden\" value=\"".utf8_encode($row["SENS_MIN_IN"])."\" id=\"minimo".$row["SENS_IN_ID"]."\" />";
	echo 			"<div id=\"container-".$row["SENS_IN_ID"]."\" class=\"container\" style=\"width: 310px; height: 250px; margin: 0 auto\">";
	echo 			"</div>";
	echo 		"</td>";
	if($i%4==3)
		echo "</tr>";
	$i++;
}
if($i%4!=0)
	echo 	 "</tr>";
echo 	"</table>";
echo 	"<div id=\"container-mapa\" style=\"width: 193px; height: 248px; margin: 0 auto\">";
echo 	"</div>";
echo "</center>";
?>