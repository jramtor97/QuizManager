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
$sql_insert = "INSERT INTO respuestas_sumi 
VALUES(2,".$id."," . $_REQUEST['p1'] . ",
". $_REQUEST['p2'] .",
". $_REQUEST['p3'] .",
". $_REQUEST['p4'] .",
". $_REQUEST['p5'] .",
". $_REQUEST['p6'] .",
". $_REQUEST['p7'] .",
". $_REQUEST['p8'] .",
". $_REQUEST['p9'] .",
". $_REQUEST['p10'] .",
" . $_REQUEST['p11'] . ",
". $_REQUEST['p12'] .",
". $_REQUEST['p13'] .",
". $_REQUEST['p14'] .",
". $_REQUEST['p15'] .",
". $_REQUEST['p16'] .",
". $_REQUEST['p17'] .",
". $_REQUEST['p18'] .",
". $_REQUEST['p19'] .",
". $_REQUEST['p20'] .",
" . $_REQUEST['p21'] . ",
". $_REQUEST['p22'] .",
". $_REQUEST['p23'] .",
". $_REQUEST['p24'] .",
". $_REQUEST['p25'] .",
". $_REQUEST['p26'] .",
". $_REQUEST['p27'] .",
". $_REQUEST['p28'] .",
". $_REQUEST['p29'] .",
". $_REQUEST['p30'] .",
" . $_REQUEST['p31'] . ",
". $_REQUEST['p32'] .",
". $_REQUEST['p33'] .",
". $_REQUEST['p34'] .",
". $_REQUEST['p35'] .",
". $_REQUEST['p36'] .",
". $_REQUEST['p37'] .",
". $_REQUEST['p38'] .",
". $_REQUEST['p39'] .",
". $_REQUEST['p40'] .",
" . $_REQUEST['p41'] . ",
". $_REQUEST['p42'] .",
". $_REQUEST['p43'] .",
". $_REQUEST['p44'] .",
". $_REQUEST['p45'] .",
". $_REQUEST['p46'] .",
". $_REQUEST['p47'] .",
". $_REQUEST['p48'] .",
". $_REQUEST['p49'] .",
". $_REQUEST['p50'] .",
". $_REQUEST['valor_eficiencia'] .",
". $_REQUEST['valor_afecto'] .",
". $_REQUEST['valor_ayuda'] .",
". $_REQUEST['valor_control'] .",
". $_REQUEST['valor_aprendizaje'] .",
". $_REQUEST['valor_usabilidad_global'] .",
'".$_REQUEST['url_usuario']."',
". $_REQUEST['valor_puntuacion_final'] .",
'". $_REQUEST['uso']."',
'". $_REQUEST['importancia'] . "',
'". $_REQUEST['aspecto']."')";

