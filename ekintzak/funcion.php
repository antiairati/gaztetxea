<?php

	// Datos de la base de datos
	$usuario = "admin";
	$password = "";
	$servidor = "localhost";
	$basededatos = "gaztetxe";
	
	// creación de la conexión a la base de datos con mysql_connect()
	$conexion = mysqli_connect( $servidor, $usuario, $password, $basededatos) or die ("No se ha podido conectar al servidor de BBDD");
	
	// Selección del a base de datos a utilizar
	$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );

	// cerrar conexión de base de datos
	mysqli_close( $conexion );
	
	$data = json_decode(file_get_contents('php://input'), true);
	print_r($data);
	echo $data["izena"];



/*
$izenburua=$_POST["izenburua"]; //coje los valores enviados por ajax
$azpititulua=$_POST["azpititulua"];
$testua=$_POST["testua"];

if (empty($izenburua)&& empty($azpititulua)&&empty($testua)) {//comprueba que los $_POST no esten vacion
  // code...
}else{// si no estan vacios inserta su valor en la BBDD
$sql="INSERT INTO ".BERRIAK."(izenburua, azpititulua, testua) VALUES ('".$izenburua."' ,'".$azpititulua."','".$testua."')";
$num_filas=$db->exec($sql);
    if ($num_filas===false) {
        $error=$db->errorInfo();
        echo false;
    }else echo true;
}*/

?>
