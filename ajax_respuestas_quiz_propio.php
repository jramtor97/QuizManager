<?php
header("Content-Type: text/html;charset=utf-8");
$connect = mysqli_connect("localhost", "root", "", "blog");

//echo "<pre>";
//print_r($_REQUEST['array22']);
$cont = 0;
$array_resp = array();
$array_preg = array();
//echo $_REQUEST['array22'][0];
//PARA COGER LAS PREGUNTAS Y METERLAS EN LA NUEVA TABLA!!
/*
- cojo las respuestas fundamentalmente
- cojo las preguntas dado que las quiero meter en un array para meterlas a la nueva tabla
*/
	$sql = "SELECT p.respuesta AS RESP,
                   p.pregunta  AS PREG
     FROM
	 pregunta_crear_cuestionario p
	 WHERE p.url_usuario = '" . $_REQUEST['url_usuario'] ."'
      AND p.id_quiz = ".$_REQUEST['id_quiz']." ORDER BY id ASC";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

    while ($row = mysqli_fetch_array($registro)){
    	$array_resp[] = $row['RESP'];
        $array_preg[] = $row['PREG'];
    }

    //print_r($array_resp);
    //PARA METER EL ID DEL PARTICIPANTE
    $sql = "SELECT p.id_participante AS ID_P
     FROM cu_propio".$_REQUEST['id_quiz']." p
   ORDER BY p.id_participante DESC";
//obtenemos la ultima fila
    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

    $row = mysqli_fetch_array($registro);
    $ultimo_id = $row['ID_P'];
    $ultimo_id = $ultimo_id + 1;
    
for ($i = 0; $i < count($_REQUEST['array22']); $i++){
    
    if ($array_resp[$i] == $_REQUEST['array22'][$i]) {
   	   $cont = $cont + 1;
    }

    $sql = "INSERT INTO cu_propio".$_REQUEST['id_quiz']."(id_participante, pregunta, respuesta, url_usuario) VALUES(".$ultimo_id.",'".$array_preg[$i]."','".$_REQUEST['array22'][$i]."','".$_REQUEST['url_usuario']."')";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
}

//PARA LA NOTA FINAL
$sql = "UPDATE cu_propio".$_REQUEST['id_quiz']." c SET c.nota = ".(($cont /$_REQUEST['num_preguntas'])*100)." WHERE c.id_participante = ".$ultimo_id." ";

$registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
//$cont_nueva_tabla = $cont_nueva_tabla +1;
// echo "<br>";
// echo "la nota final es: ";


//PARA PONER DEF SI EN PRESENTACION_USUARIO
$sql_si = "UPDATE presentacion_usuario p 
      SET p.def = 'Si'
      WHERE p.url_usuario = '".$_REQUEST['url_usuario']."' ";
$regis = mysqli_query($connect, $sql_si) or die(mysqli_error($connect));

echo $cont;

exit;
?>