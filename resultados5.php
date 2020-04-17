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
      <div id='graph'></div>
    </div>
  </div>
  </head>
<?php
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT r.url_usuario, r.puntuacion_final FROM respuestas r
            WHERE r.id_proyecto = 2";

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
                WHERE r.id_proyecto = 2
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS EXCELENTE FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = 2
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND r.puntuacion_final >= 85";

              $registro1 = mysqli_query($connect, $sql_excelente) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro1);
              $excelente = $row['EXCELENTE'];
              $array_radar[0] = $excelente . " %";

              $sql_bueno = "SELECT ROUND((COUNT(r.puntuacion_final)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = 2
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS BUENO FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = 2
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND r.puntuacion_final BETWEEN 73 AND 84.99";

              $registro1 = mysqli_query($connect, $sql_bueno) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro1);
              $bueno = $row['BUENO'];
              $array_radar[1] = $bueno . " %";

              $sql_bien = "SELECT ROUND((COUNT(r.puntuacion_final)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = 2
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS BIEN FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = 2
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND r.puntuacion_final BETWEEN 50 AND 72.99";

              $registro1 = mysqli_query($connect, $sql_bien) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro1);
              $bien = $row['BIEN'];
              $array_radar[2] = $bien . " %";

              $sql_pobre = "SELECT ROUND((COUNT(r.puntuacion_final)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = 2
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS POBRE FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = 2
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND r.puntuacion_final BETWEEN 25 AND 49.99";

              $registro1 = mysqli_query($connect, $sql_pobre) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro1);
              $pobre = $row['POBRE'];
              $array_radar[3] = $pobre . " %";


              $sql_mediocre = "SELECT ROUND((COUNT(r.puntuacion_final)/(SELECT COUNT(*) FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = 2
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'))*100,2) AS MEDIOCRE FROM respuestas r, rec r1, presentacion_usuario p, proyecto p1
                WHERE r.id_proyecto = 2
                AND r.id_proyecto = r1.id_proyecto
                AND r1.url_secreta = p.url
                AND p.def = 'Si'
                AND r.puntuacion_final BETWEEN 0 AND 24.99";

              $registro1 = mysqli_query($connect, $sql_mediocre) or die(mysqli_error($connect));

              $row = mysqli_fetch_array($registro1);
              $mediocre = $row['MEDIOCRE'];
              $array_radar[4] = $mediocre . " %";

              echo "<pre>";
              print_r($array_radar);

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

    Plotly.newPlot("graph", data, layout);

</script>

</body>
</html>

