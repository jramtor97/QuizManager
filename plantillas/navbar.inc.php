<?php
include_once 'app/ControlSesion.inc.php';
include_once 'app/config.inc.php';

Conexion :: abrir_conexion();
$total_usuarios = RepositorioUsuario :: obtener_numero_usuarios(Conexion::obtener_conexion());
?>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Este botón despliega la barra de navegación</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo SERVIDOR ?>/">QuizManager</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">	
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (ControlSesion::sesion_iniciada()) {
                    ?>
                    <li>
                        <a href="<?php echo RUTA_PERFIL; ?>">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <?php echo ' ' . $_SESSION['nombre_usuario']; ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo RUTA_GESTOR; ?>">
                            <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Gestor
                        </a>
                    </li> 
                    <li>
                        <a href="<?php echo RUTA_LOGOUT; ?>">
                            <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Cerrar sesión
                        </a>
                    </li>
                    <?php
                } else {
                    ?>
                    <!-- <li>
                        <a href="#">
                            <span class="fa fa-users" aria-hidden="true"></span>
                            <?php
                            //echo $total_usuarios;
                            ?>
                        </a>
                    </li> -->
                    <li>
                        <a href="<?php echo RUTA_LOGIN ?>">
                            <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Iniciar sesión
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo RUTA_REGISTRO ?>">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Registro
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
