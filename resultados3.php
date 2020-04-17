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
  <br>
  <br>
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

            $sql = "SELECT r.valor_eficiencia,r.valor_afecto,r.valor_ayuda,r.valor_control, r.valor_aprendizaje,r.valor_usabilidad_global FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            //$valoresYY=array(); 
            //$valoresX=array();
            $valor_efi = array();
            $valor_efi_neg = array();
            $valor_afe = array();
            $valor_ayu = array();
            $valor_ctr = array();
            $valor_apr = array();
            $valor_ubg = array();

            //$row = mysqli_fetch_array($registro);
            while ($ver = mysqli_fetch_row($registro)){
                //$valoresX[]=$ver[0];
                //$valoresYY[]=$ver[1];
                $valor_efi[] = $ver[0];
                $valor_afe[] = $ver[1];
                $valor_ayu[] = $ver[2];
                $valor_ctr[] = $ver[3];
                $valor_apr[] = $ver[4];
                $valor_ubg[] = $ver[5];
            }

            $sql = "SELECT AVG(r.valor_eficiencia) AS AVG FROM respuestas_sumi r
            WHERE r.id_proyecto = ".$_REQUEST['id']."";
            
            $regist = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($regist);
            $med_efi = $row['AVG'];

            

            if ($med_efi < 50) {
                $med_efi_neg = $med_efi * -1;
            } else {
                $med_efi = $med_efi - 50;
            }


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
        x: [ 'Afecto', 'Ayuda', 'Control', 'Capacidad de aprendizaje', 'Usabilidad Global' ],
        y: [58,44,22,85,65],
        name: "Aprobado",
        base: 50,
        type: 'bar',
        marker: {
          color: 'green'
        },
    };

    var trace2 = {
        x: ['Eficiencia'],
        y: [-35],
        name: "Suspenso",
        base: 50,
        type: 'bar',
        marker: {
          color: 'red'
        },
    };

    var cl={
      type: 'scatter',
     x: [0,5], //num veces que se repite la linea hasta el num participantes será
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
          title: 'Número de secciones'
        },
        yaxis:{
          title: 'Puntuación sección'
        }

      };

    var data = [trace1, trace2, cl];
    var config = {responsive:true};
    Plotly.newPlot('ffiih', data, layout, config);

</script>

</body>
</html>

