<?php
	function connectDB(){
		$conexion = mysqli_connect("localhost", "root", "alemania", "clases");
		if($conexion){
		echo 'La conexión de la base de datos se ha hecho satisfactoriamente';
		}else{
			echo 'Ha sucedido un error inesperado en la conexión de la base de datos';
		}
			return $conexion;
		}
	function disconnectDB($conexion){
		$close = mysqli_close($conexion);
		if($close){
		echo 'La desconexión de la base de datos se ha hecho satisfactoriamente';
		}else{
		echo 'Ha sucedido un error inesperado en la desconexión de la base de datos';
		}
		return $close;
		}
	$sql= "select * from marcadores";
	//hago mi respectiva consulta
	function getArraySQL($sql){
		//Creamos la conexión con la función anterior
		$conexion = connectDB();
		//generamos la consulta
		mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
		if(!$result = mysqli_query($conexion, $sql)) die(); //si la conexión cancelar programa
			$rawdata = array(); //creamos un array
			//guardamos en un array multidimensional todos los datos de la consulta
			$i=0;
			while($row = mysqli_fetch_array($result))
			{
				$rawdata[$i] = $row;
				$i++;
			}
			disconnectDB($conexion); //desconectamos la base de datos
			return $rawdata; //devolvemos el array
		}
	//echo var_dump($rawdata);
	$myArray = getArraySQL($sql);
	//echo var_dump($myArray);

	$myArray2 = json_encode($myArray);
	$myArray3 = json_decode($myArray2);
	print_r($myArray3);
	//echo $myArray3[0]->nombres;
	//para pedir solo un dato el array
    header('Content-Type: aplication/json');
?>
