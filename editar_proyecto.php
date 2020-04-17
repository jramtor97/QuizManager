<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/ValidadorRegistro.inc.php';

$titulo = "Nuevo proyecto";

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';

// SI NO EXISTE LA SESION IR A LOGIN
if (!isset($_SESSION['nombre_usuario'])) {
  Redireccion :: redirigir(RUTA_LOGIN);
}

//echo "<pre>";
//print_r($_POST);
//echo $_SERVER['REQUEST_URI'];
$resultado = substr($_SERVER['REQUEST_URI'], 29);

//echo $_REQUEST['id'];
//echo $resultado;

if(!isset($_REQUEST['id']) || $_REQUEST['id'] == '' || !isset($resultado) || $resultado == ''){
  Redireccion::redirigir('vistas/404.php');
}

$connect = mysqli_connect("localhost", "root", "", "blog");

$sql_q = "SELECT p.id AS ID FROM proyecto p WHERE p.id = ".$resultado."";

$reg = mysqli_query($connect, $sql_q) or die(mysqli_error($connect));
$row = mysqli_fetch_array($reg);
    //echo $row['ID'];
    //echo $resultado;
    //echo "<br>";
    //echo $row['ID'];
$h = $row['ID'];

//echo $row['ID'];
if (!isset($resultado) || $row['ID']== '' || $resultado == '' || $resultado != $row['ID']) {
      //echo "hola";
        //header('Location: editar_proyecto.php?id=' . $row['ID']);
      Redireccion::redirigir('vistas/404.php');
}


?>

<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">


<div class="container">
    <div class="jumbotron">
        <h1 class="text-center">Editar proyecto</h1>
    </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12" >
      <form class="form-nueva-entrada" method="post" action="javascript:crearProyecto()" id="formulario">
          <label for="titulo"><b>Nombre:</b></label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ponga un título al proyecto" required value="<?php
                $connect = mysqli_connect("localhost", "root", "", "blog");

                $sql = "SELECT p.nombre AS NOMBRE FROM proyecto p WHERE p.id = ".$_REQUEST['id']." ";

                $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

                $row = mysqli_fetch_array($registro);
                echo $row['NOMBRE'];

            ?>">
            <br>
            <label for="contenido"><b>Descripción:</b></label>
            <textarea class="form-control" rows="5" id="contenido" name="texto" placeholder="Escriba de qué trata su proyecto" required><?php 
                $connect = mysqli_connect("localhost", "root", "", "blog");

                $sql = "SELECT p.descripcion AS DESCRIPCION FROM proyecto p WHERE p.id = ".$_REQUEST['id']." ";

                $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

                $row = mysqli_fetch_array($registro);
                echo $row['DESCRIPCION'];

            ?></textarea>
            <br>
            <label for="url"><b>Tipo de cuestionario:</b></label>
            <select id="desplegable" name="select1" disabled >
              <option value="" disabled selected><?php
                $connect = mysqli_connect("localhost", "root", "", "blog");

                $sql = "SELECT p.cuestionario AS CUESTIONARIO FROM proyecto p WHERE p.id = ".$_REQUEST['id']." ";

                $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

                $row = mysqli_fetch_array($registro);
                echo $row['CUESTIONARIO'];

            ?></option>
            </select>
        <br>
        <br>
        <button type="button" class="btn btn-primary" name="guardar" id="ver_proyecto" onclick="location.href='crear_proyecto.php'"><span class="glyphicon glyphicon-arrow-left"></span>   Ver proyectos</button>
        <br>
        <br>
        <input type="submit" class="btn btn-primary" name="guardar" id="enviarForm" value="Modificar proyecto" onclick="e()">
        <br>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
    function crearProyecto(){
        var nombre = $('#titulo').val();
        var descripcion = $('#contenido').val();

        $.ajax({
                  type: "POST",
                  url: "ajax_editar_proyecto.php",
                  data: {
                      id: "<?=$_REQUEST['id']?>",
                      nombre: nombre,
                      descripcion: descripcion,
                  },
                  success: function (data) {
                          swal({
                            title: "Proyecto modificado con éxito",
                            text: "Visualice los proyectos actuales",
                            type: "success",
                            confirmButtonText: "Aceptar"
                          },
                          function(isConfirm){
                            if (isConfirm) {
                              setTimeout(function () {
                              window.location.href = "crear_proyecto.php";
                            }, 100);
                            }
                          });
                  }
              });
    }

    function e(){
        var nombre = $('#titulo').val();
        var descripcion = $('#contenido').val();
        var cuestionario = $('#desplegable').val();

      if (nombre == '' && descripcion == ''){
        document.getElementById('titulo').style.borderColor = "red";
        document.getElementById('contenido').style.borderColor = "red";
      } else {
        if (nombre == '') {
          document.getElementById('titulo').style.borderColor = "red";
        }
        if (descripcion == ''){
          document.getElementById('contenido').style.borderColor = "red";
        }
         
        if (nombre != '' && descripcion != '' && cuestionario != null) {
      
        }
          
      }
    }
</script>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>