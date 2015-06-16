<?php 
class Monster {
	var $__SERVER	= 'localhost';
	var $__USER		= 'root';
	var $__PASS		= '';
	var $__DB		= 'afiliados';
	var $__CX;
	var $__NUMERACION = array(1=>'UN','DOS','TRES','CUATRO','CINCO','SEIS','SIETE','OCHO','NUEVE','DIEZ','ONCE','DOCE','TRECE','CATORCE','QUINCE');
	var $__BUSCAR;
	var $__CARGAR;
	var $__ACTUALIZAR;
	//var $__CAMPOS	= array('ID','ESTABLECIMIENTO','TELEFONO','RESPONSABLE','DIRECCION','OBSERVACIONES','AUTOR','CREADO');
		
	function __construct() {
		setlocale(LC_TIME, '');
		setlocale(LC_TIME, 'es_ES.UTF-8');
		
		$this->__CX		= new mysqli($this->__SERVER, $this->__USER, $this->__PASS, $this->__DB);
		
		if($this->__CX->connect_error){
			echo '__NO SE PUEDE ESTABLECER CONEXION A LA BASE DE DATOS__<br>';
		}else{
			/*$this->__BUSCAR = $this->TRIM_ARRAY($this->ENCODE(array_slice($_REQUEST,0,-1)));
			$this->__CARGAR	= $this->ENCODE(array_slice($_REQUEST,1,-1));
			$this->__ACTUALIZAR = $this->ENCODE(array_slice($_REQUEST,0,-1));*/
		}
	}
	
	function LOADCSV($filename='',$table=NULL, $delimiter=',', $header=NULL){
		if(!file_exists($filename) || !is_readable($filename)){
			echo '<b>ERROR:</b> <i>No se pudo acceder al archivo.</i>';
			return FALSE;
		}
		if($header=='AUTO'){
			$header = array();
			$__QUERY = 'SHOW COLUMNS FROM '.$table.';';
			$__FEED = $this->__CX->query($__QUERY);
			if($__FEED->num_rows){
				while ($__DATA = $__FEED->fetch_assoc()){
					$header[]	= $__DATA['Field'];
				}
			}
		}
		$data = array();
		if (($handle = fopen($filename, 'r')) !== FALSE)
		{
			while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
			{	
				if(!$header){
					$header = $row;
				}else{
					$data[] = array_combine($header, $row);
				}
			}
			fclose($handle);
			if($data){
				foreach($this->ENCODE($data) as $VALUE){
					$__QUERY='INSERT INTO '.$table.' ('.implode(',',array_keys($VALUE)).') VALUES ("'.implode('","',$VALUE).'");';
					$__FEED = $this->__CX->query($__QUERY);
					if($__FEED){
						echo '<p><b>CARGADO:</b><i>'.$__QUERY.'</i>  <b>...OK!</b></p>';
					}else{
						echo '<p><b>ERROR:</b><i>'.$__QUERY.'</i>  <b>'.$this->__CX->error.'</b></p>';
					}
				}
			}
		}
		echo '<b>COMPLETADO:</b> <i>EXITOSO.</i>';
		return TRUE;
	}
	
	function ENCODE($_VAR){
		$_TEMP = array();
		foreach($_VAR as $KEY=>$VALUE){
			if(!is_array($VALUE)){
				$_TEMP[$KEY]= utf8_encode(mysqli_real_escape_string($this->__CX,trim($VALUE)));
			}else{
				$_TEMP[$KEY]=$this->ENCODE($VALUE);
			}
		}
		return $_TEMP;
	}
	
	function DECODE($_VAR){
		$_TEMP = array();
		foreach($_VAR as $KEY=>$VALUE){
			if(!is_array($VALUE)){
				$_TEMP[$KEY]= utf8_decode($VALUE);
			}else{
				$_TEMP[$KEY]=$this->DECODE($VALUE);
			}
		}
		return $_TEMP;
	}
	
	function TRIM_ARRAY($_VAR){
		$_TEMP = array();
		foreach($_VAR as $KEY=>$VALUE){
			if(!is_array($VALUE)){
				if($VALUE!=''){
					$_TEMP[$KEY]= $VALUE;
				}
			}else{
				$_TEMP[$KEY]=$this->TRIM_ARRAY($VALUE);
			}
		}
		return $_TEMP;
	}
	
