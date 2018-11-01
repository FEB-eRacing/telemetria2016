<?php
error_reporting(0);
ini_set("display_errors", 0 );
set_time_limit(0);
SESSION_start();
$acesso = $_SESSION["acesso_usuario"];
require_once('../includes/conectar.php');
echo "<div id=\"dialog\" title=\"Aviso\">";
echo "</div>";
$result = $mysqli->query("SELECT DISTINCT d.DAD_DATA_DT,
								  DATE_FORMAT(d.DAD_DATA_DT,'%Y-%m-%d-%k-%i-%s') AS DAD_DATA_DT2
							 FROM dados_analogicos d
						 ORDER BY DAD_DATA_DT");
$i=0;
while($row = $result->fetch_assoc()) {
	$eixoX[$i] = $row["DAD_DATA_DT2"];
	echo "<input type=\"hidden\" class=\"datas\" value=\"".$row2["DAD_DATA_DT2"]."\" />";
	$i++;
}
$result = $mysqli->query("SELECT s.SENS_IN_ID,
								 s.SENS_COD_IN,
								 s.SENS_VAL_VC,
								 s.SENS_UNID_VC,
								 s.SENS_MAX_IN,
								 s.SENS_MIN_IN,
								 s.SENS_FTRANS_VC
							FROM sensores s,
								 tipo_acesso_operador_sensor a
						   WHERE a.SENS_IN_ID = s.SENS_IN_ID
							 AND a.TIP_AC_IN_ID = ".$acesso."
							 AND s.SENS_ATV_BT = 1
						ORDER BY s.SENS_VAL_VC");
$i=0;
while($row = $result->fetch_assoc()) {
	echo "<input type=\"hidden\" value=\"".utf8_encode($row["SENS_VAL_VC"])."\" id=\"sensor".$i."\" />";
	echo "<input type=\"hidden\" value=\"".utf8_encode($row["SENS_UNID_VC"])."\" id=\"unidade".$i."\" />";
	echo "<input type=\"hidden\" value=\"".utf8_encode($row["SENS_MAX_IN"])."\" id=\"maximo".$i."\" />";
	echo "<input type=\"hidden\" value=\"".utf8_encode($row["SENS_MIN_IN"])."\" id=\"minimo".$i."\" />";
	$maximoDoSensor[$i] = $row["SENS_MAX_IN"];
	$minimoDoSensor[$i] = $row["SENS_MIN_IN"];
	$result2 = $mysqli->query("SELECT DISTINCT d.DAD_DATA_DT,
							          d.DAD_VAL_IN,
									  DATE_FORMAT(d.DAD_DATA_DT,'%Y-%m-%d-%k-%i-%s') AS DAD_DATA_DT2
								 FROM dados_analogicos d
							    WHERE d.DAD_COD_IN = ".$row["SENS_COD_IN"]."");
	while($row2 = $result2->fetch_assoc()) {
		$row["SENS_MIN_IN"];
		if($row["SENS_FTRANS_VC"])
			$valor = round(eval('return '.str_replace("x",$row2["DAD_VAL_IN"],$row["SENS_FTRANS_VC"]).';'),2);
		else
			$valor = $row2["DAD_VAL_IN"];
		if($row2["DAD_VAL_IN"]<0 || $row2["DAD_VAL_IN"]>200)
			$row2["DAD_VAL_IN"] = 0;
		//if($i==0)
		//	echo "<input type=\"hidden\" class=\"datas\" value=\"".$row2["DAD_DATA_DT2"]."\" />";
		$eixoYProvisorio[$i][$row2["DAD_DATA_DT2"]] = $valor;
		//echo "<input type=\"hidden\" class=\"dados".$i."\" value=\"".$valor."\" />";
	}
	$i++;
}
for($int=0;$int<$i;$int++)
	for($c=0;$c<count($eixoX);$c++)
		if($eixoYProvisorio[$int][$eixoX[$c]])
			//$eixoY[$int][$c] = $eixoYProvisorio[$int][$eixoX[$c]];
			echo "<input type=\"hidden\" class=\"dados".$int."\" value=\"".($eixoYProvisorio[$int][$eixoX[$c]])."\" />";
		else
			//$eixoY[$int][$c] = ($minimoDoSensor[$int]-0.2*($maximoDoSensor[$int]-$minimoDoSensor[$int]));
			echo "<input type=\"hidden\" class=\"dados".$int."\" value=\"".($minimoDoSensor[$int]-0.2*($maximoDoSensor[$int]-$minimoDoSensor[$int]))."\" />";

//echo '<table border="1">';
//for($c=0;$c<count($eixoX);$c++) {
//	echo '<tr>';
//	echo 	'<td>';
//	echo 		$eixoX[$c];
//	echo 	'</td>';
//	for($int=0;$int<$i;$int++) {
//		echo '<td>';
//		echo 	$eixoY[$int][$c];
//		echo '</td>';
//	}
//	echo '</tr>';
//}
//echo '</table>';

echo "<input type=\"hidden\" id=\"numeroSensores\" value=\"".$i."\" />";
echo "<div id=\"container-historico\" style=\"height: 93%; width: 100%\"></div>";
?>