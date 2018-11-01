<?php
	$velocidade = rand(0, 150);
	$contagiro = rand(0, 4000);
	$tempo = date('H:i');
	$posicaoX = rand(-100, 100);
	$posicaoY = rand(-100, 100);
	$read = "V".$velocidade."C".$contagiro."T".$tempo."X".$posicaoX."Y".$posicaoY."F";
	$velocidade = stristr($read,"V");
	$contagiro = stristr($velocidade,"C");
	$tempo = stristr($contagiro,"T");
	$posicaoX = stristr($tempo,"X");
	$posicaoY = stristr($posicaoX,"Y");
	$fim = stristr($posicaoY,"F");
	$velocidade = substr($velocidade,1,-1*(strlen($contagiro)));
	$contagiro = substr($contagiro,1,-1*(strlen($tempo)));
	$tempo = substr($tempo,1,-1*(strlen($posicaoX)));
	$posicaoX = substr($posicaoX,1,-1*(strlen($posicaoY)));
	$posicaoY = substr($posicaoY,1,-1*(strlen($fim)));
	echo $velocidade.'<br />';
	echo $contagiro.'<br />';
	echo $tempo.'<br />';
	echo $posicaoX.'<br />';
	echo $posicaoY.'<br />';
?>