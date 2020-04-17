<?php
$connect = mysqli_connect("localhost", "root", "", "blog");
session_start();
//print_r($_SESSION);
//$_SESSION['nombre_usuario'];
//exit;
$sql_q = "SELECT p.url_usuario AS URL
        FROM crear_cuestionario p
            WHERE p.id = ".$_REQUEST['id']."";

$reg = mysqli_query($connect, $sql_q) or die(mysqli_error($connect));
$row = mysqli_fetch_array($reg);
$url_usuario = $row['URL'];

$sql = "DELETE FROM crear_cuestionario WHERE url_usuario =  '".$url_usuario."' ";

$registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

$sql_w = "DROP TABLE cu_propio".$_REQUEST['id']." ";

$registroo = mysqli_query($connect, $sql_w) or die(mysqli_error($connect));

$sql_q = "DELETE FROM pregunta_crear_cuestionario 
                    WHERE url_usuario = '" . $url_usuario ."' ";

$registro1 = mysqli_query($connect, $sql_q) or die(mysqli_error($connect));

$sql_q = "DELETE FROM respuesta_crear_cuestionario 
                    WHERE url_usuario = '" . $url_usuario ."' ";

$registro1 = mysqli_query($connect, $sql_q) or die(mysqli_error($connect));

exit;
?>