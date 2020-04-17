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
//echo $_REQUEST['p'];

$resultado = substr($_SERVER['REQUEST_URI'], 0, -4);
//echo $resultado;
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
   <div class="container">
    <h1>Resultados Estadísticos</h1>
    <div id="h" class="container">
      <style>
        .h {
          text-align: center;
        }
      </style>
    </div>
    <div style="height:50px"></div>

<?php
  if ($_REQUEST['p'] == '1') {
        ?>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#resumen" onclick="location.href='<?php echo $resultado?>'+'&p=1'">Resumen</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#especifico" onclick="location.href='<?php echo $resultado?>'+'&p=2'">Específico</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#detallado" onclick="location.href='<?php echo $resultado?>'+'&p=3'">Detallado</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#informe" onclick="location.href='<?php echo $resultado?>'+'&p=4'">Informe</a>
            </li>
          </ul>
        <?php
      }
  ?>
  <?php
  if ($_REQUEST['p'] == '2') {
        ?>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#resumen" onclick="location.href='<?php echo $resultado?>'+'&p=1'">Resumen</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#especifico" onclick="location.href='<?php echo $resultado?>'+'&p=2'">Específico</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#detallado" onclick="location.href='<?php echo $resultado?>'+'&p=3'">Detallado</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#informe" onclick="location.href='<?php echo $resultado?>'+'&p=4'">Informe</a>
            </li>
          </ul>
        <?php
      }
  ?>
<?php
  if ($_REQUEST['p'] == '3') {
        ?>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#resumen" onclick="location.href='<?php echo $resultado?>'+'&p=1'">Resumen</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#especifico" onclick="location.href='<?php echo $resultado?>'+'&p=2'">Específico</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#detallado" onclick="location.href='<?php echo $resultado?>'+'&p=3'">Detallado</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#informe" onclick="location.href='<?php echo $resultado?>'+'&p=4'">Informe</a>
            </li>
          </ul>
        <?php
      }
  ?>
  <?php
  if ($_REQUEST['p'] == '4') {
        ?>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#resumen" onclick="location.href='<?php echo $resultado?>'+'&p=1'">Resumen</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#especifico" onclick="location.href='<?php echo $resultado?>'+'&p=2'">Específico</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#detallado" onclick="location.href='<?php echo $resultado?>'+'&p=3'">Detallado</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#informe" onclick="location.href='<?php echo $resultado?>'+'&p=4'">Informe</a>
            </li>
          </ul>
        <?php
      }
  ?>

  <!-- Tab panes -->
  <div class="container" style="background-color: #ffffff; padding: 20px; margin: auto; ">
  <div class="tab-content">
    <?php
  if ($_REQUEST['p'] == '1') {
        ?>
      <div id="resumen" class="container tab-pane active"><br>
      
<div class="row">
        <div class="col-md-8">
        <h5><strong>Datos generales: </strong></h5>
        <ul>
          <li>Número de participantes: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");
            // SELECT COUNT(*) FROM (SELECT distinct r.puntuacion_final FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
            //     WHERE r.id_proyecto = 1
            //     AND r.id_proyecto = r1.id_proyecto) p;
            $sql = "SELECT DISTINCT COUNT(r.id_proyecto) AS NUM_PART FROM respuestas_sumi r, rec r1 WHERE r.id_proyecto = ".$_REQUEST['id']." AND r.id_proyecto = r1.id_proyecto ";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?></li>
          <li>Promedio de edad: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT ROUND(AVG(p.edad),0) AS NUM_PART FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si' ";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?></li>
          <ul>
            <li>Máximo: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT MAX(p.edad) AS NUM_PART FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si' ";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?></li>
            <li>Mínimo: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT MIN(p.edad) AS NUM_PART FROM  respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si' ";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?></li>
          </ul>
          <li>Promedio de sexo: </li>
          <ul>
            <li>Hombres: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT ROUND((COUNT(p.sexo)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.sexo = 'Hombre'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?> %</li>
            <li>Mujeres: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT ROUND((COUNT(p.sexo)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.sexo = 'Mujer'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?> %</li>
          </ul>
          <li>Experiencia en internet: </li>
          <ul>
            <li>Muy alto: <?php 
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_internet = 'Muy alto'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              echo $row['NUM_PART'];

        ?> %</li>
            <li>Alto: <?php 
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_internet = 'Alto'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              echo $row['NUM_PART'];

        ?> %</li>
            <li>Medio: <?php 
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_internet = 'Medio'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              echo $row['NUM_PART'];

        ?> %</li>
            <li>Bajo: <?php 
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_internet = 'Bajo'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              echo $row['NUM_PART'];

        ?> %</li>
            <li>Muy bajo: <?php 
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_internet = 'Muy bajo'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              echo $row['NUM_PART'];

        ?> %</li>
          </ul>
          <li>Experiencia en sistemas parecidos: </li>
          <ul>
            <li>Muy alto: <?php 
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_sistemas = 'Muy alto'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              echo $row['NUM_PART'];

        ?> %</li>
            <li>Alto: <?php 
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_sistemas = 'Alto'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              echo $row['NUM_PART'];

        ?> %</li>
            <li>Medio: <?php 
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_sistemas = 'Medio'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              echo $row['NUM_PART'];

        ?> %</li>
            <li>Bajo: <?php 
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_sistemas = 'Bajo'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              echo $row['NUM_PART'];

        ?> %</li>
            <li>Muy bajo: <?php 
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_sistemas = 'Muy bajo'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              echo $row['NUM_PART'];

        ?> %</li>
          </ul>
        </ul>
          
        <h5><strong>Puntuación cuestionario: </strong></h5>
          <ul>
          <li>Promedio de resultados: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT ROUND(AVG(r.puntuacion_final),2) AS NUM_PART FROM respuestas_sumi r, rec r1 WHERE r.id_proyecto = ".$_REQUEST['id']." AND r.id_proyecto = r1.id_proyecto";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?> %</li>
      </ul>

 
    </div>
    
    </div>

  <link rel="stylesheet" type="text/css" href="plotly/bootstrap/css/bootstrap.css">
  <script src="plotly/jquery-3.3.1.min.js"></script>
  <script src="plotly/plotly-latest.min.js"></script>
  <br>
  <br>
  <h5><strong>Puntuación por participante: </strong></h5>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-primary">
          <div class="panel panel-body">
            <div class="row">
        
              <div class="col-lg-12">
                <div id="ffii"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
      
<?php
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT r.url_usuario, r.puntuacion_final FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            $valoresYY=array(); 
            $valoresX=array();

            //$row = mysqli_fetch_array($registro);
            while ($ver = mysqli_fetch_row($registro)){
                $valoresX[]=$ver[0];
                $valoresYY[]=$ver[1];
            }

            $sql_w = "SELECT COUNT(r.puntuacion_final) AS COUNTT FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registr = mysqli_query($connect, $sql_w) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registr);
            $countt = $row['COUNTT'];
            //echo $countt;
            //print_r($valoresYY);
            $valoresY = array();
            for ($i = 1; $i <= $countt; $i++){
                $valoresY[$i] = $valoresYY[$i-1];
            }
            //echo "<pre>";
            //print_r($valoresY);

            for ($i = 1; $i <= $countt; $i++){
                if ($valoresY[$i] < 50) {
                    $valoresY[$i] = $valoresY[$i] * -1;
                }
            }

            $array_p = array();

            $sql_q = "SELECT COUNT(r.url_usuario) AS COUNT FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro_q = mysqli_query($connect, $sql_q) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro_q);
            $cont = $row['COUNT'];
            
            for ($i = 1; $i <= $cont; $i++){
              //$cont = $cont +1;
              $array_p[$i] = '#'.$i;
            }

            //echo "<pre>";
            //print_r($valoresY);

            for ($i = 1; $i <= $cont; $i++){
              if ($valoresY[$i] > 0) {
                  $valoresY[$i] =($valoresY[$i] - 50.000);
              } else {
                  $valoresY[$i] =(($valoresY[$i]*-1) - 50);
              }
              
            }

            $array_posiciones_positivas = array();
            $array_posiciones_negativas = array();
            $array_datosY_positivas = array();
            $array_datosY_negativas = array();

            for ($j = 1; $j <= $cont; $j++){
              if ($valoresY[$j] >= 0.000) {
                  $array_posiciones_positivas[$j] = $j;
                  $array_datosY_positivas[$j] = $valoresY[$j];
              } else {
                  $array_posiciones_negativas[$j] = $j;
                  $array_datosY_negativas[$j] = $valoresY[$j];
              }
              
            }
            // //Coger el primer elemento de cada array y mandarlo al final.
            // for ($j = 1; $j <= $cont; $j++){
            //     $array_posiciones_positivas[$cont] = $array_posiciones_positivas[$j];
            //     $array_posiciones_negativas[$cont] = $array_posiciones_negativas[$j];
            //     $array_datosY_positivas[$cont] = $array_datosY_positivas[$j]; 
            //     $array_datosY_negativas[$cont] = $array_datosY_negativas[$j];
            // }

            //     unset($array_posiciones_positivas[0]);
            //     unset($array_datosY_positivas[0]);
            //     unset($array_datosY_positivas[0]);
            //     unset($array_datosY_positivas[0]);

            // echo "<pre>";
            // print_r($valoresY);

            // echo "<pre>";
            // print_r($array_posiciones_positivas);

            // //echo "<pre>";
            // print_r($array_datosY_positivas);
            
            // //echo "<pre>";
            // print_r($array_posiciones_negativas);
            
            // //echo "<pre>";
            // print_r($array_datosY_negativas);

            //$datosX = json_encode($array_p);
            //$datosY = json_encode($valoresY);
            $array_posiciones_positivas = implode($array_posiciones_positivas);
            $array_posiciones_negativas = implode($array_posiciones_negativas);

            $trace1_x = json_encode($array_posiciones_positivas);
            $trace1_y = json_encode($array_datosY_positivas);
            $trace2_x = json_encode($array_posiciones_negativas);
            $trace2_y = json_encode($array_datosY_negativas);



?>
<script type="text/javascript">
    function crearCadenaLineal(json){
        var parsed = JSON.parse(json);
        var arr = [];
        for (var x in parsed){
          arr.push(parsed[x]);
        }
        return arr;
    }
</script>
<script type="text/javascript">
    trace1_x = crearCadenaLineal('<?php echo $trace1_x; ?>');
    trace1_y = crearCadenaLineal('<?php echo $trace1_y; ?>');
    trace2_x = crearCadenaLineal('<?php echo $trace2_x; ?>');
    trace2_y = crearCadenaLineal('<?php echo $trace2_y; ?>');

    var trace1 = {
        x: trace1_x,
        y: trace1_y,
        name: "Aprobado",
        base: 50,
        type: 'bar',
        marker: {
          color: 'green'
        },
    };

    var trace2 = {
        x: trace2_x,
        y: trace2_y,
        name: "Suspenso",
        base: 50,
        type: 'bar',
        marker: {
          color: 'red'
        },
    };

    var cl={
      type: 'scatter',
      x: [0.5, '<?php echo $countt+0.5; ?>'], //num veces que se repite la linea hasta el num participantes será
      y: [50, 50], //aqui smp 50 no tocar
      mode: 'lines',
      name: 'Límite',
      showlegend: true,
      line: {
        color: 'black',
        width: 2,
        dash: 'dash'
      }
    }

    var layout = {
        title: 'Gráfico de barras',
        xaxis:{
          title: 'Número de participantes'
        },
        yaxis:{
          title: 'Puntuación SUS'
        }

      };

    var data = [trace1, trace2, cl];
    var config = {responsive:true};
    Plotly.newPlot('ffii', data, layout, config);

</script>
<ul>
          <li>Porcentaje de personas que han sacado un resultado en la escala (Excelente, Bueno, Bien, Mediocre, Pobre)</li>
      </ul>
<link rel="stylesheet" type="text/css" href="plotly/bootstrap/css/bootstrap.css">
<script src="plotly/jquery-3.3.1.min.js"></script>
  <script src="plotly/plotly-latest.min.js"></script>
  
 
      <div id='graph'></div>
  

  </head>
<?php
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT r.url_usuario, r.puntuacion_final FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            $valoresY=array(); 
            $valoresX=array();

            //$row = mysqli_fetch_array($registro);
            while ($ver = mysqli_fetch_row($registro)){
                $valoresX[]=$ver[0];
                $valoresY[]=$ver[1];
            }

            $array_radar = array();

            $sql_excelente = "SELECT ROUND((COUNT(r.puntuacion_final)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS EXCELENTE FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND r.puntuacion_final >= 85";

              $registro1 = mysqli_query($connect, $sql_excelente) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro1);
              $excelente = $row['EXCELENTE'];
              $array_radar[0] = $excelente . " %";

              $sql_bueno = "SELECT ROUND((COUNT(r.puntuacion_final)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS BUENO FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND r.puntuacion_final BETWEEN 73 AND 84.99";

              $registro1 = mysqli_query($connect, $sql_bueno) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro1);
              $bueno = $row['BUENO'];
              $array_radar[1] = $bueno . " %";

              $sql_bien = "SELECT ROUND((COUNT(r.puntuacion_final)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS BIEN FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND r.puntuacion_final BETWEEN 50 AND 72.99";

              $registro1 = mysqli_query($connect, $sql_bien) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro1);
              $bien = $row['BIEN'];
              $array_radar[2] = $bien . " %";

              $sql_pobre = "SELECT ROUND((COUNT(r.puntuacion_final)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS POBRE FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND r.puntuacion_final BETWEEN 25 AND 49.99";

              $registro1 = mysqli_query($connect, $sql_pobre) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro1);
              $pobre = $row['POBRE'];
              $array_radar[3] = $pobre . " %";


              $sql_mediocre = "SELECT ROUND((COUNT(r.puntuacion_final)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS MEDIOCRE FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND r.puntuacion_final BETWEEN 0 AND 24.99";

              $registro1 = mysqli_query($connect, $sql_mediocre) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro1);
              $mediocre = $row['MEDIOCRE'];
              $array_radar[4] = $mediocre . " %";

              //echo "<pre>";
              //print_r($array_radar);

              $array_radar = json_encode($array_radar);

