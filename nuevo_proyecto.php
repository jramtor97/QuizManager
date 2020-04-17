<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';

include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/ValidadorRegistro.inc.php';

$titulo = "Nuevo proyecto";

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';

// SI NO EXISTE LA SESION IR A LOGIN
if (!isset($_SESSION['nombre_usuario'])) {
  Redireccion :: redirigir(RUTA_LOGIN);
}


//print_r($_REQUEST);
//echo $_SERVER['REQUEST_URI'];
$resultado = substr($_SERVER['REQUEST_URI'], 28);
//echo $resultado;
$connect = mysqli_connect("localhost", "root", "", "blog");

$sql_q = "SELECT COUNT(IFNULL(id, 1))+1 AS ID FROM proyecto";

$reg = mysqli_query($connect, $sql_q) or die(mysqli_error($connect));
$row = mysqli_fetch_array($reg);
//echo $row['ID'];
//echo $resultado;
//echo "<br>";
//echo $row['ID'];
if ($resultado == '' || $resultado != $row['ID']) {
  //echo "hola";
    header('Location: nuevo_proyecto.php?id=' . $row['ID']);
}

?>
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

<!-- <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script> -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> -->

<div class="container">
    <div class="jumbotron">
        <h1 class="text-center">Nuevo proyecto</h1>
    </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12" >
      <!--Ponemos la clase form-nueva-entrada para los estilos definidos en estilos.css -->
      <form class="form-nueva-entrada" method="post" action="javascript:crearProyecto()" id="formulario">
          <label for="titulo"><b>Nombre:</b></label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ponga un título al proyecto" required>
            <br>
            <label for="contenido"><b>Descripción:</b></label>
            <textarea class="form-control" rows="5" id="contenido" name="texto" placeholder="Escriba de qué trata su proyecto" required></textarea>
            <br>
            <label for="url"><b>Tipo de cuestionario:</b></label>
            <select id="desplegable" name="select1" required>
              <option value="" disabled selected>--SELECCIONE--</option>
              <option value="SUS">SUS</option>
              <option value="SUMI">SUMI</option>
              <option value="Smileyometer">Smileyometer</option>
              <option value="Nuevo cuestionario">Nuevo cuestionario</option>
            </select>
        
        <br>
        <br>
        <input type="submit" class="btn btn-primary" name="guardar" id="enviarForm" value="Guardar proyecto" onclick="e()">
        <button type="button" class="btn btn-primary" name="guardar" id="ver_proyecto" onclick="location.href='crear_proyecto.php'"><span class="glyphicon glyphicon-arrow-left"></span>   Ver proyectos</button>
        <br>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
    function crearProyecto(){
        var nombre = $('#titulo').val();
        var descripcion = $('#contenido').val();
        var cuestionario = $('#desplegable').val();

        $.ajax({
                  type: "POST",
                  url: "ajax_insertar_proyecto.php",
                  data: {
                      id: "<?=$_REQUEST['id']?>",
                      nombre: nombre,
                      descripcion: descripcion,
                      cuestionario: cuestionario
                  },
                  success: function (data) {
                         
                          swal({
                            title: "Proyecto creado con éxito",
                            text: "Visualice los proyectos actuales",
                            type: "success",
                            confirmButtonText: "Aceptar"
                          },
                          function(isConfirm){
                            if (isConfirm) {
                              var val = "<?php echo RUTA_GENERAR_URL_SECRETA1; ?>";
                              location.href=val;
                              setTimeout(function () {
                              window.location.href = "crear_proyecto.php";
                            }, 100);
                            }
                          });  
                    //location.href="crear_proyecto.php";
                   //$('#example').DataTable().ajax.reload();

                  }
              });
    }

    function e(){
        var nombre = $('#titulo').val();
        var descripcion = $('#contenido').val();
        var cuestionario = $('#desplegable').val();
        //alert(cuestionario);
      if (nombre == '' && descripcion == '' && cuestionario == null){
        document.getElementById('titulo').style.borderColor = "red";
        document.getElementById('contenido').style.borderColor = "red";
        document.getElementById('desplegable').style.borderColor = "red";
      } else {
        if (nombre == '') {
          document.getElementById('titulo').style.borderColor = "red";
        }
        if (descripcion == ''){
          document.getElementById('contenido').style.borderColor = "red";
        }
        if (cuestionario == null) {
            document.getElementById('desplegable').style.borderColor = "red"; 
        } 
        if (nombre != '' && descripcion != '' && cuestionario != null) {
            
        }
          
      }
    }
</script>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>