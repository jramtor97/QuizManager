<?php
header("Content-Type: text/html;charset=utf-8");
$connect = mysqli_connect("localhost", "root", "", "blog");
session_start();

$json_response = '{"data":[ ';

$sql = "SELECT p.id           AS ID,
               p.nombre       AS NOMBRE,
               p.descripcion  AS DESCRIPCION,
               p.cuestionario AS CUESTIONARIO,
               r.url_secreta  AS URL
			 	FROM proyecto p, usuarios u, rec r
                    WHERE p.id = r.id_proyecto
                    AND p.id_usuario = u.id
                    AND u.nombre = '" . $_SESSION['nombre_usuario'] ."'";

$registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

//Consulta para controlar que en el proyecto recien creado no salga Ver resultados
//primero miramos a qué cuestionario pertenece.
// $sql = "SELECT p.cuestionario  AS ID,
//         FROM proyecto p
//             WHERE p.id IN(SELECT r.id_proyecto FROM respuestas r)";

// $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));




while ($row = mysqli_fetch_array($registro)) {
    $mostrar = true;
    $sql_q = "SELECT p.id           AS ID
        FROM proyecto p
            WHERE ".$row['ID']." IN(SELECT r.id_proyecto FROM respuestas r) 
            OR ".$row['ID']." IN(SELECT r.id_proyecto FROM respuestas_sumi r) 
            OR ".$row['ID']." IN(SELECT r.id_proyecto FROM respuestas_smil r)";

    $reg = mysqli_query($connect, $sql_q) or die(mysqli_error($connect));
    $roww = mysqli_fetch_array($reg);
    $id = $roww['ID'];

    $sql_q1 = "SELECT p.cuestionario AS QUIZ
        FROM proyecto p
            WHERE p.id = ".$row['ID']." ";

    $reg1 = mysqli_query($connect, $sql_q1) or die(mysqli_error($connect));
    $roww1 = mysqli_fetch_array($reg1);
    $quiz = $roww1['QUIZ'];

    if ($mostrar) {
        $json_response .= "[";
        $json_response .= '"' . $row["NOMBRE"] . '",';
       
        $json_response .= '"' . '<a id=\'bar\' href=\'' . 'localhost:8080/blog/recuperacion-clave1/' . utf8_encode($row["URL"]) . '\' target=\'_blank\' rel=\'noopener noreferrer\' >Ver enlace</a><a id=\'ccopiar\' href=\'getlink(' . 'localhost:8080/blog/recuperacion-clave1/' . utf8_encode($row["URL"]) . ');\'  >'. ' |'. ' Copiar enlace</a>",';
      
        $json_response .= '"' . $row["DESCRIPCION"] . '",';
        $json_response .= '"' . utf8_encode($row["CUESTIONARIO"]) . '",';

        if ($id == ''){
          $json_response .= '"' . 'No hecho",';
        } else {
            if ($quiz == 'SUS'){
                $json_response .= '"' . '<a id=\'bbar\' href=\'' . 'localhost:8080/blog/resultados.php?u='.utf8_encode($row["URL"]) .'&id='.$row["ID"].'&p=1'.'\' target=\'_blank\' rel=\'noopener noreferrer\' >Ver resultados</a>",';
            }
            if ($quiz == 'SUMI'){
                $json_response .= '"' . '<a id=\'bbar\' href=\'' . 'localhost:8080/blog/resultados_sumi.php?u='.utf8_encode($row["URL"]) .'&id='.$row["ID"].'&p=1'.'\' target=\'_blank\' rel=\'noopener noreferrer\' >Ver resultados</a>",';
            }
            if ($quiz == 'Smileyometer'){
                $json_response .= '"' . '<a id=\'bbar\' href=\'' . 'localhost:8080/blog/resultados_smil.php?u='.utf8_encode($row["URL"]) .'&id='.$row["ID"].'&p=1'.'\' target=\'_blank\' rel=\'noopener noreferrer\' >Ver resultados</a>",';
            }
          
        }
        
        $json_response .= '"<button type=\'button\' class=\'btn btn-primary\' id=\'editar_btn\' name=\'editar_btn\' onclick=\'javascript:editarProyecto(\"' . $row["ID"] . '\")\'> Editar </button>",';
        $json_response .= '"<button type=\'button\' class=\'btn btn-primary\' id=\'eliminar_btn\' name=\'eliminar_btn\' onclick=\'javascript:eliminarProyecto(\"' . $row["ID"] . '\")\'> Eliminar </button>"';

        $json_response .= '],';
    }
}

$json_response = substr($json_response, 0, strlen($json_response) - 1);
$json_response .= "]}";

echo $json_response;

exit;
?>