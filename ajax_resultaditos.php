<?php
header("Content-Type: text/html;charset=utf-8");
$connect = mysqli_connect("localhost", "root", "", "blog");

$json_response = '{"data":[ ';

$sql = "SELECT DISTINCT
               p.edad         AS EDAD,
               p.sexo         AS SEXO,
               p.estudios     AS ESTUDIOS,
               p.exp_internet AS EXP_INTERNET,
               p.exp_sistemas AS EXP_SISTEMAS  
        FROM presentacion_usuario p";

$registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

while ($row = mysqli_fetch_array($registro)) {
    $mostrar = true;
    if ($mostrar) {
        $json_response .= "[";
        $json_response .= '"' . $row["EDAD"] . '",'; 
        $json_response .= '"' . $row["SEXO"] . '",'; 
        $json_response .= '"' . $row["ESTUDIOS"] . '",'; 
        $json_response .= '"' . $row["EXP_INTERNET"] . '",'; 
        $json_response .= '"' . $row["EXP_SISTEMAS"] . '"'; 
        $json_response .= '],';
    }
}

$json_response = substr($json_response, 0, strlen($json_response) - 1);
$json_response .= "]}";

echo $json_response;

exit;
?>