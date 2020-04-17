<?php

$connect = mysqli_connect("localhost", "root", "", "blog");
print_r($_REQUEST);

$sql_update = "UPDATE proyecto p SET p.nombre = '".$_REQUEST['nombre']."',p.descripcion = '".$_REQUEST['descripcion']."' WHERE p.id = ".$_REQUEST['id']."";

$registro = mysqli_query($connect, $sql_update) or die(mysqli_error($connect));

exit;
?>