<?php
$connect = mysqli_connect("localhost", "root", "", "blog");


//print_r($_REQUEST);

/**
 * DEBEMOS COGER EL ID DEL PROYECTO PRIMERO
 */
//Cogemos el proyecto que lleve por url la pasada

$sql_id_proyecto = "SELECT r.id_proyecto AS ID_PROYECTO FROM rec r WHERE r.url_secreta = '".$_REQUEST['url']."'";

$registro = mysqli_query($connect, $sql_id_proyecto) or die(mysqli_error($connect));
$row = mysqli_fetch_array($registro);
$id = $row['ID_PROYECTO'];
//echo $id;


//SI NO HAY FILAS INSERT POR ESO LO PONEMOS: ES NECESARIO!!! NO QUITAR!!!
$sql_insert = "INSERT INTO respuestas_smil 
VALUES(3,".$id."," . $_REQUEST['p1'] . ",
". $_REQUEST['p2'] .",
". $_REQUEST['p3'] .",
". $_REQUEST['p4'] .",
". $_REQUEST['p5'] .",
". $_REQUEST['valor_atraccion'] .",
". $_REQUEST['valor_facilidad'] .",
". $_REQUEST['valor_aprendizaje'] .",
". $_REQUEST['valor_entretenimiento'] .",
". $_REQUEST['valor_puntuacion_final'] .",
'". $_REQUEST['url_usuario'] ."',
'". $_REQUEST['uso']."',
'". $_REQUEST['importancia'] . "',
'". $_REQUEST['aspecto']."')";

$regi = mysqli_query($connect, $sql_insert) or die(mysqli_error($connect));
//echo $id;
//PARA PONER DEF SI EN PRESENTACION_USUARIO
$sql_si = "UPDATE respuestas_smil r, rec r1, presentacion_usuario p 
			SET p.def = 'Si'
			WHERE p.url_usuario = '".$_REQUEST['url_usuario']."'
			AND r.id_proyecto = r1.id_proyecto
			AND r1.url_secreta = p.url";

$registro = mysqli_query($connect, $sql_si) or die(mysqli_error($connect));

/*
POR NADA DEL MUNDO BORRAR ECHO $ID !!!!!!!!!!!!
NO BORRRRAAAAAAAAAAAAAAAAAAAAAR!!!!!
*/
//exit;
echo $id;


/*
ESTO ES PARA EL GRAFICO DE CAJAS POR PREGUNTA!!!

*/


	$sql_1 = "INSERT INTO prueba_smil VALUES(1," . $_REQUEST['p1'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_1) or die(mysqli_error($connect));
	$sql_2 = "INSERT INTO prueba_smil VALUES(2," . $_REQUEST['p2'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_2) or die(mysqli_error($connect));
	$sql_3 = "INSERT INTO prueba_smil VALUES(3," . $_REQUEST['p3'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_3) or die(mysqli_error($connect));
	$sql_4 = "INSERT INTO prueba_smil VALUES(4," . $_REQUEST['p4'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_4) or die(mysqli_error($connect));
	$sql_5 = "INSERT INTO prueba_smil VALUES(5," . $_REQUEST['p5'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_5) or die(mysqli_error($connect));

/*
ESTO ES PARA EL GRAFICO MEDIA DE RESULTADOS!!

*/

// $sql_k = "INSERT INTO grafico_media_confianza VALUES(
// '".$_REQUEST['url_usuario']."',". $_REQUEST['puntuacion'] .",".$id.") ";

// $reggi = mysqli_query($connect, $sql_k) or die(mysqli_error($connect));


?>