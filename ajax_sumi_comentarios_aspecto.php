<?php
header("Content-Type: text/html;charset=utf-8");
$connect = mysqli_connect("localhost", "root", "", "blog");

$json_response = '{"data":[ ';

$sql = "SELECT DISTINCT r.url_usuario   AS URL_USUARIO,
                       r.aspecto AS COMENTARIO
        FROM respuestas_sumi r
                WHERE r.id_proyecto = ".$_REQUEST['id']."";

$registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

while ($row = mysqli_fetch_array($registro)) {
    $mostrar = true;
    if ($mostrar) {
        $json_response .= "[";
        $json_response .= '"' . $row["URL_USUARIO"] . '",';
        $json_response .= '"' . $row["COMENTARIO"] . '"'; 
        $json_response .= '],';
    }
}

$json_response = substr($json_response, 0, strlen($json_response) - 1);
$json_response .= "]}";

echo $json_response;

exit;
?>