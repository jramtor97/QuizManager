<?php
header("Content-Type: text/html;charset=utf-8");
$connect = mysqli_connect("localhost", "root", "", "blog");

$json_response = '{"data":[ ';

$sql = "SELECT DISTINCT r.url_usuario   AS URL_USUARIO,
                       r.valor_eficiencia AS EFICIENCIA,
                       r.valor_afecto AS AFECTO,
                       r.valor_ayuda AS AYUDA,
                       r.valor_control AS CTRL,
                       r.valor_aprendizaje AS APR,
                       r.valor_usabilidad_global AS USAB
        FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
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
        $json_response .= '"' . $row["EFICIENCIA"] . '",'; 
        $json_response .= '"' . $row["AFECTO"] . '",'; 
        $json_response .= '"' . $row["AYUDA"] . '",'; 
        $json_response .= '"' . $row["CTRL"] . '",'; 
        $json_response .= '"' . $row["APR"] . '",'; 
        $json_response .= '"' . $row["USAB"] . '"'; 
        $json_response .= '],';
    }
}

$json_response = substr($json_response, 0, strlen($json_response) - 1);
$json_response .= "]}";

echo $json_response;

exit;
?>