?>
<script type="text/javascript">
    function crearCadenaLineal(json){
        var parsed = JSON.parse(json);
        var arr = [];
        for (var x in parsed){
          arr.push(parsed[x]);
        }
        return arr;
    }
</script>
<script type="text/javascript">

    $array_radar = crearCadenaLineal('<?php echo $array_radar; ?>');

    data = [{
      type: 'scatterpolar',
      r: $array_radar,
      theta: ['Excelente','Bueno','Bien', 'Mediocre', 'Pobre'],
      fill: 'toself'
    }]

    layout = {
      polar: {
        radialaxis: {
          visible: true,
          range: [0, 100]
        }
      },
      showlegend: false
    }

    var config = {responsive: true};
    Plotly.newPlot("graph", data, layout, config);

</script>
    
  </body>

    <div style="height:50px"></div>
     <h5><strong>Datos por participante: </strong></h5>
     <br>
        <div class="row">
                <div class="col-lg-12">
                      <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                          <thead>
                              <tr>
                                <th>Usuario</th>
                                <th>Puntuación</th>
                                <th>Edad</th>
                                <th>Sexo</th>
                                <th>Estudios</th>
                                <th>Experiencia en internet</th>
                                <th>Experiencia en sistemas parecidos</th>
                            </tr>
                          </thead>     
                       </table>
    </div>    </div>
    </div>
    <br>
    <br>
    
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    

    <script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            lengthChange: false,
            dom: 'Bfrtip',
            buttons: [ 'copy', 'excel', 'csv', 'pdf', 'colvis' ],
            ajax: "ajax_tabla_resultados_sumi.php?id="+'<?php echo $_REQUEST['id'] ?>',
            language: {
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "Mostrando _START_ de _END_ filas",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast":"Último",
                            "sNext":"Siguiente",
                            "sPrevious": "Anterior"
                         },
                         "sProcessing":"Procesando...",
                }
        });
     
        table.buttons().container()
    .appendTo( $('#example .col-sm-6:eq(0)', table.table().container() ) );
    });
    </script>








      </div>
        <?php
      }
  ?>
    
    <?php
  if ($_REQUEST['p'] == '2') {
        ?>
      <div id="especifico" class="container tab-pane active"><br>
        <h5><strong>Gráfico edad: </strong></h5>

        <link rel="stylesheet" type="text/css" href="plotly/bootstrap/css/bootstrap.css">
        <script src="plotly/jquery-3.3.1.min.js"></script>
        <script src="plotly/plotly-latest.min.js"></script>
        <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-primary">
          <div class="panel panel-body">
            <div class="row">
        
              <div class="col-lg-12">
                <div id="myDivy"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT r.url_usuario, u.edad FROM respuestas_sumi r, presentacion_usuario u WHERE
            r.url_usuario = u.url_usuario AND u.def = 'Si' AND r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            $valoresY=array(); //puntuacion
            $valoresX=array(); //url_usuario

            //$row = mysqli_fetch_array($registro);
            while ($ver = mysqli_fetch_row($registro)){
                $valoresX[]=$ver[0];
                $valoresY[]=$ver[1];
            }
            $array_nuevo_part = array();

            $sql_q1 = "SELECT COUNT(r.url_usuario) AS COUNT FROM respuestas_sumi r, presentacion_usuario u
            WHERE r.url_usuario = u.url_usuario AND u.def = 'Si' AND r.id_proyecto = ".$_REQUEST['id']."";

            $registro_q1 = mysqli_query($connect, $sql_q1) or die(mysqli_error($connect));

            $row1 = mysqli_fetch_array($registro_q1);
            $cont1 = $row1['COUNT'];
            
            for ($i = 1; $i <= $cont1; $i++){
              //$cont = $cont +1;
              $array_nuevo_part[$i-1] = '#'.$i;
            }

            $datosX=json_encode($array_nuevo_part);
            $datosY=json_encode($valoresY);

?>
<script type="text/javascript">
  function crearCadenaLineal(json){
    var parsed = JSON.parse(json);
    var arr = [];
    for (var x in parsed){
      arr.push(parsed[x]);
    }
    return arr;
  }
</script>
<script type="text/javascript">
    datosX = crearCadenaLineal('<?php echo $datosX; ?>');

    datosY = crearCadenaLineal('<?php echo $datosY; ?>');
    var trace1 = {
      x: datosX,
      y: datosY,
      type: 'bar'
    };

    var data = [trace1];

    var layout = {
      title: 'Gráfico de barras',
      font: {
        family: 'Raleway, sans-serif'
      },
      xaxis:{
        //tickangle: -45,
        title: 'Participantes'
      },
      yaxis:{
        title: 'Edad'
      }
    };  
    var config = {responsive: true};
    Plotly.newPlot('myDivy', data, layout,config);
  </script>
    
        <h5><strong>Gráfico distinción de género: </strong></h5>
        
    
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-primary">
                <div class="panel panel-body">
                  <div class="row">
              
                    <div class="col-lg-12">
                      <div id="myDivii"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <script type="text/javascript">
  <?php
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT ROUND((COUNT(p.sexo)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS GRAFICA_MUJER FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.sexo = 'Mujer'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $graf_muj = $row['GRAFICA_MUJER'];

            $sql_q = "SELECT ROUND((COUNT(p.sexo)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS GRAFICA_HOMBRE FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.sexo = 'Hombre'";

            $registr = mysqli_query($connect, $sql_q) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registr);
            $graf_hom = $row['GRAFICA_HOMBRE'];
  ?>
  var data = [{
  values: ['<?php echo $graf_hom; ?>','<?php echo $graf_muj; ?>'],
  labels: ['Hombres', 'Mujeres'],
  type: 'pie'
}];

var layout = {
  height: 400,
  width: 500
};
var config = {responsive: true};

Plotly.newPlot('myDivii', data, layout, config);
  </script>

        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-primary">
                <div class="panel panel-body">
                  <div class="row">
              
                    <div class="col-lg-12">
                      <div id="myDivii"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <script type="text/javascript">
  <?php
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT ROUND((COUNT(p.sexo)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS GRAFICA_MUJER FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.sexo = 'Mujer'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $graf_muj = $row['GRAFICA_MUJER'];

            $sql_q = "SELECT ROUND((COUNT(p.sexo)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS GRAFICA_HOMBRE FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.sexo = 'Hombre'";

            $registr = mysqli_query($connect, $sql_q) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registr);
            $graf_hom = $row['GRAFICA_HOMBRE'];
  ?>
  var data = [{
  values: ['<?php echo $graf_hom; ?>','<?php echo $graf_muj; ?>'],
  labels: ['Hombres', 'Mujeres'],
  type: 'pie'
}];

var layout = {
  height: 400,
  width: 500
};

var config = {responsive: true};

Plotly.newPlot('myDivii', data, layout, config);
  </script>

        <h5><strong>Gráfico experiencia en internet / sistemas parecidos: </strong></h5>

        <div class="container">
    <div class="row">
      <div id='myDi'></div>
    </div>
  </div>
  </head>

    <script type="text/javascript">
      <?php
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS MUY_BAJO FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_sistemas = 'Muy bajo'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              //echo $row['MUY_BAJO'];

              $sql_b = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS BAJO FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_sistemas = 'Bajo'";

              $registrob = mysqli_query($connect, $sql_b) or die(mysqli_error($connect));

              $rowb = mysqli_fetch_array($registrob);
              //echo $rowb['BAJO'];

              $sqlm = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS MEDIO FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_sistemas = 'Medio'";

              $registrom = mysqli_query($connect, $sqlm) or die(mysqli_error($connect));

              $rowm = mysqli_fetch_array($registrom);
              //echo $rowm['MEDIO'];

              $sqla = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS ALTO FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_sistemas = 'Alto'";

              $registroa = mysqli_query($connect, $sqla) or die(mysqli_error($connect));

              $rowa = mysqli_fetch_array($registroa);
              //echo $rowa['ALTO'];

              $sqlaa = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS MUY_ALTO FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_sistemas = 'Muy alto'";

              $registroaa = mysqli_query($connect, $sqlaa) or die(mysqli_error($connect));

              $rowaa = mysqli_fetch_array($registroaa);
              //echo $rowaa['MUY_ALTO'];


              $sqlmm = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS MUY_BAJO FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_internet = 'Muy bajo'";

              $registromm = mysqli_query($connect, $sqlmm) or die(mysqli_error($connect));

              $rowmm = mysqli_fetch_array($registromm);
              //echo $rowmm['MUY_BAJO'];

              $sqlmmm = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS BAJO FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_internet = 'Bajo'";

              $registrommm = mysqli_query($connect, $sqlmmm) or die(mysqli_error($connect));

              $rowmmm = mysqli_fetch_array($registrommm);
              //echo $rowmmm['BAJO'];

              $sqlmmmm = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS MEDIO FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_internet = 'Medio'";

              $registrommmm = mysqli_query($connect, $sqlmmmm) or die(mysqli_error($connect));

              $rowmmmm = mysqli_fetch_array($registrommmm);
              //echo $rowmmmm['MEDIO'];

              $sqlmmmmm = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS ALTO FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_internet = 'Alto'";

              $registrommmmm = mysqli_query($connect, $sqlmmmmm) or die(mysqli_error($connect));

              $rowmmmmm = mysqli_fetch_array($registrommmmm);
              //echo $rowmmmmm['ALTO'];

              $sqlmmmmmm = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS MUY_ALTO FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_internet = 'Muy alto'";

              $registrommmmmmm = mysqli_query($connect, $sqlmmmmmm) or die(mysqli_error($connect));

              $rowmmmmmmm = mysqli_fetch_array($registrommmmmmm);
              //echo $rowmmmmmmm['MUY_ALTO'];



           
      ?>
      var data = [{
        values: ['<?php echo $rowmm['MUY_BAJO']; ?>', '<?php echo $rowmmm['BAJO']; ?>', '<?php echo $rowmmmm['MEDIO']; ?>', '<?php echo $rowmmmmm['ALTO']; ?>', '<?php echo $rowmmmmmmm['MUY_ALTO']; ?>' ],
        labels: ['Muy bajo', 'Bajo', 'Medio', 'Alto', 'Muy Alto' ],
        domain: {column: 0},
        name: 'exp_internet',
        hoverinfo: 'label+percent+name',
        hole: .4,
        type: 'pie'
      },{
        values: ['<?php echo $row['MUY_BAJO']; ?>', '<?php echo $rowb['BAJO']; ?>', '<?php echo $rowm['MEDIO']; ?>', '<?php echo $rowa['ALTO']; ?>', '<?php echo $rowaa['MUY_ALTO']; ?>'],
        labels: ['Muy bajo', 'Bajo', 'Medio', 'Alto', 'Muy Alto' ],
        text: 'CO2',
        textposition: 'inside',
        domain: {column: 1},
        name: 'exp_sistemas',
        hoverinfo: 'label+percent+name',
        hole: .4,
        type: 'pie'
      }];

      var layout = {
        title: 'Experiencia internet            Experiencia sistemas',
        annotations: [
          {
            font: {
              size: 20
            },
            showarrow: false,
            text: ' ',
            x: 0.17,
            y: 0.5
          },
          {
            font: {
              size: 20
            },
            showarrow: false,
            text: ' ',
            x: 0.82,
            y: 0.5
          }
        ],
        height: 400,
        width: 600,
        showlegend: false,
        grid: {rows: 1, columns: 2}
      };
      var config = {responsive: true};
      Plotly.newPlot('myDi', data, layout, config);
  </script>

        <h5><strong>Gráfico por preguntas: </strong></h5>

        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-primary">
                <div class="panel panel-body">
                  <div class="row">
              
                    <div class="col-lg-12">
                      <div id="myDivi"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <?php
            $connect = mysqli_connect("localhost", "root", "", "blog");

            //TAMAÑO DE LA MUESTRA (N) -> numero usuarios
            $sqqql = "SELECT COUNT(r.valor_aprendizaje) AS COUNT FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroqq = mysqli_query($connect, $sqqql) or die(mysqli_error($connect));
            $rwow = mysqli_fetch_array($registroqq);
            $count = $rwow['COUNT'];
            //$count;
            //echo "hola";
            //EFICIENCIA
            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.valor_eficiencia) AS EFICIENCIA FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_eficiencia = $row['EFICIENCIA'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.valor_afecto) AS AFECTO FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_afecto = $row['AFECTO'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.valor_ayuda) AS AYUDA FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_ayuda = $row['AYUDA'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.valor_control) AS CONTROL FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_control = $row['CONTROL'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.valor_aprendizaje) AS APRENDIZAJE FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_aprendizaje = $row['APRENDIZAJE'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.valor_usabilidad_global) AS USAB_GL FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_usab_gl = $row['USAB_GL'];


            //DATOS P1,...,PN
            $sql = "SELECT r.valor_eficiencia FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_eficiencia = mysqli_fetch_assoc($registro)){
                $nuevo_array_eficiencia[] = $fila_eficiencia;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.valor_afecto FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_afecto = mysqli_fetch_assoc($registro)){
                $nuevo_array_afecto[] = $fila_afecto;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.valor_ayuda FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_ayuda = mysqli_fetch_assoc($registro)){
                $nuevo_array_ayuda[] = $fila_ayuda;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.valor_control FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_control = mysqli_fetch_assoc($registro)){
                $nuevo_array_control[] = $fila_control;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.valor_aprendizaje FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_aprendizaje = mysqli_fetch_assoc($registro)){
                $nuevo_array_aprendizaje[] = $fila_aprendizaje;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.valor_usabilidad_global FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_valor_usabilidad_global = mysqli_fetch_assoc($registro)){
                $nuevo_array_valor_usabilidad_global[] = $fila_valor_usabilidad_global;
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
              $desv_tip_eficiencia = 0;
              $desv_tip_afecto = 0;
              $desv_tip_ayuda = 0;
              $desv_tip_control = 0;
              $desv_tip_aprendizaje = 0;
              $desv_tip_usab_gl = 0;

              for ($i = 0; $i < $count; $i++) {
                  $desv_tip_eficiencia = $desv_tip_eficiencia + pow(($nuevo_array_eficiencia[$i]['valor_eficiencia'] - $media_eficiencia),2);
                  $desv_tip_afecto = $desv_tip_afecto + pow(($nuevo_array_afecto[$i]['valor_afecto'] - $media_afecto),2);
                  $desv_tip_ayuda = $desv_tip_ayuda + pow(($nuevo_array_ayuda[$i]['valor_ayuda'] - $media_ayuda),2);
                  $desv_tip_control = $desv_tip_control + pow(($nuevo_array_control[$i]['valor_control'] - $media_control),2);
                  $desv_tip_aprendizaje = $desv_tip_aprendizaje + pow(($nuevo_array_aprendizaje[$i]['valor_aprendizaje'] - $media_aprendizaje),2);
                  $desv_tip_usab_gl = $desv_tip_usab_gl + pow(($nuevo_array_valor_usabilidad_global[$i]['valor_usabilidad_global'] - $media_usab_gl),2);
              }

              $resultado_eficiencia = $desv_tip_eficiencia / ($count); //es muestral
              $final_eficiencia = sqrt($resultado_eficiencia);

              $resultado_afecto = $desv_tip_afecto / ($count); //es muestral
              $final_afecto = sqrt($resultado_afecto);
              $resultado_ayuda = $desv_tip_ayuda / ($count); //es muestral
              $final_ayuda = sqrt($resultado_ayuda);

              $resultado_control = $desv_tip_control / ($count); //es muestral
              $final_control = sqrt($resultado_control);

              $resultado_aprendizaje = $desv_tip_aprendizaje / ($count); //es muestral
              $final_aprendizaje = sqrt($resultado_aprendizaje);

              $resultado_usab_gl = $desv_tip_usab_gl / ($count); //es muestral
              $final_usab_gl = sqrt($resultado_usab_gl);

              //calculamos tn-1;0,025
              $t = $count - 1;

              //Miramos donde esté esa t
              $sql = "SELECT t.valor AS T_FINAL FROM tstudent t
                WHERE t.n = ".$t."";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
              $row = mysqli_fetch_array($registro);
              $t_final = $row['T_FINAL'];
              //echo $count;
              $intervalo_eficiencia = (($t_final * $final_eficiencia) / sqrt($count));
              $intervalo_afecto = (($t_final * $final_afecto) / sqrt($count));
              $intervalo_ayuda = (($t_final * $final_ayuda) / sqrt($count));
              $intervalo_control = (($t_final * $final_control) / sqrt($count));
              $intervalo_aprendizaje = (($t_final * $final_aprendizaje) / sqrt($count));
              $intervalo_usab_gl = (($t_final * $final_usab_gl) / sqrt($count));

              // echo $intervalo_eficiencia;
              // echo "<br>";
              // echo $t_final;
              // echo "<br>";
              // echo $final_eficiencia;
              // echo "<br>";
              // echo $desv_tip_eficiencia;

          } else {
              $desv_tip_eficiencia = 0;
              $desv_tip_afecto = 0;
              $desv_tip_ayuda = 0;
              $desv_tip_control = 0;
              $desv_tip_aprendizaje = 0;
              $desv_tip_usab_gl = 0;

              for ($i = 0; $i < $count; $i++) {
                  $desv_tip_eficiencia = $desv_tip_eficiencia + pow(($nuevo_array_eficiencia[$i]['valor_eficiencia'] - $media_eficiencia),2);
                  $desv_tip_afecto = $desv_tip_afecto + pow(($nuevo_array_afecto[$i]['valor_afecto'] - $media_afecto),2);
                  $desv_tip_ayuda = $desv_tip_ayuda + pow(($nuevo_array_ayuda[$i]['valor_ayuda'] - $media_ayuda),2);
                  $desv_tip_control = $desv_tip_control + pow(($nuevo_array_control[$i]['valor_control'] - $media_control),2);
                  $desv_tip_aprendizaje = $desv_tip_aprendizaje + pow(($nuevo_array_aprendizaje[$i]['valor_aprendizaje'] - $media_aprendizaje),2);
                  $desv_tip_usab_gl = $desv_tip_usab_gl + pow(($nuevo_array_valor_usabilidad_global[$i]['valor_usabilidad_global'] - $media_usab_gl),2);
              }

              $resultado_eficiencia = $desv_tip_eficiencia / ($count); //es muestral
              $final_eficiencia = sqrt($resultado_eficiencia);

              $resultado_afecto = $desv_tip_afecto / ($count); //es muestral
              $final_afecto = sqrt($resultado_afecto);
              $resultado_ayuda = $desv_tip_ayuda / ($count); //es muestral
              $final_ayuda = sqrt($resultado_ayuda);

              $resultado_control = $desv_tip_control / ($count); //es muestral
              $final_control = sqrt($resultado_control);

              $resultado_aprendizaje = $desv_tip_aprendizaje / ($count); //es muestral
              $final_aprendizaje = sqrt($resultado_aprendizaje);

              $resultado_usab_gl = $desv_tip_usab_gl / ($count); //es muestral
              $final_usab_gl = sqrt($resultado_usab_gl);
              

             // T=1,96
              $intervalo_eficiencia = ((1.96 * $final_eficiencia) / sqrt($count));
              $intervalo_afecto = ((1.96 * $final_afecto) / sqrt($count));
              $intervalo_ayuda = ((1.96 * $final_ayuda) / sqrt($count));
              $intervalo_control = ((1.96 * $final_control) / sqrt($count));
              $intervalo_aprendizaje = ((1.96 * $final_aprendizaje) / sqrt($count));
              $intervalo_usab_gl = ((1.96 * $final_usab_gl) / sqrt($count));
          }

?>

<script type="text/javascript">
      var trace2 = {
        x: ['Eficiencia', 'Afecto', 'Ayuda', 'Control', 'Capacidad de aprendizaje', 'Usabilidad Global' ],
        y: ['<?php echo $media_eficiencia ?>','<?php echo $media_afecto ?>','<?php echo $media_ayuda ?>','<?php echo $media_control ?>','<?php echo $media_aprendizaje ?>','<?php echo $media_usab_gl ?>'],
        name: 'Experimental',
        error_y: {
          type: 'data',
          array: ['<?php echo $intervalo_eficiencia; ?>', '<?php echo $intervalo_afecto; ?>', '<?php echo $intervalo_ayuda; ?>', '<?php echo $intervalo_control; ?>', '<?php echo $intervalo_aprendizaje; ?>', '<?php echo $intervalo_usab_gl; ?>'],
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
      var config = {responsive: true};
      Plotly.newPlot('myDivi', data, layout, config);
  </script>
<link rel="stylesheet" type="text/css" href="plotly/bootstrap/css/bootstrap.css">
  <script src="plotly/jquery-3.3.1.min.js"></script>
  <script src="plotly/plotly-latest.min.js"></script>
  <br>
  <br>
  <h5><strong>Puntuación por participante: </strong></h5>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-primary">
          <div class="panel panel-body">
            <div class="row">
        
              <div class="col-lg-12">
                <div id="ffiih"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
      
<?php
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT r.url_usuario, r.puntuacion_final FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            $valoresYY=array(); 
            $valoresX=array();

            //$row = mysqli_fetch_array($registro);
            while ($ver = mysqli_fetch_row($registro)){
                $valoresX[]=$ver[0];
                $valoresYY[]=$ver[1];
            }

            $sql_w = "SELECT COUNT(r.puntuacion_final) AS COUNTT FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registr = mysqli_query($connect, $sql_w) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registr);
            $countt = $row['COUNTT'];
            //echo $countt;
            //print_r($valoresYY);
            $valoresY = array();
            for ($i = 1; $i <= $countt; $i++){
                $valoresY[$i] = $valoresYY[$i-1];
            }
            //echo "<pre>";
            //print_r($valoresY);

            for ($i = 1; $i <= $countt; $i++){
                if ($valoresY[$i] < 50) {
                    $valoresY[$i] = $valoresY[$i] * -1;
                }
            }

            $array_p = array();

            $sql_q = "SELECT COUNT(r.url_usuario) AS COUNT FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro_q = mysqli_query($connect, $sql_q) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro_q);
            $cont = $row['COUNT'];
            
            for ($i = 1; $i <= $cont; $i++){
              //$cont = $cont +1;
              $array_p[$i] = '#'.$i;
            }

            //echo "<pre>";
            //print_r($valoresY);

            for ($i = 1; $i <= $cont; $i++){
              if ($valoresY[$i] > 0) {
                  $valoresY[$i] =($valoresY[$i] - 50.000);
              } else {
                  $valoresY[$i] =(($valoresY[$i]*-1) - 50);
              }
              
            }

            $array_posiciones_positivas = array();
            $array_posiciones_negativas = array();
            $array_datosY_positivas = array();
            $array_datosY_negativas = array();

            for ($j = 1; $j <= $cont; $j++){
              if ($valoresY[$j] >= 0.000) {
                  $array_posiciones_positivas[$j] = $j;
                  $array_datosY_positivas[$j] = $valoresY[$j];
              } else {
                  $array_posiciones_negativas[$j] = $j;
                  $array_datosY_negativas[$j] = $valoresY[$j];
              }
              
            }
            
            $array_posiciones_positivas = implode($array_posiciones_positivas);
            $array_posiciones_negativas = implode($array_posiciones_negativas);

            $trace1_x = json_encode($array_posiciones_positivas);
            $trace1_y = json_encode($array_datosY_positivas);
            $trace2_x = json_encode($array_posiciones_negativas);
            $trace2_y = json_encode($array_datosY_negativas);



?>
<script type="text/javascript">
    function crearCadenaLineal(json){
        var parsed = JSON.parse(json);
        var arr = [];
        for (var x in parsed){
          arr.push(parsed[x]);
        }
        return arr;
    }
</script>
<script type="text/javascript">
    // trace1_x = crearCadenaLineal('<?php //echo $trace1_x; ?>');
    // trace1_y = crearCadenaLineal('<?php //echo $trace1_y; ?>');
    // trace2_x = crearCadenaLineal('<?php //echo $trace2_x; ?>');
    // trace2_y = crearCadenaLineal('<?php //echo $trace2_y; ?>');

    // var trace1 = {
    //     x: ['Eficiencia', 'Afecto', 'Ayuda', 'Control', 'Capacidad de aprendizaje', 'Usabilidad Global' ],
    //     y: trace1_y,
    //     name: "Aprobado",
    //     base: 50,
    //     type: 'bar',
    //     marker: {
    //       color: 'green'
    //     },
    // };

    // var trace2 = {
    //     x: ['Eficiencia', 'Afecto', 'Ayuda', 'Control', 'Capacidad de aprendizaje', 'Usabilidad Global' ],
    //     y: trace2_y,
    //     name: "Suspenso",
    //     base: 50,
    //     type: 'bar',
    //     marker: {
    //       color: 'red'
    //     },
    // };

    // var cl={
    //   type: 'scatter',
    //   x: [0.5, '<?php echo $countt+0.5; ?>'], //num veces que se repite la linea hasta el num participantes será
    //   y: [50, 50], //aqui smp 50 no tocar
    //   mode: 'lines',
    //   name: 'Límite',
    //   showlegend: true,
    //   line: {
    //     color: 'black',
    //     width: 2,
    //     dash: 'dash'
    //   }
    // }

    // var layout = {
    //     title: 'Gráfico de barras',
    //     xaxis:{
    //       title: 'Número de secciones'
    //     },
    //     yaxis:{
    //       title: 'Puntuación sección'
    //     }

    //   };

    // var data = [trace1, trace2, cl];
    // var config = {responsive:true};
    // Plotly.newPlot('ffiih', data, layout, config);

</script>

  <div id='myDivv'></div>
 
  </head>
<?php
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT r.valor_eficiencia AS EFI FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $valor_efi=array(); 

            while($row = mysqli_fetch_array($registro)){
                  $valor_efi[] = $row['EFI'];
            };
          
            //echo "<pre>";
            //print_r($valor_efi);
            
            $valor_efi=json_encode($valor_efi);

            $sql = "SELECT r.valor_afecto AS AFE FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $valor_afec=array(); 

            while($row = mysqli_fetch_array($registro)){
                  $valor_afec[] = $row['AFE'];
            };
          
            //echo "<pre>";
            //print_r($valor_afec);
            
            $valor_afec=json_encode($valor_afec);

            $sql = "SELECT r.valor_ayuda AS AYU FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $valor_ayu=array(); 

            while($row = mysqli_fetch_array($registro)){
                  $valor_ayu[] = $row['AYU'];
            };
          
            //echo "<pre>";
            //print_r($valor_ayu);
            
            $valor_ayu=json_encode($valor_ayu);

            $sql = "SELECT r.valor_control AS CTR FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $valor_ctr=array(); 

            while($row = mysqli_fetch_array($registro)){
                  $valor_ctr[] = $row['CTR'];
            };
          
            //echo "<pre>";
            //print_r($valor_ctr);
            
            $valor_ctr=json_encode($valor_ctr);

            $sql = "SELECT r.valor_aprendizaje AS APR FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $valor_apr=array(); 

            while($row = mysqli_fetch_array($registro)){
                  $valor_apr[] = $row['APR'];
            };
          
            //echo "<pre>";
            //print_r($valor_apr);
            
            $valor_apr=json_encode($valor_apr);

            $sql = "SELECT r.valor_usabilidad_global AS USB FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $valor_usb=array(); 

            while($row = mysqli_fetch_array($registro)){
                  $valor_usb[] = $row['USB'];
            };
          
            //echo "<pre>";
            //print_r($valor_usb);
            
            $valor_usb=json_encode($valor_usb);

?>
    <script type="text/javascript">
        function crearCadenaLineal(json){
          var parsed = JSON.parse(json);
          var arr = [];
          for (var x in parsed){
            arr.push(parsed[x]);
          }
          return arr;
        }
</script>
<script type="text/javascript">
    valor_efi = crearCadenaLineal('<?php echo $valor_efi; ?>');
    valor_afec = crearCadenaLineal('<?php echo $valor_afec; ?>');
    valor_ayu = crearCadenaLineal('<?php echo $valor_ayu; ?>');
    valor_ctr = crearCadenaLineal('<?php echo $valor_ctr; ?>');
    valor_apr = crearCadenaLineal('<?php echo $valor_apr; ?>');
    valor_usb = crearCadenaLineal('<?php echo $valor_usb; ?>');


var xData = ['Eficiencia', 'Afecto',
      'Ayuda', 'Control',
      'Capacidad de<br>aprendizaje','Usabilidad<br>Global'];

var yData = [
        valor_efi,
        valor_afec,
        valor_ayu,
        valor_ctr,
        valor_apr,
        valor_usb
    ];
var colors = ['rgba(93, 164, 214, 0.5)', 'rgba(255, 144, 14, 0.5)', 'rgba(44, 160, 101, 0.5)', 'rgba(255, 65, 54, 0.5)', 'rgba(207, 114, 255, 0.5)', 'rgba(127, 96, 0, 0.5)', 'rgba(255, 140, 184, 0.5)', 'rgba(79, 90, 117, 0.5)', 'rgba(222, 223, 0, 0.5)'];

var data = [];

for ( var i = 0; i < xData.length; i ++ ) {
    var result = {
        type: 'box',
        y: yData[i],
        name: xData[i],
        boxpoints: 'all',
        jitter: 0.5,
        whiskerwidth: 0.2,
        fillcolor: 'cls',
        base: 50,
        marker: {
            size: 2
        },
        line: {
            width: 1
        },
      boxmean:'sd'
    };
    data.push(result);
};

layout = {
    title: 'Diagrama de cajas para la media y desviación estándar',
    xaxis:{
          title: 'Escala SUMI'
    },
    yaxis: {
        title: 'Puntuación escala',
        autorange: true,
        showgrid: true,
        zeroline: true,
        dtick: 5,
        gridcolor: 'rgb(255, 255, 255)',
        gridwidth: 1,
        zerolinecolor: 'rgb(255, 255, 255)',
        zerolinewidth: 2
    },
    margin: {
        l: 40,
        r: 30,
        b: 80,
        t: 100
    },
    //paper_bgcolor: 'rgb(243, 243, 243)',
    //plot_bgcolor: 'rgb(243, 243, 243)',
    showlegend: false
};


var config = {responsive:true};
Plotly.newPlot('myDivv', data, layout,config);
  </script>


        <h5><strong>Datos por escala: </strong></h5>
     <br>
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                          <thead>
                              <tr>
                                <th>Usuario</th>
                                <th>Eficiencia</th>
                                <th>Afecto</th>
                                <th>Ayuda</th>
                                <th>Control</th>
                                <th>Aprendizaje</th>
                                <th>Usabilidad Global</th>
                            </tr>
                          </thead>     
                       </table>
                   </div>
        </div>   
    </div>
    <br>
    <br>

  
    
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    
    <script>
    $(document).ready(function() {
        var table = $('#example1').DataTable({
            lengthChange: false,
            responsive: true,
            dom: 'Bfrtip',
            buttons: [ 'copy', 'excel', 'csv', 'pdf', 'colvis' ],
            ajax: "ajax_sumi_por_pregunta.php?id="+'<?php echo $_REQUEST['id'] ?>',
            language: {
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "Mostrando _START_ de _END_ filas",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast":"Último",
                            "sNext":"Siguiente",
                            "sPrevious": "Anterior"
                         },
                         "sProcessing":"Procesando...",
                }
        });
     
        table.buttons().container()
    .appendTo( $('#example1 .col-sm-6:eq(0)', table.table().container() ) );
    });
    </script>

     </div>
        <?php
      }
  ?>
    
      <?php
  if ($_REQUEST['p'] == '3') {
        ?>
      <div id="detallado" class="container tab-pane active"><br>
       <h5><strong>Datos descriptivos: </strong></h5>
        <ul>
          <li>Tamaño de la muestra: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");
            // SELECT COUNT(*) FROM (SELECT distinct r.puntuacion_final FROM respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
            //     WHERE r.id_proyecto = 1
            //     AND r.id_proyecto = r1.id_proyecto) p;
            $sql = "SELECT DISTINCT COUNT(r.puntuacion_final) AS NUM_PART FROM respuestas_sumi r, rec r1 WHERE r.id_proyecto = ".$_REQUEST['id']." AND r.id_proyecto = r1.id_proyecto ";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];
            ?></li>
          <ul>
            <li>Media: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT ROUND(AVG(r.puntuacion_final),2) AS NUM_PART FROM respuestas_sumi r, rec r1 WHERE r.id_proyecto = ".$_REQUEST['id']." AND r.id_proyecto = r1.id_proyecto";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?></li>
            <li>Moda: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT MIN(p.edad) AS NUM_PART FROM  respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si' ";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?></li>
        <li>Mediana: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT MIN(p.edad) AS NUM_PART FROM  respuestas_sumi r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si' ";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?></li>
        <li>Máximo: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT ROUND(MAX(r.puntuacion_final),2) AS NUM_PART FROM respuestas_sumi r, rec r1 WHERE r.id_proyecto = ".$_REQUEST['id']." AND r.id_proyecto = r1.id_proyecto";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?></li>
        <li>Mínimo: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT ROUND(MIN(r.puntuacion_final),2) AS NUM_PART FROM respuestas_sumi r, rec r1 WHERE r.id_proyecto = ".$_REQUEST['id']." AND r.id_proyecto = r1.id_proyecto";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?></li>
        <li>Desviación estándar poblacional <?php echo "(σ)" ?>: <?php
            $connect = mysqli_connect("localhost", "root", "", "blog");
            //TAMAÑO DE LA MUESTRA (N) -> numero usuarios
            $sqqql = "SELECT COUNT(r.puntuacion_final) AS COUNT FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroqq = mysqli_query($connect, $sqqql) or die(mysqli_error($connect));
            $rwow = mysqli_fetch_array($registroqq);
            $count = $rwow['COUNT'];
            //MEDIA DE LA MUESTRA
            $sqql = "SELECT AVG(r.puntuacion_final) AS MEDIA FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media = $row['MEDIA'];
            //DATOS AGRUPADOS.
            $sql = "SELECT r.puntuacion_final FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila = mysqli_fetch_assoc($registro)){
                $nuevo_array[] = $fila;
            }
            //echo $count;
            //echo $media;
          ### IMPRIMIENDO EL ARRAY Y TODOS SUS VALORES
          //echo '<pre>';
          //print_r($nuevo_array); 

          $desv_tip = 0;
          for ($i = 0; $i < $count; $i++) {
              $desv_tip = $desv_tip + pow(($nuevo_array[$i]['puntuacion_final'] - $media),2);
          }

          $resultado = $desv_tip / ($count);
          $final = sqrt($resultado);
          echo round($final,2);

        ?></li>
        <li>Intervalo de confianza al 95%: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");
            //TAMAÑO DE LA MUESTRA (N) -> numero usuarios
            $sqqql = "SELECT COUNT(r.puntuacion_final) AS COUNT FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroqq = mysqli_query($connect, $sqqql) or die(mysqli_error($connect));
            $rwow = mysqli_fetch_array($registroqq);
            $count = $rwow['COUNT'];
            //MEDIA DE LA MUESTRA
            $sqql = "SELECT AVG(r.puntuacion_final) AS MEDIA FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media = $row['MEDIA'];
            //DATOS AGRUPADOS.
            $sql = "SELECT r.puntuacion_final FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila = mysqli_fetch_assoc($registro)){
                $nuevo_array[] = $fila;
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
              $desv_tip = 0;
              for ($i = 0; $i < $count; $i++) {
                  $desv_tip = $desv_tip + pow(($nuevo_array[$i]['puntuacion_final'] - $media),2);
              }

              $resultado = $desv_tip / ($count); //es muestral
              $final = sqrt($resultado);
              //echo round($final,2);

              //calculamos tn-1;0,025
              $t = $count - 1;

              //Miramos donde esté esa t
              $sql = "SELECT t.valor AS T_FINAL FROM tstudent t
                WHERE t.n = ".$t."";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
              $row = mysqli_fetch_array($registro);
              $t_final = $row['T_FINAL'];

              $intervalo = (($t_final * $final) / sqrt($count));

              echo "(".round($media-$intervalo,2).",".round($media+$intervalo,2).")"." - "."[".round($media,2)."±".round($intervalo,2)."]";
          } else {
              $desv_tip = 0;
              for ($i = 0; $i < $count; $i++) {
                  $desv_tip = $desv_tip + pow(($nuevo_array[$i]['puntuacion_final'] - $media),2);
              }

              $resultado = $desv_tip / ($count); //es muestral
              $final = sqrt($resultado);
              //echo round($final,2);

              // T = 1.96
              $intervalo = ((1.96 * $final) / sqrt($count));

              echo "(".round($media-$intervalo,2).",".round($media+$intervalo,2).")"." - "."[".round($media,2)."±".round($intervalo,2)."]";
          }
          

        ?></li>
          </ul>
          
        </ul>

        <h5><strong>Puntuación cuestionario: </strong></h5>
          <ul>
          <li>Promedio de resultados: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT ROUND(AVG(r.puntuacion_final),2) AS NUM_PART FROM respuestas_sumi r, rec r1 WHERE r.id_proyecto = ".$_REQUEST['id']." AND r.id_proyecto = r1.id_proyecto";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?> %</li>


      </ul>

