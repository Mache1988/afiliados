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
$__QUERY = 'SELECT * FROM afiliados CROSS JOIN documento USING (documento);';
$__RESULT= $__MON->MOSTRAR($__QUERY);
if($__RESULT){
	echo '<table><tr>';
	echo '<th>'.implode('</th><th>',array_keys(current($__RESULT))).'</th>';
	foreach($__RESULT as $ROW){
		$MAP = $ROW;
		/*$DIR = explode(',',$ROW['DIRECCION']);
		$DIR = preg_replace('/\s/','+',$DIR);
		$MAP['DIRECCION'] = '<a href=\'https://www.google.com/maps/place/'.$DIR[0].',+Salta,+Argentina\' target=\'_blank\'>'.$ROW['DIRECCION'].'</a>';
		*/echo '<tr>';
		echo '<td>'.implode('</td><td>',$MAP).'</td>';
		echo '</tr>';
	}
	echo '</tr></table>';
}
?>
</body>
</html>