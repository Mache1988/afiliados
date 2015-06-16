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
<form action='#' method='GET'>
<table>

	<tr>
		<th>ID</th>
		<th>[ESTABLECIMIENTO]NOMBRE</th>
		<th>TELEFONO/S</th>
		<th>[CARGO]RESPONSABLE</th>
		<th>DIRECCION</th>
		<th>OBSERVACIONES</th>
		<th>AUTOR</th>
		<th colspan=4>OPCIONES</th>		
	</tr>

	<tr id='BUSCAR'>
		<td><input name='ID' size='3'></td>
		<td><textarea name='ESTABLECIMIENTO'rows='1' cols='35'></textarea></td>
		<td><textarea name='TELEFONO'rows='1' cols='35'></textarea></td>
		<td><textarea name='RESPONSABLE'rows='1' cols='35'></textarea></td>
		<td><textarea name='DIRECCION'rows='1' cols='35'></textarea></td>
		<td><textarea name='OBSERVACIONES'rows='1' cols='35'></textarea></td>
		<td><input name='AUTOR' size='3'></td>
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