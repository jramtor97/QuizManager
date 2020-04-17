<?php
header("Content-Type: text/html;charset=utf-8");
$connect = mysqli_connect("localhost", "root", "", "blog");
/*
NECESITAMOS METER UN ID UNICO AUTOMATICO AUTOINCREMENTAL PARA RELACIONARLO CON LA RESPUESTA
*/

$sql_id = "SELECT COUNT(IFNULL(id, 1)) AS ID_GESTION FROM pregunta_crear_cuestionario p";

$reg = mysqli_query($connect, $sql_id) or die(mysqli_error($connect));
$row_count = mysqli_fetch_array($reg);
//echo $row_count['ID_GESTION'];

if ($row_count['ID_GESTION'] == 0){
    //echo "hola";
    //exit;
    $sql_id_proyecto1 = "SELECT COUNT(IFNULL(id, 1))+1 AS ID_G FROM pregunta_crear_cuestionario p";
    $reg = mysqli_query($connect, $sql_id_proyecto1) or die(mysqli_error($connect));
    $row_count_id = mysqli_fetch_array($reg);

} else {
    $sql_id_proyecto1 = "SELECT MAX(id)+1 AS ID_G FROM pregunta_crear_cuestionario p";
    $reg = mysqli_query($connect, $sql_id_proyecto1) or die(mysqli_error($connect));
    $row_count_id = mysqli_fetch_array($reg);
}

$id = $row_count_id['ID_G'];

//Vamos a mirar si está ya la URL_USUARIO en la tabla y si está hacemos un update para poder volver atrás tanto en la tabla prefgunta como respuesta.
$sql_u = "SELECT p.url_usuario AS URL FROM pregunta_crear_cuestionario p WHERE p.url_usuario = '".$_REQUEST['u']."'";
$reg4 = mysqli_query($connect, $sql_u) or die(mysqli_error($connect));
$row4 = mysqli_fetch_array($reg4);

$sql_a = "SELECT p.url_usuario AS URL FROM respuesta_crear_cuestionario p WHERE p.url_usuario = '".$_REQUEST['u']."'";
$reg5 = mysqli_query($connect, $sql_a) or die(mysqli_error($connect));
$row5 = mysqli_fetch_array($reg5);

echo "<pre>";
print_r($_REQUEST);
$array = array();
//$array2 = array();
$num_preguntas = $_REQUEST['num_preguntas'];
$num_respuestas = $_REQUEST['respuestas'];
//Va de 0 a 3-1 (3 preguntas)0,1,2
$mostrar = true;
for ($i = 0; $i <= $num_preguntas - 1; $i++){
	if ($i > 0) {
		$id = $id + 1; //en cada vuelta metemos un id distinto
	}
	
	if ($_REQUEST['formato_resp'] == 'Opción múltiple'){
		if ($row4['URL'] != ''){
			echo $id;
			//Buscamos el último id introducido...
			$sql_6 = "SELECT p.id AS IDD FROM pregunta_crear_cuestionario p order by p.id desc limit 1";
			$reg6 = mysqli_query($connect, $sql_6) or die(mysqli_error($connect));
			$row6 = mysqli_fetch_array($reg6);
			$idd = $row6['IDD'];
			$sql = "UPDATE pregunta_crear_cuestionario p SET 
			 p.pregunta = '".$_REQUEST['array'][$i]."'
			WHERE p.id = ".($id-$idd)." ";
			$mostrar = false;
			echo "hola";
		} else {
			$sql = "INSERT INTO pregunta_crear_cuestionario(id, pregunta,id_quiz,url_usuario,respuesta) VALUES(".$id.",'".$_REQUEST['array'][$i]."',".$_REQUEST['id_quiz'].",'".$_REQUEST['url_usuario']."','".$_REQUEST['arr_inputs'][$i]."')";
		}
		
	}

	if ($_REQUEST['formato_resp'] == 'Respuesta corta'){
		$sql = "INSERT INTO pregunta_crear_cuestionario(id, pregunta,id_quiz,url_usuario,respuesta) VALUES(".$id.",'".$_REQUEST['array'][$i]."',".$_REQUEST['id_quiz'].",'".$_REQUEST['url_usuario']."','".$_REQUEST['array_resp'][$i]."')";
	}
	

	$registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	$array[$i] = $id;

	if ($mostrar){
			$sql = "CREATE TABLE cu_propio".$_REQUEST['id_quiz']."(
					id_participante int,
					pregunta varchar(500),
					respuesta varchar(500),
					nota decimal(7,3),
					url_usuario varchar(500));";

			$registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
			$mostrar = false;
		}
	//echo "<pre>";

	//print_r($array[$i]);
	//Duplicamos el array
	//$x = $array[$i];
	
}

