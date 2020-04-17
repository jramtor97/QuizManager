<?php
header("Content-Type: text/html;charset=utf-8");
$connect = mysqli_connect("localhost", "root", "", "blog");
session_start();
//$json_response = '{"data":[ ';
//echo "<pre>";
//print_r($_REQUEST);
//insert...
//echo $_REQUEST['nombre'];
//echo $_REQUEST['descripcion'];

$sql_id_proyecto = "SELECT COUNT(IFNULL(id, 1)) AS ID_GESTION FROM proyecto";

$reg = mysqli_query($connect, $sql_id_proyecto) or die(mysqli_error($connect));
$row_count = mysqli_fetch_array($reg);
//echo $row_count['ID_GESTION'];

if ($row_count['ID_GESTION'] == 0){
    //echo "hola";
    //exit;
    $sql_id_proyecto1 = "SELECT COUNT(IFNULL(id, 1))+1 AS ID_G FROM proyecto p";
    $reg = mysqli_query($connect, $sql_id_proyecto1) or die(mysqli_error($connect));
    $row_count_id = mysqli_fetch_array($reg);

} else {
    $sql_id_proyecto1 = "SELECT MAX(id)+1 AS ID_G FROM proyecto p";
    $reg = mysqli_query($connect, $sql_id_proyecto1) or die(mysqli_error($connect));
    $row_count_id = mysqli_fetch_array($reg);
}

	$sql_id_usuario = "SELECT id AS ID from usuarios u WHERE u.nombre = '" . $_SESSION['nombre_usuario'] . "'";

	$registro1 = mysqli_query($connect, $sql_id_usuario) or die(mysqli_error($connect));
	$row = mysqli_fetch_array($registro1);
	$id = $row['ID'];

    $sql_insert = "INSERT INTO proyecto(id,nombre,cuestionario,descripcion,id_usuario) VALUES(" . $row_count_id['ID_G'] . ",'" . $_REQUEST['nombre'] . "',
                                        '" . $_REQUEST['cuestionario'] . "', 
                                         '" . $_REQUEST['descripcion'] . "', ". $id.")";

    $registro = mysqli_query($connect, $sql_insert) or die(mysqli_error($connect));
    $roow = $row_count_id['ID_G'];
    //echo $roow;
//exit;
    $sql = "SELECT DISTINCT c.url_secreta AS URL
                FROM rec c
                    WHERE c.id_proyecto = (
                        SELECT p.id FROM proyecto p WHERE p.id = " . $_REQUEST['id'] . "
                            AND p.nombre = '" . $_REQUEST['nombre'] . "')";

$registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
$row = mysqli_fetch_array($registro);
$row_url = $row['URL'];
echo $row_url;
// $sql_q = "UPDATE proyecto p SET p.url = 'localhost:8080/blog/recuperacion-clave1/". $row_url ."'
//                         WHERE p.nombre = '".$_REQUEST['nombre']." AND p.id_usuario = " . $_SESSION['id_usuario'] . " AND p.id =  " . $_REQUEST['id'] . "'";
$sql_q = "UPDATE proyecto p SET p.url = 'localhost:8080/blog/recuperacion-clave1/". $row_url ."'
                        WHERE p.id_usuario = " . $_SESSION['id_usuario'] . " AND p.id =  " . $_REQUEST['id'] . " ";

$reg = mysqli_query($connect, $sql_q) or die(mysqli_error($connect));
exit;
?>