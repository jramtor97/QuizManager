<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php
        if (!isset($titulo) || empty($titulo)) {
            $titulo = 'Blog de JavaDevOne';
        }
        
        echo "<title>$titulo</title>";
        ?>
        <!-- FALLA SOLO ESTA LINEA DE ABAJO -->
        <!-- <link href="<?php echo RUTA_CSS ?>bootstrap.min.css" rel="stylesheet"> -->

        <link href="<?php echo RUTA_CSS ?>font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo RUTA_CSS ?>estilos.css" rel="stylesheet">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
        html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
        </style>
</head>
<body>
<!--
PARA RETOCAR LOS ESTILOS DE LAS LETRAS Y COPIARLOS CON RESPECTO A LAS OTRAS BARRAS TENEMOS QUE RETOCAR EN LAS CLASES DE LOS BOTONES
class=".........." -- aqui tienen todo el estilo
 -->
<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <div class="container">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>
</div>

<span onclick="window.location.href='./dashboard.php';" class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey">QuizManager</span>

  <div class="container">
    <?php
      if (ControlSesion::sesion_iniciada()) {
    ?>
    <span onclick="window.location.href='<?php echo RUTA_LOGOUT; ?>';" class="w3-bar-item w3-right"><span class="fa fa-sign-out" aria-hidden="true"></span>&nbsp;Cerrar sesión</span>
    
  <span onclick="window.location.href='<?php echo RUTA_PERFIL; ?>';" class="w3-bar-item w3-right"><span class="fa fa-user" aria-hidden="true"></span>&nbsp;<?php echo ' ' . $_SESSION['nombre_usuario']; ?></span>
    <?php
       } else {
    ?>
  <span onclick="window.location.href='<?php echo RUTA_REGISTRO; ?>';" class="w3-bar-item w3-right">Registro</span> 
  <span onclick="window.location.href='<?php echo RUTA_LOGIN; ?>';" class="w3-bar-item w3-right">Iniciar sesión</span>
                               
   <?php
      }
   ?>
  <!-- <span class="w3-bar-item w3-right">Logo</span> -->
</div>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="/w3images/avatar2.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Welcome, <strong>Mike</strong></span><br>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Menú</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Cerrar Menú</a>
    <a href="#" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>  Dashboard</a>
    <a href="./crear_proyecto.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Gestión de Proyectos</a>
    <style>
.collapsible {
  background-color: #777;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active, .collapsible:hover {
  background-color: #555;
}

.content {
  padding: 0 18px;
  display: none;
  overflow: hidden;
  background-color: #f1f1f1;
}
</style>
<button type="button" class="collapsible">Mis proyectos</button>
<div class="content">
<?php 
  $connect = mysqli_connect("localhost", "root", "", "blog");

  $sql = "SELECT DISTINCT p.id AS ID_PROYECTO FROM proyecto p WHERE p.id_usuario = ".$_SESSION['id_usuario']."";

  $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));
  
  while($row = mysqli_fetch_array($registro)){
        ?>
        <li><a href="dashboard_proyecto.php?id=<?php echo $row['ID_PROYECTO']; ?>"><?php 
          $connect = mysqli_connect("localhost", "root", "", "blog");

          $sql = "SELECT DISTINCT p.nombre AS NOMBRE FROM proyecto p WHERE p.id = ".$row['ID_PROYECTO']."";

          $registr = mysqli_query($connect, $sql) or die(mysqli_error($connect));
          $row = mysqli_fetch_array($registr);
          echo $row['NOMBRE'];

        ?></a></li>
    <?php
    }
?>
</div>
    <!--<a href="#" class="collapsible"><i class="fa fa-users fa-fw"></i>  Mis proyectos</a> -->
                
    <a href="./gestion_cuestionarios.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"></i>  Gestión de cuestionarios</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-diamond fa-fw"></i>  Mis cuestionarios</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bell fa-fw"></i>  Gestión de usuarios</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bank fa-fw"></i>  Darme de baja</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i>  History</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Settings</a><br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>


<script>
  var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}

</script>


</html>     
    </head>
    <body>