//Duplicamos valores del array
$array_final = array_merge($array,$array);
//ordenamos
sort($array_final);
print_r($array_final);

/*
NECESITAMOS METER UN ID UNICO AUTOMATICO AUTOINCREMENTAL
*/

$sql_id = "SELECT COUNT(IFNULL(id, 1)) AS ID_GESTION FROM respuesta_crear_cuestionario p";

$reg = mysqli_query($connect, $sql_id) or die(mysqli_error($connect));
$row_count = mysqli_fetch_array($reg);
//echo $row_count['ID_GESTION'];

if ($row_count['ID_GESTION'] == 0){
    //echo "hola";
    //exit;
    $sql_id_proyecto1 = "SELECT COUNT(IFNULL(id, 1))+1 AS ID_G FROM respuesta_crear_cuestionario p";
    $reg = mysqli_query($connect, $sql_id_proyecto1) or die(mysqli_error($connect));
    $row_count_id = mysqli_fetch_array($reg);

} else {
    $sql_id_proyecto1 = "SELECT MAX(id)+1 AS ID_G FROM respuesta_crear_cuestionario p";
    $reg = mysqli_query($connect, $sql_id_proyecto1) or die(mysqli_error($connect));
    $row_count_id = mysqli_fetch_array($reg);
}

$id_f = $row_count_id['ID_G'];

for ($j = 0; $j <= $num_respuestas - 1; $j++){
		if ($j > 0){
			$id_f = $id_f + 1;
		}

		if ($row5['URL'] != ''){
			echo $id_f;
			$sql_7 = "SELECT p.id AS IDD1 FROM respuesta_crear_cuestionario p order by p.id desc limit 1";
			$reg7 = mysqli_query($connect, $sql_7) or die(mysqli_error($connect));
			$row7 = mysqli_fetch_array($reg7);
			$iddd = $row7['IDD1'];
			$sql = "UPDATE  respuesta_crear_cuestionario r
			SET r.opciones_respuesta = '".$_REQUEST['array_resp'][$j]."' WHERE r.id = ".($id_f-$iddd)." ";
			echo "que tal";
		} else {
			$sql = "INSERT INTO respuesta_crear_cuestionario(id_quiz,url_usuario,opciones_respuesta,id) VALUES(".$_REQUEST['id_quiz'].",'".$_REQUEST['url_usuario']."','".$_REQUEST['array_resp'][$j]."',".$id_f.")";
		}

		$registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
}

if ($row4['URL'] == '' || $row5['URL'] == ''){
	$sql = "SELECT id AS ID FROM respuesta_crear_cuestionario WHERE id_quiz = ".$_REQUEST['id_quiz']." ";

	$registro = mysqli_query($connect, $sql);
	//$row = mysqli_fetch_array($registro);

	$sql_q = "SELECT COUNT(*) AS COUNT FROM respuesta_crear_cuestionario WHERE id_quiz = ".$_REQUEST['id_quiz']." ";

	$reg = mysqli_query($connect, $sql_q);
	$roww = mysqli_fetch_array($reg);
	$count = $roww['COUNT'];


	$array2 = array();
	//Metemos los ids en un array

	for ($w = 0; $w < $count; $w++){
		$row = mysqli_fetch_array($registro);
		$array2[$w] = $row['ID'];
	}

	print_r($array2);
	for ($k = 0; $k < $count; $k++){
		$sql_q = "UPDATE respuesta_crear_cuestionario r SET id_pregunta = '".$array_final[$k]."' WHERE id = ".$array2[$k]." ";

		$reg = mysqli_query($connect, $sql_q);
	}
}



exit;
?>