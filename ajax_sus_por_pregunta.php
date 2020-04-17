<?php
header("Content-Type: text/html;charset=utf-8");
$connect = mysqli_connect("localhost", "root", "", "blog");

$json_response = '{"data":[ ';

$sql = "SELECT DISTINCT r.url_usuario   AS URL_USUARIO,
                       r.p1 AS P1,
                       r.p2 AS P2,
                       r.p3 AS P3,
                       r.p4 AS P4,
                       r.p5 AS P5,
                       r.p6 AS P6,
                       r.p7 AS P7,
                       r.p8 AS P8,
                       r.p9 AS P9,
                       r.p10 AS P10
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
        $json_response .= '"' . $row["P1"] . '",'; 
        $json_response .= '"' . $row["P2"] . '",'; 
        $json_response .= '"' . $row["P3"] . '",'; 
        $json_response .= '"' . $row["P4"] . '",'; 
        $json_response .= '"' . $row["P5"] . '",'; 
        $json_response .= '"' . $row["P6"] . '",'; 
        $json_response .= '"' . $row["P7"] . '",';
        $json_response .= '"' . $row["P8"] . '",'; 
        $json_response .= '"' . $row["P9"] . '",'; 
        $json_response .= '"' . $row["P10"] . '"'; 
        $json_response .= '],';
    }
}

$json_response = substr($json_response, 0, strlen($json_response) - 1);
$json_response .= "]}";

echo $json_response;

exit;
?>