<link rel="stylesheet" type="text/css" href="plotly/bootstrap/css/bootstrap.css">
  <script src="plotly/jquery-3.3.1.min.js"></script>
  <script src="plotly/plotly-latest.min.js"></script>
<div class="container">
    <div class="row">
      <div id='myD'></div>
    </div>
  </div>
  </head>
<?php
            $connect = mysqli_connect("localhost", "root", "", "blog");

            //TAMAÑO DE LA MUESTRA (N) -> numero usuarios
            $sqqql = "SELECT COUNT(r.puntuacion_final) AS COUNT FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroqq = mysqli_query($connect, $sqqql) or die(mysqli_error($connect));
            $rwow = mysqli_fetch_array($registroqq);
            $count = $rwow['COUNT'];
            
            //MEDIA DE LA MUESTRA
            $sqql = "SELECT AVG(r.puntuacion_final) AS MEDIA FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media = $row['MEDIA'];

            //DATOS P1,...,PN
            $sql = "SELECT r.puntuacion_final FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila = mysqli_fetch_assoc($registro)){
                $nuevo_array[] = $fila;
            }

          /*
            SI MUESTRA N <= 30 --> T-Student
            SI MUESTRA N > 30 ---> Z normal (1,96)
          */
          if ($count <= 30){
              $desv_tip = 0;
              for ($i = 0; $i < $count; $i++) {
                  $desv_tip = $desv_tip + pow(($nuevo_array[$i]['puntuacion_final'] - $media),2);
              }

              $resultado = $desv_tip / ($count); //es muestral
              $final = sqrt($resultado);
              

              //calculamos tn-1;0,025
              $t = $count - 1;

              //Miramos donde esté esa t
              $sql = "SELECT t.valor AS T_FINAL FROM tstudent t
                WHERE t.n = ".$t."";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
              $row = mysqli_fetch_array($registro);
              $t_final = $row['T_FINAL'];

              $intervalo = (($t_final * $final) / sqrt($count));

          } else {
              $desv_tip = 0;
              for ($i = 0; $i < $count; $i++) {
                  $desv_tip = $desv_tip + pow(($nuevo_array[$i]['puntuacion_final'] - $media),2);
              }

              $resultado = $desv_tip / ($count); //es muestral
              $final = sqrt($resultado); 

             // T=1,96
              $intervalo = ((1.96 * $final) / sqrt($count));
          }

