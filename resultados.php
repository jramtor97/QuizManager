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
            // SELECT COUNT(*) FROM (SELECT distinct r.puntuacion_final FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
            //     WHERE r.id_proyecto = 1
            //     AND r.id_proyecto = r1.id_proyecto) p;
            $sql = "SELECT DISTINCT COUNT(r.puntuacion_final) AS NUM_PART FROM respuestas r, rec r1 WHERE r.id_proyecto = ".$_REQUEST['id']." AND r.id_proyecto = r1.id_proyecto ";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?></li>
          <li>Promedio de edad: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT ROUND(AVG(p.edad),0) AS NUM_PART FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
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

            $sql = "SELECT MAX(p.edad) AS NUM_PART FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
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

            $sql = "SELECT MIN(p.edad) AS NUM_PART FROM  respuestas r, rec r1, presentacion_usuario p, proyecto p1
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

            $sql = "SELECT ROUND((COUNT(p.sexo)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
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

            $sql = "SELECT ROUND((COUNT(p.sexo)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
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

              $sql = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
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

              $sql = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
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

              $sql = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
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

              $sql = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
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

              $sql = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
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

              $sql = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
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

              $sql = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
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

              $sql = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
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

              $sql = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
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

              $sql = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
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

            $sql = "SELECT ROUND(AVG(r.puntuacion_final),2) AS NUM_PART FROM respuestas r, rec r1 WHERE r.id_proyecto = ".$_REQUEST['id']." AND r.id_proyecto = r1.id_proyecto";

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

            $sql = "SELECT r.url_usuario, r.puntuacion_final FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            $valoresYY=array(); 
            $valoresX=array();

            //$row = mysqli_fetch_array($registro);
            while ($ver = mysqli_fetch_row($registro)){
                $valoresX[]=$ver[0];
                $valoresYY[]=$ver[1];
            }

            $sql_w = "SELECT COUNT(r.puntuacion_final) AS COUNTT FROM respuestas r
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

            $sql_q = "SELECT COUNT(r.url_usuario) AS COUNT FROM respuestas r
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

            $sql = "SELECT r.url_usuario, r.puntuacion_final FROM respuestas r
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

            $sql_excelente = "SELECT ROUND((COUNT(r.puntuacion_final)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS EXCELENTE FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND r.puntuacion_final >= 85";

              $registro1 = mysqli_query($connect, $sql_excelente) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro1);
              $excelente = $row['EXCELENTE'];
              $array_radar[0] = $excelente . " %";

              $sql_bueno = "SELECT ROUND((COUNT(r.puntuacion_final)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS BUENO FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND r.puntuacion_final BETWEEN 73 AND 84.99";

              $registro1 = mysqli_query($connect, $sql_bueno) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro1);
              $bueno = $row['BUENO'];
              $array_radar[1] = $bueno . " %";

              $sql_bien = "SELECT ROUND((COUNT(r.puntuacion_final)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS BIEN FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND r.puntuacion_final BETWEEN 50 AND 72.99";

              $registro1 = mysqli_query($connect, $sql_bien) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro1);
              $bien = $row['BIEN'];
              $array_radar[2] = $bien . " %";

              $sql_pobre = "SELECT ROUND((COUNT(r.puntuacion_final)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS POBRE FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND r.puntuacion_final BETWEEN 25 AND 49.99";

              $registro1 = mysqli_query($connect, $sql_pobre) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro1);
              $pobre = $row['POBRE'];
              $array_radar[3] = $pobre . " %";


              $sql_mediocre = "SELECT ROUND((COUNT(r.puntuacion_final)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS MEDIOCRE FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
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
            ajax: "ajax_tabla_resultados_sus.php?id="+'<?php echo $_REQUEST['id'] ?>',
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

            $sql = "SELECT r.url_usuario, u.edad FROM respuestas r, presentacion_usuario u WHERE
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

            $sql_q1 = "SELECT COUNT(r.url_usuario) AS COUNT FROM respuestas r, presentacion_usuario u
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

            $sql = "SELECT ROUND((COUNT(p.sexo)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS GRAFICA_MUJER FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.sexo = 'Mujer'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $graf_muj = $row['GRAFICA_MUJER'];

            $sql_q = "SELECT ROUND((COUNT(p.sexo)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS GRAFICA_HOMBRE FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
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

            $sql = "SELECT ROUND((COUNT(p.sexo)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS GRAFICA_MUJER FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.sexo = 'Mujer'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $graf_muj = $row['GRAFICA_MUJER'];

            $sql_q = "SELECT ROUND((COUNT(p.sexo)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS GRAFICA_HOMBRE FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
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

              $sql = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS MUY_BAJO FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_sistemas = 'Muy bajo'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              //echo $row['MUY_BAJO'];

              $sql_b = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS BAJO FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_sistemas = 'Bajo'";

              $registrob = mysqli_query($connect, $sql_b) or die(mysqli_error($connect));

              $rowb = mysqli_fetch_array($registrob);
              //echo $rowb['BAJO'];

              $sqlm = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS MEDIO FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_sistemas = 'Medio'";

              $registrom = mysqli_query($connect, $sqlm) or die(mysqli_error($connect));

              $rowm = mysqli_fetch_array($registrom);
              //echo $rowm['MEDIO'];

              $sqla = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS ALTO FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_sistemas = 'Alto'";

              $registroa = mysqli_query($connect, $sqla) or die(mysqli_error($connect));

              $rowa = mysqli_fetch_array($registroa);
              //echo $rowa['ALTO'];

              $sqlaa = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS MUY_ALTO FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_sistemas = 'Muy alto'";

              $registroaa = mysqli_query($connect, $sqlaa) or die(mysqli_error($connect));

              $rowaa = mysqli_fetch_array($registroaa);
              //echo $rowaa['MUY_ALTO'];


              $sqlmm = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS MUY_BAJO FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_internet = 'Muy bajo'";

              $registromm = mysqli_query($connect, $sqlmm) or die(mysqli_error($connect));

              $rowmm = mysqli_fetch_array($registromm);
              //echo $rowmm['MUY_BAJO'];

              $sqlmmm = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS BAJO FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_internet = 'Bajo'";

              $registrommm = mysqli_query($connect, $sqlmmm) or die(mysqli_error($connect));

              $rowmmm = mysqli_fetch_array($registrommm);
              //echo $rowmmm['BAJO'];

              $sqlmmmm = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS MEDIO FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_internet = 'Medio'";

              $registrommmm = mysqli_query($connect, $sqlmmmm) or die(mysqli_error($connect));

              $rowmmmm = mysqli_fetch_array($registrommmm);
              //echo $rowmmmm['MEDIO'];

              $sqlmmmmm = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS ALTO FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND p.exp_internet = 'Alto'";

              $registrommmmm = mysqli_query($connect, $sqlmmmmm) or die(mysqli_error($connect));

              $rowmmmmm = mysqli_fetch_array($registrommmmm);
              //echo $rowmmmmm['ALTO'];

              $sqlmmmmmm = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = ".$_REQUEST['id']."
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS MUY_ALTO FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
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
            $sqqql = "SELECT COUNT(r.puntuacion_final) AS COUNT FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroqq = mysqli_query($connect, $sqqql) or die(mysqli_error($connect));
            $rwow = mysqli_fetch_array($registroqq);
            $count = $rwow['COUNT'];
            
            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.p1) AS MEDIA1 FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_p1 = $row['MEDIA1'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.p2) AS MEDIA2 FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_p2 = $row['MEDIA2'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.p3) AS MEDIA3 FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_p3 = $row['MEDIA3'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.p4) AS MEDIA4 FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_p4 = $row['MEDIA4'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.p5) AS MEDIA5 FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_p5 = $row['MEDIA5'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.p6) AS MEDIA6 FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_p6 = $row['MEDIA6'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.p7) AS MEDIA7 FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_p7 = $row['MEDIA7'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.p8) AS MEDIA8 FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_p8 = $row['MEDIA8'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.p9) AS MEDIA9 FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_p9 = $row['MEDIA9'];

            //MEDIA DE LA MUESTRA P1,...,PN
            $sqql = "SELECT AVG(r.p10) AS MEDIA10 FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media_p10 = $row['MEDIA10'];

            //DATOS P1,...,PN
            $sql = "SELECT r.p1 FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_p1 = mysqli_fetch_assoc($registro)){
                $nuevo_array_p1[] = $fila_p1;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.p2 FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_p2 = mysqli_fetch_assoc($registro)){
                $nuevo_array_p2[] = $fila_p2;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.p3 FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_p3 = mysqli_fetch_assoc($registro)){
                $nuevo_array_p3[] = $fila_p3;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.p4 FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_p4 = mysqli_fetch_assoc($registro)){
                $nuevo_array_p4[] = $fila_p4;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.p5 FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_p5 = mysqli_fetch_assoc($registro)){
                $nuevo_array_p5[] = $fila_p5;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.p6 FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_p6 = mysqli_fetch_assoc($registro)){
                $nuevo_array_p6[] = $fila_p6;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.p7 FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_p7 = mysqli_fetch_assoc($registro)){
                $nuevo_array_p7[] = $fila_p7;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.p8 FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_p8 = mysqli_fetch_assoc($registro)){
                $nuevo_array_p8[] = $fila_p8;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.p9 FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            
            while ($fila_p9 = mysqli_fetch_assoc($registro)){
                $nuevo_array_p9[] = $fila_p9;
            }

            //DATOS P1,...,PN
            $sql = "SELECT r.p10 FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

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

              $resultado_p1 = $desv_tip_p1 / ($count); //es muestral
              $final_p1 = sqrt($resultado_p1);

              $resultado_p2 = $desv_tip_p2 / ($count); //es muestral
              $final_p2 = sqrt($resultado_p2);

              $resultado_p3 = $desv_tip_p3 / ($count); //es muestral
              $final_p3 = sqrt($resultado_p3);

              $resultado_p4 = $desv_tip_p4 / ($count); //es muestral
              $final_p4 = sqrt($resultado_p4);

              $resultado_p5 = $desv_tip_p5 / ($count); //es muestral
              $final_p5 = sqrt($resultado_p5);

              $resultado_p6 = $desv_tip_p6 / ($count); //es muestral
              $final_p6 = sqrt($resultado_p6);

              $resultado_p7 = $desv_tip_p7 / ($count); //es muestral
              $final_p7 = sqrt($resultado_p7);

              $resultado_p8 = $desv_tip_p8 / ($count); //es muestral
              $final_p8 = sqrt($resultado_p8);

              $resultado_p9 = $desv_tip_p9 / ($count); //es muestral
              $final_p9 = sqrt($resultado_p9);

              $resultado_p10 = $desv_tip_p10 / ($count); //es muestral
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

              $resultado_p1 = $desv_tip_p1 / ($count); //es muestral
              $final_p1 = sqrt($resultado_p1);

              $resultado_p2 = $desv_tip_p2 / ($count); //es muestral
              $final_p2 = sqrt($resultado_p2);

              $resultado_p3 = $desv_tip_p3 / ($count); //es muestral
              $final_p3 = sqrt($resultado_p3);

              $resultado_p4 = $desv_tip_p4 / ($count); //es muestral
              $final_p4 = sqrt($resultado_p4);

              $resultado_p5 = $desv_tip_p5 / ($count); //es muestral
              $final_p5 = sqrt($resultado_p5);

              $resultado_p6 = $desv_tip_p6 / ($count); //es muestral
              $final_p6 = sqrt($resultado_p6);

              $resultado_p7 = $desv_tip_p7 / ($count); //es muestral
              $final_p7 = sqrt($resultado_p7);

              $resultado_p8 = $desv_tip_p8 / ($count); //es muestral
              $final_p8 = sqrt($resultado_p8);

              $resultado_p9 = $desv_tip_p9 / ($count); //es muestral
              $final_p9 = sqrt($resultado_p9);

              $resultado_p10 = $desv_tip_p10 / ($count); //es muestral
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
      var config = {responsive: true};
      Plotly.newPlot('myDivi', data, layout, config);
  </script>


  <div id='myDivv'></div>
 
  </head>
<?php
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT r.id_pregunta, r.valor FROM prueba r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            $valoresY=array(); 
            $valoresX=array();

            //$row = mysqli_fetch_array($registro);
            while ($ver = mysqli_fetch_row($registro)){
                $valoresX[]=$ver[0];
                $valoresY[]=$ver[1];
            }

            $datosX=json_encode($valoresX);
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
      var trace2 = {
        x: datosX,
        y: datosY,
        type: 'box',
        name: 'Mean and Standard Deviation',
        marker: {
          color: 'rgb(10,140,208)'
        },
        boxmean: 'sd'
      };


      var data = [trace2];

      var layout = {
        responsive: true,
        title: 'Diagrama de cajas por pregunta para la media y la desviación estándar',
        xaxis:{
          title: 'Preguntas'
        },
        yaxis:{
          title: 'Puntuación pregunta'
        }
      };
      var config2 = {responsive: true};
      Plotly.newPlot('myDivv', data, layout, config2);
  </script>


        <h5><strong>Datos por pregunta: </strong></h5>
     <br>
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                          <thead>
                              <tr>
                                <th>Usuario</th>
                                <th>P1</th>
                                <th>P2</th>
                                <th>P3</th>
                                <th>P4</th>
                                <th>P5</th>
                                <th>P6</th>
                                <th>P7</th>
                                <th>P8</th>
                                <th>P9</th>
                                <th>P10</th>
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
            ajax: "ajax_sus_por_pregunta.php?id="+'<?php echo $_REQUEST['id'] ?>',
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
            // SELECT COUNT(*) FROM (SELECT distinct r.puntuacion_final FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
            //     WHERE r.id_proyecto = 1
            //     AND r.id_proyecto = r1.id_proyecto) p;
            $sql = "SELECT DISTINCT COUNT(r.puntuacion_final) AS NUM_PART FROM respuestas r, rec r1 WHERE r.id_proyecto = ".$_REQUEST['id']." AND r.id_proyecto = r1.id_proyecto ";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];
            ?></li>
          <ul>
            <li>Media: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT ROUND(AVG(r.puntuacion_final),2) AS NUM_PART FROM respuestas r, rec r1 WHERE r.id_proyecto = ".$_REQUEST['id']." AND r.id_proyecto = r1.id_proyecto";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?></li>
            <li>Moda: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT MIN(p.edad) AS NUM_PART FROM  respuestas r, rec r1, presentacion_usuario p, proyecto p1
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

            $sql = "SELECT MIN(p.edad) AS NUM_PART FROM  respuestas r, rec r1, presentacion_usuario p, proyecto p1
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

            $sql = "SELECT ROUND(MAX(r.puntuacion_final),2) AS NUM_PART FROM respuestas r, rec r1 WHERE r.id_proyecto = ".$_REQUEST['id']." AND r.id_proyecto = r1.id_proyecto";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?></li>
        <li>Mínimo: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT ROUND(MIN(r.puntuacion_final),2) AS NUM_PART FROM respuestas r, rec r1 WHERE r.id_proyecto = ".$_REQUEST['id']." AND r.id_proyecto = r1.id_proyecto";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?></li>
        <li>Desviación estándar poblacional <?php echo "(σ)" ?>: <?php
            $connect = mysqli_connect("localhost", "root", "", "blog");
            //TAMAÑO DE LA MUESTRA (N) -> numero usuarios
            $sqqql = "SELECT COUNT(r.puntuacion_final) AS COUNT FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroqq = mysqli_query($connect, $sqqql) or die(mysqli_error($connect));
            $rwow = mysqli_fetch_array($registroqq);
            $count = $rwow['COUNT'];
            //MEDIA DE LA MUESTRA
            $sqql = "SELECT AVG(r.puntuacion_final) AS MEDIA FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media = $row['MEDIA'];
            //DATOS AGRUPADOS.
            $sql = "SELECT r.puntuacion_final FROM respuestas r
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
            $sqqql = "SELECT COUNT(r.puntuacion_final) AS COUNT FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroqq = mysqli_query($connect, $sqqql) or die(mysqli_error($connect));
            $rwow = mysqli_fetch_array($registroqq);
            $count = $rwow['COUNT'];
            //MEDIA DE LA MUESTRA
            $sqql = "SELECT AVG(r.puntuacion_final) AS MEDIA FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media = $row['MEDIA'];
            //DATOS AGRUPADOS.
            $sql = "SELECT r.puntuacion_final FROM respuestas r
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

            $sql = "SELECT ROUND(AVG(r.puntuacion_final),2) AS NUM_PART FROM respuestas r, rec r1 WHERE r.id_proyecto = ".$_REQUEST['id']." AND r.id_proyecto = r1.id_proyecto";

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
            $sqqql = "SELECT COUNT(r.puntuacion_final) AS COUNT FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroqq = mysqli_query($connect, $sqqql) or die(mysqli_error($connect));
            $rwow = mysqli_fetch_array($registroqq);
            $count = $rwow['COUNT'];
            
            //MEDIA DE LA MUESTRA
            $sqql = "SELECT AVG(r.puntuacion_final) AS MEDIA FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registroq = mysqli_query($connect, $sqql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registroq);
            $media = $row['MEDIA'];

            //DATOS P1,...,PN
            $sql = "SELECT r.puntuacion_final FROM respuestas r
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
      var config = {responsive: true};
      Plotly.newPlot('myD', data, layout, config);
  </script>

  <div class="container">
    <div class="row">
      <div id='myDivl'></div>
    </div>
  </div>
  </head>
