<?php

include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/config.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

$titulo = 'Lista de proyectos';

include_once 'plantillas/documento-declaracion.inc2.php';
//include_once 'plantillas/navbar.inc.php';

//echo "<pre>";
//print_r($_SESSION);
// SI NO EXISTE LA SESION IR A LOGIN
if (!isset($_SESSION['nombre_usuario'])) {
  Redireccion :: redirigir(RUTA_LOGIN);
}
//print_r($_REQUEST);

$connect = mysqli_connect("localhost", "root", "", "blog");

      // $sql = "SELECT COUNT(IFNULL(p.id,1))+1 AS ID
      //         FROM proyecto p";

      // $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

      // $row = mysqli_fetch_array($registro);
      // echo $row['ID'];

$sql_id_proyecto = "SELECT COUNT(IFNULL(id, 1)) AS ID_GESTION FROM proyecto";

$reg = mysqli_query($connect, $sql_id_proyecto) or die(mysqli_error($connect));
$row_count = mysqli_fetch_array($reg);
//echo $row_count['ID_GESTION'];

if ($row_count['ID_GESTION'] == 0){
    //echo "hola";
    //exit;
    $sql_id_proyecto1 = "SELECT COUNT(IFNULL(id, 1))+1 AS ID_G FROM proyecto p";
    $reg = mysqli_query($connect, $sql_id_proyecto1) or die(mysqli_error($connect));
    $row_count_id = mysqli_fetch_array($reg);

} else {
    $sql_id_proyecto1 = "SELECT MAX(id)+1 AS ID_G FROM proyecto p";
    $reg = mysqli_query($connect, $sql_id_proyecto1) or die(mysqli_error($connect));
    $row_count_id = mysqli_fetch_array($reg);
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
   <div class="container">
    <h1>Gestión de Proyectos</h1>
    <div id="h" class="container">
      <style>
        .h {
          text-align: center;
        }
      </style>
          <button type="button" id="nuevo_proy" class="btn btn-primary pull-right menu" onclick="location.href='nuevo_proyecto.php?id=<?php echo $row_count_id['ID_G']?>'" ><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Nuevo proyecto

            <button type="button" id="quiz" class="btn btn-primary pull-right menu" onclick="location.href='crear-cuestionario.php'" ><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Crear quiz
     
    </div>
    
    <div style="height:50px"></div>
     <div class="container" style="background-color: #ffffff; padding: 20px; margin: auto; ">  
    <!--Ejemplo tabla con DataTables-->
    
        <div class="row">
                <div class="col-lg-12">
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>URL</th>
                                <th>Descripción</th>
                                <th>Cuestionario</th>
                                <th>Resultados</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>       
                       </table>                  
                </div> 
    </div>    
    </div> 
      
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>  

    <script src="https://clipboardjs.com/dist/clipboard.min.js"></script>
    
    <script>

    $(document).ready(function() { 
        //$("container").fadeIn(2000);
         
        var x = $('#example').DataTable({
            lengthChange: false,
            dom: 'Bfrtip',
            buttons: [ 
                { extend: 'copy', text: 'Copiar' },
                { extend: 'excel', text: 'Excel' },
                { extend: 'csv', text: 'CSV' },
                { extend: 'pdf', text: 'PDF' },
                { extend: 'colvis', text: 'Visibilidad' }],
            responsive: true,
            ajax: "ajax_listar_proyecto.php",
            language: {
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "Mostrando _START_ de _END_ filas",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast":"Último",
                            "sNext":"Siguiente",
                            "sPrevious": "Anterior"
                         },
                         "sProcessing":"Procesando...",
                }
        });

    });
  </script>

  <script type="text/javascript">


    function crearProyecto(){
        var nombre = $('#titulo').val();
        var descripcion = $('#contenido').val();
        var cuestionario = $('#desplegable').val();
        
        $.ajax({
                  type: "POST",
                  url: "ajax_insertar_proyecto.php",
                  data: {
                      nombre: nombre,
                      descripcion: descripcion,
                      cuestionario: cuestionario
                  },
                  success: function (data) {         
                    $('#example').DataTable().ajax.reload();

                  }
              });
    }

    function eliminarProyecto(id){
        $.ajax({
                  type: "POST",
                  url: "ajax_borrar_proyecto.php",
                  data: {
                      id : id
                  },
                  success: function (data) {         
                    $('#example').DataTable().ajax.reload();

                  }
        });
    }

    function editarProyecto(id){
        window.location.href = "editar_usuario.php?id="+id;
    }
  </script>

  </body>
</html>


