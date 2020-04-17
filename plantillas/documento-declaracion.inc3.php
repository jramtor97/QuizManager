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
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<!-- <nav class="navbar navbar-default navbar-static-top"> -->
<nav class="navbar navbar-expand-sm navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Este botón despliega la barra de navegación</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> -->
            <a class="navbar-brand" href="<?php echo SERVIDOR ?>">QuizManager</a>
        </div>
  <!-- <a class="navbar-brand" href="#">Navbar</a> -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" style="background-color:#9c9c9c;">
<span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="nav navbar-nav ml-auto">
        <li>
            <a href="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-user" aria-hidden="true"></span>
               Participante: <?php 
                    // ESTA MAL!!!!!!!
                    //$connect = mysqli_connect("localhost", "root", "", "blog");

                    // $sql = "SELECT COUNT(participante)+1 AS NUM_PART FROM presentacion_usuario u";

                    // $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

                    // $row = mysqli_fetch_array($registro);
                    // print_r($_REQUEST);
                    // echo $row['NUM_PART'];
               ?>
            </a>
        </li>
    </ul>
  </div>
   </div>  
</nav>
<br>
</body>
</html>     
    </head>
    <body>
