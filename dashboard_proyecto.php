<?php

include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/config.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

$titulo = 'Lista de proyectos';

include_once 'plantillas/documento-declaracion.inc5.php';

if (!isset($_SESSION['nombre_usuario'])) {
  Redireccion :: redirigir(RUTA_LOGIN);
}

//include_once 'plantillas/navbar.inc.php';

//echo "<pre>";
//print_r($_SESSION);
// SI NO EXISTE LA SESION IR A LOGIN

//print_r($_REQUEST);
// echo "<br>";
// echo "<br>";
// echo "<br>";
$connect = mysqli_connect("localhost", "root", "", "blog");

$sql = "SELECT DISTINCT p.cuestionario AS CUESTIONARIO FROM proyecto p WHERE p.id = ".$_REQUEST['id']."";

$registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

$row = mysqli_fetch_array($registro);
$quiz = $row['CUESTIONARIO'];

if ($quiz == "SUS"){
  $sql = "SELECT AVG(r.puntuacion_final) AS PUNT FROM respuestas r WHERE r.id_proyecto = ".$_REQUEST['id']."";

  $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

  $row = mysqli_fetch_array($registro);
  $nota_final = round($row['PUNT'],2);

  $sql1 = "SELECT COUNT(r.puntuacion_final) AS CONT_PART FROM respuestas r WHERE r.id_proyecto = ".$_REQUEST['id']."";

  $registro1 = mysqli_query($connect, $sql1) or die(mysqli_error($connect));

  $row1 = mysqli_fetch_array($registro1);
  $participantes = $row1['CONT_PART'];

  if ($nota_final < 25 ) {
    $interpretacion = "Mediocre";
  } else if ($nota_final >= 25 AND $nota_final < 50) {
    $interpretacion = "Pobre";
  } else if ($nota_final >= 50 AND $nota_final < 73) {
    $interpretacion = "Bien";
  } else if ($nota_final >= 73 AND $nota_final < 85) {
    $interpretacion = "Bueno";
  } else if ($nota_final >= 85 AND $nota_final <= 100) {
    $interpretacion = "Excelente";
  }


} else if ($quiz == "SUMI"){

  $sql = "SELECT AVG(r.puntuacion_final) AS PUNT FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

  $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

  $row = mysqli_fetch_array($registro);
  $nota_final = round($row['PUNT'],2);

  $sql1 = "SELECT COUNT(r.puntuacion_final) AS CONT_PART FROM respuestas_sumi r WHERE r.id_proyecto = ".$_REQUEST['id']."";

  $registro1 = mysqli_query($connect, $sql1) or die(mysqli_error($connect));

  $row1 = mysqli_fetch_array($registro1);
  $participantes = $row1['CONT_PART'];

  if ($nota_final < 25 ) {
    $interpretacion = "Mediocre";
  } else if ($nota_final >= 25 AND $nota_final < 50) {
    $interpretacion = "Pobre";
  } else if ($nota_final >= 50 AND $nota_final < 73) {
    $interpretacion = "Bien";
  } else if ($nota_final >= 73 AND $nota_final < 85) {
    $interpretacion = "Bueno";
  } else if ($nota_final >= 85 AND $nota_final <= 100) {
    $interpretacion = "Excelente";
  }

} else if ($quiz == "Smileyometer"){

  $sql = "SELECT AVG(r.puntuacion_final) AS PUNT FROM respuestas_smil r WHERE r.id_proyecto = ".$_REQUEST['id']."";

  $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

  $row = mysqli_fetch_array($registro);
  $nota_final = round($row['PUNT'],2);

  $sql1 = "SELECT COUNT(r.puntuacion_final) AS CONT_PART FROM respuestas_smil r WHERE r.id_proyecto = ".$_REQUEST['id']."";

  $registro1 = mysqli_query($connect, $sql1) or die(mysqli_error($connect));

  $row1 = mysqli_fetch_array($registro1);
  $participantes = $row1['CONT_PART'];

  if ($nota_final < 25 ) {
    $interpretacion = "Mediocre";
  } else if ($nota_final >= 25 AND $nota_final < 50) {
    $interpretacion = "Pobre";
  } else if ($nota_final >= 50 AND $nota_final < 73) {
    $interpretacion = "Bien";
  } else if ($nota_final >= 73 AND $nota_final < 85) {
    $interpretacion = "Bueno";
  } else if ($nota_final >= 85 AND $nota_final <= 100) {
    $interpretacion = "Excelente";
  }

}

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
   <!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    
  </header>

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $nota_final; ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Puntuación</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $interpretacion; ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Resultado</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $participantes; ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Participantes</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>23</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Fecha</h4>
      </div>
    </div>
    
  </div>

      
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <script src='https://cdn.plot.ly/plotly-latest.min.js'></script>
        <div id='myDiv'><!-- Plotly chart will be drawn inside this DIV --></div>

        <script type="text/javascript">
          $(function () {

function obtenerAncho( obj, ancho ) {
  //$( "#anvent" ).text( "El ancho de la " + obj + " es " + ancho + "px. (Width)" );
  var data = [{
  values: [16, 15, 12, 6, 5, 4, 42],
  labels: ['US', 'China', 'European Union', 'Russian Federation', 'Brazil', 'India', 'Rest of World' ],
  domain: {column: 0},
  name: 'GHG Emissions',
  hoverinfo: 'label+percent+name',
  hole: .4,
  type: 'pie'
},{
  values: [27, 11, 25, 8, 1, 3, 25],
  labels: ['US', 'China', 'European Union', 'Russian Federation', 'Brazil', 'India', 'Rest of World' ],
  text: 'CO2',
  textposition: 'inside',
  domain: {column: 1},
  name: 'CO2 Emissions',
  hoverinfo: 'label+percent+name',
  hole: .4,
  type: 'pie',

},
{
  values: [16, 15, 12, 6, 5, 4, 42],
  labels: ['US', 'China', 'European Union', 'Russian Federation', 'Brazil', 'India', 'Rest of World' ],
  domain: {column: 2},
  name: 'GHG Emissions',
  hoverinfo: 'label+percent+name',
  hole: .4,
  type: 'pie'
},{
  values: [27, 11, 25, 8, 1, 3, 25],
  labels: ['US', 'China', 'European Union', 'Russian Federation', 'Brazil', 'India', 'Rest of World' ],
  text: 'CO2',
  textposition: 'inside',
  domain: {column: 3},
  name: 'CO2 Emissions',
  hoverinfo: 'label+percent+name',
  hole: .4,
  type: 'pie',

}];

if (ancho < 1900){
    var layout = {
  title: 'Gráfico edad - Gráfico género - Gráfico experiencia internet - Gráfico experiencia sistemas parecidos',
  annotations: [
    {
      font: {
        size: 20
      },
      showarrow: false,
      text: 'GHG',
      x: 0.085,
      y: 1.2
    },
    {
      font: {
        size: 20
      },
      showarrow: false,
      text: 'CO2',
      x: 0.82,
      y: 0.5
    }
  ],
  height: 400,
  width: ancho,
  showlegend: false,
  grid: {rows: 1, columns: 4}
};
Plotly.newPlot('myDiv', data, layout);
} else {
    var layout1 = {
  title: 'Gráfico edad - Gráfico género - Gráfico experiencia internet - Gráfico experiencia sistemas parecidos',
  annotations: [
    {
      font: {
        size: 20
      },
      showarrow: false,
      text: 'GHG',
      x: 0.2,
      y: 0.0
    },
    {
      font: {
        size: 20
      },
      showarrow: false,
      text: 'CO2',
      x: 0.5,
      y: 0.2
    }
  ],
  height: 400,
  width: ancho - 300, //ajuste pantalla!!
  showlegend: false,
  grid: {rows: 1, columns: 4}
};
  Plotly.newPlot('myDiv', data, layout1);
}
}

function obtenerAlto( obj, alto ) {
  //$( "#alvent" ).text( "El alto de la " + obj + " es " + alto + "px. (Height)" );
}
obtenerAlto( "ventana", $( window ).height() );
     obtenerAncho( "ventana", $( window ).width() );
$(window).resize(function(){

          obtenerAlto( "ventana", $( window ).height() );
     obtenerAncho( "ventana", $( window ).width() );
 

});
});
          
        </script>

      <div class="w3-twothird">
        <h5>Feeds</h5>
        <script src='https://cdn.plot.ly/plotly-latest.min.js'></script>
        <div id='myDivo'><!-- Plotly chart will be drawn inside this DIV --></div>
        <script type="text/javascript">
            var data = [{
                x: ['giraffes', 'orangutans', 'monkeys'],
                y: [20, 14, 23],
                type: 'bar'}];
            Plotly.newPlot('myDivo', data);
        </script>
      </div>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>General Stats</h5>
    <p>New Visitors</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-green" style="width:25%">+25%</div>
    </div>

    <p>New Users</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-orange" style="width:50%">50%</div>
    </div>

    <p>Bounce Rate</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-red" style="width:75%">75%</div>
    </div>
  </div>
  <hr>

  <div class="w3-container">
    <h5>Countries</h5>
    <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
      <tr>
        <td>United States</td>
        <td>65%</td>
      </tr>
      <tr>
        <td>UK</td>
        <td>15.7%</td>
      </tr>
      <tr>
        <td>Russia</td>
        <td>5.6%</td>
      </tr>
      <tr>
        <td>Spain</td>
        <td>2.1%</td>
      </tr>
      <tr>
        <td>India</td>
        <td>1.9%</td>
      </tr>
      <tr>
        <td>France</td>
        <td>1.5%</td>
      </tr>
    </table><br>
    <button class="w3-button w3-dark-grey">More Countries  <i class="fa fa-arrow-right"></i></button>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Recent Users</h5>
    <ul class="w3-ul w3-card-4 w3-white">
      <li class="w3-padding-16">
        <img src="/w3images/avatar2.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge">Mike</span><br>
      </li>
      <li class="w3-padding-16">
        <img src="/w3images/avatar5.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge">Jill</span><br>
      </li>
      <li class="w3-padding-16">
        <img src="/w3images/avatar6.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge">Jane</span><br>
      </li>
    </ul>
  </div>
  <hr>

  <div class="w3-container">
    <h5>Recent Comments</h5>
    <div class="w3-row">
      <div class="w3-col m2 text-center">
        <img class="w3-circle" src="/w3images/avatar3.png" style="width:96px;height:96px">
      </div>
      <div class="w3-col m10 w3-container">
        <h4>John <span class="w3-opacity w3-medium">Sep 29, 2014, 9:12 PM</span></h4>
        <p>Keep up the GREAT work! I am cheering for you!! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><br>
      </div>
    </div>

    <div class="w3-row">
      <div class="w3-col m2 text-center">
        <img class="w3-circle" src="/w3images/avatar1.png" style="width:96px;height:96px">
      </div>
      <div class="w3-col m10 w3-container">
        <h4>Bo <span class="w3-opacity w3-medium">Sep 28, 2014, 10:15 PM</span></h4>
        <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><br>
      </div>
    </div>
  </div>
  <br>
  <div class="w3-container w3-dark-grey w3-padding-32">
    <div class="w3-row">
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-green">Demographic</h5>
        <p>Language</p>
        <p>Country</p>
        <p>City</p>
      </div>
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-red">System</h5>
        <p>Browser</p>
        <p>OS</p>
        <p>More</p>
      </div>
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-orange">Target</h5>
        <p>Users</p>
        <p>Active</p>
        <p>Geo</p>
        <p>Interests</p>
      </div>
    </div>
  </div>

  <div class="w3-container w3-dark-grey w3-padding-32">
    <div class="w3-row">
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-green">Demographic</h5>
        <p>Language</p>
        <p>Country</p>
        <p>City</p>
      </div>
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-red">System</h5>
        <p>Browser</p>
        <p>OS</p>
        <p>More</p>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>FOOTER</h4>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
  </footer>

  <!-- End page content -->
</div>

  </body>
</html>


