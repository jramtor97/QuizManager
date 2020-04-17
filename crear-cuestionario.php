<?php

include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/config.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

$titulo = 'Presentación';

include_once 'plantillas/documento-declaracion.inc3.php';
//include_once 'plantillas/navbar.inc.php';
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $url = '';
    //Acotar la URL a 12 caracteres
    for ($i = 0; $i <= 11; $i++) {
        $url .= $characters[rand(0, $charactersLength -1 )];
    }
    
    //echo $url;
    $char = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charLength = strlen($char);
    $url_usuario = '';
    //Acotar la URL_USUARIO a 8 caracteres
    for ($i = 0; $i <= 7; $i++) {
        $url_usuario .= $char[rand(0, $charLength - 1)];
    }
    
    echo "<br>";
    //echo $url_usuario;
  ?>
    <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> 
      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> 
    </script> 
      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"> 
    </script> 
      
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"> 
    </script>  

    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> 
  </head>
    
  <body> 
    <style type="text/css">
      .jumbotron {
        background-color: deepskyblue;
        color: #fff;
        padding: 100px 25px;
        font-family: Montserrat, sans-serif;
      }
    </style>
    
    <div class="container">
    <div class="jumbotron text-center">
      <h1>Creación de cuestionario</h1> 
      <p align="justify"></p> 
    </div> 
  </div>
  <style type="text/css">
    .tp {
     background-color: white;
      padding: 2em;
    }
  </style>
    <div class="container">
      <div class="tp">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
                <label for="titulo"><b>Ponga un título al cuestionario:</b></label>
                <br>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Nombre">
              </div>
              <div class="form-group">
                <label for="contenido"><b>Ponga una descripción al cuestionario:</b></label>
                <br>
                <textarea class="form-control" rows="5" id="contenido" name="texto" placeholder="Escriba de qué tratará su cuestionario" required></textarea>
              </div>
              <div class="form-group">
                <label for="titulo"><b>Introduzca el número de preguntas:</b></label>
                <br>
                <select id="desplegable0" name="select0" required>
                <option value="" disabled selected><- Número -></option>
                <?php for ($i = 1; $i <= 20; $i++){  ?>
                  <option value="<?php 
                  echo $i;
                  ?>"><?php 
                  echo $i;
                  ?></option>
                  <?php } ?>
              </select>
              </div>
              <div class="form-group">
                <label for="contenido"><b>Indique el formato de la respuesta:</b></label>
               <br>
               <select id="desplegable" name="select1" required>
                <option value="" disabled selected><- Formato respuesta -></option>
                <option value="Respuesta corta">Respuesta corta</option>
                <option value="Opción múltiple">Opción múltiple</option>
                <option value="Verdadero/Falso">Verdadero/Falso</option>
                <option value="Likert">Likert</option>
              </select>
              </div>
              
              <form id="ok" action="/action_page.php">
              <label for="contenido"><b>¿Cuántas posibles opciones debe tener su pregunta?</b></label>
               <br>
               <select id="desplegable1" name="select2" required>
                <option value="" disabled selected><- Opciones -></option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
              </select>
            </form>
              
            <script type="text/javascript">
              $('#ok').hide();
              $('#desplegable').on('change', function() {
                var value = $(this).val();

                if (value == "Opción múltiple") {
                  $('#ok').show();
                  <?php $entrar = 1; ?>
                } else {
                  $('#ok').hide();
                  <?php $entrar = 2; ?>
                }
                
              });
            </script>

           
              <br>
              <button type="button" class="btn btn-primary" onclick="registrarQuiz()"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Comenzar cuestionario</a>
          </div>
        </div>
        <br>
      </div>
    </div>
    </div>
    <br>
    <br>
    <br>
  </body>
  <script type="text/javascript">
    
    function registrarQuiz(){
        var entrar = "<?php echo $entrar ?>";
        var titulo = $('#titulo').val();
        var formato_respuesta = $('#desplegable').val();
        var num_preguntas = $('#desplegable0').val();
        var num_opciones = $('#desplegable1').val();
        var descripcion = $('#contenido').val();

      if (titulo == '' && formato_respuesta == null && num_preguntas == null && descripcion == ''){
        document.getElementById('titulo').style.borderColor = "red";
        document.getElementById('desplegable').style.borderColor = "red";
        document.getElementById('desplegable0').style.borderColor = "red";
        document.getElementById('contenido').style.borderColor = "red";
        if (entrar == 2 && num_opciones == null){
          document.getElementById('desplegable1').style.borderColor = "red";
        }
      } else {
        if (titulo == '') {
          document.getElementById('titulo').style.borderColor = "red";
        }
        if (formato_respuesta == null){
          document.getElementById('desplegable').style.borderColor = "red";
        }
        if (num_preguntas == null) {
            document.getElementById('desplegable0').style.borderColor = "red"; 
        } 
        if (descripcion == '') {
            document.getElementById('contenido').style.borderColor = "red";
        }
        if (entrar == 2 && num_opciones == null){
          document.getElementById('desplegable1').style.borderColor = "red";
        } 

        if (titulo != '' && formato_respuesta != null && num_preguntas != null && descripcion != '' && num_opciones != null) {

            $.ajax({
            type: "POST",
            url: "ajax_crear_cuestionario.php",
            data: {
                url: "<?php echo $url; ?>",
                url_usuario: "<?php echo $url_usuario; ?>",
                titulo: titulo,
                formato_respuesta: formato_respuesta,
                num_preguntas: num_preguntas,
                num_opciones: num_opciones,
                descripcion: descripcion
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
                        setTimeout(function () {
                           window.location.href='cuestionario_creado.php?url='+'<?php echo $url; ?>'+'&u=<?php echo $url_usuario; ?>'+'&id_quiz='+data;
                            }, 100);
                        }
                });


            }
        });


        }
    }
  }
  </script>
</html>