<?php
set_time_limit(10);
error_reporting(0);
ini_set(“display_errors”, 0 );
require_once('../includes/conectar.php');
if (mysqli_connect_errno())
	echo "<center>Erro ao conectar no banco de dados: " . mysqli_connect_error()."</center>";
while(1) {
	//for($codSensor = 0x40;$codSensor<=0x43;$codSensor++) {
	//	$valSensor = rand(0,4095);
	//	$mysqli->query("INSERT INTO DADOS_ANALOGICOS (DAD_VAL_IN,DAD_COD_IN,DAD_DATA_DT) VALUES (".$valSensor.",".$codSensor.",CURRENT_TIMESTAMP());");
	//}
	$valSensor = rand(0,4095);
	$mysqli->query("INSERT INTO DADOS_ANALOGICOS (DAD_VAL_IN,DAD_COD_IN,DAD_DATA_DT) VALUES (".$valSensor.",72,CURRENT_TIMESTAMP());");
	$valSensor = rand(0,4095);
	$mysqli->query("INSERT INTO DADOS_ANALOGICOS (DAD_VAL_IN,DAD_COD_IN,DAD_DATA_DT) VALUES (".$valSensor.",73,CURRENT_TIMESTAMP());");
	$valSensor = rand(0,4095);
	$mysqli->query("INSERT INTO DADOS_ANALOGICOS (DAD_VAL_IN,DAD_COD_IN,DAD_DATA_DT) VALUES (".$valSensor.",88,CURRENT_TIMESTAMP());");
	usleep(500000);
}
?>