	function INIT_ARRAY($_VAR){
		$_TEMP = array();
		foreach($_VAR as $KEY=>$VALUE){
			if(!is_array($VALUE)){
				if($VALUE==''){
					$_TEMP[$KEY]= 'NULL';
				}
			}else{
				$_TEMP[$KEY]=$this->INIT_ARRAY($VALUE);
			}
		}
		return $_TEMP;
	}
	
	function MOSTRAR($__QUERY){
		$__RETURN	= array();
		$__FEED = $this->__CX->query($__QUERY);
		if($__FEED->num_rows){
			while ($__DATA = $__FEED->fetch_assoc()){
				$__RETURN[]	= $__DATA;
			}
		}
		if(current($__RETURN)){
			return $this->DECODE($__RETURN);
		}else{
			return 0;
		}
	}
	
	function BUSCAR(){
		$__CAT		= array();
		$__RETURN	= array();
		foreach($this->__BUSCAR as $KEY=>$VALUE){
			$__CAT[] = $KEY.' LIKE \'%'.$VALUE.'%\'';
		}
		if(current($__CAT)){
			$__QUERY 	= 'SELECT * FROM SSSALUD WHERE '.implode(' AND ', $__CAT).' ;';
			$__FEED = $this->__CX->query($__QUERY);
			if($__FEED->num_rows){
				while ($__DATA = $__FEED->fetch_assoc()){
					$__RETURN[]	= $__DATA;
				}
			}
			if(current($__RETURN)){
				return $this->DECODE($__RETURN);
			}else{
				return 0;
			}
		}
	}

	function CARGAR(){
		$__QUERY = 'INSERT INTO SSSALUD ('.implode(',',array_keys($this->__CARGAR)).') VALUES (\''.implode('\',\'',$this->__CARGAR).'\')';
		$__FEED = $this->__CX->query($__QUERY);
		if($__FEED){
			return 1;
		}else{
			return 0;
		}
	}
	
	function ACTUALIZAR(){
		$__QUERY='REPLACE INTO SSSALUD ('.implode(',',array_keys($this->__ACTUALIZAR)).') VALUES ("'.implode('","',$this->__ACTUALIZAR).'");';
		$__FEED = $this->__CX->query($__QUERY);
		//echo $__QUERY;
		if($__FEED){
			return 1;
		}else{
			return 0;
		}
	}
		/*if ($__FEED->num_rows){
			$__DATA = $__FEED->fetch_assoc();
			$__RAW	= $this->DECODE(json_decode($__DATA['DATA'],true));
			if(isset($__RAW['EMP']['ID'])){
				$__QUERY = 'SELECT RNEMP, DENOMINACION, CUIT, DOMICILIO, LOCALIDAD, CP, PROVINCIA FROM EEMP WHERE ID="'.$__RAW['EMP']['ID'].'"';
				$__FEED = $this->__CX->query($__QUERY);
				if ($__FEED->num_rows){
					$__RAW['EMP'] = $__FEED->fetch_assoc();
				};
			}else{
				$__QUERY = 'SELECT RNOS, DENOMINACION, SIGLA, DOMICILIO, LOCALIDAD, CP, PROVINCIA FROM OOSS WHERE ID="'.$__RAW['OS']['ID'].'"';
				$__FEED = $this->__CX->query($__QUERY);
				if ($__FEED->num_rows){
					$__RAW['OS'] = $__FEED->fetch_assoc();
				};
			};
			foreach($__RAW['BENEFICIARIO'] as $__PARENT=>$__BENEFICIARIO){
				$__QUERY = 'SELECT CARATULA, TEXTO, FUNDAMENTACION FROM PROBLEMATICA WHERE PROBLEMATICA_ID="'.$__BENEFICIARIO['PROBLEMATICA_ID'].'";';
				$__FEED = $this->__CX->query($__QUERY);
				if ($__FEED->num_rows){
					$__RAW['BENEFICIARIO'][$__PARENT]['PROBLEMATICA'] = $__FEED->fetch_assoc();
				};
			};
			return $this->DECODE($__RAW);
			*/
	
	
}
?>