<?php
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT r.puntuacion_final FROM respuestas r
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
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT r.p3, r.puntuacion_final FROM respuestas r
            WHERE r.id_proyecto = ".$_REQUEST['id']." ORDER BY r.puntuacion_final ASC";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            $valoresY=array(); 
            $valoresX=array();

            //$row = mysqli_fetch_array($registro);
            while ($ver = mysqli_fetch_row($registro)){
                $valoresX[]=$ver[0];
                $valoresY[]=$ver[1];
            }

            $sql_w = "SELECT COUNT(r.puntuacion_final) AS COUNTT FROM respuestas r
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
            //AQUI DA EL ERROR
            //COntrolamos que el denominador no sea 0, tras eso, no hay predicción
            $excepcion = (($countt*$sum_3)-(pow($sum_x,2)));

            if ($excepcion != 0){
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
            $sqqql = "SELECT COUNT(r.puntuacion_final) AS COUNT FROM respuestas r
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
    var config = {responsive: true};
    Plotly.plot('plotly-div', {
      data: data,
      layout: layout,
      config: config
    });
  </script>




          <?php
            } else {
              ?>

              <h5><strong>Datos de predicción: </strong></h5>
              <ul>
                <li>No puede realizarse una predicción con los datos actuales.</li>
              <ul>

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
</div>
    
  </body>
</html>