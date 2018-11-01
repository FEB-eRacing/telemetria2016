<?php
ini_set('display_errors', 0 );
error_reporting(0);
class Form {
	function getIntValue($method, $name)
	{
		eval("\$vars = \$_".$method.";");
		return (int) $vars[$name];
	}
	function getFloatValue($method, $name)
	{
		eval("\$vars = \$_".$method.";");
		return (float) $vars[$name];
	}
	function getStringValue($method, $name)
	{
		eval("\$vars = \$_".$method.";");
		$vars[$name] = trim($vars[$name]);
		return (string) $vars[$name];
	}
	function getSQLStringValue($method, $name)
	{
		$list = ARRAY (
                    "insert", "select", "update", "delete", "distinct", "having", "truncate", "replace",
                    "handler", "like", " as ", "or ", "procedure", "limit", "order by", "group by", "asc", "desc"
        );
		eval("\$vars = \$_".$method.";");
		$vars[$name] = trim(str_replace($list, '', ereg_replace("[^a-zA-Z0-9 ]+", "", $vars[$name])));
		return (string) $vars[$name];	
	}
	function isNumeric($method, $name)
	{
		eval("\$vars = \$_".$method.";");
		return is_numeric($vars[$name]);
	}
	function isAlphaNumeric($method, $name)
	{
		eval("\$vars = \$_".$method.";");
		if (eregi("[^a-zA-Z0-9]+", $vars[$name]))
		return false;
		return true;
	}
	function isAlphaNumericWithSpace($method, $name)
	{
		eval("\$vars = \$_".$method.";");
		if (eregi("[^a-zA-Z0-9 ]+", $vars[$name]))
		return false;
		return true;
	}
}
function corrigeAcentuacao($texto) {
	$texto = str_replace("รก", "แ", $texto);
	$texto = str_replace("รข", "โ", $texto);
	$texto = str_replace("รฃ", "ใ", $texto);
	$texto = str_replace("รฉ", "้", $texto);
	$texto = str_replace("รช", "๊", $texto);
	$texto = str_replace("รญ", "ํ", $texto);
	$texto = str_replace("รฎ", "๎", $texto);
	$texto = str_replace("รณ", "๓", $texto);
	$texto = str_replace("รด", "๔", $texto);
	$texto = str_replace("รต ", "๕", $texto);
	$texto = str_replace("รบ", "๚", $texto);
	$texto = str_replace("รป", "๛", $texto);  
	$texto = str_replace("ร?", "ม", $texto);
	$texto = str_replace("ร", "ย", $texto);
	$texto = str_replace("ร", "ร", $texto);
	$texto = str_replace("ร", "ษ", $texto);
	$texto = str_replace("ร", "ส", $texto);
	$texto = str_replace("ร?", "อ", $texto);
	$texto = str_replace("ร“", "ำ", $texto);
	$texto = str_replace("ร”", "ิ", $texto);
	$texto = str_replace("ร•", "ี", $texto);
	$texto = str_replace("ร", "ฺ", $texto);  
	$texto = str_replace("รง", "็", $texto);
	$texto = str_replace("ร", "ว", $texto);
	$texto = str_replace("ยบ", "บ", $texto);  
	return $texto;  
}
?>