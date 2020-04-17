<?php
header("Content-Type: text/html;charset=utf-8");
$connect = mysqli_connect("localhost", "root", "", "blog");
//echo "<pre>";
//print_r($_REQUEST);
session_start();
/*
PARA SUMAR LOS IDS
*/
$sql_id_proyecto = "SELECT COUNT(IFNULL(id, 1)) AS ID_GESTION FROM crear_cuestionario";

$reg = mysqli_query($connect, $sql_id_proyecto) or die(mysqli_error($connect));
$row_count = mysqli_fetch_array($reg);
//echo $row_count['ID_GESTION'];

if ($row_count['ID_GESTION'] == 0){
    //echo "hola";
    //exit;
    $sql_id_proyecto1 = "SELECT COUNT(IFNULL(id, 1))+1 AS ID_G FROM crear_cuestionario p";
    $reg = mysqli_query($connect, $sql_id_proyecto1) or die(mysqli_error($connect));
    $row_count_id = mysqli_fetch_array($reg);

} else {
    $sql_id_proyecto1 = "SELECT MAX(id)+1 AS ID_G FROM crear_cuestionario p";
    $reg = mysqli_query($connect, $sql_id_proyecto1) or die(mysqli_error($connect));
    $row_count_id = mysqli_fetch_array($reg);
}

//Si ya está el registro no volver a meterlo para evitar duplicados
$sql_u = "SELECT c.url AS URL FROM crear_cuestionario c WHERE c.url = '".$_REQUEST['url']."'";

$reg1 = mysqli_query($connect, $sql_u) or die(mysqli_error($connect));
$row1 = mysqli_fetch_array($reg1);
if ($_REQUEST['url'] == $row1['URL']){
    //update
    // lo del if es como abajo para controlar el num_opciones
    if ($_REQUEST['num_opciones'] == ''){
        $sql_u = "UPDATE crear_cuestionario c SET c.titulo ='".$_REQUEST['titulo']."', c.formato_respuesta ='".$_REQUEST['formato_respuesta']."', c.num_preguntas=".$_REQUEST['num_preguntas'].", c.num_opciones =1, c.descripcion='".$_REQUEST['descripcion']."' WHERE c.url = '".$_REQUEST['url']."'";
    } else {
        $sql_u = "UPDATE crear_cuestionario c SET c.titulo ='".$_REQUEST['titulo']."', c.formato_respuesta ='".$_REQUEST['formato_respuesta']."', c.num_preguntas=".$_REQUEST['num_preguntas'].", c.num_opciones =".$_REQUEST['num_opciones'].", c.descripcion='".$_REQUEST['descripcion']."' WHERE c.url = '".$_REQUEST['url']."'";
    }

    $reg2 = mysqli_query($connect, $sql_u) or die(mysqli_error($connect));
    //NO BORRAR!!!!!
    echo $row_count_id['ID_G']-1;
    
} else {
    if ($_REQUEST['num_opciones'] == ''){
        $sql = "INSERT INTO crear_cuestionario VALUES(".$row_count_id['ID_G'].",'".$_REQUEST['titulo']."','".$_REQUEST['formato_respuesta']."',".$_REQUEST['num_preguntas'].",1,'".$_REQUEST['url']."', '".$_REQUEST['url_usuario']."',".$_SESSION['id_usuario'].",'".$_REQUEST['descripcion']."')";
    } else {
        $sql = "INSERT INTO crear_cuestionario VALUES(".$row_count_id['ID_G'].",'".$_REQUEST['titulo']."','".$_REQUEST['formato_respuesta']."',".$_REQUEST['num_preguntas'].",".$_REQUEST['num_opciones'].",'".$_REQUEST['url']."', '".$_REQUEST['url_usuario']."',".$_SESSION['id_usuario'].",'".$_REQUEST['descripcion']."')";
    }

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    //NO BORRAR!!!!!
    echo $row_count_id['ID_G'];
}



//exit;
?>