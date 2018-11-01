<?php
	$arduino = fopen('COM1','w+');
	$string = fgets($arduino);
	while(!$string) {
		$string = fgets($arduino);
	}
	echo $string;
	fclose($arduino);
?>