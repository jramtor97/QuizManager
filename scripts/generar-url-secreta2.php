<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/RecuperacionClave.inc1.php';

include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioRecuperacionClave.inc1.php';

include_once 'app/Redireccion.inc.php';

session_start();


function sa($longitud) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numero_caracteres = strlen($caracteres);
    $string_aleatorio = '';
    
    for ($i = 0; $i < $longitud; $i++) {
        $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)];
    }
    
    return $string_aleatorio;
}

	$connect = mysqli_connect("localhost", "root", "", "blog");

      $sql = "SELECT email AS EMAIL
                      FROM usuarios u
                          WHERE u.id = ". $_SESSION['id_usuario']."
                          AND u.nombre = '".$_SESSION['nombre_usuario']."'";

      $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
      $row = mysqli_fetch_array($registro);
      //echo $row['EMAIL'];

if (isset($row['EMAIL'])) {
	$email = $row['EMAIL'];

	Conexion::abrir_conexion();

	if (!RepositorioUsuario :: email_existe(Conexion :: obtener_conexion(), $email)) {
		return;
	}
	//HAY QUE COMPROBAR QUE NO SALGA MÁS DE UNA PETICION!!!
	$usuario = RepositorioUsuario :: obtener_usuario_por_email(Conexion :: obtener_conexion(), $email);

	$nombre_usuario = $usuario -> obtener_nombre();
	$string_aleatorio = sa(10);

	$url_secreta = hash('sha256', $string_aleatorio . $nombre_usuario); //64 caracteres

	$url_s = substr($url_secreta, 0, -42);
	//echo $url_s;

	$peticion_generada = RepositorioRecuperacionClave1 :: generar_peticion(Conexion :: obtener_conexion(), $usuario -> obtener_id(), $url_s);

	Conexion :: cerrar_conexion();

	//si la peticion es correcta, notificar instrucciones
	if ($peticion_generada) {
		//Redireccion :: redirigir('./crear_proyecto.php');
		//echo "URL generada con éxito,por favor cierra la pestaña";
		//Redireccion :: redirigir('crear_proyecto.php');

		echo "<script lenguaje=\"JavaScript\">window.close();</script>";
		
		//echo "hhh";

	}
}

// si la peticion ha fallado, notificar error