?>

<script type="text/javascript">
      var trace2 = {
        x: ['Participantes'],
        y: ['<?php echo $media ?>'],
        name: 'Experimental',
        error_y: {
          type: 'data',
          array: ['<?php echo $intervalo; ?>'],
          visible: true
        },
        type: 'bar'
      };
      var data = [trace2];
      var layout = {barmode: 'group',
        responsive: true,
        title: 'Puntuación obtenida para medias con un 95% de confianza en barras de error',
        xaxis:{
          title: 'Participante'
        },
        yaxis:{
          title: 'Puntuación cuestionario'
        }
      };
      //var config = {responsive: true};
      Plotly.newPlot('myD', data, layout);
  </script>

  <div class="container">
    <div class="row">
      <div id='myDivl'></div>
    </div>
  </div>
  </head>
<?php
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT r.puntuacion_final FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            $valoresX=array(); 

            //$row = mysqli_fetch_array($registro);
            while ($ver = mysqli_fetch_row($registro)){
                $valoresX[]=$ver[0];
            }

            $datosX=json_encode($valoresX);

?>
    <script type="text/javascript">
        function crearCadenaLineal(json){
          var parsed = JSON.parse(json);
          var arr = [];
          for (var x in parsed){
            arr.push(parsed[x]);
          }
          return arr;
        }
