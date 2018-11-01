<?php
$tempoInicial = microtime();

ini_set('display_errors', 0 );
error_reporting(0);
require_once('../includes/conectar.php');
require_once("../php/php_serial.class.php");
$porta = "/dev/ttyS0";
//$porta = "COM1";
//$serial = new phpSerial();
//
//$serial->deviceSet($porta);
//$serial->confBaudRate(9600);
//$serial->confParity("none");
//$serial->confCharacterLength(8);
//$serial->confStopBits(1);
//$serial->confFlowControl("none");
//
//
//$serial->deviceOpen();
//$read = $serial->readPort();
//while(!$read) {
//	$read = $serial->readPort();
//}
//$serial->deviceClose();
for($i=0;$i<10000;$i++) {
	
	$velocidade = rand(0, 150);
	$contagiro = rand(0, 4000);
	$tempo = date('H:i');
	$posicaoX = rand(-100, 100);
	$posicaoY = rand(-100, 100);
	$forcaGX = rand(40, 60);
	$forcaGY = rand(40, 60);
	$read = "V".$velocidade."C".$contagiro."T".$tempo."X".$posicaoX."Y".$posicaoY."G".$forcaGX."H".$forcaGY."F";
	//
	//echo $read.'<br />';
	
	$velocidade = stristr($read,"V");
	$contagiro = stristr($velocidade,"C");
	$tempo = stristr($contagiro,"T");
	$posicaoX = stristr($tempo,"X");
	$posicaoY = stristr($posicaoX,"Y");
	$forcaGX = stristr($posicaoY,"G");
	$forcaGY = stristr($forcaGX,"H");
	$fim = stristr($posicaoY,"F");
	$velocidade = substr($velocidade,1,-1*(strlen($contagiro)));
	$contagiro = substr($contagiro,1,-1*(strlen($tempo)));
	$tempo = substr($tempo,1,-1*(strlen($posicaoX)));
	$posicaoX = substr($posicaoX,1,-1*(strlen($posicaoY)));
	$posicaoY = substr($posicaoY,1,-1*(strlen($forcaGX)));
	$forcaGX = substr($forcaGX,1,-1*(strlen($forcaGY)));
	$forcaGY = substr($forcaGY,1,-1*(strlen($fim)));
	
	mysql_query('INSERT INTO dados (DAD_DATA_DT,DAD_VEL_IN,DAD_ROT_MOT_IN,DAD_POS_X_IN,DAD_POS_Y_IN,DAD_FG_X_IN,DAD_FG_Y_IN,DAD_ORD_IN)
					VALUES (\''.date('Y-m-d H:i:s').'\','.$velocidade.','.$contagiro.','.$posicaoX.','.$posicaoY.','.$forcaGX.','.$forcaGY.',1)');
	//echo 'INSERT INTO dados (DAD_DATA_DT,DAD_VEL_IN,DAD_ROT_MOT_IN,DAD_POS_X_IN,DAD_POS_Y_IN,DAD_FG_X_IN,DAD_FG_Y_IN,DAD_ORD_IN)
	//				VALUES (\''.date('Y-m-d H:i:s').'\','.$velocidade.','.$contagiro.','.$posicaoX.','.$posicaoY.','.$forcaGX.','.$forcaGY.',1);<br />';
	
	//$hoje = date('d_m_y');
	//$instante = date('H:i:s');
	//$log = fopen("logs/".$hoje.".txt", "a");
	//fwrite($log, "I".$instante."V".$velocidade."C".$contagiro."T".$tempo."X".$posicaoX."Y".$posicaoY."F\n");
	//fclose($log);

}

mysql_close($conecta);

$tempoFinal = microtime();

echo 'Dura&ccedil;&atilde;o:&nbsp;'.($tempoFinal-$tempoInicial);

?>