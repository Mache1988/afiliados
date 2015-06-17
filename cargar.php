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
$__TABLAS	= array('PADRON-JUN2015/tsec.txt'=>'seccion','PADRON-JUN2015/tprf.txt'=>'profesion','PADRON-JUN2015/tmun.txt'=>'municipio','PADRON-JUN2015/ttdo.txt'=>'documento','PADRON-JUN2015/tcir.txt'=>'circuito','PADRON-JUN2015/KOLINA.txt'=>'afiliados');
//$__HEAD		= array('CIRCUITO', 'SECCION', 'DESCRIPCION', 'MUNICIPIO', 'DISTRITO', 'CIRC_NOD_1', 'CIRC_NOD_2', 'CIRC_NOD_3', 'CIRC_NOD_4');
echo '<ul>';
foreach($__TABLAS as $KEY=>$VALUE){
	echo '<li>'.$VALUE.'<ul><li>';
	$__MON->LOADCSV($KEY,$VALUE,'|','AUTO');
	echo '</li></ul></li>';
}
echo '<li>NUEVOS<ul><li>';
$__MON->DIFF();
echo '</li></ul></li>';

echo '<li>BAJAS<ul><li>';
$__MON->BAJAS();
echo '</li></ul></li>';
echo '</ul>';
//afiliados.DEPARTAMENTO,afiliados.MUNICIPIO,afiliados.SEXO,afiliados.CLASE,afiliados.TIPO,afiliados.DNI,afiliados.APELLIDO,afiliados.NOMBRE,afiliados.CALLE,afiliados.NUMERO,afiliados.PUERTA,afiliados.ANALFABETO,afiliados.PROFESION,afiliados.ALTA,afiliados.BAJA
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('ul ul').hide();
		});
	$('li').click(function(event){
		$(this).children('ul').slideToggle();
		});
</script>
</body>
</html>