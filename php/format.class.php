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
	$texto = str_replace("á", "�", $texto);
	$texto = str_replace("â", "�", $texto);
	$texto = str_replace("ã", "�", $texto);
	$texto = str_replace("é", "�", $texto);
	$texto = str_replace("ê", "�", $texto);
	$texto = str_replace("í", "�", $texto);
	$texto = str_replace("î", "�", $texto);
	$texto = str_replace("ó", "�", $texto);
	$texto = str_replace("ô", "�", $texto);
	$texto = str_replace("õ ", "�", $texto);
	$texto = str_replace("ú", "�", $texto);
	$texto = str_replace("û", "�", $texto);  
	$texto = str_replace("�?", "�", $texto);
	$texto = str_replace("Â", "�", $texto);
	$texto = str_replace("Ã", "�", $texto);
	$texto = str_replace("É", "�", $texto);
	$texto = str_replace("Ê", "�", $texto);
	$texto = str_replace("�?", "�", $texto);
	$texto = str_replace("Ó", "�", $texto);
	$texto = str_replace("Ô", "�", $texto);
	$texto = str_replace("Õ", "�", $texto);
	$texto = str_replace("Ú", "�", $texto);  
	$texto = str_replace("ç", "�", $texto);
	$texto = str_replace("Ç", "�", $texto);
	$texto = str_replace("º", "�", $texto);  
	return $texto;  
}
?>