<!DOCTYPE html>
<html>
<head>
<script src="jquery-1.11.3.js"></script>


<link rel="stylesheet" type="text/css" href="agenda.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<meta charset="ISO-8859-1">
<title>AGENDA</title>
</head>
<body>
<?php
require 'monster.php';
$__MON		= new Monster();
// afiliados.SECCION, afiliados.CIRCUITO, afiliados.SEXO, afiliados.CLASE, afiliados.ID, afiliados.APELLIDO, afiliados.NOMBRE, afiliados.CALLE, afiliados.NUMERO, afiliados.DEPARTAMENTO, afiliados.ANALFABETO, afiliados.PROFESION, afiliados.DOCUMENTO, afiliados.FECHA
// replace afiliados.PROFESION , afiliados.DOCUMENTO, afiliados.SECCION
$__RESULT= $__MON->MOSTRAR();
if($__RESULT){
	echo '<table><tr>';
	echo '<th>'.implode('</th><th>',array_keys(current($__RESULT))).'</th>';
	foreach($__RESULT as $ROW){
		$MAP = $ROW;
		echo '<tr>';
		echo '<td>'.implode('</td><td>',$MAP).'</td>';
		echo '</tr>';
	}
	echo '</tr></table>';
}

?>
</body>
</html>