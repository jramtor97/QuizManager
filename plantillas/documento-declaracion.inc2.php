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
                <?php
                if (ControlSesion::sesion_iniciada()) {
                    ?>
                    <li>
                        <a href="<?php echo RUTA_PERFIL; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-user" aria-hidden="true"></span>
                            <?php echo ' ' . $_SESSION['nombre_usuario']; ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo RUTA_GESTOR; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-dashboard" aria-hidden="true"></span> Gestor
                        </a>
                    </li> 
                    <li>
                        <a href="<?php echo RUTA_LOGOUT; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-sign-out" aria-hidden="true"></span> Cerrar sesión
                        </a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li>
                        <a href="<?php echo RUTA_LOGIN ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-sign-in" aria-hidden="true"></span> Iniciar sesión
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo RUTA_REGISTRO ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-plus" aria-hidden="true"></span> Registro
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
  </div>
   </div>  
</nav>
<br>
</body>
</html>     
    </head>
    <body>
