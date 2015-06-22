<!DOCTYPE html>
<html>
<head>
<script src="jquery-1.11.3.js"></script>
<link rel="stylesheet" type="text/css" href="agenda.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<meta charset="ISO-8859-1">
<title>AFILIADOS</title>
</head>
<body>
<form action='#' method='GET'>
<table>
<?php
require 'monster.php';
$__MON		= new Monster();

?>
	<tr>
		<?php 
		foreach($__MON->COLS('afiliados_dif') as $COL){
			echo '<th>'.$COL.'</th>';
		}
		?>
		<th colspan=4>OPCIONES</th>		
	</tr>

	<tr id='BUSCAR'>
		<?php 
		foreach($__MON->COLS('afiliados_dif') as $COL){
			echo '<td><textarea name=\''.$COL.'\'></textarea></td>';
		}
		?>
		<td><table>
		<tr><td><button id='AGREGAR' name='ACCION' value='AGREGAR' >AGREGAR</button></td></tr>
		<tr><td><button id='ACTUALIZAR' name='ACCION' value='ACTUALIZAR' >ACTUALIZAR</button></td></tr>
		<tr><td><button id='LIMPIAR' name='ACCION' value='LIMPIAR' >LIMPIAR</button></td></tr>
		<tr><td><button id='ELIMINAR' name='ACCION' value='ELIMINAR' >ELIMINAR</button></td></tr>
		</table></td>
	</tr>
</table>
<div id='RESULTADO'></div>
</form>
<script type="text/javascript">
	$('tr[id="BUSCAR"]').find(':input').keyup(function(event){
		//console.log($('tr[id="BUSCAR"]').find(':input').serializeArray().concat({name:'ACTION',value:'BUSCAR'}));
		$.post('ajax.php',$('tr[id="BUSCAR"]').find(':input').serializeArray().concat({name:'ACTION',value:'BUSCAR'})).done(function(data){
				$('#RESULTADO').html(data);
				});
		});
	
	$('form').submit(function(event){
		event.preventDefault();
		});

	$('#AGREGAR').click(function(event){
		$.post('ajax.php',$('tr[id="BUSCAR"]').find(':input').serializeArray().concat({name:'ACTION',value:'CARGAR'})).done(function(data){
			if(data){
				$(':input').each(function(elem){
					if($(this).attr('name')!='AUTOR'){
						$(this).val('');
						};
					});
				}
			});
		});
	function COPIAR(obj){
		$.each(obj	,function(key, value){
			$('input[name="'+key+'"]').val(value);
			$('textarea[name="'+key+'"]').val(value);
			//console.log(key+":"+value);
			});
		
		};
		$('#ACTUALIZAR').click(function(event){
			$.post('ajax.php',$('tr[id="BUSCAR"]').find(':input').serializeArray().concat({name:'ACTION',value:'ACTUALIZAR'})).done(function(data){
				if(data){
					$(':input').each(function(elem){
						if($(this).attr('name')!='AUTOR'){
							$(this).val('');
							};
						});
					}
				});
			});
		$('#LIMPIAR').click(function(event){
			$(':input').each(function(elem){
				$(this).val('');
				});
			});
</script>
</body>
</html>