</script>
<script type="text/javascript">

    datosX = crearCadenaLineal('<?php echo $datosX; ?>');
      var trace2 = {
        x: datosX,
        type: 'box',
        name: '',
        marker: {
          color: '#FF4136'
        },
        boxmean: 'sd',
        orientation: 'h'
      };


      var data = [trace2];

      var layout = {
        title: 'Puntuación cuestionario para la media y la desviación estándar',
        xaxis:{
          title: 'Puntuación cuestionario'
        },
        yaxis:{
          title: 'Participante'
        }
      };
      var config = {responsive: true};
      Plotly.newPlot('myDivl', data, layout, config);
  </script>

  <?php
  //SI HAY 4 participantes o menos no saco la prediccion, pq las formulas salen div/0
          $sql_w = "SELECT COUNT(r.puntuacion_final) AS COUNTT FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registr = mysqli_query($connect, $sql_w) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registr);
            $countt = $row['COUNTT'];
  ?>

  <?php
    if ($countt > 4){
      ?>

      <?php
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT r.valor_usabilidad_global, r.puntuacion_final FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." ORDER BY r.puntuacion_final ASC";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            $valoresY=array(); 
            $valoresX=array();

            //$row = mysqli_fetch_array($registro);
            while ($ver = mysqli_fetch_row($registro)){
                $valoresX[]=$ver[0];
                $valoresY[]=$ver[1];
            }

            $sql_w = "SELECT COUNT(r.puntuacion_final) AS COUNTT FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registr = mysqli_query($connect, $sql_w) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registr);
            $countt = $row['COUNTT'];
            //echo $countt;

            $array_p3 = array();
            $array_puntuac_final = array();
            for ($i = 0; $i < $countt; $i++){
                $array_p3[$i] = $valoresX[$i];
                $array_puntuac_final[$i] = $valoresY[$i];
            }

            // echo "<pre>";
            // print_r($array_p3);
            // print_r($array_puntuac_final);
            //Calculamos a ----> y = ax + b
            $sum_1 = 0;
            $sum_x = 0;
            $sum_y = 0;
            $sum_3 = 0;
            for ($i = 0; $i < $countt; $i++){
                $sum_1 = $sum_1 + ($array_p3[$i] * $array_puntuac_final[$i]);
                $sum_x = $sum_x + $array_p3[$i];
                $sum_y = $sum_y + $array_puntuac_final[$i];
                $sum_3 = $sum_3 + pow($array_p3[$i],2);
                //echo $sum_3;
                //echo "<br>";
            }

            //a
            $a = (($countt*$sum_1)-($sum_x*$sum_y))/(($countt*$sum_3)-(pow($sum_x,2)));
            // echo $a;
            // echo "<br>";
            // echo $sum_x;
            // echo "<br>";
            // echo $sum_y;
            // echo "<br>";
            // echo $sum_1;
            // echo "<br>";
            // echo $sum_3;
            // echo "<br>";

            //b
            $b = ($sum_y / $countt)-($a*($sum_x / $countt));
            //echo $b;

            //Con Y=ax+b calculamos las tablas y arrays finales (solo con y nos vale)
            $array_final_puntuacion_final = array();

            for ($i = 0; $i < $countt; $i++){
                $array_final_puntuacion_final[$i] = ($array_p3[$i]*$a)+$b;
            }

            //CALCULAR COEFICIENTE DE CORRELACION LINEAL (PEARSON) R^2
            //calculamos directamente:
            //-1) RAIz-SUMATORIO(x-x')^2 = $aa
            //-2) RAIZ-SUMATORIO(y-y')^2 = $bb
            //-3) SUMATORIO(x-x')(y-y') = $cc
            //- RESULTADO = 3) / 1) * 2) = $res
            $aa = 0;
            $bb = 0;
            $cc = 0;
            for ($i = 0; $i < $countt; $i++){
                //echo $array_p3[$i];
                
                //echo "<br>";
                $aa = $aa + pow(($array_p3[$i]-($sum_x/$countt)),2);
                $bb = $bb + pow(($array_puntuac_final[$i]-($sum_y/$countt)),2);
                $cc = $cc + (($array_p3[$i]-($sum_x/$countt))*($array_puntuac_final[$i]-($sum_y/$countt)));
            }

            $raiz_aa = sqrt($aa);
            $raiz_bb = sqrt($bb);

            $res = $cc / ($raiz_aa *  $raiz_bb);
            $r_cuadrado = pow($res,2);
            //echo "<pre>";
            //print_r($array_final_puntuacion_final);
            //ERROR TIPICO
            $y_cuadrado = 0;
            $xy = 0;
            for ($i = 0; $i < $countt; $i++){
                $y_cuadrado = $y_cuadrado + pow($array_puntuac_final[$i],2);
                $xy = $xy + ($array_p3[$i] * $array_puntuac_final[$i]);
            }

            $s = ($y_cuadrado-($b*$sum_y)-($a*$xy))/($countt-2);
            $s_final = sqrt($s);
            //echo $s_final;
            
            //R^2 ajustado

            $r_ajustado = 1-(($countt)/($countt-2-1))*(1-$r_cuadrado); 
            

            $array_p3=json_encode($array_p3);
            $array_puntuac_final=json_encode($array_puntuac_final);
            $array_final_puntuacion_final=json_encode($array_final_puntuacion_final);

?>

<h5><strong>Datos de predicción: </strong></h5>
          <ul>
          <li>Función de regresión: y=<?php 
            echo ROUND($a,3)."x+".ROUND($b,3);
        ?> </li>
        <ul>
          <li>Pendiente: <?php echo ROUND($a,3);

        ?></li>
          <li>Ordenada: <?php echo ROUND($b,3);

        ?></li>
      </ul>
      <li> Estadísticas de la regresión:
      </li>
      <ul>
        <li>Coeficiente de correlación múltiple R: <?php echo ROUND($res,3);

        ?></li>
          <li>Coeficiente de determinación R² (Pearson): <?php echo ROUND($r_cuadrado,3);

        ?></li>
        <li>R² ajustado: <?php echo ROUND($r_ajustado,3);

        ?></li>
        <li>Error típico: <?php echo ROUND($s_final,3);

        ?></li>
        <li>Observaciones: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            //TAMAÑO DE LA MUESTRA (N) -> numero usuarios
            $sqqql = "SELECT COUNT(r.puntuacion_final) AS COUNT FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroqq = mysqli_query($connect, $sqqql) or die(mysqli_error($connect));
            $rwow = mysqli_fetch_array($registroqq);
            $count = $rwow['COUNT'];
            echo $countt;

        ?></li>

      </ul>

  <link rel="stylesheet" type="text/css" href="plotly/bootstrap/css/bootstrap.css">
  <script src="plotly/jquery-3.3.1.min.js"></script>
  <script src="plotly/plotly-latest.min.js"></script>
  <div class="container">
    <div class="row">
      <div id='plotly-div'></div>
    </div>
  </div>
  </head>

<script type="text/javascript">
        function crearCadenaLineal(json){
          var parsed = JSON.parse(json);
          var arr = [];
          for (var x in parsed){
            arr.push(parsed[x]);
          }
          return arr;
        }
</script>
<script type="text/javascript">
    $array_p3 = crearCadenaLineal('<?php echo $array_p3; ?>');
    $array_puntuac_final = crearCadenaLineal('<?php echo $array_puntuac_final; ?>');
    $array_final_puntuacion_final = crearCadenaLineal('<?php echo $array_final_puntuacion_final; ?>');

    trace1 = {
          mode: 'markers', 
          type: 'scatter', 
          x: $array_p3, 
          y: $array_puntuac_final
        };
    trace2 = {
      mode: 'lines', 
      name: 'lines', 
      type: 'scatter', 
      x: $array_p3,
      y: $array_final_puntuacion_final
    };
    data = [trace1, trace2];
    layout = {
      title: 'Recta de regresión lineal', 
      xaxis: {
        title: 'Puntuación pregunta 3 (SUS)', 
        titlefont: {
          size: 18, 
          color: '#7f7f7f', 
          family: 'Courier New, monospace'
        }
      }, 
      yaxis: {
        title: 'Puntuación final a predecir (SUS)', 
        titlefont: {
          size: 18, 
          color: '#7f7f7f', 
          family: 'Courier New, monospace'
        }
      }
    };

  //   annotations: [
  //   { 
  //     text: '$Y= -3.18x + 40.83$', 
  //     showarrow: false
  //   }, 
  //   {
  //     x: 5.0, 
  //     y: 24.940677966101703, 
  //     ax: 0, 
  //     ay: -40, 
  //     text: 'Valor de prediccion', 
  //     xref: 'x', 
  //     yref: 'y', 
  //     arrowhead: 7, 
  //     showarrow: true
  //   }, 
  //   {
  //     x: 7, 
  //     y: 40, 
  //     text: '$R^2= 95.02%$', 
  //     showarrow: false
  //   }
  // ];

    Plotly.plot('plotly-div', {
      data: data,
      layout: layout
    });
  </script>

      <?php
    }
  ?>

  

  <h5><strong>Puntuación por participante: </strong></h5>
     <br>
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="example4" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                          <thead>
                              <tr>
                                <th>Usuario</th>
                                <th>Puntuación</th>
                            </tr>
                          </thead>     
                       </table>
                   </div>
        </div>   
    </div>
    <br>
    <br>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    
    <script>
    $(document).ready(function() {
        var table = $('#example4').DataTable({
            lengthChange: false,
            responsive: true,
            dom: 'Bfrtip',
            buttons: [ 'copy', 'excel', 'csv', 'pdf', 'colvis' ],
            ajax: "ajax_sus_por_participante.php?id="+'<?php echo $_REQUEST['id'] ?>',
            language: {
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "Mostrando _START_ de _END_ filas",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast":"Último",
                            "sNext":"Siguiente",
                            "sPrevious": "Anterior"
                         },
                         "sProcessing":"Procesando...",
                }
        });
     
        table.buttons().container()
    .appendTo( $('#example4 .col-sm-6:eq(0)', table.table().container() ) );
    });
    </script>
      
    </div>
        <?php
      }
  ?>
