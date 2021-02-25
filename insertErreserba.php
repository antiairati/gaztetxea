<?php 
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
 

 //Instantiation and passing `true` enables exceptions
 $mail = new PHPMailer(TRUE);


  
// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json);

$izena = $data->izena;
$abizena = $data->abizena;
$email=$data->email;
$zenbat=intval($data->zenbat);
$ekintza=intval($data->id);
// Ejemplo de conexión a base de datos MySQL con PHP.
//
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $response->result = "Error";
  //$posts = array($json);
  header('Content-type: application/json');
  echo json_encode(array('posts'=>$response));
}else{
	
	// Datos de la base de datos
	$usuario = "qaeu793";
	$password = "PWVJ78mGJ";
	$servidor = "qaeu793.gasteizkogaztetxea.com";
	$basededatos = "qaeu793";

  // creación de la conexión a la base de datos con mysql_connect()
  $conexion = mysqli_connect( $servidor, $usuario, $password, $basededatos) or die ("No se ha podido conectar al servidor de BBDD");

  // Selección del a base de datos a utilizar
  $db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );

  $query=mysqli_query($conexion,"INSERT INTO pertsonak (izena,abizena,email,kopurua,ekintza_id) VALUES ('".$izena."', '".$abizena."', '".$email."', '".$zenbat."', '".$ekintza."')");
	$query_info=mysqli_query($conexion,"SELECT erreserbak FROM ekintzak WHERE ekintza_id = '".$ekintza."'");
	if (mysqli_num_rows($query_info) > 0) {
	   $row = mysqli_fetch_assoc($query_info);
	   $newValue=$row["erreserbak"]+$zenbat;
	}
 $update_info=mysqli_query($conexion,"UPDATE ekintzak SET erreserbak=".$newValue." WHERE ekintza_id = '".$ekintza."'"); 
  // cerrar conexión de base de datos
  mysqli_close( $conexion );

  try {
    // Configuracion SMTP
    $mail->SMTPDebug =0;                         // Mostrar salida (Desactivar en producción)
		$mail->isSMTP();                                               // Activar envio SMTP
		$mail->Host  = 'smtp.serviciodecorreo.es';                     // Servidor saliente SMTP
		$mail->SMTPAuth  = true;                                       // Identificacion SMTP
		$mail->Username  = 'ekintzak@gasteizkogaztetxea.com';                  // Usuario SMTP
		$mail->Password  = 'gasteiz12GTX';	          // Contraseña SMTP
		$mail->SMTPSecure ='ssl';
		$mail->Port  = 465;
		$mail->setFrom('ekintzak@gasteizkogaztetxea.com', 'GTX');                // correo + nombre emisor

    // Destinatarios
	$mail->addAddress($email, $izena);  // Email y nombre del destinatario

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Asunto del correo';
    $mail->Body  = 'Zure erreserba ondo egin da<br/>'.$izena.'hwelloo';
    $mail->AltBody = 'Contenido del correo en texto plano para los clientes de correo que no soporten HTML';
    $mail->send();
  
  } catch (Exception $e) {

  }
  $response->result = "OK";
  //$posts = array($json);
  header('Content-type: application/json');
  echo json_encode(array('posts'=>$response));
}


?> 