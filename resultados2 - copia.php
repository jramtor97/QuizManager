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
      <div id='plotly-div'></div>
    </div>
  </div>
  </head>
<?php
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT r.id_pregunta, r.valor FROM prueba r
            WHERE r.id_proyecto = 2";

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
     trace1 = {
      mode: 'markers', 
      type: 'scatter', 
      x: [23.6, 32.4, 13.6, 22.8, 16.1, 20.0, 17.8, 14.0, 19.6, 16.8, 21.5, 18.9, 7.0, 21.2, 18.5, 29.8, 18.8, 10.2, 50.0, 14.1, 25.2, 29.1, 12.7, 22.4, 14.2, 13.8, 20.3, 14.9, 21.7, 18.3, 23.1, 23.8, 15.0, 20.8, 19.1, 19.4, 34.7, 19.5, 24.4, 23.4, 19.7, 28.2, 50.0, 17.4, 22.6, 15.1, 13.1, 24.2, 19.9, 24.0, 18.9, 35.4, 15.2, 26.5, 43.5, 21.2, 18.4, 28.5, 23.9, 18.5, 25.0, 35.4, 31.5, 20.2, 24.1, 20.0, 13.1, 24.8, 30.8, 12.7, 20.0, 23.7, 10.8, 20.6, 20.8, 5.0], 
      y: [23.740350276313265, 26.79545892048593, 19.87233260693674, 20.604844036241303, 22.67731539720054, 22.516520205401978, 19.25595103837559, 21.578548253243714, 22.069866894850417, 20.26538752022212, 19.586474488183743, 20.059926997368397, 6.7943236739870425, 22.09666609348352, 17.41573939890316, 28.778599619334873, 18.943293720989498, 10.01916057616931, 36.77369387820781, 21.67681198156504, 22.168130623171766, 24.329932646241318, 17.460404729958313, 25.32150299566579, 20.077793129790468, 14.905547793603382, 18.898628389934334, 26.527466934154994, 19.66687208408303, 18.183983093051843, 16.200842394202912, 23.82968093842357, 31.75331066760826, 14.324898489886362, 20.050993931157365, 17.424672465114188, 30.609878192596263, 18.85396305887918, 20.595910970030275, 22.21279595422692, 14.575024343795228, 27.60836794568978, 38.194051405761776, 16.397369850845607, 23.749283342524286, 17.460404729958313, 17.353207935425935, 23.749283342524286, 21.51601678976649, 25.160707803867226, 20.10459232842356, 28.671402824802495, 21.292690134490712, 27.000919443339647, 33.155802062740165, 22.81131139036601, 21.98053623274011, 27.715564740222145, 23.49915748861542, 16.495633579166945, 26.831191185330056, 31.181594430102265, 24.955247281013502, 15.164606713723302, 25.19644006871135, 14.164103298087799, 24.231668917919983, 22.721980728255694, 25.33936912808785, 19.809801143459527, 18.112518563363587, 26.72399439079769, 18.71996706571372, 19.452478495018273, 21.27482400206864, 15.137807515090199]
    };
trace2 = {
  mode: 'lines', 
  name: 'lines', 
  type: 'scatter', 
  x: [23.6, 32.4, 13.6, 22.8, 16.1, 20.0, 17.8, 14.0, 19.6, 16.8, 21.5, 18.9, 7.0, 21.2, 18.5, 29.8, 18.8, 10.2, 50.0, 14.1, 25.2, 29.1, 12.7, 22.4, 14.2, 13.8, 20.3, 14.9, 21.7, 18.3, 23.1, 23.8, 15.0, 20.8, 19.1, 19.4, 34.7, 19.5, 24.4, 23.4, 19.7, 28.2, 50.0, 17.4, 22.6, 15.1, 13.1, 24.2, 19.9, 24.0, 18.9, 35.4, 15.2, 26.5, 43.5, 21.2, 18.4, 28.5, 23.9, 18.5, 25.0, 35.4, 31.5, 20.2, 24.1, 20.0, 13.1, 24.8, 30.8, 12.7, 20.0, 23.7, 10.8, 20.6, 20.8, 5.0], 
  y: [23.6, 32.4, 13.6, 22.8, 16.1, 20.0, 17.8, 14.0, 19.6, 16.8, 21.5, 18.9, 7.0, 21.2, 18.5, 29.8, 18.8, 10.2, 50.0, 14.1, 25.2, 29.1, 12.7, 22.4, 14.2, 13.8, 20.3, 14.9, 21.7, 18.3, 23.1, 23.8, 15.0, 20.8, 19.1, 19.4, 34.7, 19.5, 24.4, 23.4, 19.7, 28.2, 50.0, 17.4, 22.6, 15.1, 13.1, 24.2, 19.9, 24.0, 18.9, 35.4, 15.2, 26.5, 43.5, 21.2, 18.4, 28.5, 23.9, 18.5, 25.0, 35.4, 31.5, 20.2, 24.1, 20.0, 13.1, 24.8, 30.8, 12.7, 20.0, 23.7, 10.8, 20.6, 20.8, 5.0]
};
data = [trace1, trace2];
layout = {
  title: 'Linear Regression', 
  xaxis: {
    title: 'Actual', 
    titlefont: {
      size: 18, 
      color: '#7f7f7f', 
      family: 'Courier New, monospace'
    }
  }, 
  yaxis: {
    title: 'Predicted', 
    titlefont: {
      size: 18, 
      color: '#7f7f7f', 
      family: 'Courier New, monospace'
    }
  }
};
Plotly.plot('plotly-div', {
  data: data,
  layout: layout
});
      //Plotly.newPlot('myDiv', data, layout);
  </script>

</body>
</html>

