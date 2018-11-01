<?php
error_reporting(0);
ini_set('display_errors', '0');
require_once('../includes/conectar.php');
$cod = $_POST['cod'];
echo "<style>";
echo ".verticalText{";
echo 	"width: 30px;";
echo 	"margin: 0px;";
echo 	"padding: 0px;";
echo 	"padding-left: 0px;";
echo 	"padding-right: 90px;";
echo 	"padding-top: 65px;";
echo 	"white-space: nowrap;";
echo 	"-webkit-transform: rotate(-90deg);";
echo 	"-moz-transform: rotate(-90deg);                 ";
echo "};";
echo "</style>";

//parametros: 
//pid marcha lenta: SP,kP,kI,kD
//temp ideal: temp acionamento, desacionamento
//pid lambda: SP,kP,kI,kD
//aceleracao rapida:delta borb, k ganho, decaimento no ganho por rotacao 
//enriquecimento de partida
//limitacao de rotacao
//pressao do coletor

//correcao percentual temp motor
//correcao percentual pressao do ar
//correcao tensao bat

if($cod!=0) {
	$result = $mysqli->query("SELECT EST_MOT_NOM_VC
								FROM estrategia_motor
							   WHERE EST_MOT_IN_ID = ".$cod."");
	$row = $result->fetch_assoc();
	$EST_MOT_NOM_VC = $row["EST_MOT_NOM_VC"];
	$result = $mysqli->query("SELECT PAR_MOT_VAL_IN,
									 PAR_MOT_END_IN
								FROM parametros_motor
							   WHERE EST_MOT_IN_ID = ".$cod."");
	while($row = $result->fetch_assoc())
		$valoresParametros[$row["PAR_MOT_END_IN"]] = $row["PAR_MOT_VAL_IN"];
}
$enderecoROM = 0;
echo "<div id=\"dialog-estrategiaMotor\" class=\"dialog\" title=\"Mensagem\">";
echo "</div>";
echo "<center>";
echo 	"<table>";
echo 		"<tr>";
echo 			"<td>";
echo 				"<input class=\"form-control verificarPreenchimento\" type=\"text\" placeholder=\"Nome da estratégia\" size=\"40\" onChange=\"atualizaNomeEstrategiaMotor(this.value,".$cod.")\" value=\"".utf8_encode($EST_MOT_NOM_VC)."\" />";
echo 			"</td>";
if($cod==0) {
	echo 		"<td>";
	echo 			"&nbsp;";
	echo 			"&nbsp;";
	echo 			"<button onClick=\"salvarEstrategia()\" class=\"btn btn-primary\">";
	echo 				"Salvar";
	echo 			"</button>";
	echo 		"</td>";
}
echo 		"</tr>";
echo 	"</table>";
echo "</center>";
echo "<br />";
echo "<table width=\"100%\">";
echo 	"<tr>";
echo 		"<td>";
echo 		"</td>";
echo 		"<td>";
echo 			"<ul class=\"nav nav-tabs\">";
echo 				"<li class=\"active\"><a data-toggle=\"tab\" href=\"#mapaInj\" onClick=\"geraGrafico3DMapa('Inj')\">Mapa de injeção</a></li>";
echo 				"<li><a data-toggle=\"tab\" href=\"#mapaIgn\" onClick=\"geraGrafico3DMapa('Ign')\">Mapa de ignição</a></li>";
echo 				"<li><a data-toggle=\"tab\" href=\"#mapaLamb\" onClick=\"geraGrafico3DMapa('Lamb')\">Mapa de realimenteção</a></li>";
echo 				"<li><a data-toggle=\"tab\" href=\"#controleMarchaLenta\">Marcha lenta</a></li>";
echo 				"<li><a data-toggle=\"tab\" href=\"#controleRealimentacao\">Realimentação</a></li>";
echo 				"<li><a data-toggle=\"tab\" href=\"#controleTemperatura\">Temperatura</a></li>";
echo 				"<li><a data-toggle=\"tab\" href=\"#controleAceleracaoRapida\">Aceleração rápida</a></li>";
echo 			"</ul>";
echo 			"<div class=\"tab-content\">";
echo 				"<div id=\"mapaInj\" class=\"tab-pane fade in active\">";
echo 					"<table>";
echo 						"<tr>";
echo 							"<td>";
echo 								"<table>";
echo 									"<tr>";
echo 										"<td>";
echo 										"</td>";
echo 										"<td colspan=\"12\" style=\"vertical-align: middle;text-align: center;\">";
echo 											"Rotação (rpm)";
echo 										"</td>";
echo 									"</tr>";
echo 									"<tr>";
echo 										"<td rowspan=\"13\" style=\"vertical-align: middle;text-align: center;\">";
echo 											"<p class=\"verticalText\">";
echo 												"Acelerador (%)";
echo 											"</p>";
echo 										"</td>";
echo 									"</tr>";
for($i=-1;$i<11;$i++) {
	echo 								"<tr>";
	if($i==-1) {
		echo 								"<td style=\"vertical-align: middle;text-align: center;\">";
		echo 									"(ms)";
		echo 								"</td>";
		for($j=0;$j<11;$j++) {
			echo 							"<td style=\"vertical-align: middle;text-align: center;\">";
			echo 								$j*1000;
			echo 							"</td>";
		}
	} else {
		echo 								"<td style=\"vertical-align: middle;text-align: center;\">";
		echo 									$i*10;
		echo 								"</td>";
		for($j=0;$j<11;$j++) {
			echo 							"<td style=\"vertical-align: middle;text-align: center;\">";
			echo 								"<input type=\"number\" id=\"celulaMapaInj".$i."-".$j."\" value=\"";
			if($cod>0)
				echo 							($valoresParametros[$enderecoROM]/10);
			echo 								"\" name=\"".$enderecoROM++."\" class=\"verificarPreenchimento\" onChange=\"validaValorMapaInj(this,".$cod.")\" style=\"width:60px;text-align:center\" step=\"0.1\" size=\"1\" max=\"15\" min=\"0\" />"; //O valor salvo no banco de dados e multiplicado por 10
			echo 							"</td>";
		}
	}
	echo 								"</tr>";
}
echo 								"</table>";
echo 							"</td>";
echo 							"<td id=\"graficoMapaInj\">";
echo 							"</td>";
echo 						"</tr>";
echo 					"</table>";
echo 				"</div>";
echo 				"<div id=\"mapaIgn\" class=\"tab-pane fade\">";
echo 					"<table>";
echo 						"<tr>";
echo 							"<td>";
echo 								"<table>";
echo 									"<tr>";
echo 										"<td>";
echo 										"</td>";
echo 										"<td colspan=\"12\" style=\"vertical-align: middle;text-align: center;\">";
echo 											"Rotação (rpm)";
echo 										"</td>";
echo 									"</tr>";
echo 									"<tr>";
echo 										"<td rowspan=\"13\" style=\"vertical-align: middle;text-align: center;\">";
echo 											"<p class=\"verticalText\">";
echo 												"Acelerador (%)";
echo 											"</p>";
echo 										"</td>";
echo 									"</tr>";
for($i=-1;$i<11;$i++) {
	echo 								"<tr>";
	if($i==-1) {
		echo 								"<td style=\"vertical-align: middle;text-align: center;\">";
		echo 									"(º)";
		echo 								"</td>";
		for($j=0;$j<11;$j++) {
			echo 							"<td style=\"vertical-align: middle;text-align: center;\">";
			echo 								$j*1000;
			echo 							"</td>";
		}
	} else {
		echo 								"<td style=\"vertical-align: middle;text-align: center;\">";
		echo 									$i*10;
		echo 								"</td>";
		for($j=0;$j<11;$j++) {
			echo 							"<td style=\"vertical-align: middle;text-align: center;\">";
			echo 								"<input type=\"number\" id=\"celulaMapaIgn".$i."-".$j."\" value=\"";
			if($cod>0)
				echo 							$valoresParametros[$enderecoROM];
			echo 								"\" name=\"".$enderecoROM++."\" class=\"verificarPreenchimento\" onChange=\"validaValorMapaIgn(this,".$cod.")\"  style=\"width:60px;text-align:center\" step=\"1\" size=\"1\" max=\"120\" min=\"0\" />";
			echo 							"</td>";
		}
	}
	echo 								"</tr>";
}
echo 								"</table>";
echo 							"</td>";
echo 							"<td id=\"graficoMapaIgn\">";
echo 							"</td>";
echo 						"</tr>";
echo 					"</table>";
echo 				"</div>";
echo 				"<div id=\"mapaLamb\" class=\"tab-pane fade\">";
echo 					"<table>";
echo 						"<tr>";
echo 							"<td>";
echo 								"<table>";
echo 									"<tr>";
echo 										"<td>";
echo 										"</td>";
echo 										"<td colspan=\"12\" style=\"vertical-align: middle;text-align: center;\">";
echo 											"Rotação (rpm)";
echo 										"</td>";
echo 									"</tr>";
echo 									"<tr>";
echo 										"<td rowspan=\"13\" style=\"vertical-align: middle;text-align: center;\">";
echo 											"<p class=\"verticalText\">";
echo 												"Acelerador (%)";
echo 											"</p>";
echo 										"</td>";
echo 									"</tr>";
for($i=-1;$i<11;$i++) {
	echo 								"<tr>";
	if($i==-1) {
		echo 								"<td style=\"vertical-align: middle;text-align: center;\">";
		echo 									"(0/1)";
		echo 								"</td>";
		for($j=0;$j<11;$j++) {
			echo 							"<td style=\"vertical-align: middle;text-align: center;\">";
			echo 								$j*1000;
			echo 							"</td>";
		}
	} else {
		echo 								"<td style=\"vertical-align: middle;text-align: center;\">";
		echo 									$i*10;
		echo 								"</td>";
		for($j=0;$j<11;$j++) {
			echo 							"<td style=\"vertical-align: middle;text-align: center;\">";
			echo 								"<input type=\"number\" id=\"celulaMapaLamb".$i."-".$j."\" value=\"";
			if($cod>0)
				echo 							$valoresParametros[$enderecoROM];
			echo 								"\" name=\"".$enderecoROM++."\" class=\"verificarPreenchimento\" onChange=\"validaValorMapaLamb(this,".$cod.")\"  style=\"width:60px;text-align:center\" step=\"1\" size=\"1\" max=\"1\" min=\"0\" />";
			echo 							"</td>";
		}
	}
	echo 								"</tr>";
}
echo 								"</table>";
echo 							"</td>";
echo 							"<td id=\"graficoMapaLamb\">";
echo 							"</td>";
echo 						"</tr>";
echo 					"</table>";
echo 				"</div>";
echo 				"<div id=\"controleMarchaLenta\" class=\"tab-pane fade\">";
echo 					"<br />";
echo 					"<center>";
echo 						"<table class=\"table-striped\">";
echo 							"<tr>";
echo 								"<td style=\"text-align:center;padding:1\" colspan=\"2\" class=\"bordaAcima bordaEsquerda bordaDireita\">";
echo 									"Parâmetros de controle PID<br />da marcha lenta";
echo 								"</td>";
echo 							"</tr>";
echo 							"<tr>";
echo 								"<td style=\"text-align:right;padding:1\" class=\"bordaEsquerda\">";
echo 									"Rotação ideal (SP):";
echo 								"</td>";
echo 								"<td style=\"text-align:center;padding:1\" class=\"bordaDireita\">";
echo 									"<input type=\"number\" value=\"";
if($cod>0)
	echo 								($valoresParametros[$enderecoROM]*100);
echo 									"\" name=\"".$enderecoROM++."\" min=\"0\" max=\"4000\" step=\"100\" onChange=\"validarValorGenerico(0,4000,-2,this,".$cod.")\" class=\"form-control verificarPreenchimento input-sm\" style=\"width:70px;text-align:right\" value=\"".utf8_encode('')."\" />"; //sera armazenada rotacao dividido por cem
echo 								"</td>";
echo 							"</tr>";
echo 							"<tr>";
echo 								"<td style=\"text-align:right;padding:1\" class=\"bordaEsquerda\">";
echo 									"Ganho proporcional (kP):";
echo 								"</td>";
echo 								"<td style=\"text-align:center;padding:1\" class=\"bordaDireita\">";
echo 									"<input type=\"number\" value=\"";
if($cod>0)
	echo 								($valoresParametros[$enderecoROM]/10);
echo 									"\" name=\"".$enderecoROM++."\" min=\"0\" max=\"2\" step=\"0.1\" onChange=\"validarValorGenerico(0,2,1,this,".$cod.")\" class=\"form-control verificarPreenchimento input-sm\" style=\"width:70px;text-align:right\" value=\"".utf8_encode('')."\" />"; //sera armazenado ganho vezes 10
echo 								"</td>";
echo 							"</tr>";
echo 							"<tr>";
echo 								"<td style=\"text-align:right;padding:1\" class=\"bordaEsquerda\">";
echo 									"Ganho integral (kI):";
echo 								"</td>";
echo 								"<td style=\"text-align:center;padding:1\" class=\"bordaDireita\">";
echo 									"<input type=\"number\" value=\"";
if($cod>0)
	echo 								($valoresParametros[$enderecoROM]/10);
echo 									"\" name=\"".$enderecoROM++."\" min=\"0\" max=\"2\" step=\"0.1\" onChange=\"validarValorGenerico(0,2,1,this,".$cod.")\" class=\"form-control verificarPreenchimento input-sm\" style=\"width:70px;text-align:right\" value=\"".utf8_encode('')."\" />"; //sera armazenado ganho vezes 10
echo 								"</td>";
echo 							"</tr>";
echo 							"<tr>";
echo 								"<td style=\"text-align:right;padding:1\" style=\"width:50%\" class=\"bordaAbaixo bordaEsquerda\">";
echo 									"Ganho derivativa (kD):";
echo 								"</td>";
echo 								"<td style=\"text-align:center;padding:1\" class=\"bordaAbaixo bordaDireita\">";
echo 									"<input type=\"number\" value=\"";
if($cod>0)
	echo 								($valoresParametros[$enderecoROM]/10);
echo 									"\" name=\"".$enderecoROM++."\" min=\"0\" max=\"2\" step=\"0.1\" onChange=\"validarValorGenerico(0,2,1,this,".$cod.")\" class=\"form-control verificarPreenchimento input-sm\" style=\"width:70px;text-align:right\" value=\"".utf8_encode('')."\" />"; //sera armazenado ganho vezes 10
echo 								"</td>";
echo 							"</tr>";
echo 						"</table>";
echo 					"</center>";
echo 				"</div>";
echo 				"<div id=\"controleRealimentacao\" class=\"tab-pane fade\">";
echo 					"<br />";
echo 					"<center>";
echo 						"<table class=\"table-striped\">";
echo 							"<tr>";
echo 								"<td style=\"text-align:center;padding:1\" colspan=\"2\" class=\"bordaAcima bordaEsquerda bordaDireita\">";
echo 									"Parâmetros de controle PID<br />do enriquecimento da mistura";
echo 								"</td>";
echo 							"</tr>";
echo 							"<tr>";
echo 								"<td style=\"text-align:right;padding:1\" class=\"bordaEsquerda\">";
echo 									"Mistura ideal (SP):";
echo 								"</td>";
echo 								"<td style=\"text-align:center;padding:1\" class=\"bordaDireita\">";
echo 									"<input type=\"number\" value=\"";
if($cod>0)
	echo 								($valoresParametros[$enderecoROM]/10);
echo 									"\" name=\"".$enderecoROM++."\" min=\"0\" max=\"2\" step=\"0.1\" onChange=\"validarValorGenerico(0,2,1,this,".$cod.")\" class=\"form-control verificarPreenchimento input-sm\" style=\"width:70px;text-align:right\" value=\"".utf8_encode('')."\" >"; //sera armazenado o sp vezes 10
echo 								"</td>";
echo 							"</tr>";
echo 							"<tr>";
echo 								"<td style=\"text-align:right;padding:1\" class=\"bordaEsquerda\">";
echo 									"Ganho proporcional (kP):";
echo 								"</td>";
echo 								"<td style=\"text-align:center;padding:1\" class=\"bordaDireita\">";
echo 									"<input type=\"number\" value=\"";
if($cod>0)
	echo 								($valoresParametros[$enderecoROM]/10);
echo 									"\" name=\"".$enderecoROM++."\" min=\"0\" max=\"2\" step=\"0.1\" onChange=\"validarValorGenerico(0,2,1,this,".$cod.")\" class=\"form-control verificarPreenchimento input-sm\" style=\"width:70px;text-align:right\" value=\"".utf8_encode('')."\" >"; //sera armazenado ganho vezes 10
echo 								"</td>";
echo 							"</tr>";
echo 							"<tr>";
echo 								"<td style=\"text-align:right;padding:1\" class=\"bordaEsquerda\">";
echo 									"Ganho integral (kI):";
echo 								"</td>";
echo 								"<td style=\"text-align:center;padding:1\" class=\"bordaDireita\">";
echo 									"<input type=\"number\" value=\"";
if($cod>0)
	echo 								($valoresParametros[$enderecoROM]/10);
echo 									"\" name=\"".$enderecoROM++."\" min=\"0\" max=\"2\" step=\"0.1\" onChange=\"validarValorGenerico(0,2,1,this,".$cod.")\" class=\"form-control verificarPreenchimento input-sm\" style=\"width:70px;text-align:right\" value=\"".utf8_encode('')."\" >"; //sera armazenado ganho vezes 10
echo 								"</td>";
echo 							"</tr>";
echo 							"<tr>";
echo 								"<td style=\"text-align:right;padding:1\" style=\"width:50%\" class=\"bordaAbaixo bordaEsquerda\">";
echo 									"Ganho derivativa (kD):";
echo 								"</td>";
echo 								"<td style=\"text-align:center;padding:1\" class=\"bordaAbaixo bordaDireita\">";
echo 									"<input type=\"number\" value=\"";
if($cod>0)
	echo 								($valoresParametros[$enderecoROM]/10);
echo 									"\" name=\"".$enderecoROM++."\" min=\"0\" max=\"2\" step=\"0.1\" onChange=\"validarValorGenerico(0,2,1,this,".$cod.")\" class=\"form-control verificarPreenchimento input-sm\" style=\"width:70px;text-align:right\" value=\"".utf8_encode('')."\" >"; //sera armazenado ganho vezes 10
echo 								"</td>";
echo 							"</tr>";
echo 						"</table>";
echo 					"</center>";
echo 				"</div>";
echo 				"<div id=\"controleTemperatura\" class=\"tab-pane fade\">";
echo 					"<br />";
echo 					"<center>";
echo 						"<table class=\"table-striped\">";
echo 							"<tr>";
echo 								"<td style=\"text-align:center;padding:1\" colspan=\"2\" class=\"bordaAcima bordaEsquerda bordaDireita\">";
echo 									"Parâmetros de controle de temperatura";
echo 								"</td>";
echo 							"</tr>";
echo 							"<tr>";
echo 								"<td style=\"text-align:right;padding:1\" class=\"bordaEsquerda\">";
echo 									"Temperatura de acionamento da ventoinha:";
echo 								"</td>";
echo 								"<td style=\"text-align:center;padding:1\" class=\"bordaDireita\">";
echo 									"<div class=\"input-group input-group-sm\" style=\"width:95px;\">";
echo 										"<input type=\"number\" value=\"";
if($cod>0)
	echo 									$valoresParametros[$enderecoROM];
echo 										"\" name=\"".$enderecoROM++."\" min=\"0\" max=\"120\" onChange=\"validarValorGenerico(0,120,0,this,".$cod.")\" class=\"form-control verificarPreenchimento\" style=\"text-align:right\" value=\"".utf8_encode('')."\" >";
echo 										"<span class=\"input-group-addon\" id=\"sizing-addon3\">ºC</span>";
echo 									"</div>";
echo 								"</td>";
echo 							"</tr>";
echo 							"<tr>";
echo 								"<td style=\"text-align:right;padding:1\" class=\"bordaAbaixo bordaEsquerda\">";
echo 									"Temperatura de desacionamento da ventoinha:";
echo 								"</td>";
echo 								"<td style=\"text-align:center;padding:1\" class=\"bordaAbaixo bordaDireita\">";
echo 									"<div class=\"input-group input-group-sm\" style=\"width:95px;\">";
echo 										"<input type=\"number\" value=\"";
if($cod>0)
	echo 									$valoresParametros[$enderecoROM];
echo 										"\" name=\"".$enderecoROM++."\" min=\"0\" max=\"120\" onChange=\"validarValorGenerico(0,120,0,this,".$cod.")\" class=\"form-control verificarPreenchimento\" style=\"text-align:right\" value=\"".utf8_encode('')."\" >";
echo 										"<span class=\"input-group-addon\" id=\"sizing-addon3\">ºC</span>";
echo 									"</div>";
echo 								"</td>";
echo 							"</tr>";
echo 						"</table>";
echo 					"</center>";
echo 				"</div>";
echo 				"<div id=\"controleAceleracaoRapida\" class=\"tab-pane fade\">";
echo 					"<br />";
echo 					"<center>";
echo 						"<table class=\"table-striped\">";
echo 							"<tr>";
echo 								"<td style=\"text-align:center;padding:1\" colspan=\"2\" class=\"bordaAcima bordaEsquerda bordaDireita\">";
echo 									"Parâmetros de controle da aceleração rápida";
echo 								"</td>";
echo 							"</tr>";
echo 							"<tr>";
echo 								"<td style=\"text-align:right;padding:1\" class=\"bordaEsquerda\">";
echo 									"Variação da borboleta:";
echo 								"</td>";
echo 								"<td style=\"text-align:center;padding:1\" class=\"bordaDireita\">";
echo 									"<div class=\"input-group input-group-sm\" style=\"width:95px;\">";
echo 										"<input type=\"number\" value=\"";
if($cod>0)
	echo 									$valoresParametros[$enderecoROM];
echo 										"\" name=\"".$enderecoROM++."\" min=\"0\" max=\"100\" onChange=\"validarValorGenerico(0,100,0,this,".$cod.")\" class=\"form-control verificarPreenchimento\" style=\"text-align:right\" value=\"".utf8_encode('')."\" >";
echo 										"<span class=\"input-group-addon\" id=\"sizing-addon3\">%</span>";
echo 									"</div>";
echo 								"</td>";
echo 							"</tr>";
echo 							"<tr>";
echo 								"<td style=\"text-align:right;padding:1\" class=\"bordaEsquerda\">";
echo 									"Ganho (k):";
echo 								"</td>";
echo 								"<td style=\"text-align:center;padding:1\" class=\"bordaDireita\">";
echo 									"<input type=\"number\" value=\"";
if($cod>0)
	echo 								($valoresParametros[$enderecoROM]/10);
echo 									"\" name=\"".$enderecoROM++."\" min=\"0\" max=\"2\" step=\"0.1\" onChange=\"validarValorGenerico(0,2,1,this,".$cod.")\" class=\"form-control verificarPreenchimento input-sm\" style=\"width:95px;text-align:right\" value=\"".utf8_encode('')."\" >"; //sera armazenado ganho vezes 10
echo 								"</td>";
echo 							"</tr>";
echo 							"<tr>";
echo 								"<td style=\"text-align:right;padding:1\" class=\"bordaAbaixo bordaEsquerda\">";
echo 									"Decaimento no ganho por rotação:";
echo 								"</td>";
echo 								"<td style=\"text-align:center;padding:1\" class=\"bordaAbaixo bordaDireita\">";
echo 									"<div class=\"input-group input-group-sm\" style=\"width:95px;\">";
echo 										"<input type=\"number\" value=\"";
if($cod>0)
	echo 									$valoresParametros[$enderecoROM];
echo 										"\" name=\"".$enderecoROM++."\" min=\"0\" max=\"100\" onChange=\"validarValorGenerico(0,100,0,this,".$cod.")\" class=\"form-control verificarPreenchimento\" style=\"text-align:right\" value=\"".utf8_encode('')."\" >";
echo 										"<span class=\"input-group-addon\" id=\"sizing-addon3\">%</span>";
echo 									"</div>";
echo 								"</td>";
echo 							"</tr>";
echo 						"</table>";
echo 					"</center>";
echo 				"</div>";
echo 			"</div>";
echo 		"</td>";
echo 	"</tr>";
echo "</table>";
?>