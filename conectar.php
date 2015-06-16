<?php
$__SERVER	= 'localhost';
$__USER		= 'root';
$__PASS		= '';
$__DB		= 'agenda';
$__CX		= new mysqli($__SERVER, $__USER, $__PASS, $__DB);

if($__CX->connect_error){
	echo '__NO SE PUEDE ESTABLECER CONEXION A LA BASE DE DATOS__<br>__CONTACTAR URGENTE A MARCELO (3875018250)__ ';
}
?>