<?php

include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/config.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

$titulo = 'Lista de proyectos';

//EN CONCRETO ESTA BARRA NO SALE EL PARTICIPANTE (Q ES LO QUE QUIERO; QUE NO SALGA EN ESTADÍSTICAS)
include_once 'plantillas/documento-declaracion.inc4.php';
//include_once 'plantillas/navbar.inc.php';

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
  </head>
    
  <body> 
   
  <link rel="stylesheet" type="text/css" href="plotly/bootstrap/css/bootstrap.css">
  <script src="plotly/jquery-3.3.1.min.js"></script>
  <script src="plotly/plotly-latest.min.js"></script>
  <div class="container">
    <div class="row">
      <div id='myDiv'></div>
    </div>
  </div>
  </head>
<?php
            $connect = mysqli_connect("localhost", "root", "", "blog");

            //TAMAÑO DE LA MUESTRA (N) -> numero usuarios
            $sqqql = "SELECT COUNT(r.puntuacion_final) AS COUNT FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registroqq = mysqli_query($connect, $sqqql) or die(mysqli_error($connect));
            $rwow = mysqli_fetch_array($registroqq);
            $count = $rwow['COUNT'];
            
            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.p1) AS MEDIA1 FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_p1 = $row['MEDIA1'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.p2) AS MEDIA2 FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_p2 = $row['MEDIA2'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.p3) AS MEDIA3 FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_p3 = $row['MEDIA3'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.p4) AS MEDIA4 FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_p4 = $row['MEDIA4'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.p5) AS MEDIA5 FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_p5 = $row['MEDIA5'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.p6) AS MEDIA6 FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_p6 = $row['MEDIA6'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.p7) AS MEDIA7 FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_p7 = $row['MEDIA7'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.p8) AS MEDIA8 FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_p8 = $row['MEDIA8'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.p9) AS MEDIA9 FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_p9 = $row['MEDIA9'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.p10) AS MEDIA10 FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_p10 = $row['MEDIA10'];

            //DATOS P1,...,PN
            $sql = "SELECT r.p1 FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_p1 = mysqli_fetch_assoc($registro)){
                $nuevo_array_p1[] = $fila_p1;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.p2 FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_p2 = mysqli_fetch_assoc($registro)){
                $nuevo_array_p2[] = $fila_p2;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.p3 FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_p3 = mysqli_fetch_assoc($registro)){
                $nuevo_array_p3[] = $fila_p3;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.p4 FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_p4 = mysqli_fetch_assoc($registro)){
                $nuevo_array_p4[] = $fila_p4;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.p5 FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_p5 = mysqli_fetch_assoc($registro)){
                $nuevo_array_p5[] = $fila_p5;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.p6 FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_p6 = mysqli_fetch_assoc($registro)){
                $nuevo_array_p6[] = $fila_p6;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.p7 FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_p7 = mysqli_fetch_assoc($registro)){
                $nuevo_array_p7[] = $fila_p7;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.p8 FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_p8 = mysqli_fetch_assoc($registro)){
                $nuevo_array_p8[] = $fila_p8;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.p9 FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_p9 = mysqli_fetch_assoc($registro)){
                $nuevo_array_p9[] = $fila_p9;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.p10 FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_p10 = mysqli_fetch_assoc($registro)){
                $nuevo_array_p10[] = $fila_p10;
            }
            //echo $count;
            //echo $media;
          ### IMPRIMIENDO EL ARRAY Y TODOS SUS VALORES
          //echo '<pre>';
          //print_r($nuevo_array); 
          /*
            SI MUESTRA N <= 30 --> T-Student
            SI MUESTRA N > 30 ---> Z normal (1,96)
          */
          if ($count <= 30){
              $desv_tip_p1 = 0;
              $desv_tip_p2 = 0;
              $desv_tip_p3 = 0;
              $desv_tip_p4 = 0;
              $desv_tip_p5 = 0;
              $desv_tip_p6 = 0;
              $desv_tip_p7 = 0;
              $desv_tip_p8 = 0;
              $desv_tip_p9 = 0;
              $desv_tip_p10 = 0;
              for ($i = 0; $i < $count; $i++) {
                  $desv_tip_p1 = $desv_tip_p1 + pow(($nuevo_array_p1[$i]['p1'] - $media_p1),2);
                  $desv_tip_p2 = $desv_tip_p2 + pow(($nuevo_array_p2[$i]['p2'] - $media_p2),2);
                  $desv_tip_p3 = $desv_tip_p3 + pow(($nuevo_array_p3[$i]['p3'] - $media_p3),2);
                  $desv_tip_p4 = $desv_tip_p4 + pow(($nuevo_array_p4[$i]['p4'] - $media_p4),2);
                  $desv_tip_p5 = $desv_tip_p5 + pow(($nuevo_array_p5[$i]['p5'] - $media_p5),2);
                  $desv_tip_p6 = $desv_tip_p6 + pow(($nuevo_array_p6[$i]['p6'] - $media_p6),2);
                  $desv_tip_p7 = $desv_tip_p7 + pow(($nuevo_array_p7[$i]['p7'] - $media_p7),2);
                  $desv_tip_p8 = $desv_tip_p8 + pow(($nuevo_array_p8[$i]['p8'] - $media_p8),2);
                  $desv_tip_p9 = $desv_tip_p9 + pow(($nuevo_array_p9[$i]['p9'] - $media_p9),2);
                  $desv_tip_p10 = $desv_tip_p10 + pow(($nuevo_array_p10[$i]['p10'] - $media_p10),2);
              }

              $resultado_p1 = $desv_tip_p1 / ($count -1); //es muestral
              $final_p1 = sqrt($resultado_p1);

              $resultado_p2 = $desv_tip_p2 / ($count -1); //es muestral
              $final_p2 = sqrt($resultado_p2);

              $resultado_p3 = $desv_tip_p3 / ($count -1); //es muestral
              $final_p3 = sqrt($resultado_p3);

              $resultado_p4 = $desv_tip_p4 / ($count -1); //es muestral
              $final_p4 = sqrt($resultado_p4);

              $resultado_p5 = $desv_tip_p5 / ($count -1); //es muestral
              $final_p5 = sqrt($resultado_p5);

              $resultado_p6 = $desv_tip_p6 / ($count -1); //es muestral
              $final_p6 = sqrt($resultado_p6);

              $resultado_p7 = $desv_tip_p7 / ($count -1); //es muestral
              $final_p7 = sqrt($resultado_p7);

              $resultado_p8 = $desv_tip_p8 / ($count -1); //es muestral
              $final_p8 = sqrt($resultado_p8);

              $resultado_p9 = $desv_tip_p9 / ($count -1); //es muestral
              $final_p9 = sqrt($resultado_p9);

              $resultado_p10 = $desv_tip_p10 / ($count -1); //es muestral
              $final_p10 = sqrt($resultado_p10);
              

              //calculamos tn-1;0,025
              $t = $count - 1;

              //Miramos donde esté esa t
              $sql = "SELECT t.valor AS T_FINAL FROM tstudent t
                WHERE t.n = ".$t."";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
              $row = mysqli_fetch_array($registro);
              $t_final = $row['T_FINAL'];

              $intervalo_p1 = (($t_final * $final_p1) / sqrt($count));
              $intervalo_p2 = (($t_final * $final_p2) / sqrt($count));
              $intervalo_p3 = (($t_final * $final_p3) / sqrt($count));
              $intervalo_p4 = (($t_final * $final_p4) / sqrt($count));
              $intervalo_p5 = (($t_final * $final_p5) / sqrt($count));
              $intervalo_p6 = (($t_final * $final_p6) / sqrt($count));
              $intervalo_p7 = (($t_final * $final_p7) / sqrt($count));
              $intervalo_p8 = (($t_final * $final_p8) / sqrt($count));
              $intervalo_p9 = (($t_final * $final_p9) / sqrt($count));
              $intervalo_p10 = (($t_final * $final_p10) / sqrt($count));

          } else {
              $desv_tip_p1 = 0;
              $desv_tip_p2 = 0;
              $desv_tip_p3 = 0;
              $desv_tip_p4 = 0;
              $desv_tip_p5 = 0;
              $desv_tip_p6 = 0;
              $desv_tip_p7 = 0;
              $desv_tip_p8 = 0;
              $desv_tip_p9 = 0;
              $desv_tip_p10 = 0;
              for ($i = 0; $i < $count; $i++) {
                  $desv_tip_p1 = $desv_tip_p1 + pow(($nuevo_array_p1[$i]['p1'] - $media_p1),2);
                  $desv_tip_p2 = $desv_tip_p2 + pow(($nuevo_array_p2[$i]['p2'] - $media_p2),2);
                  $desv_tip_p3 = $desv_tip_p3 + pow(($nuevo_array_p3[$i]['p3'] - $media_p3),2);
                  $desv_tip_p4 = $desv_tip_p4 + pow(($nuevo_array_p4[$i]['p4'] - $media_p4),2);
                  $desv_tip_p5 = $desv_tip_p5 + pow(($nuevo_array_p5[$i]['p5'] - $media_p5),2);
                  $desv_tip_p6 = $desv_tip_p6 + pow(($nuevo_array_p6[$i]['p6'] - $media_p6),2);
                  $desv_tip_p7 = $desv_tip_p7 + pow(($nuevo_array_p7[$i]['p7'] - $media_p7),2);
                  $desv_tip_p8 = $desv_tip_p8 + pow(($nuevo_array_p8[$i]['p8'] - $media_p8),2);
                  $desv_tip_p9 = $desv_tip_p9 + pow(($nuevo_array_p9[$i]['p9'] - $media_p9),2);
                  $desv_tip_p10 = $desv_tip_p10 + pow(($nuevo_array_p10[$i]['p10'] - $media_p10),2);
              }

              $resultado_p1 = $desv_tip_p1 / ($count -1); //es muestral
              $final_p1 = sqrt($resultado_p1);

              $resultado_p2 = $desv_tip_p2 / ($count -1); //es muestral
              $final_p2 = sqrt($resultado_p2);

              $resultado_p3 = $desv_tip_p3 / ($count -1); //es muestral
              $final_p3 = sqrt($resultado_p3);

              $resultado_p4 = $desv_tip_p4 / ($count -1); //es muestral
              $final_p4 = sqrt($resultado_p4);

              $resultado_p5 = $desv_tip_p5 / ($count -1); //es muestral
              $final_p5 = sqrt($resultado_p5);

              $resultado_p6 = $desv_tip_p6 / ($count -1); //es muestral
              $final_p6 = sqrt($resultado_p6);

              $resultado_p7 = $desv_tip_p7 / ($count -1); //es muestral
              $final_p7 = sqrt($resultado_p7);

              $resultado_p8 = $desv_tip_p8 / ($count -1); //es muestral
              $final_p8 = sqrt($resultado_p8);

              $resultado_p9 = $desv_tip_p9 / ($count -1); //es muestral
              $final_p9 = sqrt($resultado_p9);

              $resultado_p10 = $desv_tip_p10 / ($count -1); //es muestral
              $final_p10 = sqrt($resultado_p10);
              

             // T=1,96
              $intervalo_p1 = ((1.96 * $final_p1) / sqrt($count));
              $intervalo_p2 = ((1.96 * $final_p2) / sqrt($count));
              $intervalo_p3 = ((1.96 * $final_p3) / sqrt($count));
              $intervalo_p4 = ((1.96 * $final_p4) / sqrt($count));
              $intervalo_p5 = ((1.96 * $final_p5) / sqrt($count));
              $intervalo_p6 = ((1.96 * $final_p6) / sqrt($count));
              $intervalo_p7 = ((1.96 * $final_p7) / sqrt($count));
              $intervalo_p8 = ((1.96 * $final_p8) / sqrt($count));
              $intervalo_p9 = ((1.96 * $final_p9) / sqrt($count));
              $intervalo_p10 = ((1.96 * $final_p10) / sqrt($count));
          }

