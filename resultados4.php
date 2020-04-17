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
      <div id='ffii'></div>
    </div>
  </div>
  </head>
<?php
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT r.url_usuario, r.puntuacion_final FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            $valoresYY=array(); 
            $valoresX=array();

            //$row = mysqli_fetch_array($registro);
            while ($ver = mysqli_fetch_row($registro)){
                $valoresX[]=$ver[0];
                $valoresYY[]=$ver[1];
            }

            $sql_w = "SELECT COUNT(r.puntuacion_final) AS COUNTT FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registr = mysqli_query($connect, $sql_w) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($registr);
            $countt = $row['COUNTT'];
            //echo $countt;
            //print_r($valoresYY);
            $valoresY = array();
            for ($i = 1; $i <= $countt; $i++){
                $valoresY[$i] = $valoresYY[$i-1];
            }
            echo "<pre>";
            print_r($valoresY);

            for ($i = 1; $i <= $countt; $i++){
                if ($valoresY[$i] < 50) {
                    $valoresY[$i] = $valoresY[$i] * -1;
                }
            }

            $array_p = array();

            $sql_q = "SELECT COUNT(r.url_usuario) AS COUNT FROM respuestas r
            WHERE r.id_proyecto = 2";

            $registro_q = mysqli_query($connect, $sql_q) or die(mysqli_error($connect));

            $row = mysqli_fetch_array($registro_q);
            $cont = $row['COUNT'];
            
            for ($i = 1; $i <= $cont; $i++){
              //$cont = $cont +1;
              $array_p[$i] = '#'.$i;
            }

            echo "<pre>";
            print_r($valoresY);

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

            echo "<pre>";
            print_r($valoresY);

            echo "<pre>";
            print_r($array_posiciones_positivas);

            //echo "<pre>";
            print_r($array_datosY_positivas);
            
            //echo "<pre>";
            print_r($array_posiciones_negativas);
            
            //echo "<pre>";
            print_r($array_datosY_negativas);

            //$datosX = json_encode($array_p);
            //$datosY = json_encode($valoresY);
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
      x: [1, '<?php echo $countt; ?>'], //num veces que se repite la linea hasta el num participantes será
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

    Plotly.newPlot('ffii', data, layout);

</script>

</body>
</html>

