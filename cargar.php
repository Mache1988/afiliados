<?php
require 'monster.php';
$__MON		= new Monster();
$__MON->LOADCSV('PADRON-JUN2015/tcir.txt','CIRCUITO','|',array(`CIRCUITO`, `SECCION`, `DESCRIPCION`, `MUNICIPIO`, `DISTRITO`, `CIRC_NOD_1`, `CIRC_NOD_2`, `CIRC_NOD_3`));

?>