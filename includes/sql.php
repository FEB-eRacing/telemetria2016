<?php
require_once('conectar.php');
ini_set('display_errors', '0');
$gmtDate = gmdate("D, d M Y H:i:s");
header("Expires: {$gmtDate} GMT");
header("Last-Modified: {$gmtDate} GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
date_default_timezone_set('America/Sao_Paulo');
$acao = $_POST["acao"];
if($acao=='mudaNomeOperador') {
	$cod = $_POST["cod"];
	$nome = $_POST["nome"];
	$result = $mysqli->query("SELECT 1 FROM operador WHERE OPR_IN_ID = ".$cod."");
	if($result->num_rows==1) {
		if($mysqli->query("UPDATE operador SET OPR_NM_VC = '".$nome."' WHERE OPR_IN_ID = ".$cod.""))
			echo 'Nome alterado com sucesso.';
		else
			echo 'Problema na altera&ccedil;&atilde;o.';
	} else 
		echo 'Nome n&atilde;o encontrado.';
} elseif($acao=='mudaUsuarioOperador') {
	$cod = $_POST["cod"];
	$usuario = $_POST["usuario"];
	$result = $mysqli->query("SELECT 1 FROM operador WHERE OPR_IN_ID = ".$cod."");
	if($result->num_rows==1) {
		$result = $mysqli->query("SELECT 1 FROM operador WHERE OPR_US_VC = '".$usuario."'");
		if($result->num_rows==0)
			if($mysqli->query("UPDATE operador SET OPR_US_VC = '".$usuario."' WHERE OPR_IN_ID = ".$cod.""))
				echo 'Usu&aacute;rio alterado com sucesso.';
			else
				echo 'Problema na altera&ccedil;&atilde;o.';
		else
			echo 'J&aacute; existe um usu&aacute;rio cadastrado com esse nome.';
	} else 
		echo 'Usu&aacute;rio n&atilde;o encontrado.';
} elseif($acao=='mudaAcessoOperador') {
	$cod = $_POST["cod"];
	$acesso = $_POST["acesso"];
	$result = $mysqli->query("SELECT 1 FROM operador WHERE OPR_IN_ID = ".$cod."");
	if($result->num_rows==1) {
		if($mysqli->query("UPDATE operador SET OPR_AC_IN = ".$acesso." WHERE OPR_IN_ID = ".$cod.""))
			echo 'Acesso alterado com sucesso.';
		else
			echo 'Problema na altera&ccedil;&atilde;o.';
	} else 
		echo 'Acesso n&atilde;o encontrado.';
} elseif($acao=='mudaSenhaOperador') {
	$cod = $_POST["cod"];
	$senha = $_POST["senha"];
	$senha = md5($senha);
	$result = $mysqli->query("SELECT 1 FROM operador WHERE OPR_IN_ID = ".$cod."");
	if($result->num_rows==1) {
		if($mysqli->query("UPDATE operador SET OPR_SN_VC = '".$senha."' WHERE OPR_IN_ID = ".$cod.""))
			echo 'Senha alterada com sucesso.';
		else
			echo 'Problema na altera&ccedil;&atilde;o.';
	} else 
		echo 'Senha n&atilde;o encontrada.';
} elseif($acao=='novoOperador') {
	$nome = $_POST["nome"];
	$usuario = $_POST["usuario"];
	$acesso = $_POST["acesso"];
	$result = $mysqli->query("SELECT * FROM operador WHERE OPR_US_VC = '".$usuario."'");
	if($result->num_rows==0) {
		if($mysqli->query("INSERT INTO operador (OPR_US_VC,OPR_SN_VC,OPR_NM_VC,OPR_AC_IN)
							VALUES ('".$usuario."','".md5('123456')."','".$nome."',".$acesso.")")) {
			echo json_encode(array("RESPOSTA"=>"Usu&aacute;rio cadastrado com sucesso, a senha padr&atilde;o &eacute; 123456.","SEQUENCIA"=>$mysqli->insert_id));
		} else
			echo json_encode(array("RESPOSTA"=>"Problema na inser&ccedil;&atilde;o.","SEQUENCIA"=>"0"));
	} else
		echo json_encode(array("RESPOSTA"=>"Nome de usu&aacute;rio j&aacute; cadastrado,<br />escolha outro.","SEQUENCIA"=>"0"));
} elseif($acao=='excluiOperador') {
	$cod = $_POST["cod"];
	$result = $mysqli->query("SELECT 1 FROM operador WHERE OPR_IN_ID = ".$cod."");
	if($result->num_rows==1) {
		if($mysqli->query("DELETE FROM operador WHERE OPR_IN_ID = ".$cod.""))
			echo "Operador exclu&iacute;do com sucesso.";
		else
			echo 'Problema na dele&ccedil;&atilde;o.';
	} else
		echo "Operador n&atilde;o encontrado.";
} elseif($acao=='selecionaTipoAcessoOperador') {
	$result = $mysqli->query("SELECT * FROM tipo_acesso_operador order by TIP_AC_VAL_VC");
	$output = "[";
	while($row = $result->fetch_assoc()) {
		if ($output != "[") 
			$output .= ",";
		$output .= '{"COD":"'.$row["TIP_AC_IN_ID"].'",';
		$output .= '"VAL":"'.utf8_encode($row["TIP_AC_VAL_VC"]).'"}';
	}
	$output .="]";
	echo $output;
} elseif($acao=='selecionaTipoAcessoOperadorSensor') {
	$cod = $_POST["cod"];
	$result = $mysqli->query("SELECT * FROM tipo_acesso_operador order by TIP_AC_VAL_VC");
	$output = "[";
	while($row = $result->fetch_assoc()) {
		if ($output != "[") 
			$output .= ",";
		$output .= '{"COD":"'.$row["TIP_AC_IN_ID"].'",';
		if($cod>0) {
			$result2 = $mysqli->query("SELECT * 
										 FROM tipo_acesso_operador_sensor 
									    WHERE TIP_AC_IN_ID = ".$row["TIP_AC_IN_ID"]." 
										  AND SENS_IN_ID   = ".$cod."");
			$output .= '"SEL":"'.$result2->num_rows.'",';
		} else
			$output .= '"SEL":"",';
		$output .= '"VAL":"'.utf8_encode($row["TIP_AC_VAL_VC"]).'"}';
	}
	$output .="]";
	echo $output;
} elseif($acao=='selecionaDadosSensor') {
	$cod = $_POST["cod"];
	if($cod>0) {
		$result = $mysqli->query("SELECT * FROM sensores WHERE SENS_IN_ID = ".$cod."");
		$row = $result->fetch_assoc();
	}
	$output = "[";
	$output .= '{"valSensor":"'.utf8_encode($row["SENS_VAL_VC"]).'",';
	$output .= '"valUnidade":"'.utf8_encode($row["SENS_UNID_VC"]).'",';
	$output .= '"valCodigo":"'.$row["SENS_COD_IN"].'",';
	$output .= '"valFrequencia":"'.$row["SENS_FREQ_IN"].'",';
	$output .= '"valMaximo":"'.$row["SENS_MAX_IN"].'",';
	$output .= '"valMinimo":"'.$row["SENS_MIN_IN"].'",';
	$output .= '"valFtrans":"'.$row["SENS_FTRANS_VC"].'",';
	$output .= '"valTipo":"'.$row["SENS_TIP_IN"].'"}';
	$output .="]";
	echo $output;
} elseif($acao=='insertSensor') {
	$valSensor = $_POST["valSensor"];
	$valUnidade = $_POST["valUnidade"];
	$valCodigo = $_POST["valCodigo"];
	$valFrequencia = $_POST["valFrequencia"];
	$valMaximo = $_POST["valMaximo"];
	$valMinimo = $_POST["valMinimo"];
	$valFtrans = $_POST["valFtrans"];
	$valTipo = $_POST["valTipo"];
	$checkeds = $_POST["checkeds"];
	$mysqli->set_charset("utf8");
	if($mysqli->query("INSERT INTO sensores
						(SENS_VAL_VC,
						SENS_UNID_VC,
						SENS_COD_IN,
						SENS_FREQ_IN,
						SENS_MAX_IN,
						SENS_MIN_IN,
						SENS_FTRANS_VC,
						SENS_TIP_IN)
					   VALUES
					    ('".$valSensor."',
					    '".$valUnidade."',
					    ".$valCodigo.",
					    ".$valFrequencia.",
					    ".$valMaximo.",
					    ".$valMinimo.",
					    '".$valFtrans."',
						".$valTipo.")")) {
		$id = $mysqli->insert_id;
		for($i=0;$i<count($checkeds);$i++)
			$mysqli->query("INSERT INTO tipo_acesso_operador_sensor
								(TIP_AC_IN_ID,
								SENS_IN_ID)
								VALUES
								(".$checkeds[$i].",
								".$id.")");
		$resposta = "Sensor cadastrado com sucesso.";
	} else
		$resposta = "Problema na inser&ccedil;&atilde;o.";
	$output = "[";
	$output .= '{"resposta":"'.$resposta.'",';
	$output .= '"cod":"'.$id.'"}';
	$output .="]";
	echo $output;
} elseif($acao=='updateSensor') {
	$cod = $_POST["cod"];
	$valSensor = $_POST["valSensor"];
	$valUnidade = $_POST["valUnidade"];
	$valCodigo = $_POST["valCodigo"];
	$valFrequencia = $_POST["valFrequencia"];
	$valMaximo = $_POST["valMaximo"];
	$valMinimo = $_POST["valMinimo"];
	$valFtrans = $_POST["valFtrans"];
	$valTipo = $_POST["valTipo"];
	$checkeds = $_POST["checkeds"];
	$mysqli->set_charset("utf8");
	if($mysqli->query("UPDATE sensores SET
						SENS_VAL_VC = '".$valSensor."',
						SENS_UNID_VC = '".$valUnidade."',
						SENS_COD_IN = ".$valCodigo.",
						SENS_FREQ_IN = ".$valFrequencia.",
						SENS_MAX_IN = ".$valMaximo.",
						SENS_MIN_IN = ".$valMinimo.",
						SENS_FTRANS_VC = '".$valFtrans."',
						SENS_TIP_IN = ".$valTipo."
					   WHERE
					    SENS_IN_ID = ".$cod."")) {
		$mysqli->query("DELETE FROM tipo_acesso_operador_sensor
							  WHERE SENS_IN_ID = ".$cod."");
		for($i=0;$i<count($checkeds);$i++)
			$mysqli->query("INSERT INTO tipo_acesso_operador_sensor
								(TIP_AC_IN_ID,
								SENS_IN_ID)
								VALUES
								(".$checkeds[$i].",
								".$cod.")");
		$resposta = "Sensor alterado com sucesso.";
	} else
		$resposta = "Problema na inser&ccedil;&atilde;o.";
	$output = "[";
	$output .= '{"resposta":"'.$resposta.'"}';
	$output .="]";
	echo $output;
} elseif($acao=='excluiSensor') {
	$cod = $_POST["cod"];
	$result = $mysqli->query("SELECT * FROM sensores WHERE SENS_IN_ID = ".$cod."");
	if($result->num_rows==1) {
		if($mysqli->query("DELETE FROM sensores WHERE SENS_IN_ID = ".$cod.""))
			echo "Sensor exclu&iacute;do com sucesso.";
		else
			echo 'Problema na dele&ccedil;&atilde;o.';
	} else
		echo "Sensor n&atilde;o encontrado.";
} elseif($acao=='aquisitaDadosDashboard') {
	$ids = $_POST['ids'];
	$output = "["; 
	for($i=0;$i<count($ids);$i++) {
		$result = $mysqli->query("SELECT SENS_COD_IN,
										 SENS_MAX_IN,
										 SENS_MIN_IN,
										 SENS_FTRANS_VC
									FROM sensores
								   WHERE SENS_IN_ID = ".$ids[$i]."");
		$row = $result->fetch_assoc();
		$result2 = $mysqli->query("SELECT DAD_DATA_DT,
  	                                      DAD_VAL_IN
                                     FROM dados_analogicos
                                    WHERE DAD_COD_IN = ".$row["SENS_COD_IN"]."
                                 ORDER BY DAD_IN_ID DESC
                                    LIMIT 1");
		$row2 = $result2->fetch_assoc();
		if($output!='[')
			$output .= ',';
		$output .= '{"DAD_DATA_DT":"'.strtotime($row2["DAD_DATA_DT"]).'",';
		if(((time()-strtotime($row2["DAD_DATA_DT"]))>5)||!($row2["DAD_VAL_IN"]))
			$output .= '"DAD_VAL_IN":"'.($row["SENS_MIN_IN"]-0.1*($row["SENS_MAX_IN"]-$row["SENS_MIN_IN"])).'"}';
		else {
			if($row["SENS_FTRANS_VC"] && $row2["DAD_VAL_IN"])
				$valor = str_replace("x",$row2["DAD_VAL_IN"],$row["SENS_FTRANS_VC"]);
			else
				$valor = $row2["DAD_VAL_IN"];
			$output .= '"DAD_VAL_IN":"'.$valor.'"}';
		}
	}
	$output .="]";
	echo $output;
} elseif($acao=='ativaOuDesativaSensor') {
	$atv = $_POST['atv'];
	$cod = $_POST['cod'];
	if($atv=='true')
		if($mysqli->query("UPDATE sensores
							  SET SENS_ATV_BT = 1
							WHERE SENS_IN_ID = ".$cod.""))
			echo "Sensor ativado com sucesso.";
		else
			echo 'Problema na altera&ccedil;&atilde;o.';
	else
		if($mysqli->query("UPDATE sensores
							  SET SENS_ATV_BT = 0
							WHERE SENS_IN_ID = ".$cod.""))
			echo "Sensor desativado com sucesso.";
		else
			echo 'Problema na altera&ccedil;&atilde;o.';
} elseif($acao=='salvarEstrategia') {
	$EST_MOT_NOM_VC = utf8_decode($_POST['EST_MOT_NOM_VC']);
	$enderecoROMMapaInj = $_POST['enderecoROMMapaInj'];
	$valMapaInj = $_POST['valMapaInj'];
	$enderecoROMMapaIgn = $_POST['enderecoROMMapaIgn'];
	$valMapaIgn = $_POST['valMapaIgn'];
	$enderecoROMMapaLamb = $_POST['enderecoROMMapaLamb'];
	$valMapaLamb = $_POST['valMapaLamb'];
	$enderecoROMParametros = $_POST['enderecoROMParametros'];
	$valMapaParametros = $_POST['valMapaParametros'];
	if($mysqli->query("SELECT 1 FROM estrategia_motor WHERE EST_MOT_NOM_VC = '".$EST_MOT_NOM_VC."'")->num_rows==0) {
		if($mysqli->query("INSERT INTO estrategia_motor
							(EST_MOT_NOM_VC,
							EST_MOT_ATV_IN)
						VALUES
							('".$EST_MOT_NOM_VC."',
							0)")) {
			$EST_MOT_IN_ID = $mysqli->insert_id;
			$sql = 'INSERT INTO parametros_motor (EST_MOT_IN_ID,PAR_MOT_VAL_IN,PAR_MOT_END_IN,PAR_MOT_FLAG_IN) VALUES ';
			for($i=0;$i<count($valMapaInj);$i++) {
				if($i>0)
					$sql .= ',';
				$sql .= '('.$EST_MOT_IN_ID.','.$valMapaInj[$i].','.$enderecoROMMapaInj[$i].',0)';
			}
			for($i=0;$i<count($valMapaIgn);$i++)
				$sql .= ',('.$EST_MOT_IN_ID.','.$valMapaIgn[$i].','.$enderecoROMMapaIgn[$i].',0)';
			for($i=0;$i<count($valMapaLamb);$i++)
				$sql .= ',('.$EST_MOT_IN_ID.','.$valMapaLamb[$i].','.$enderecoROMMapaLamb[$i].',0)';
			for($i=0;$i<count($valMapaParametros);$i++)
				$sql .= ',('.$EST_MOT_IN_ID.','.$valMapaParametros[$i].','.$enderecoROMParametros[$i].',0)';
			if($mysqli->query($sql))
				echo 'Cadastro efetuado com sucesso.';
			else
				echo 'Problema no cadastro dos parâmetros.';
		} else
			echo 'Problema no cadastro.';
	} else
		echo 'Nome de estratégia já cadastrada.';
} elseif($acao=='excluiEstrategia') {
	$EST_MOT_IN_ID = $_POST['cod'];
	if($mysqli->query("DELETE FROM estrategia_motor WHERE EST_MOT_IN_ID = ".$EST_MOT_IN_ID.""))
		if($mysqli->query("DELETE FROM parametros_motor WHERE EST_MOT_IN_ID = ".$EST_MOT_IN_ID.""))
			echo "Estratégia excluída com sucesso.";
		else
			echo 'Problema na exclusão dos parâmetros.';
	else
		echo 'Problema na exclusão da estratégia.';
} elseif($acao=='atualizaNomeEstrategiaMotor') {
	$EST_MOT_IN_ID = $_POST['cod'];
	$EST_MOT_NOM_VC = utf8_decode($_POST['EST_MOT_NOM_VC']);
	if($mysqli->query("SELECT 1 FROM estrategia_motor WHERE EST_MOT_NOM_VC = '".$EST_MOT_NOM_VC."'")->num_rows==0)
		if($mysqli->query("UPDATE estrategia_motor
							  SET EST_MOT_NOM_VC = '".$EST_MOT_NOM_VC."'
							WHERE EST_MOT_IN_ID = ".$EST_MOT_IN_ID.""))
			echo "Atualizado com sucesso.";
		else
			echo 'Problema na altera&ccedil;&atilde;o.';
	else
		echo 'Nome já cadastrado.';
} elseif($acao=='atualizaParametroEstrategiaMotor') {
	$EST_MOT_IN_ID = $_POST['EST_MOT_IN_ID'];
	$PAR_MOT_VAL_IN = $_POST['PAR_MOT_VAL_IN'];
	$PAR_MOT_END_IN = $_POST['PAR_MOT_END_IN'];
	if($mysqli->query("SELECT 1 FROM estrategia_motor WHERE EST_MOT_IN_ID = '".$EST_MOT_IN_ID."' AND EST_MOT_ATV_IN = 1")->num_rows==1)
		$flag = ",PAR_MOT_FLAG_IN = 1";
	if($mysqli->query("UPDATE parametros_motor
						  SET PAR_MOT_VAL_IN = ".$PAR_MOT_VAL_IN." ".$flag."
						WHERE EST_MOT_IN_ID = ".$EST_MOT_IN_ID."
						  AND PAR_MOT_END_IN = ".$PAR_MOT_END_IN.""))
		echo "Atualizado com sucesso.";
	else
		echo 'Problema na altera&ccedil;&atilde;o.';
} elseif($acao=='estrategiaEscolhida') {
	$EST_MOT_IN_ID = $_POST['EST_MOT_IN_ID'];
	if($mysqli->query("UPDATE estrategia_motor
						  SET EST_MOT_ATV_IN = 0
						WHERE EST_MOT_ATV_IN = 1"))
		if($mysqli->query("UPDATE parametros_motor
							  SET PAR_MOT_FLAG_IN = 0
							WHERE PAR_MOT_FLAG_IN = 1"))
			if($mysqli->query("UPDATE estrategia_motor
								  SET EST_MOT_ATV_IN = 1
								WHERE EST_MOT_IN_ID = ".$EST_MOT_IN_ID.""))
				if($mysqli->query("UPDATE parametros_motor
									  SET PAR_MOT_FLAG_IN = 1
								    WHERE EST_MOT_IN_ID = ".$EST_MOT_IN_ID.""))
					echo "Selecionada com sucesso.";
				else
					echo 'Problema na escolha.';
			else
				echo 'Problema na escolha.';
		else
			echo 'Problema na escolha.';
	else
		echo 'Problema na escolha.';
}
?>