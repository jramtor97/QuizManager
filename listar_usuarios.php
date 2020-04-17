<?php

include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/config.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

$titulo = 'Blog de JavaDevOne';

include_once 'plantillas/documento-declaracion.inc2.php';
//include_once 'plantillas/navbar.inc.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="datatables_intro/bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="datatables_intro/main.css">  
      
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables_intro/datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
   <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
           
  </head>
    
  <body> 
   <div class="container">
    <h1>Usuarios registrados</h1>
    <div id="h" class="container">
      <style>
        .h {
          text-align: center;
        }
      </style>
         <a href="crear_proyecto2.php" class="btn btn-primary pull-right menu"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Nuevo proyecto</a>
    </div>
    <div style="height:50px"></div>
     <div class="container" style="background-color: #ffffff; padding: 20px; margin: auto; ">  
    <!--Ejemplo tabla con DataTables-->
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Nombre</th>
                                <th>URL</th>
                            </tr>
                        </thead>       
                       </table>                  
                    </div>
                </div>
        </div>  
    </div>    
    </div> 
      
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="datatables_intro/jquery/jquery-3.3.1.min.js"></script>
    <script src="datatables_intro/popper/popper.min.js"></script>

    <!-- datatables JS -->
    <script type="text/javascript" src="datatables_intro/datatables/datatables.min.js"></script>    
     
    <script>
    $(document).ready(function() {    
       load_data();
       function load_data(is_category) {
           var dataTable = $('#example').DataTable({
                "ajax":{
                        url:"ajax_lista_usuarios.php",
                        type:"POST",
                        data:{
                            is_category: is_category
                        }
                   },
                "language": {
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
        }

    $(document).on('change', '#category', function(){
      var category = $(this).val();
      $('#example').DataTable().destroy();
      if(category != '')
      {
       load_data(category);
      }
      else
      {
       load_data();
      }
     });


    });
    </script>
  </body>
</html>


