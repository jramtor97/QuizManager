<?php
header("Content-Type: text/html;charset=utf-8");
$connect = mysqli_connect("localhost", "root", "", "blog");

echo "<pre>";
print_r($_REQUEST['array22']);

//Cogemos el último id que haya metido ya en la bbdd
$sql = "SELECT p.id AS ID FROM pregunta_crear_cuestionario p 
	ORDER BY p.id DESC LIMIT 1";

$registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
$row = mysqli_fetch_array($registro);
$id = $row['ID'];
echo $id;
$cont = 1;
for ($i = 0; $i < count($_REQUEST['array22']); $i++){
	echo "hola";
	echo $_REQUEST['array22'][$i];
	echo "<br>";

	$sql = "UPDATE pregunta_crear_cuestionario p 
	SET p.respuesta = '".$_REQUEST['array22'][$i]."'
      WHERE p.id = ".($id-$cont)." AND
    p.url_usuario = '" . $_REQUEST['url_usuario'] ."'
      AND p.id_quiz = ".$_REQUEST['id_quiz']." ";

	$registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	$cont = $cont - 1;
	echo $cont;
}

exit;
?>