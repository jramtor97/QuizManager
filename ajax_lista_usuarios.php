<?php
$connect = mysqli_connect("localhost", "root", "", "blog");

$json_response = '{"data":[ ';

$sql = "SELECT u.id       AS ID, 
			   u.nombre   AS NOMBRE, 
			   u.email    AS EMAIL, 
			   u.password AS PASSWORD, 
			   u.fecha_registro AS FECHA_REGISTRO
			 	FROM usuarios u";

$registro = mysqli_query($connect, $sql);

while ($row = mysqli_fetch_array($registro)) {
    $mostrar = true;
    if ($mostrar) {
        $json_response .= "[";
        $json_response .= '"' . utf8_encode($row["ID"]) . '",';
        $json_response .= '"' . utf8_encode($row["NOMBRE"]) . '",';
        $json_response .= '"' . utf8_encode($row["EMAIL"]) . '",';
        $json_response .= '"' . utf8_encode($row["PASSWORD"]) . '",';
        $json_response .= '"' . utf8_encode($row["FECHA_REGISTRO"]) . '"';
        $json_response .= '],';
    }
}

$json_response = substr($json_response, 0, strlen($json_response) - 1);
$json_response .= "]}";

echo $json_response;

exit;
?>