?>

<script type="text/javascript">
      var trace2 = {
        x: ['p1', 'p2', 'p3', 'p4', 'p5', 'p6', 'p7', 'p8','p9', 'p10'],
        y: ['<?php echo $media_p1 ?>','<?php echo $media_p2 ?>','<?php echo $media_p3 ?>','<?php echo $media_p4 ?>','<?php echo $media_p5 ?>','<?php echo $media_p6 ?>', '<?php echo $media_p7 ?>', '<?php echo $media_p8 ?>', '<?php echo $media_p9 ?>', '<?php echo $media_p10 ?>'],
        name: 'Experimental',
        error_y: {
          type: 'data',
          array: ['<?php echo $intervalo_p1; ?>', '<?php echo $intervalo_p2; ?>', '<?php echo $intervalo_p3; ?>', '<?php echo $intervalo_p4; ?>', '<?php echo $intervalo_p5; ?>', '<?php echo $intervalo_p6; ?>', '<?php echo $intervalo_p7; ?>', '<?php echo $intervalo_p8; ?>','<?php echo $intervalo_p9; ?>', '<?php echo $intervalo_p10; ?>'],
          visible: true
        },
        type: 'bar'
      };
      var data = [trace2];
      var layout = {barmode: 'group',
        title: 'Puntuación por pregunta para medias con un 95% de confianza en barras de error',
        xaxis:{
          title: 'Pregunta'
        },
        yaxis:{
          title: 'Puntuación pregunta'
        }

      };
      Plotly.newPlot('myDiv', data, layout);
  </script>

</body>
</html>