</div>
 <?php
  if ($_REQUEST['p'] == '4') {
        ?>
      <div id="informe" class="container tab-pane active"><br>
       <style type="text/css">
table {
  width: 100%;
  background: white;
  margin-bottom: 1.25em;
  border: solid 1px #dddddd;
  border-collapse: collapse;
  border-spacing: 0;
}

table tr th,
table tr td {
  padding: 0.5em 0.3em;
  font-size: 0.8em;
  color: #222222;
  border: 0.5px solid #dddddd;
}

table tr.even,
table tr.alt,
table tr:nth-of-type(even) {
  background: #f9f9f9;
}
@media only screen and (max-width: 768px) {
    table.resp,
    .resp thead,
    .resp tbody,
    .resp tr,
    .resp th,
    .resp td,
    .resp caption {
      display: block;
    }
    
    table.resp {
      border: none
    }
    
    .resp thead tr {
      display: none;
    }
    
    .resp tbody tr {
      margin: 1em 0;
      border: 1px solid #2ba6cb;
    }
    
    .resp td {
      border: none;
      border-bottom: 1px solid #d6d2d2;
      position: relative;
      padding-left: 45%;
      text-align: left;
    }
    
    .resp tr td:last-child {
      border-bottom: 1px double #dddddd;
    }
    
    .resp tr:last-child td:last-child {
      border: none;
    }
    
    .resp td:before {
      position: absolute;
      top: 6px;
      left: 6px;
      width: 45%;
      padding-right: 10px;
      white-space: nowrap;
      text-align: left;
      font-weight: bold;
    }

    td:nth-of-type(1):before {
      content: "Usuario";
    }
    
    td:nth-of-type(2):before {
      content: "Eficiencia";
    }
    
    td:nth-of-type(3):before {
      content: "Afecto";
    }
    
    td:nth-of-type(4):before {
      content: "Ayuda";
    }
    
    td:nth-of-type(5):before {
      content: "Control";
    }

    td:nth-of-type(6):before {
      content: "Aprendizaje";
    }

    td:nth-of-type(7):before {
      content: "Usabilidad Global";
    }
    
}
</style>
    <h5><strong>Contenidos del informe: </strong></h5>
        <section class="botones">
            <div class="bloque_btn1">
                <div class="btn btn_izq">
                    <a onClick="myFunction()" style="color:#007bff;">Puntuación por escalas SUMI</a>
                </div>
            </div>
            
            <div id="bloque_enlaces" style="display: none">
                
              <br>
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="example1" class="resp" style="width:100%">
                          <thead>
                              <tr>
                                <th>Usuario</th>
                                <th>Eficiencia</th>
                                <th>Afecto</th>
                                <th>Ayuda</th>
                                <th>Control</th>
                                <th>Aprendizaje</th>
                                <th>Usabilidad Global</th>
                            </tr>
                          </thead>     
                       </table>
                   </div>
        </div>   
    </div>
    <br>
    <br>

  
    
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    
    <script>
    $(document).ready(function() {
        var table = $('#example1').DataTable({
            lengthChange: false,
            responsive: false,
            paging: false,
            dom: 'Bfrtip',
            buttons: [ 'copy', 'excel', 'csv', 'pdf', 'colvis' ],
            ajax: "ajax_sumi_por_pregunta.php?id="+'<?php echo $_REQUEST['id'] ?>',
            language: {
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "Mostrando _START_ de _END_ filas",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast":"Último",
                            "sNext":"Siguiente",
                            "sPrevious": "Anterior"
                         },
                         "sProcessing":"Procesando...",
                }
        });
     
        table.buttons().container()
    .appendTo( $('#example1 .col-sm-6:eq(0)', table.table().container() ) );
    });
    </script>

            </div>

            <div class="bloque_btn3">
                <div class="btn btn_izq">
                    <a onClick="myFunction3()" style="color:#007bff;">Resumen estadístico por escalas</a>
                </div>
            </div>
            
            <?php
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT p.cuestionario AS QUIZ FROM proyecto p
            WHERE p.id = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            $row = mysqli_fetch_array($registro);
            $quiz = $row['QUIZ'];


            if ($quiz == 'SUMI'){

                //LA MEDIA
              $sqql = "SELECT AVG(r.valor_eficiencia) AS EFICIENCIA FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_eficiencia = $row['EFICIENCIA'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.valor_afecto) AS AFECTO FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_afecto = $row['AFECTO'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.valor_ayuda) AS AYUDA FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_ayuda = $row['AYUDA'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.valor_control) AS CONTROL FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_control = $row['CONTROL'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.valor_aprendizaje) AS APRENDIZAJE FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_aprendizaje = $row['APRENDIZAJE'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.valor_usabilidad_global) AS USAB_GL FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_usab_gl = $row['USAB_GL'];
                //LA DESV ESTANDAR TB
                //MAXIMO
                $sqql = "SELECT MAX(r.valor_eficiencia) AS EFICIENCIA FROM respuestas_sumi r
                  WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $max_eficiencia = $row['EFICIENCIA'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT MAX(r.valor_afecto) AS AFECTO FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $max_afecto = $row['AFECTO'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT max(r.valor_ayuda) AS AYUDA FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $max_ayuda = $row['AYUDA'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT max(r.valor_control) AS CONTROL FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $max_control = $row['CONTROL'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT max(r.valor_aprendizaje) AS APRENDIZAJE FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $max_aprendizaje = $row['APRENDIZAJE'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT max(r.valor_usabilidad_global) AS USAB_GL FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $max_usab_gl = $row['USAB_GL'];
                //MINIMO
            $sqql = "SELECT min(r.valor_eficiencia) AS EFICIENCIA FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $min_eficiencia = $row['EFICIENCIA'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT min(r.valor_afecto) AS AFECTO FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $min_afecto = $row['AFECTO'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT min(r.valor_ayuda) AS AYUDA FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $min_ayuda = $row['AYUDA'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT min(r.valor_control) AS CONTROL FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $min_control = $row['CONTROL'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT min(r.valor_aprendizaje) AS APRENDIZAJE FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $min_aprendizaje = $row['APRENDIZAJE'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT min(r.valor_usabilidad_global) AS USAB_GL FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $min_usab_gl = $row['USAB_GL'];

            //DESV. ESTANDAR
            //TAMAÑO DE LA MUESTRA (N) -> numero usuarios
            $sqqql = "SELECT COUNT(r.valor_aprendizaje) AS COUNT FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroqq = mysqli_query($connect, $sqqql) or die(mysqli_error($connect));
            $rwow = mysqli_fetch_array($registroqq);
            $count = $rwow['COUNT'];
            //$count;
            //echo "hola";
            //EFICIENCIA
            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.valor_eficiencia) AS EFICIENCIA FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_eficiencia = $row['EFICIENCIA'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.valor_afecto) AS AFECTO FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_afecto = $row['AFECTO'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.valor_ayuda) AS AYUDA FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_ayuda = $row['AYUDA'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.valor_control) AS CONTROL FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_control = $row['CONTROL'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.valor_aprendizaje) AS APRENDIZAJE FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_aprendizaje = $row['APRENDIZAJE'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.valor_usabilidad_global) AS USAB_GL FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_usab_gl = $row['USAB_GL'];


            //DATOS P1,...,PN
            $sql = "SELECT r.valor_eficiencia FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_eficiencia = mysqli_fetch_assoc($registro)){
                $nuevo_array_eficiencia[] = $fila_eficiencia;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.valor_afecto FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_afecto = mysqli_fetch_assoc($registro)){
                $nuevo_array_afecto[] = $fila_afecto;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.valor_ayuda FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_ayuda = mysqli_fetch_assoc($registro)){
                $nuevo_array_ayuda[] = $fila_ayuda;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.valor_control FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_control = mysqli_fetch_assoc($registro)){
                $nuevo_array_control[] = $fila_control;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.valor_aprendizaje FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_aprendizaje = mysqli_fetch_assoc($registro)){
                $nuevo_array_aprendizaje[] = $fila_aprendizaje;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.valor_usabilidad_global FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_valor_usabilidad_global = mysqli_fetch_assoc($registro)){
                $nuevo_array_valor_usabilidad_global[] = $fila_valor_usabilidad_global;
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
          
              $desv_tip_eficiencia = 0;
              $desv_tip_afecto = 0;
              $desv_tip_ayuda = 0;
              $desv_tip_control = 0;
              $desv_tip_aprendizaje = 0;
              $desv_tip_usab_gl = 0;

              for ($i = 0; $i < $count; $i++) {
                  $desv_tip_eficiencia = $desv_tip_eficiencia + pow(($nuevo_array_eficiencia[$i]['valor_eficiencia'] - $media_eficiencia),2);
                  $desv_tip_afecto = $desv_tip_afecto + pow(($nuevo_array_afecto[$i]['valor_afecto'] - $media_afecto),2);
                  $desv_tip_ayuda = $desv_tip_ayuda + pow(($nuevo_array_ayuda[$i]['valor_ayuda'] - $media_ayuda),2);
                  $desv_tip_control = $desv_tip_control + pow(($nuevo_array_control[$i]['valor_control'] - $media_control),2);
                  $desv_tip_aprendizaje = $desv_tip_aprendizaje + pow(($nuevo_array_aprendizaje[$i]['valor_aprendizaje'] - $media_aprendizaje),2);
                  $desv_tip_usab_gl = $desv_tip_usab_gl + pow(($nuevo_array_valor_usabilidad_global[$i]['valor_usabilidad_global'] - $media_usab_gl),2);
              }

              $resultado_eficiencia = $desv_tip_eficiencia / ($count); //es muestral
              $final_eficiencia = sqrt($resultado_eficiencia);

              $resultado_afecto = $desv_tip_afecto / ($count); //es muestral
              $final_afecto = sqrt($resultado_afecto);
              $resultado_ayuda = $desv_tip_ayuda / ($count); //es muestral
              $final_ayuda = sqrt($resultado_ayuda);

              $resultado_control = $desv_tip_control / ($count); //es muestral
              $final_control = sqrt($resultado_control);

              $resultado_aprendizaje = $desv_tip_aprendizaje / ($count); //es muestral
              $final_aprendizaje = sqrt($resultado_aprendizaje);

              $resultado_usab_gl = $desv_tip_usab_gl / ($count); //es muestral
              $final_usab_gl = sqrt($resultado_usab_gl);

              //MEDIANA
              
              $cont_efi = count($nuevo_array_eficiencia);

              $array_ord_efi = array();
              for ($k = 0; $k < $cont_efi; $k++){
                $array_ord_efi[$k] = $nuevo_array_eficiencia[$k]['valor_eficiencia'];
              }
              sort($array_ord_efi);

              //Si la mediana es par
              $modulo = ($cont_efi%2);
              //echo $modulo;
              if ($modulo == 0) {
                //PAR --> n/2  y (n/2)+1
                $me1 = ($cont_efi)/2;
                $me2 = $me1 + 1;

                $me_efi = ($array_ord_efi[$me1-1] + $array_ord_efi[$me2-1])/2;
              } else {
                $me = ($cont_efi +1)/2;
              
                $me_efi = $array_ord_efi[$me-1];

              }

              $cont_afe = count($nuevo_array_afecto);

              $array_ord_afe = array();
              for ($k = 0; $k < $cont_afe; $k++){
                $array_ord_afe[$k] = $nuevo_array_afecto[$k]['valor_afecto'];
              }
              sort($array_ord_afe);

              //Si la mediana es par
              $modulo = ($cont_afe%2);
              //echo $modulo;
              if ($modulo == 0) {
                //PAR --> n/2  y (n/2)+1
                $me1 = ($cont_afe)/2;
                $me2 = $me1 + 1;

                $me_afe = ($array_ord_afe[$me1-1] + $array_ord_afe[$me2-1])/2;
              } else {
                $me = ($cont_afe +1)/2;
              
                $me_afe = $array_ord_afe[$me-1];

              }

              $cont_ayu = count($nuevo_array_ayuda);

              $array_ord_ayu = array();
              for ($k = 0; $k < $cont_ayu; $k++){
                $array_ord_ayu[$k] = $nuevo_array_ayuda[$k]['valor_ayuda'];
              }
              sort($array_ord_ayu);

              //Si la mediana es par
              $modulo = ($cont_ayu%2);
              //echo $modulo;
              if ($modulo == 0) {
                //PAR --> n/2  y (n/2)+1
                $me1 = ($cont_ayu)/2;
                $me2 = $me1 + 1;

                $me_ayu = ($array_ord_ayu[$me1-1] + $array_ord_ayu[$me2-1])/2;
              } else {
                $me = ($cont_ayu +1)/2;
              
                $me_ayu = $array_ord_ayu[$me-1];

              }

            $cont_control = count($nuevo_array_control);

              $array_ord_control = array();
              for ($k = 0; $k < $cont_control; $k++){
                $array_ord_control[$k] = $nuevo_array_control[$k]['valor_control'];
              }
              sort($array_ord_control);

              //Si la mediana es par
              $modulo = ($cont_control%2);
              //echo $modulo;
              if ($modulo == 0) {
                //PAR --> n/2  y (n/2)+1
                $me1 = ($cont_control)/2;
                $me2 = $me1 + 1;

                $me_control = ($array_ord_control[$me1-1] + $array_ord_control[$me2-1])/2;
              } else {
                $me = ($cont_control +1)/2;
              
                $me_control = $array_ord_control[$me-1];

              }

              $cont_apr = count($nuevo_array_aprendizaje);

              $array_ord_apr = array();
              for ($k = 0; $k < $cont_apr; $k++){
                $array_ord_apr[$k] = $nuevo_array_aprendizaje[$k]['valor_aprendizaje'];
              }
              sort($array_ord_apr);

              //Si la mediana es par
              $modulo = ($cont_apr%2);
              //echo $modulo;
              if ($modulo == 0) {
                //PAR --> n/2  y (n/2)+1
                $me1 = ($cont_apr)/2;
                $me2 = $me1 + 1;

                $me_apr = ($array_ord_apr[$me1-1] + $array_ord_apr[$me2-1])/2;
              } else {
                $me = ($cont_apr +1)/2;
              
                $me_apr = $array_ord_apr[$me-1];

              }

              $cont_usb = count($nuevo_array_valor_usabilidad_global);

              $array_ord_usb = array();
              for ($k = 0; $k < $cont_usb; $k++){
                $array_ord_usb[$k] = $nuevo_array_valor_usabilidad_global[$k]['valor_usabilidad_global'];
              }
              sort($array_ord_usb);

              //Si la mediana es par
              $modulo = ($cont_usb%2);
              //echo $modulo;
              if ($modulo == 0) {
                //PAR --> n/2  y (n/2)+1
                $me1 = ($cont_usb)/2;
                $me2 = $me1 + 1;

                $me_usb = ($array_ord_usb[$me1-1] + $array_ord_usb[$me2-1])/2;
              } else {
                $me = ($cont_usb +1)/2;
              
                $me_usb = $array_ord_usb[$me-1];

              }

              //IQR
              //Q3-Q1

              $modulo_efi = $cont_efi %2;
              
              $array_ord_efi_nuevo = array();
              for ($i = 1; $i <= $cont_efi; $i++) {
                  $array_ord_efi_nuevo[$i] = $array_ord_efi[$i-1];
              }
              
              if ($modulo_efi == 0){
                $q3 = ((3*($cont_efi+1))/4);
                $q1 = ((1*($cont_efi+1))/4);
                //echo $q3;
                //echo $q1;
                $redondeo_up_q3=ceil($q3);
                $entero_q3 = floor($q3);
                //para obtener la parte decimal
                $parte_decimal_q3= $q3 - $entero_q3;

                //Formula
                $q3_final = $array_ord_efi_nuevo[$entero_q3] + $parte_decimal_q3 * ($array_ord_efi_nuevo[$redondeo_up_q3]-$array_ord_efi_nuevo[$entero_q3]);

                $redondeo_up_q1=ceil($q1);
                $entero_q1 = floor($q1);
                //para obtener la parte decimal
                $parte_decimal_q1= $q1 - $entero_q1;

                //Formula
                $q1_final = $array_ord_efi_nuevo[$entero_q1] + $parte_decimal_q1 * ($array_ord_efi_nuevo[$redondeo_up_q1]-$array_ord_efi_nuevo[$entero_q1]);

                $iqr_efi = $q3_final - $q1_final;
                

              } else {
                $q3 = ($cont_efi *0.75)-1;
                $q1 = ($cont_efi *0.25)-1;

                $iqr_efi = $array_ord_efi[ceil($q3)] - $array_ord_efi[ceil($q1)];
              }

              $modulo_afe = $cont_afe %2;
             
              $array_ord_afe_nuevo = array();
              for ($i = 1; $i <= $cont_afe; $i++) {
                  $array_ord_afe_nuevo[$i] = $array_ord_afe[$i-1];
              }
              
              if ($modulo_afe == 0){
                $q3 = ((3*($cont_afe+1))/4);
                $q1 = ((1*($cont_afe+1))/4);
                //echo $q3;
                //echo $q1;
                $redondeo_up_q3=ceil($q3);
                $entero_q3 = floor($q3);
                //para obtener la parte decimal
                $parte_decimal_q3= $q3 - $entero_q3;

                //Formula
                $q3_final = $array_ord_afe_nuevo[$entero_q3] + $parte_decimal_q3 * ($array_ord_afe_nuevo[$redondeo_up_q3]-$array_ord_afe_nuevo[$entero_q3]);

                $redondeo_up_q1=ceil($q1);
                $entero_q1 = floor($q1);
                //para obtener la parte decimal
                $parte_decimal_q1= $q1 - $entero_q1;

                //Formula
                $q1_final = $array_ord_afe_nuevo[$entero_q1] + $parte_decimal_q1 * ($array_ord_afe_nuevo[$redondeo_up_q1]-$array_ord_afe_nuevo[$entero_q1]);

                $iqr_afe = $q3_final - $q1_final;

              } else {
                $q3 = ($cont_afe *0.75)-1;
                $q1 = ($cont_afe *0.25)-1;

                $iqr_afe = $array_ord_afe[ceil($q3)] - $array_ord_afe[ceil($q1)];
              }


              $modulo_ayu = $cont_ayu %2;
             
              $array_ord_ayu_nuevo = array();
              for ($i = 1; $i <= $cont_ayu; $i++) {
                  $array_ord_ayu_nuevo[$i] = $array_ord_ayu[$i-1];
              }
              
              if ($modulo_ayu == 0){
                $q3 = ((3*($cont_ayu+1))/4);
                $q1 = ((1*($cont_ayu+1))/4);
                //echo $q3;
                //echo $q1;
                $redondeo_up_q3=ceil($q3);
                $entero_q3 = floor($q3);
                //para obtener la parte decimal
                $parte_decimal_q3= $q3 - $entero_q3;

                //Formula
                $q3_final = $array_ord_ayu_nuevo[$entero_q3] + $parte_decimal_q3 * ($array_ord_ayu_nuevo[$redondeo_up_q3]-$array_ord_ayu_nuevo[$entero_q3]);

                $redondeo_up_q1=ceil($q1);
                $entero_q1 = floor($q1);
                //para obtener la parte decimal
                $parte_decimal_q1= $q1 - $entero_q1;

                //Formula
                $q1_final = $array_ord_ayu_nuevo[$entero_q1] + $parte_decimal_q1 * ($array_ord_ayu_nuevo[$redondeo_up_q1]-$array_ord_ayu_nuevo[$entero_q1]);

                $iqr_ayu = $q3_final - $q1_final;

              } else {
                $q3 = ($cont_ayu *0.75)-1;
                $q1 = ($cont_ayu *0.25)-1;

                $iqr_ayu = $array_ord_ayu[ceil($q3)] - $array_ord_ayu[ceil($q1)];
              }

              $modulo_control = $cont_control %2;
             
              $array_ord_control_nuevo = array();
              for ($i = 1; $i <= $cont_control; $i++) {
                  $array_ord_control_nuevo[$i] = $array_ord_control[$i-1];
              }
              
              if ($modulo_control == 0){
                $q3 = ((3*($cont_control+1))/4);
                $q1 = ((1*($cont_control+1))/4);
                //echo $q3;
                //echo $q1;
                $redondeo_up_q3=ceil($q3);
                $entero_q3 = floor($q3);
                //para obtener la parte decimal
                $parte_decimal_q3= $q3 - $entero_q3;

                //Formula
                $q3_final = $array_ord_control_nuevo[$entero_q3] + $parte_decimal_q3 * ($array_ord_control_nuevo[$redondeo_up_q3]-$array_ord_control_nuevo[$entero_q3]);

                $redondeo_up_q1=ceil($q1);
                $entero_q1 = floor($q1);
                //para obtener la parte decimal
                $parte_decimal_q1= $q1 - $entero_q1;

                //Formula
                $q1_final = $array_ord_control_nuevo[$entero_q1] + $parte_decimal_q1 * ($array_ord_control_nuevo[$redondeo_up_q1]-$array_ord_control_nuevo[$entero_q1]);

                $iqr_control = $q3_final - $q1_final;

              } else {
                $q3 = ($cont_control *0.75)-1;
                $q1 = ($cont_control *0.25)-1;

                $iqr_control = $array_ord_control[ceil($q3)] - $array_ord_control[ceil($q1)];
              }

              $modulo_apr = $cont_apr %2;
             
              $array_ord_apr_nuevo = array();
              for ($i = 1; $i <= $cont_apr; $i++) {
                  $array_ord_apr_nuevo[$i] = $array_ord_apr[$i-1];
              }
              
              if ($modulo_apr == 0){
                $q3 = ((3*($cont_apr+1))/4);
                $q1 = ((1*($cont_apr+1))/4);
                //echo $q3;
                //echo $q1;
                $redondeo_up_q3=ceil($q3);
                $entero_q3 = floor($q3);
                //para obtener la parte decimal
                $parte_decimal_q3= $q3 - $entero_q3;

                //Formula
                $q3_final = $array_ord_apr_nuevo[$entero_q3] + $parte_decimal_q3 * ($array_ord_apr_nuevo[$redondeo_up_q3]-$array_ord_apr_nuevo[$entero_q3]);

                $redondeo_up_q1=ceil($q1);
                $entero_q1 = floor($q1);
                //para obtener la parte decimal
                $parte_decimal_q1= $q1 - $entero_q1;

                //Formula
                $q1_final = $array_ord_apr_nuevo[$entero_q1] + $parte_decimal_q1 * ($array_ord_apr_nuevo[$redondeo_up_q1]-$array_ord_apr_nuevo[$entero_q1]);

                $iqr_apr = $q3_final - $q1_final;

              } else {
                $q3 = ($cont_apr *0.75)-1;
                $q1 = ($cont_apr *0.25)-1;

                $iqr_apr = $array_ord_apr[ceil($q3)] - $array_ord_apr[ceil($q1)];
              }

              $modulo_usb = $cont_usb %2;
             
              $array_ord_usb_nuevo = array();
              for ($i = 1; $i <= $cont_usb; $i++) {
                  $array_ord_usb_nuevo[$i] = $array_ord_usb[$i-1];
              }
              
              if ($modulo_afe == 0){
                $q3 = ((3*($cont_usb+1))/4);
                $q1 = ((1*($cont_usb+1))/4);
                //echo $q3;
                //echo $q1;
                $redondeo_up_q3=ceil($q3);
                $entero_q3 = floor($q3);
                //para obtener la parte decimal
                $parte_decimal_q3= $q3 - $entero_q3;

                //Formula
                $q3_final = $array_ord_usb_nuevo[$entero_q3] + $parte_decimal_q3 * ($array_ord_usb_nuevo[$redondeo_up_q3]-$array_ord_usb_nuevo[$entero_q3]);

                $redondeo_up_q1=ceil($q1);
                $entero_q1 = floor($q1);
                //para obtener la parte decimal
                $parte_decimal_q1= $q1 - $entero_q1;

                //Formula
                $q1_final = $array_ord_usb_nuevo[$entero_q1] + $parte_decimal_q1 * ($array_ord_usb_nuevo[$redondeo_up_q1]-$array_ord_usb_nuevo[$entero_q1]);

                $iqr_usb = $q3_final - $q1_final;

              } else {
                $q3 = ($cont_usb *0.75)-1;
                $q1 = ($cont_usb *0.25)-1;

                $iqr_usb = $array_ord_usb[ceil($q3)] - $array_ord_usb[ceil($q1)];
              }
              





            }     

?>
            <div id="bloque_enlaces3" style="display: none">
                
              <br>
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="example5" class="resp" style="width:100%">
                          <thead>
                              <tr>
                                <th></th>
                                <th>Media</th>
                                <th>Desv. estándar</th>
                                <th>Mediana</th>
                                <th>IQR</th>
                                <th>Mínimo</th>
                                <th>Máximo</th>
                            </tr>
                          </thead> 
            <form action="/action_page.php" id="hh">
                <td>Eficiencia</td>
                <td><?php echo $media_eficiencia; ?></td>
                <td><?php echo $final_eficiencia; ?></td>
                <td><?php echo $me_efi; ?></td>
                <td><?php echo $iqr_efi; ?></td>
                <td><?php echo $min_eficiencia; ?></td>
                <td><?php echo $max_eficiencia; ?></td>
            </tr>
            </form>
            
            <form action="/action_page.php">
            <tr><td>Afecto</td>
                <td><?php echo $media_afecto; ?></td>
                <td><?php echo $final_afecto; ?></td>
                <td><?php echo $me_afe; ?></td>
                <td><?php echo $iqr_afe; ?></td>
                <td><?php echo $min_afecto; ?></td>
                <td><?php echo $max_afecto; ?></td>
            </tr>
            </form>
         <form action="/action_page.php">
            <tr><td>Ayuda</td>
                <td><?php echo $media_ayuda; ?></td>
                <td><?php echo $final_ayuda; ?></td>
                <td><?php echo $me_ayu; ?></td>
                <td><?php echo $iqr_ayu; ?></td>
                <td><?php echo $min_ayuda; ?></td>
                <td><?php echo $max_ayuda; ?></td>
            </tr>
            </form>
        <form action="/action_page.php">
            <tr><td>Control</td>
                <td><?php echo $media_control; ?></td>
                <td><?php echo $final_control; ?></td>
                <td><?php echo $me_control; ?></td>
                <td><?php echo $iqr_control; ?></td>
                <td><?php echo $min_control; ?></td>
                <td><?php echo $max_control; ?></td>
            </tr>
            </form>
        <form action="/action_page.php">
            <tr><td>Capacidad de aprendizaje</td>
                <td><?php echo $media_aprendizaje; ?></td>
                <td><?php echo $final_aprendizaje; ?></td>
                <td><?php echo $me_apr; ?></td>
                <td><?php echo $iqr_apr; ?></td>
                <td><?php echo $min_aprendizaje; ?></td>
                <td><?php echo $max_aprendizaje; ?></td>
            </tr>
            </form>
        <form action="/action_page.php">
            <tr><td>Usabilidad Global</td>
                <td><?php echo $media_usab_gl; ?></td>
                <td><?php echo $final_usab_gl; ?></td>
                <td><?php echo $me_usb; ?></td>
                <td><?php echo $iqr_usb; ?></td>
                <td><?php echo $min_usab_gl; ?></td>
                <td><?php echo $max_usab_gl; ?></td>
            </tr>
            </form>
                       </table>
                   </div>
        </div>   
    </div>
    <br>
    <br>

  
</div>

        <div class="bloque_btn5">
                <div class="btn btn_izq">
                    <a onClick="myFunction5()" style="color:#007bff;">Análisis por pregunta: fortalezas y debilidades</a>
                </div>
            </div>
            
            <div id="bloque_enlaces5" style="display: none">
                
            <?php
    $array_filas_preguntas = array();

    $sql = "SELECT AVG(r.p1) AS P1 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[1] = $row['P1'];

    $sql = "SELECT AVG(r.p2) AS P2 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[2] = $row['P2'];

    $sql = "SELECT AVG(r.p3) AS P3 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[3] = $row['P3'];

    $sql = "SELECT AVG(r.p4) AS P4 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[4] = $row['P4'];

    $sql = "SELECT AVG(r.p5) AS P5 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[5] = $row['P5'];

    $sql = "SELECT AVG(r.p6) AS P6 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[6] = $row['P6'];

    $sql = "SELECT AVG(r.p7) AS P7 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[7] = $row['P7'];

    $sql = "SELECT AVG(r.p8) AS P8 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[8] = $row['P8'];

    $sql = "SELECT AVG(r.p9) AS P9 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[9] = $row['P9'];

    $sql = "SELECT AVG(r.p10) AS P10 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[10] = $row['P10'];

    $sql = "SELECT AVG(r.p11) AS P11 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[11] = $row['P11'];

    $sql = "SELECT AVG(r.p12) AS P12 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[12] = $row['P12'];

    $sql = "SELECT AVG(r.p13) AS P13 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[13] = $row['P13'];

    $sql = "SELECT AVG(r.p14) AS P14 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[14] = $row['P14'];

    $sql = "SELECT AVG(r.p15) AS P15 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[15] = $row['P15'];

    $sql = "SELECT AVG(r.p16) AS P16 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[16] = $row['P16'];

    $sql = "SELECT AVG(r.p17) AS P17 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[17] = $row['P17'];

    $sql = "SELECT AVG(r.p18) AS P18 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[18] = $row['P18'];

    $sql = "SELECT AVG(r.p19) AS P19 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[19] = $row['P19'];

    $sql = "SELECT AVG(r.p20) AS P20 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[20] = $row['P20'];

    $sql = "SELECT AVG(r.p21) AS P21 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[21] = $row['P21'];

    $sql = "SELECT AVG(r.p22) AS P22 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[22] = $row['P22'];

    $sql = "SELECT AVG(r.p23) AS P23 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[23] = $row['P23'];

    $sql = "SELECT AVG(r.p24) AS P24 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[24] = $row['P24'];

    $sql = "SELECT AVG(r.p25) AS P25 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[25] = $row['P25'];

    $sql = "SELECT AVG(r.p26) AS P26 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[26] = $row['P26'];

    $sql = "SELECT AVG(r.p27) AS P27 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[27] = $row['P27'];

    $sql = "SELECT AVG(r.p28) AS P28 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[28] = $row['P28'];

    $sql = "SELECT AVG(r.p29) AS P29 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[29] = $row['P29'];

    $sql = "SELECT AVG(r.p30) AS P30 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[30] = $row['P30'];

    $sql = "SELECT AVG(r.p31) AS P31 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[31] = $row['P31'];

    $sql = "SELECT AVG(r.p32) AS P32 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[32] = $row['P32'];

    $sql = "SELECT AVG(r.p33) AS P33 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[33] = $row['P33'];

    $sql = "SELECT AVG(r.p34) AS P34 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[34] = $row['P34'];

    $sql = "SELECT AVG(r.p35) AS P35 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[35] = $row['P35'];

    $sql = "SELECT AVG(r.p36) AS P36 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[36] = $row['P36'];

    $sql = "SELECT AVG(r.p37) AS P37 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[37] = $row['P37'];

    $sql = "SELECT AVG(r.p38) AS P38 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[38] = $row['P38'];

    $sql = "SELECT AVG(r.p39) AS P39 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[39] = $row['P39'];

    $sql = "SELECT AVG(r.p40) AS P40 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[40] = $row['P40'];

    $sql = "SELECT AVG(r.p41) AS P41 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[41] = $row['P41'];

    $sql = "SELECT AVG(r.p42) AS P42 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[42] = $row['P42'];

    $sql = "SELECT AVG(r.p43) AS P43 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[43] = $row['P43'];

    $sql = "SELECT AVG(r.p44) AS P44 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[44] = $row['P44'];

    $sql = "SELECT AVG(r.p45) AS P45 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[45] = $row['P45'];

    $sql = "SELECT AVG(r.p46) AS P46 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[46] = $row['P46'];

    $sql = "SELECT AVG(r.p47) AS P47 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[47] = $row['P47'];

    $sql = "SELECT AVG(r.p48) AS P48 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[48] = $row['P48'];

    $sql = "SELECT AVG(r.p49) AS P49 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[49] = $row['P49'];

    $sql = "SELECT AVG(r.p50) AS P50 FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

    $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($registro);
    $array_filas_preguntas[50] = $row['P50'];

    $array_media_filas_preguntas = array();
    $entrar1 = true;
    $entrar = true;
    for ($i = 1; $i <= 50; $i++) {
        $array_media_filas_preguntas[$i] = ($array_filas_preguntas[$i]/5)*100;

        if ($array_media_filas_preguntas[$i] <= 40){ 
            if ($entrar){
                echo "<div align='center'>"."Items por debajo del 40%"."</div>";
                echo "<br>";
                $entrar = false;
            }
            
            $sql = "SELECT p.pregunta AS PREG FROM preguntas_sumi p WHERE p.id = ".$i."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
              while ($row = mysqli_fetch_array($registro)) {
                ?>
                <div class="container">
                  <div class="container">
                <?php
              //echo utf8_encode($row['PREG']);
              echo "<font color='red'>"."Item: ".$i." - ".utf8_encode($row['PREG'])."</font>";
              echo "<br>";
              echo "<font color='red'><i>"." Media: ".$array_media_filas_preguntas[$i]."% - Veredicto: En desacuerdo"."</i></font>";
              echo "<br>";
              echo "<br>";
              ?>
            </div>
          </div>
              <?php
              }
      }

        if ($array_media_filas_preguntas[$i] >= 60){
            if ($entrar1){
                echo "<div align='center'>"."Items por encima del 60%"."</div>";
                echo "<br>";
                $entrar1 = false;
            }
            $sql = "SELECT p.pregunta AS PREG FROM preguntas_sumi p WHERE p.id = ".$i."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
              while ($row = mysqli_fetch_array($registro)) {
              //echo utf8_encode($row['PREG']);
              echo "<font color='green'>"."Item: ".$i." - ".utf8_encode($row['PREG'])."</font>";
              echo "<br>";
              echo "<font color='green'><i>"." Media: ".$array_media_filas_preguntas[$i]."% - Veredicto: De acuerdo"."</i></font>";
              echo "<br>";
              echo "<br>";
        }
      }

        
    }

    //echo "<pre>";
    //print_r($array_media_filas_preguntas);


?>

            </div>
            
            <div class="bloque_btn1">
                <div class="btn btn_izq">
                    <a onClick="myFunction1()" style="color:#007bff;">Comentarios: En general, ¿para qué utilizaría este sistema?</a>
                </div>
            </div>
          
            <div id="bloque_enlaces1" style="display: none">
                <br>
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="example33" class="resp" style="width:100%">
                          <thead>
                              <tr>
                                <th>Usuario</th>
                                <th>Comentario</th>
                            </tr>
                          </thead>     
                       </table>
                   </div>
        </div>   
    </div>
    <br>
    <br>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    
    <script>
    $(document).ready(function() {
        var table = $('#example33').DataTable({
            lengthChange: false,
            responsive: false,
            paging: false,
            dom: 'Bfrtip',
            buttons: [ 'copy', 'excel', 'csv', 'pdf', 'colvis' ],
            ajax: "ajax_sumi_comentarios.php?id="+'<?php echo $_REQUEST['id'] ?>',
            language: {
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "Mostrando _START_ de _END_ filas",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast":"Último",
                            "sNext":"Siguiente",
                            "sPrevious": "Anterior"
                         },
                         "sProcessing":"Procesando...",
                }
        });
     
        table.buttons().container()
    .appendTo( $('#example33 .col-sm-6:eq(0)', table.table().container() ) );
    });
    </script>
            </div>

            <div class="bloque_btn3">
                <div class="btn btn_izq">
                    <a onClick="myFunction2()" style="color:#007bff;">Comentarios: ¿Cuál crees que es el mejor aspecto del sistema y por qué?</a>
                </div>
            </div>
          
            <div id="bloque_enlaces2" style="display: none">
                <br>
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="example333" class="resp" style="width:100%">
                          <thead>
                              <tr>
                                <th>Usuario</th>
                                <th>Comentario</th>
                            </tr>
                          </thead>   
                       </table>
                   </div>
        </div>   
    </div>
    <br>
    <br>

  
    
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    
    <script>
    $(document).ready(function() {
        var table = $('#example333').DataTable({
            lengthChange: false,
            responsive: false,
            paging: false,
            dom: 'Bfrtip',
            buttons: [ 'copy', 'excel', 'csv', 'pdf', 'colvis' ],
            ajax: "ajax_sumi_comentarios_aspecto.php?id="+'<?php echo $_REQUEST['id'] ?>',
            language: {
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "Mostrando _START_ de _END_ filas",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast":"Último",
                            "sNext":"Siguiente",
                            "sPrevious": "Anterior"
                         },
                         "sProcessing":"Procesando...",
                }
        });
     
        table.buttons().container()
    .appendTo( $('#example333 .col-sm-6:eq(0)', table.table().container() ) );
    });
    </script>
            </div>


            <div class="bloque_btn4">
                <div class="btn btn_izq">
                    <a onClick="myFunction4()" style="color:#007bff;">Comentarios: ¿Cómo de importante es para ti el sistema que está evaluando?</a>
                </div>
            </div>

            <?php

            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT COUNT(r.valor_eficiencia) AS COUNT_EXT_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Extremadamente importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $count_ext_imp = $row['COUNT_EXT_IMP'];

            $sql = "SELECT AVG(r.valor_eficiencia) AS V_EFI FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Extremadamente importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_efi_ext_imp = $row['V_EFI'];

            $sql = "SELECT AVG(r.valor_afecto) AS V_AFE FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Extremadamente importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_afe_ext_imp = $row['V_AFE'];

            $sql = "SELECT AVG(r.valor_ayuda) AS V_AYU FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Extremadamente importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_ayu_ext_imp = $row['V_AYU'];

            $sql = "SELECT AVG(r.valor_control) AS V_CTRL FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Extremadamente importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_ctrl_ext_imp = $row['V_CTRL'];

            $sql = "SELECT AVG(r.valor_aprendizaje) AS V_APR FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Extremadamente importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_apr_ext_imp = $row['V_APR'];

            $sql = "SELECT AVG(r.valor_usabilidad_global) AS V_USB FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Extremadamente importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_usb_ext_imp = $row['V_USB'];



            $sql = "SELECT COUNT(r.valor_eficiencia) AS COUNT_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $count_imp = $row['COUNT_IMP'];

            $sql = "SELECT AVG(r.valor_eficiencia) AS V_EFI_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_efi_imp = $row['V_EFI_IMP'];

            $sql = "SELECT AVG(r.valor_afecto) AS V_AFE_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_afe_imp = $row['V_AFE_IMP'];

            $sql = "SELECT AVG(r.valor_ayuda) AS V_AYU_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_ayu_imp = $row['V_AYU_IMP'];

            $sql = "SELECT AVG(r.valor_control) AS V_CTRL_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_ctrl_imp = $row['V_CTRL_IMP'];

            $sql = "SELECT AVG(r.valor_aprendizaje) AS V_APR_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_apr_imp = $row['V_APR_IMP'];

            $sql = "SELECT AVG(r.valor_usabilidad_global) AS V_USB_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_usb_imp = $row['V_USB_IMP'];




            $sql = "SELECT COUNT(r.valor_eficiencia) AS COUNT_NO_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'No muy importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $count_no_imp = $row['COUNT_NO_IMP'];

            $sql = "SELECT AVG(r.valor_eficiencia) AS V_EFI_NO_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'No muy importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_efi_no_imp = $row['V_EFI_NO_IMP'];

            $sql = "SELECT AVG(r.valor_afecto) AS V_AFE_NO_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'No muy importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_afe_no_imp = $row['V_AFE_NO_IMP'];

            $sql = "SELECT AVG(r.valor_ayuda) AS V_AYU_NO_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'No muy importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_ayu_no_imp = $row['V_AYU_NO_IMP'];

            $sql = "SELECT AVG(r.valor_control) AS V_CTRL_NO_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'No muy importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_ctrl_no_imp = $row['V_CTRL_NO_IMP'];

            $sql = "SELECT AVG(r.valor_aprendizaje) AS V_APR_NO_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'No muy importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_apr_no_imp = $row['V_APR_NO_IMP'];

            $sql = "SELECT AVG(r.valor_usabilidad_global) AS V_USB_NO_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'No muy importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_usb_no_imp = $row['V_USB_NO_IMP'];



            $sql = "SELECT COUNT(r.valor_eficiencia) AS COUNT_NADA_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Nada importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $count_nada_imp = $row['COUNT_NADA_IMP'];

            $sql = "SELECT AVG(r.valor_eficiencia) AS V_EFI_NADA_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Nada importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_efi_nada_imp = $row['V_EFI_NADA_IMP'];

            $sql = "SELECT AVG(r.valor_afecto) AS V_AFE_NADA_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Nada importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_afe_nada_imp = $row['V_AFE_NADA_IMP'];

            $sql = "SELECT AVG(r.valor_ayuda) AS V_AYU_NADA_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Nada importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_ayu_nada_imp = $row['V_AYU_NADA_IMP'];

            $sql = "SELECT AVG(r.valor_control) AS V_CTRL_NADA_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Nada importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_ctrl_nada_imp = $row['V_CTRL_NADA_IMP'];

            $sql = "SELECT AVG(r.valor_aprendizaje) AS V_APR_NADA_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Nada importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_apr_nada_imp = $row['V_APR_NADA_IMP'];

            $sql = "SELECT AVG(r.valor_usabilidad_global) AS V_USB_NADA_IMP FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']." AND
              r.importancia = 'Nada importante'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $media_usb_nada_imp = $row['V_USB_NADA_IMP'];


            ?>
          
            <div id="bloque_enlaces4" style="display: none">
                <br>
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="example3334" class="resp" style="width:100%">
                          <thead>
                              <tr>
                                <th></th>
                                <th>n</th>
                                <th>Eficiencia</th>
                                <th>Afecto</th>
                                <th>Ayuda</th>
                                <th>Control</th>
                                <th>Capacidad de aprendizaje</th>
                                <th>Usabilidad Global</th>
                            </tr>
                          </thead>
            <form action="/action_page.php" id="hh">
                <td>Extremadamente importante</td>
                <td><?php echo $count_ext_imp; ?></td>
                <td><?php echo round($media_efi_ext_imp,2); ?></td>
                <td><?php echo round($media_afe_ext_imp,2); ?></td>
                <td><?php echo round($media_ayu_ext_imp,2); ?></td>
                <td><?php echo round($media_ctrl_ext_imp,2); ?></td>
                <td><?php echo round($media_apr_ext_imp,2); ?></td>
                <td><?php echo round($media_usb_ext_imp,2); ?></td>
            </tr>
            </form>
            
            <form action="/action_page.php">
            <tr><td>Importante</td>
                <td><?php echo $count_imp; ?></td>
                <td><?php echo round($media_efi_imp,2); ?></td>
                <td><?php echo round($media_afe_imp,2); ?></td>
                <td><?php echo round($media_ayu_imp,2); ?></td>
                <td><?php echo round($media_ctrl_imp,2); ?></td>
                <td><?php echo round($media_apr_imp,2); ?></td>
                <td><?php echo round($media_usb_imp,2); ?></td>
            </tr>
            </form>
         <form action="/action_page.php">
            <tr><td>No muy importante</td>
                <td><?php echo $count_no_imp; ?></td>
                <td><?php echo round($media_efi_no_imp,2); ?></td>
                <td><?php echo round($media_afe_no_imp,2); ?></td>
                <td><?php echo round($media_ayu_no_imp,2); ?></td>
                <td><?php echo round($media_ctrl_no_imp,2); ?></td>
                <td><?php echo round($media_apr_no_imp,2); ?></td>
                <td><?php echo round($media_usb_no_imp,2); ?></td>
            </tr>
            </form>
        <form action="/action_page.php">
            <tr><td>Nada importante</td>
                <td><?php echo $count_nada_imp; ?></td>
                <td><?php echo round($media_efi_nada_imp,2); ?></td>
                <td><?php echo round($media_afe_nada_imp,2); ?></td>
                <td><?php echo round($media_ayu_nada_imp,2); ?></td>
                <td><?php echo round($media_ctrl_nada_imp,2); ?></td>
                <td><?php echo round($media_apr_nada_imp,2); ?></td>
                <td><?php echo round($media_usb_nada_imp,2); ?></td>
            </tr>
            </form>
                       </table>
                   </div>
        </div>   
    </div>
    <br>
    <br>

            </div>
             
        </section>
      
        <script type="text/javascript">
          
            function myFunction() {
                var x = document.getElementById("bloque_enlaces");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }

            }
            function myFunction1(){
              var y = document.getElementById("bloque_enlaces1");
                if (y.style.display === "none") {
                    y.style.display = "block";
                } else {
                    y.style.display = "none";
                }
            }
            function myFunction2(){
              var z = document.getElementById("bloque_enlaces2");
                if (z.style.display === "none") {
                    z.style.display = "block";
                } else {
                    z.style.display = "none";
                }
            }
            function myFunction3(){
              var t = document.getElementById("bloque_enlaces3");
                if (t.style.display === "none") {
                    t.style.display = "block";
                } else {
                    t.style.display = "none";
                }
            }
            function myFunction4(){
              var w = document.getElementById("bloque_enlaces4");
                if (w.style.display === "none") {
                    w.style.display = "block";
                } else {
                    w.style.display = "none";
                }
            }
            function myFunction5(){
              var w = document.getElementById("bloque_enlaces5");
                if (w.style.display === "none") {
                    w.style.display = "block";
                } else {
                    w.style.display = "none";
                }
            }
        </script>
        
      
    </div>
        <?php
      }
  ?>
</div>
</div>
    
  </body>
</html>