<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/RecuperacionClave.inc.php';

include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioRecuperacionClave.inc.php';

include_once 'app/Redireccion.inc.php';

function sa($longitud) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numero_caracteres = strlen($caracteres);
    $string_aleatorio = '';
    
    for ($i = 0; $i < $longitud; $i++) {
        $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)];
    }
    
    return $string_aleatorio;
}

if (isset($_POST['enviar_email'])) {
	$email = $_POST['email'];

	Conexion::abrir_conexion();

	if (!RepositorioUsuario :: email_existe(Conexion :: obtener_conexion(), $email)) {
		return;
	}
	//CONTROLAMOS QUE NO SALGA MÁS DE UNA PETICION EN LA BBDD
	$connect = mysqli_connect("localhost", "root", "", "blog");

	$sql_peticion = "SELECT r.url_secreta AS URL FROM recuperacion_clave r, usuarios u WHERE r.usuario_id = u.id AND u.email = '".$email."'";

	$registroo = mysqli_query($connect, $sql_peticion) or die(mysqli_error($connect));
	$row = mysqli_fetch_array($registroo);

	if (!isset($row['URL']) || $row['URL'] == '') {
		$usuario = RepositorioUsuario :: obtener_usuario_por_email(Conexion :: obtener_conexion(), $email);

		$nombre_usuario = $usuario -> obtener_nombre();
		$string_aleatorio = sa(10);

		$url_secreta = hash('sha256', $string_aleatorio . $nombre_usuario); //64 caracteres

		$url_s = substr($url_secreta, 0, -42);
		//echo $url_s;

		$peticion_generada = RepositorioRecuperacionClave :: generar_peticion(Conexion :: obtener_conexion(), $usuario -> obtener_id(), $url_s);

		Conexion :: cerrar_conexion();

		//si la peticion es correcta, notificar instrucciones
		// if ($peticion_generada) {
		// 	Redireccion :: redirigir(RUTA_SERVIDOR);
		// }
			echo $email;

		$asunto = "Recuperación de contraseña";
		$mensaje = '
			<html>
			<head>
			  <title>Birthday Reminders for August</title>
			</head>
			<body>
			  <p>Estimado usuario,</p>
			  <br>
			  <p>Hemos recibido una solicitud de recuperación de contraseña. Actualmente podrá reestablecer su contraseña escribiendo una nueva en la siguiente URL: <a href=#>http://localhost:8080/blog/recuperar-clave/'. $row['URL'] . '</a></p>
			</body>
			</html>
			';

		// To send HTML mail, the Content-type header must be set
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';

		// Additional headers
		//$headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>';
		$headers[] = 'From: Contraseña QuizManager <helpassistant@quizmanager.com>';
		//$headers[] = 'Cc: birthdayarchive@example.com';
		//$headers[] = 'Bcc: birthdaycheck@example.com';


		$exito = mail($email, $asunto, $mensaje, implode("\r\n", $headers));

		if ($exito) {
			echo 'email enviado';
		} else {
			echo 'envio fallido';
		}

	} else {
		// SI QUEREMOS QUE AUNQUE HAGA PETICIONES SIGA MANDANDO CORREOS CADA VEZ QUE HACE UNA PETICION DESCOMENTAR TODO ESTO DE AQUI ABAJO
		$asunto = "Recuperación de contraseña";
		$mensaje = '
			<html>
			<head>
			  <title>Birthday Reminders for August</title>
			</head>
			<body>
			  <p>Estimado usuario,</p>
			  <br>
			  <p>Hemos recibido una solicitud de recuperación de contraseña. Actualmente podrá reestablecer su contraseña escribiendo una nueva en la siguiente URL: <a href=#>http://localhost:8080/blog/recuperar-clave/'. $row['URL'] . '</a></p>
			</body>
			</html>
			';

		// To send HTML mail, the Content-type header must be set
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';

		// Additional headers
		//$headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>';
		$headers[] = 'From: Contraseña QuizManager <helpassistant@quizmanager.com>';
		//$headers[] = 'Cc: birthdayarchive@example.com';
		//$headers[] = 'Bcc: birthdaycheck@example.com';


		$exito = mail($email, $asunto, $mensaje, implode("\r\n", $headers));

		if ($exito) {
			echo 'email enviado http://localhost:8080/blog/recuperar-clave/'. $row['URL'] .'' ;
		} else {
			echo 'envio fallido';
		}
		echo "Petición ya realizada, mire su correo";
	}

}

// si la peticion ha fallado, notificar error
?>