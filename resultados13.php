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
      <div id='myDivv'></div>
    </div>
  </div>
  </head>
<?php
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT r.valor_eficiencia AS EFI FROM respuestas_sumi r
            WHERE r.id_proyecto = 6";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $valor_efi=array(); 

            while($row = mysqli_fetch_array($registro)){
                  $valor_efi[] = $row['EFI'];
            };
          
            echo "<pre>";
            print_r($valor_efi);
            
            $valor_efi=json_encode($valor_efi);

            $sql = "SELECT r.valor_afecto AS AFE FROM respuestas_sumi r
            WHERE r.id_proyecto = 6";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $valor_afec=array(); 

            while($row = mysqli_fetch_array($registro)){
                  $valor_afec[] = $row['AFE'];
            };
          
            echo "<pre>";
            print_r($valor_afec);
            
            $valor_afec=json_encode($valor_afec);

            $sql = "SELECT r.valor_ayuda AS AYU FROM respuestas_sumi r
            WHERE r.id_proyecto = 6";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $valor_ayu=array(); 

            while($row = mysqli_fetch_array($registro)){
                  $valor_ayu[] = $row['AYU'];
            };
          
            echo "<pre>";
            print_r($valor_ayu);
            
            $valor_ayu=json_encode($valor_ayu);

            $sql = "SELECT r.valor_control AS CTR FROM respuestas_sumi r
            WHERE r.id_proyecto = 6";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $valor_ctr=array(); 

            while($row = mysqli_fetch_array($registro)){
                  $valor_ctr[] = $row['CTR'];
            };
          
            echo "<pre>";
            print_r($valor_ctr);
            
            $valor_ctr=json_encode($valor_ctr);

            $sql = "SELECT r.valor_aprendizaje AS APR FROM respuestas_sumi r
            WHERE r.id_proyecto = 6";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $valor_apr=array(); 

            while($row = mysqli_fetch_array($registro)){
                  $valor_apr[] = $row['APR'];
            };
          
            echo "<pre>";
            print_r($valor_apr);
            
            $valor_apr=json_encode($valor_apr);

            $sql = "SELECT r.valor_usabilidad_global AS USB FROM respuestas_sumi r
            WHERE r.id_proyecto = 6";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $valor_usb=array(); 

            while($row = mysqli_fetch_array($registro)){
                  $valor_usb[] = $row['USB'];
            };
          
            echo "<pre>";
            print_r($valor_usb);
            
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
    title: 'Points Scored by the Top 9 Scoring NBA Players in 2012',
    yaxis: {
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
    paper_bgcolor: 'rgb(243, 243, 243)',
    plot_bgcolor: 'rgb(243, 243, 243)',
    showlegend: false
};

Plotly.newPlot('myDivv', data, layout);

  </script>



</body>
</html>

