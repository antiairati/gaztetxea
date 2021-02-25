<?php 
  
// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json);
$ekintza=1;

// Datos de la base de datos

$usuario = "qaeu793";
$password = "PWVJ78mGJ";
$servidor = "qaeu793.gasteizkogaztetxea.com";
$basededatos = "qaeu793";

// creación de la conexión a la base de datos con mysql_connect()
$conexion = mysqli_connect( $servidor, $usuario, $password, $basededatos) or die ("No se ha podido conectar al servidor de BBDD");

// Selección del a base de datos a utilizar
$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );

$query_info=mysqli_query($conexion,"SELECT erreserbak,aforoa FROM ekintzak WHERE ekintza_id = '".$ekintza."'");
if (mysqli_num_rows($query_info) > 0) {
   $row = mysqli_fetch_assoc($query_info);
   $lekuLibreak=$row["aforoa"]-$row["erreserbak"];
}
if ($lekuLibreak==0){
  $response->libre = FALSE;
  $response->kopurua = 0;
}else{
  if ($lekuLibreak>=4){
    $response->libre = TRUE;
    $response->kopurua = 4;
  }else{
    $response->libre = TRUE;
    $response->kopurua = $lekuLibreak;
  }
}
// cerrar conexión de base de datos
mysqli_close( $conexion );
//Enviar respuesta
header('Content-type: application/json');
echo json_encode($response);
?> 