$regi = mysqli_query($connect, $sql_insert) or die(mysqli_error($connect));
//echo $id;
//PARA PONER DEF SI EN PRESENTACION_USUARIO
$sql_si = "UPDATE respuestas_sumi r, rec r1, presentacion_usuario p 
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


	$sql_1 = "INSERT INTO prueba_sumi VALUES(1," . $_REQUEST['p1'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_1) or die(mysqli_error($connect));
	$sql_2 = "INSERT INTO prueba_sumi VALUES(2," . $_REQUEST['p2'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_2) or die(mysqli_error($connect));
	$sql_3 = "INSERT INTO prueba_sumi VALUES(3," . $_REQUEST['p3'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_3) or die(mysqli_error($connect));
	$sql_4 = "INSERT INTO prueba_sumi VALUES(4," . $_REQUEST['p4'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_4) or die(mysqli_error($connect));
	$sql_5 = "INSERT INTO prueba_sumi VALUES(5," . $_REQUEST['p5'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_5) or die(mysqli_error($connect));
	$sql_6 = "INSERT INTO prueba_sumi VALUES(6," . $_REQUEST['p6'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_6) or die(mysqli_error($connect));
	$sql_7 = "INSERT INTO prueba_sumi VALUES(7," . $_REQUEST['p7'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_7) or die(mysqli_error($connect));
	$sql_8 = "INSERT INTO prueba_sumi VALUES(8," . $_REQUEST['p8'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_8) or die(mysqli_error($connect));
	$sql_9 = "INSERT INTO prueba_sumi VALUES(9," . $_REQUEST['p9'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_9) or die(mysqli_error($connect));
	$sql_10 = "INSERT INTO prueba_sumi VALUES(10," . $_REQUEST['p10'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_10) or die(mysqli_error($connect));

	$sql_11 = "INSERT INTO prueba_sumi VALUES(11," . $_REQUEST['p11'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_11) or die(mysqli_error($connect));
	$sql_12 = "INSERT INTO prueba_sumi VALUES(12," . $_REQUEST['p12'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_12) or die(mysqli_error($connect));
	$sql_13 = "INSERT INTO prueba_sumi VALUES(13," . $_REQUEST['p13'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_13) or die(mysqli_error($connect));
	$sql_14 = "INSERT INTO prueba_sumi VALUES(14," . $_REQUEST['p14'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_14) or die(mysqli_error($connect));
	$sql_15 = "INSERT INTO prueba_sumi VALUES(15," . $_REQUEST['p15'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_15) or die(mysqli_error($connect));
	$sql_16 = "INSERT INTO prueba_sumi VALUES(16," . $_REQUEST['p16'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_16) or die(mysqli_error($connect));
	$sql_17 = "INSERT INTO prueba_sumi VALUES(17," . $_REQUEST['p17'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_17) or die(mysqli_error($connect));
	$sql_18 = "INSERT INTO prueba_sumi VALUES(18," . $_REQUEST['p18'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_18) or die(mysqli_error($connect));
	$sql_19 = "INSERT INTO prueba_sumi VALUES(19," . $_REQUEST['p19'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_19) or die(mysqli_error($connect));
	$sql_20 = "INSERT INTO prueba_sumi VALUES(20," . $_REQUEST['p20'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_20) or die(mysqli_error($connect));

	$sql_21 = "INSERT INTO prueba_sumi VALUES(21," . $_REQUEST['p21'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_21) or die(mysqli_error($connect));
	$sql_22 = "INSERT INTO prueba_sumi VALUES(22," . $_REQUEST['p22'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_22) or die(mysqli_error($connect));
	$sql_23 = "INSERT INTO prueba_sumi VALUES(23," . $_REQUEST['p23'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_23) or die(mysqli_error($connect));
	$sql_24 = "INSERT INTO prueba_sumi VALUES(24," . $_REQUEST['p24'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_24) or die(mysqli_error($connect));
	$sql_25 = "INSERT INTO prueba_sumi VALUES(25," . $_REQUEST['p25'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_25) or die(mysqli_error($connect));
	$sql_26 = "INSERT INTO prueba_sumi VALUES(26," . $_REQUEST['p26'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_26) or die(mysqli_error($connect));
	$sql_27 = "INSERT INTO prueba_sumi VALUES(27," . $_REQUEST['p27'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_27) or die(mysqli_error($connect));
	$sql_28 = "INSERT INTO prueba_sumi VALUES(28," . $_REQUEST['p28'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_28) or die(mysqli_error($connect));
	$sql_29 = "INSERT INTO prueba_sumi VALUES(29," . $_REQUEST['p29'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_29) or die(mysqli_error($connect));
	$sql_30 = "INSERT INTO prueba_sumi VALUES(30," . $_REQUEST['p30'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_30) or die(mysqli_error($connect));

	$sql_31 = "INSERT INTO prueba_sumi VALUES(31," . $_REQUEST['p31'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_31) or die(mysqli_error($connect));
	$sql_32 = "INSERT INTO prueba_sumi VALUES(32," . $_REQUEST['p32'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_32) or die(mysqli_error($connect));
	$sql_33 = "INSERT INTO prueba_sumi VALUES(33," . $_REQUEST['p33'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_33) or die(mysqli_error($connect));
	$sql_34 = "INSERT INTO prueba_sumi VALUES(34," . $_REQUEST['p34'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_34) or die(mysqli_error($connect));
	$sql_35 = "INSERT INTO prueba_sumi VALUES(35," . $_REQUEST['p35'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_35) or die(mysqli_error($connect));
	$sql_36 = "INSERT INTO prueba_sumi VALUES(36," . $_REQUEST['p36'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_36) or die(mysqli_error($connect));
	$sql_37 = "INSERT INTO prueba_sumi VALUES(37," . $_REQUEST['p37'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_37) or die(mysqli_error($connect));
	$sql_38 = "INSERT INTO prueba_sumi VALUES(38," . $_REQUEST['p38'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_38) or die(mysqli_error($connect));
	$sql_39 = "INSERT INTO prueba_sumi VALUES(39," . $_REQUEST['p39'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_39) or die(mysqli_error($connect));
	$sql_40 = "INSERT INTO prueba_sumi VALUES(40," . $_REQUEST['p40'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_40) or die(mysqli_error($connect));

	$sql_41 = "INSERT INTO prueba_sumi VALUES(41," . $_REQUEST['p41'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_41) or die(mysqli_error($connect));
	$sql_42 = "INSERT INTO prueba_sumi VALUES(42," . $_REQUEST['p42'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_42) or die(mysqli_error($connect));
	$sql_43 = "INSERT INTO prueba_sumi VALUES(43," . $_REQUEST['p43'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_43) or die(mysqli_error($connect));
	$sql_44 = "INSERT INTO prueba_sumi VALUES(44," . $_REQUEST['p44'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_44) or die(mysqli_error($connect));
	$sql_45 = "INSERT INTO prueba_sumi VALUES(45," . $_REQUEST['p45'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_45) or die(mysqli_error($connect));
	$sql_46 = "INSERT INTO prueba_sumi VALUES(46," . $_REQUEST['p46'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_46) or die(mysqli_error($connect));
	$sql_47 = "INSERT INTO prueba_sumi VALUES(47," . $_REQUEST['p47'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_47) or die(mysqli_error($connect));
	$sql_48 = "INSERT INTO prueba_sumi VALUES(48," . $_REQUEST['p48'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_48) or die(mysqli_error($connect));
	$sql_49 = "INSERT INTO prueba_sumi VALUES(49," . $_REQUEST['p49'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_49) or die(mysqli_error($connect));
	$sql_50 = "INSERT INTO prueba_sumi VALUES(50," . $_REQUEST['p50'] . ",".$id.") ";

	$reggi = mysqli_query($connect, $sql_50) or die(mysqli_error($connect));

/*
ESTO ES PARA EL GRAFICO MEDIA DE RESULTADOS!!

*/

// $sql_k = "INSERT INTO grafico_media_confianza VALUES(
// '".$_REQUEST['url_usuario']."',". $_REQUEST['puntuacion'] .",".$id.") ";

// $reggi = mysqli_query($connect, $sql_k) or die(mysqli_error($connect));


?>