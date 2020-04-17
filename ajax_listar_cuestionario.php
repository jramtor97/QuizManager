<?php
header("Content-Type: text/html;charset=utf-8");
$connect = mysqli_connect("localhost", "root", "", "blog");
session_start();

$json_response = '{"data":[ ';

$sql = "SELECT  p.id           AS ID,
                p.titulo       AS NOMBRE,
               p.formato_respuesta AS TIPO,
               p.url AS URL,
               p.url_usuario AS URL_USUARIO
			 	FROM crear_cuestionario p
                    WHERE p.id_usuario = '" . $_SESSION['id_usuario'] ."'";

$registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

//Consulta para controlar que en el proyecto recien creado no salga Ver resultados
//primero miramos a qué cuestionario pertenece.
// $sql = "SELECT p.cuestionario  AS ID,
//         FROM proyecto p
//             WHERE p.id IN(SELECT r.id_proyecto FROM respuestas r)";

// $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));


// $sql = "SELECT p.id           AS ID,
//         FROM proyecto p
//             WHERE p.id IN(SELECT r.id_proyecto FROM respuestas r)";

// $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));


while ($row = mysqli_fetch_array($registro)) {
    $mostrar = true;
    $sql_q2 = "SELECT c.url_usuario AS URL FROM crear_cuestionario c WHERE c.id =".$row['ID']." ";

    $registro12 = mysqli_query($connect, $sql_q2) or die(mysqli_error($connect));
    $row12 = mysqli_fetch_array($registro12);
    $url_u = $row12['URL'];
    $sql_q = "SELECT url_usuario AS URL_F FROM cu_propio".$row['ID']." WHERE url_usuario = '". $url_u."' ";

    $registro1 = mysqli_query($connect, $sql_q) or die(mysqli_error($connect));
    $row1 = mysqli_fetch_array($registro1);
    $url_f = $row1['URL_F'];

    if ($mostrar) {
        $json_response .= "[";
        $json_response .= '"' . $row["NOMBRE"] . '",';
        $json_response .= '"' . '<a id=\'bar\' href=\'' . 'localhost:8080/blog/presentacion_quiz.php?url=' . utf8_encode($row["URL"]) . '&u='.$row["URL_USUARIO"] .'&id_quiz='.$row["ID"] .'\' target=\'_blank\' rel=\'noopener noreferrer\' >Ver enlace</a><a id=\'ccopiar\' href=\'getlink(' . 'localhost:8080/blog/recuperacion-clave1/' . utf8_encode($row["URL"]) . ');\'  >'. ' |'. ' Copiar enlace</a>",';
        $json_response .= '"' . $row["TIPO"] . '",';

        if ($url_f == '') {
            $json_response .= '"' . 'No hecho",';
        } else {
            $json_response .= '"' . '<a id=\'bbar\' href=\'' . 'localhost:8080/blog/estadistica_propia.php?url='.utf8_encode($row["URL"]) .'&u='.utf8_encode($row["URL_USUARIO"]).'&id_quiz='.$row["ID"].'&p=1'.'\' target=\'_blank\' rel=\'noopener noreferrer\' >Ver resultados</a>",';
        }
        

        $json_response .= '"<button type=\'button\' class=\'btn btn-primary\' id=\'editar_btn\' name=\'editar_btn\' onclick=\'javascript:editarProyecto(\"' . $row["ID"] . '\")\'> Editar </button>",';
        $json_response .= '"<button type=\'button\' class=\'btn btn-primary\' id=\'eliminar_btn\' name=\'eliminar_btn\' onclick=\'javascript:eliminarQuiz(\"' . $row["ID"] . '\")\'> Eliminar </button>"';

        
        //$json_response .= '"<button type=\'button\' class=\'btn btn-primary\' id=\'editar_btn\' name=\'editar_btn\' onclick=\'javascript:editarProyecto(\"' . $row["ID"] . '\")\'> Editar </button>",';
        //$json_response .= '"<button type=\'button\' class=\'btn btn-primary\' id=\'eliminar_btn\' name=\'eliminar_btn\' onclick=\'javascript:eliminarProyecto(\"' . $row["ID"] . '\")\'> Eliminar </button>"';

        $json_response .= '],';
    }
}

$json_response = substr($json_response, 0, strlen($json_response) - 1);
$json_response .= "]}";

echo $json_response;

exit;
?>