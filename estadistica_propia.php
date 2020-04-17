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
            $sql = "SELECT COUNT(DISTINCT c.id_participante) AS COUNT
              FROM cu_propio".$_REQUEST['id_quiz']." c WHERE c.url_usuario = '".$_REQUEST['u']."'
              GROUP BY c.id_participante";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['COUNT'];

        ?></li>
          <li>Promedio de edad: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT ROUND(AVG(u.edad),0) AS NUM_PART FROM pregunta_crear_cuestionario c, presentacion_usuario u
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = u.url_usuario
                AND u.url_usuario = '".$_REQUEST['u']."'
                AND u.def = 'Si' ";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?></li>
          <ul>
            <li>Máximo: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT MAX(u.edad) AS NUM_PART FROM pregunta_crear_cuestionario c, presentacion_usuario u
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = u.url_usuario
                AND u.url_usuario = '".$_REQUEST['u']."'
                AND u.def = 'Si' ";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?></li>
            <li>Mínimo: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT MIN(u.edad) AS NUM_PART FROM pregunta_crear_cuestionario c, presentacion_usuario u
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = u.url_usuario
                AND u.url_usuario = '".$_REQUEST['u']."'
                AND u.def = 'Si' ";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?></li>
          </ul>
          <li>Promedio de sexo: </li>
          <ul>
            <li>Hombres: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT ROUND((COUNT(p.sexo)/(SELECT COUNT(*) FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.sexo = 'Hombre'
                AND p.def = 'Si'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?> %</li>
            <li>Mujeres: <?php 
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT ROUND((COUNT(p.sexo)/(SELECT COUNT(*) FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.sexo = 'Mujer'
                AND p.def = 'Si'";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            echo $row['NUM_PART'];

        ?> %</li>
          </ul>
          <li>Experiencia en internet: </li>
          <ul>
            <li>Muy alto: <?php 
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.exp_internet = 'Muy alto'
                AND p.def = 'Si'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              echo $row['NUM_PART'];

        ?> %</li>
            <li>Alto: <?php 
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.exp_internet = 'Alto'
                AND p.def = 'Si'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              echo $row['NUM_PART'];

        ?> %</li>
            <li>Medio: <?php 
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.exp_internet = 'Medio'
                AND p.def = 'Si'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              echo $row['NUM_PART'];

        ?> %</li>
            <li>Bajo: <?php 
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.exp_internet = 'Bajo'
                AND p.def = 'Si'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              echo $row['NUM_PART'];

        ?> %</li>
            <li>Muy bajo: <?php 
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_internet)/(SELECT COUNT(*) FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.exp_internet = 'Muy bajo'
                AND p.def = 'Si'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              echo $row['NUM_PART'];

        ?> %</li>
          </ul>
          <li>Experiencia en sistemas parecidos: </li>
          <ul>
            <li>Muy alto: <?php 
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.exp_sistemas = 'Muy alto'
                AND p.def = 'Si'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              echo $row['NUM_PART'];

        ?> %</li>
            <li>Alto: <?php 
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.exp_sistemas = 'Alto'
                AND p.def = 'Si'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              echo $row['NUM_PART'];

        ?> %</li>
            <li>Medio: <?php 
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.exp_sistemas = 'Medio'
                AND p.def = 'Si'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              echo $row['NUM_PART'];

        ?> %</li>
            <li>Bajo: <?php 
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.exp_sistemas = 'Bajo'
                AND p.def = 'Si'";

              $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro);
              echo $row['NUM_PART'];

        ?> %</li>
            <li>Muy bajo: <?php 
              $connect = mysqli_connect("localhost", "root", "", "blog");

              $sql = "SELECT ROUND((COUNT(p.exp_sistemas)/(SELECT COUNT(*) FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.def = 'Si'))*100,2) AS NUM_PART FROM pregunta_crear_cuestionario c, presentacion_usuario p
                WHERE c.id_quiz = ".$_REQUEST['id_quiz']."
                AND c.url_usuario = p.url_usuario
                AND p.url_usuario = '".$_REQUEST['u']."'
                AND p.exp_sistemas = 'Muy bajo'
                AND p.def = 'Si'";

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

            $sql = "SELECT ROUND(AVG(p.nota),2) AS NUM_PART FROM (SELECT c.nota FROM cu_propio".$_REQUEST['id_quiz']." c WHERE c.url_usuario = '".$_REQUEST['u']."' GROUP BY c.id_participante) p";

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

            $sql = "SELECT c.id_participante, AVG(c.nota) FROM cu_propio".$_REQUEST['id_quiz']." c WHERE c.url_usuario = '".$_REQUEST['u']."' GROUP BY c.id_participante";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            $valoresYY=array(); 
            $valoresX=array();

            //$row = mysqli_fetch_array($registro);
            while ($ver = mysqli_fetch_row($registro)){
                $valoresX[]=$ver[0];
                $valoresYY[]=$ver[1];
            }

            $sql_w = "SELECT c.id_participante AS COUNTT FROM cu_propio".$_REQUEST['id_quiz']." c WHERE c.url_usuario = '".$_REQUEST['u']."' GROUP BY c.id_participante";

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

            $sql_q = "SELECT c.id_participante AS COUNT FROM cu_propio".$_REQUEST['id_quiz']." c WHERE c.url_usuario = '".$_REQUEST['u']."' GROUP BY c.id_participante";

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
        <h5><strong>Resultados por pregunta: </strong></h5>
          <?php 
          $cont = 0;
            $connect = mysqli_connect("localhost", "root", "", "blog");
            
            $sql = "SELECT c.num_preguntas AS NUM_PREG FROM crear_cuestionario c WHERE c.url_usuario = '".$_REQUEST['u']."' ";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro);
            $num_preguntas = $row['NUM_PREG'];
            $sql_q = "SELECT c.num_opciones AS NUM_OPC FROM crear_cuestionario c WHERE c.url_usuario = '".$_REQUEST['u']."' ";

            $registro1 = mysqli_query($connect, $sql_q) or die(mysqli_error($connect));

            $row1 = mysqli_fetch_array($registro1);
            $num_opciones = $row1['NUM_OPC'];

            for ($i = 0; $i <= $num_preguntas -1; $i++){  ?>
                  <label for="tituloo"><b>Pregunta <?php echo $i+1; ?>:</b></label>
                  <label for="tituloo"><?php  

                  $connect = mysqli_connect("localhost", "root", "", "blog");

                  $sql = "SELECT p.pregunta AS PREGUNTA FROM pregunta_crear_cuestionario p WHERE p.id_quiz = ".$_REQUEST['id_quiz']." AND p.url_usuario = '".$_REQUEST['u']."' ";

                  $reg = mysqli_query($connect, $sql) or die(mysqli_error($connect));

                  $sql_count = "SELECT COUNT(p.pregunta) AS COUNT FROM pregunta_crear_cuestionario p WHERE p.id_quiz = ".$_REQUEST['id_quiz']." AND p.url_usuario = '".$_REQUEST['u']."' ";

                  $regg = mysqli_query($connect, $sql_count) or die(mysqli_error($connect));
                  $roww = mysqli_fetch_array($regg);
                  $cont_consulta = $roww['COUNT'];

                for ($w = 0; $w <= $cont_consulta -1; $w++){
                    $row = mysqli_fetch_array($reg);
                    $array2[$w] = $row['PREGUNTA'];
                }
                  echo $array2[$i];
                  
                  //echo "<pre>";
                  //print_r($array2);

                  ?></label>
                  <br>
                  <label for="url"><b>Respuesta: </b></label><br>
                <?php 
                  //$cont = 0;
                for ($j = 0; $j <= $num_opciones-1; $j++){  
                    $cont = $cont + 1;

                    $connect = mysqli_connect("localhost", "root", "", "blog");

                  $sql = "SELECT p.opciones_respuesta AS RESPUESTA FROM respuesta_crear_cuestionario p WHERE p.id_quiz = ".$_REQUEST['id_quiz']." AND p.url_usuario = '".$_REQUEST['u']."' ";

                  $reg = mysqli_query($connect, $sql) or die(mysqli_error($connect));

                  //$row = mysqli_fetch_array($reg);
                  
                  $sql_countt = "SELECT COUNT(p.opciones_respuesta) AS COUNTT FROM respuesta_crear_cuestionario p WHERE p.id_quiz = ".$_REQUEST['id_quiz']." AND p.url_usuario = '".$_REQUEST['u']."' ";

                  $reggt = mysqli_query($connect, $sql_countt) or die(mysqli_error($connect));
                  $roww = mysqli_fetch_array($reggt);
                  $cont_consultaa = $roww['COUNTT'];

                for ($y = 0; $y <= $cont_consultaa -1; $y++){
                    $row = mysqli_fetch_array($reg);
                    $array3[$y] = $row['RESPUESTA'];

                }

                  ?>
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

  ?>
  var data = [{
  values: [55,65],
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

                  <label name="<?php echo $array3[$cont-1]; ?>">&nbsp;<?php echo $array3[$cont-1]; ?></label><?php 
                  $sql = "SELECT ROUND((COUNT(p.respuesta)/(SELECT COUNT(*) FROM (SELECT p.id_participante FROM cu_propio1 p WHERE p.url_usuario = '".$_REQUEST['u']."' GROUP BY p.id_participante) c))*100,2) AS NUM_PART FROM cu_propio".$_REQUEST['id_quiz']." p WHERE p.respuesta ='".$array3[$cont-1]."' AND p.url_usuario = '".$_REQUEST['u']."' ";

                  $reggt = mysqli_query($connect, $sql) or die(mysqli_error($connect));
                  $row = mysqli_fetch_array($reggt);
                  $consultaa = $row['NUM_PART'];
                  echo ": ".$consultaa." %";
                  ?>
                  <br>
                  <?php } ?>
                  <?php } ?>        


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