<?php
header("Content-Type: text/html;charset=utf-8");
$connect = mysqli_connect("localhost", "root", "", "blog");

$json_response = '{"data":[ ';

$sql = "SELECT DISTINCT r.url_usuario   AS URL_USUARIO,
                       r.puntuacion_final AS PUNTUACION
        FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.url_usuario = p.url_usuario
                AND p.def = 'Si'
                AND p.url = r1.url_secreta
                AND r1.id_proyecto = p1.id
                AND p1.id = ".$_REQUEST['id']."";

$registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

while ($row = mysqli_fetch_array($registro)) {
    $mostrar = true;
    if ($mostrar) {
        $json_response .= "[";
        $json_response .= '"' . $row["URL_USUARIO"] . '",';
        $json_response .= '"' . $row["PUNTUACION"] . '"'; 
        $json_response .= '],';
    }
}

$json_response = substr($json_response, 0, strlen($json_response) - 1);
$json_response .= "]}";

echo $json_response;

exit;
?>