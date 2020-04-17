<?php
$connect = mysqli_connect("localhost", "root", "", "blog");
session_start();
//print_r($_SESSION);
//$_SESSION['nombre_usuario'];
//exit;

$sql = "DELETE FROM proyecto 
                    WHERE id = " . $_REQUEST['id'] ."";

$registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

$sql_q = "DELETE FROM rec 
                    WHERE id_proyecto = " . $_REQUEST['id'] ."";

$registro1 = mysqli_query($connect, $sql_q) or die(mysqli_error($connect));

exit;
?>