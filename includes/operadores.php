<?php
error_reporting(0);
ini_set("display_errors", 0 );
require_once('../includes/conectar.php');
$result = $mysqli->query("SELECT OPR_IN_ID,OPR_US_VC,OPR_NM_VC,OPR_AC_IN FROM operador ORDER BY OPR_US_VC");
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
echo 	"<button onClick=\"incluir()\" class=\"btn btn-primary\">";
echo 		"Novo";
echo 	"</button>";
echo 	"<br />";
echo 	"<br />";
echo 	"<table id=\"operadores\" class=\"table-striped\">";
while($row = $result->fetch_assoc()) {
	//if($row["OPR_US_VC"]!='messias') {
	echo 	"<tr id = ".$row["OPR_IN_ID"].">";
	echo 		"<td style=\"text-align:center;padding:1\" class=\"bordaAcimaAbaixo bordaEsquerda\">";
	echo 			"<input type=\"text\" class=\"form-control\" placeholder=\"Nome\" onChange=\"mudaNomeOperador('".$row["OPR_IN_ID"]."',this.value);\" value=\"".$row["OPR_NM_VC"]."\" />";
	echo 		"</td>";
	echo 		"<td style=\"text-align:center;padding:1\" class=\"bordaAcimaAbaixo\">";
	echo 			"<input type=\"text\" class=\"form-control\" placeholder=\"Usuário\" onChange=\"mudaUsuario('".$row["OPR_IN_ID"]."',this.value);\" value=\"".$row["OPR_US_VC"]."\">";
	echo 		"</td>";
	echo 		"<td style=\"text-align:center;padding:1\" class=\"bordaAcimaAbaixo\">";
	echo 			"<select class=\"selectmenu\">";
	$result2 = $mysqli->query("SELECT * FROM tipo_acesso_operador order by TIP_AC_VAL_VC");
	while($row2 = $result2->fetch_assoc()) {
		echo 				"<option ";
		if($row["OPR_AC_IN"]==$row2["TIP_AC_IN_ID"])
			echo 			"selected=\"selected\" ";
		echo 				"value=\"".$row2["TIP_AC_IN_ID"]."\">";
		echo					utf8_encode($row2["TIP_AC_VAL_VC"]);
		echo 				"</option>";
	}
	echo 			"</select>";
	echo 		"</td>";
	echo 		"<td class=\"bordaAcimaAbaixo\">";
	echo 			"<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\" onClick=\"mudaSenha('".$row["OPR_IN_ID"]."')\">";
	echo 				"<li class=\"ui-state-default ui-corner-all\" title=\"Mudar senha\">";
	echo 					"<span class=\"ui-icon ui-icon-key\">";
	echo 					"</span>";
	echo 				"</li>";
	echo 			"</ul>";
	echo 		"</td>";
	echo 		"<td class=\"bordaAcimaAbaixo bordaDireita\">";
	echo 			"<ul id=\"icons\" class=\"ui-widget ui-helper-clearfix\" onClick=\"confirmaExclusao('".$row["OPR_IN_ID"]."')\">";
	echo 				"<li class=\"ui-state-default ui-corner-all\" title=\"Excluir\">";
	echo 					"<span class=\"ui-icon ui-icon-trash\">";
	echo 					"</span>";
	echo 				"</li>";
	echo 			"</ul>";
	echo 		"</td>";
	echo 	"</tr>";
	//}
}
echo 	"</table>";
echo "</center>";
?>