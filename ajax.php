<?php 
require 'monster.php';
if(isset($_REQUEST['ACTION'])){
	$__ACTION 	= $_REQUEST['ACTION'];
	$__MON		= new Monster();
	//print_r($__MON->__CARGAR);
	switch($__ACTION){
		case 'BUSCAR':
			if($__MON->BUSCAR()){
				echo '<table><tr>';
				echo '<th>'.implode('</th><th>',array_keys(current($__MON->BUSCAR()))).'</th>';
				foreach($__MON->BUSCAR() as $ROW){
					$MAP = $ROW;
					$DIR = explode(',',$ROW['DIRECCION']);
					$DIR = preg_replace('/\s/','+',$DIR);
					$MAP['DIRECCION'] = '<a href=\'https://www.google.com/maps/place/'.$DIR[0].',+Salta,+Argentina\' target=\'_blank\'>'.$ROW['DIRECCION'].'</a>';
					echo '<tr>';
					echo '<td>'.implode('</td><td>',$MAP).'</td><td><button onClick=\'COPIAR('.json_encode($ROW).');\'>SELECCIONAR</button></td>';
					echo '</tr>';
				}
				echo '</tr></table>';
			}			
			break;
		case 'CARGAR':
			print_r($__MON->CARGAR());
			break;
		case 'ACTUALIZAR':
			print_r($__MON->ACTUALIZAR());
			break;
	}
}else{
	$__ACTION = 'NULL';
}

?>