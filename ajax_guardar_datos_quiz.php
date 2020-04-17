<?php
header("Content-Type: text/html;charset=utf-8");
$connect = mysqli_connect("localhost", "root", "", "blog");

$edad = $_REQUEST['edad'];
if ($edad == "< 6") {
    $edad = 5; 
}

if ($edad == "> 65") {
    $edad = 66;
}
//echo "<pre>";
//print_r($_REQUEST);
//COMPROBAMOS QUE EXISTA ALGUNA FILA EN LA TABLA PRESENTACION USUARIO
$sql = "SELECT p.url_usuario AS PT FROM presentacion_usuario p WHERE p.url = '".$_REQUEST['url']."' ";
$reg = mysqli_query($connect, $sql) or die(mysqli_error($connect));
$row = mysqli_fetch_array($reg);
$pt = $row['PT'];
//echo $pt;
//print_r($_REQUEST);

if ($pt == null) {
	//insert
	$sql_insert = "INSERT INTO presentacion_usuario VALUES(".$edad.",'".$_REQUEST['sexo']."','".$_REQUEST['estudios']."','".$_REQUEST['exp_internet']."','".$_REQUEST['exp_sistemas']."','".$_REQUEST['url']."','".$_REQUEST['url_quiz']."','".$_REQUEST['url_usuario']."','No')";

	$registro = mysqli_query($connect, $sql_insert) or die(mysqli_error($connect));
} else {
	//update
	// MIRAMOS SI EXISTE YA EL REQUEST ID Y EN CASO DE EXISTIR NO LO VOLVEMOS A METER EN LA BBDD!!
	$sql_update = "INSERT INTO presentacion_usuario VALUES(".$edad.",'".$_REQUEST['sexo']."','".$_REQUEST['estudios']."','".$_REQUEST['exp_internet']."','".$_REQUEST['exp_sistemas']."','".$_REQUEST['url']."','".$_REQUEST['url_quiz']."','".$_REQUEST['url_usuario']."','No')";

	$registro = mysqli_query($connect, $sql_update) or die(mysqli_error($connect));

}

//METEMOS LA URL SHUFFLED EN LA BBDD PARA CONTROLAR QUE CUANDO UN USUARIO BORRE LA URL DESAPAREZCA LA PÁGINA

// $sql = "UPDATE presentacion_usuario p SET p.url_shuffle = '".$_REQUEST['url_quiz']."' WHERE p.url = '". $_REQUEST['url'] ."' ";

// $reg = mysqli_query($connect, $sql) or die(mysqli_error($connect));

// echo $_REQUEST['url'];





















// //COMPROBAMOS QUE EXISTA ALGUNA FILA EN LA TABLA PRESENTACION USUARIO
// $sql = "SELECT p.participante AS PT FROM presentacion_usuario p WHERE p.url = '".$_REQUEST['url']."' ";
// $reg = mysqli_query($connect, $sql) or die(mysqli_error($connect));
// $row = mysqli_fetch_array($reg);
// $pt = $row['PT'];
// //echo $pt;
// //print_r($_REQUEST);

// if ($pt == null) {
// 	//insert
// 	$sql_insert = "INSERT INTO presentacion_usuario VALUES(".$edad.",'".$_REQUEST['sexo']."','".$_REQUEST['estudios']."','".$_REQUEST['exp_internet']."','".$_REQUEST['exp_sistemas']."','".$_REQUEST['url']."',".$_REQUEST['participante'].",'".$_REQUEST['url_quiz']."');";

// 	$registro = mysqli_query($connect, $sql_insert) or die(mysqli_error($connect));
// } else {
// 	//update
// 	// MIRAMOS SI EXISTE YA EL REQUEST ID Y EN CASO DE EXISTIR NO LO VOLVEMOS A METER EN LA BBDD!!
// 	$sql_s = "SELECT p.participante AS PRT FROM presentacion_usuario p WHERE p.participante = ".$_REQUEST['participante']."";

// 	$regg = mysqli_query($connect, $sql_s) or die(mysqli_error($connect));
// 	$roow = mysqli_fetch_array($regg);
// 	$ps = $roow['PRT'];

// 	if ($ps == null || $ps == '') {
// 		$sql_u = "INSERT INTO presentacion_usuario(participante) VALUES(".$_REQUEST['participante'].")";

// 		$regi = mysqli_query($connect, $sql_u) or die(mysqli_error($connect));
// 	}

// 	$sql_update = "UPDATE presentacion_usuario p SET 
// 	p.edad = ".$edad.", 
// 	p.sexo ='".$_REQUEST['sexo']."', 
// 	p.estudios ='".$_REQUEST['estudios']."', 
// 	p.exp_internet = '".$_REQUEST['exp_internet']."', 
// 	p.exp_sistemas ='".$_REQUEST['exp_sistemas']."', 
// 	p.url ='".$_REQUEST['url']."',
// 	p.participante = ".$_REQUEST['participante']."
// 	WHERE p.participante = ".$_REQUEST['participante']."";

// 	$registro = mysqli_query($connect, $sql_update) or die(mysqli_error($connect));
// }



// //METEMOS LA URL SHUFFLED EN LA BBDD PARA CONTROLAR QUE CUANDO UN USUARIO BORRE LA URL DESAPAREZCA LA PÁGINA

// $sql = "UPDATE presentacion_usuario p SET p.url_shuffle = '".$_REQUEST['url_quiz']."' WHERE p.url = '". $_REQUEST['url'] ."' ";

// $reg = mysqli_query($connect, $sql) or die(mysqli_error($connect));

// echo $_REQUEST['url'];


?>