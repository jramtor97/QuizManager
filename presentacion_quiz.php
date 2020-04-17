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

    session_start();
    $_SESSION['am'] = 'a';
    //print_r($_SESSION);

    // PARA CONTROLAR QUE NO SE META OTRA URL
    $connect = mysqli_connect("localhost", "root", "", "blog");


    // //echo $row['URL'];
    // //echo $url_quiz;
    // if ($resultado != $row['URL'] || $resultado == '' || $row['URL'] == '') {
    //    //header('Location: ../presentacion_usuario.php');
    //   //echo "hola";
    //   Redireccion::redirigir('vistas/404.php');
    // }
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
          <h1>Presentación del Usuario</h1> 
          <p align="justify">Estimado Sr./Sra, gracias por su visita, le agradecemos enormemente su disposición de participar en esta prueba de usabilidad. ¡No le hagamos esperar! Comencemos con algunas preguntas que nos permitirán saber quién es Usted y qué actividad tiene en Internet.</p> 
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
                    <label for="titulo"><b>1. ¿Qué edad tiene?</b></label>
                    <!-- <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Edad"> -->
                    <br>
                    <select id="desplegable0" name="select0" required>
                    <option value="" disabled selected><- Edad -></option>
                    <?php for ($i = 5; $i <= 65; $i++){  ?>
                      <option value="<?php 
                      if ($i < 6){
                        echo "< 6";
                      } else if ($i >=6  && $i < 65){
                        echo $i;
                      } else if ($i >= 65){
                        echo "> 65";
                      }
                      ?>"><?php 
                      if ($i < 6){
                        echo "< 6";
                      } else if ($i >=6  && $i < 65){
                        echo $i;
                      } else if ($i >= 65){
                        echo "> 65";
                      }
                      ?></option>
                      <?php } ?>
                  </select>
                  </div>
                  <form action="/action_page.php">
                  <div class="form-group">
                    <label for="url"><b>2. Indique su sexo:</b></label><br>
                    <input type="radio" class="aa" name="aa" value="Hombre">&nbsp;Hombre<br>
                    <input type="radio" class="aa" name="aa" value="Mujer">&nbsp;Mujer<br>
                  </div>
                </form>
                  <div class="form-group">
                    <label for="contenido"><b>3. Formación cultural: ¿cuál es su nivel de estudios?</b></label>
                    <!-- <input type="text" class="form-control" id="url" name="url" placeholder="Formación">
                   -->
                   <br>
                   <select id="desplegable" name="select1" required>
                    <option value="" disabled selected><- Estudios -></option>
                    <option value="Eduación Primaria">Eduación Primaria</option>
                    <option value="Educación Secundaria Obligatoria (E.S.O)">Educación Secundaria Obligatoria (E.S.O)</option>
                    <option value="Módulo: Grado Medio">Módulo: Grado Medio</option>
                    <option value="Técnico Grado Superior (F.P)">Técnico Grado Superior (F.P)</option>
                    <option value="Grado Universitario">Grado Universitario</option>
                    <option value="Máster Universitario">Máster Universitario</option>
                    <option value="Doctorado">Doctorado</option>
                  </select>
                  </div>
                  <form action="/action_page.php">
                  <div class="form-group">
                    <label for="url"><b>4. ¿Qué experiencia tiene en Internet?</b></label><br>
                    <input type="radio" class="aaa" name="aaa" value="Muy alto">&nbsp;Muy alto<br>
                    <input type="radio" class="aaa" name="aaa" value="Alto">&nbsp;Alto<br>
                    <input type="radio" class="aaa" name="aaa" value="Medio">&nbsp;Medio<br>
                    <input type="radio" class="aaa" name="aaa" value="Bajo">&nbsp;Bajo<br>
                    <input type="radio" class="aaa" name="aaa" value="Muy bajo">&nbsp;Muy bajo<br>
                  </div>
                </form>
                  <div class="form-group">
                    <label for="url"><b>5. ¿Qué experiencia tiene en el uso de sistemas parecidos?</b></label><br>
                    <input type="radio" class="aaaa" name="aaaa" value="Muy alto">&nbsp;Muy alto<br>
                    <input type="radio" class="aaaa" name="aaaa" value="Alto">&nbsp;Alto<br>
                    <input type="radio" class="aaaa" name="aaaa" value="Medio">&nbsp;Medio<br>
                    <input type="radio" class="aaaa" name="aaaa" value="Bajo">&nbsp;Bajo<br>
                    <input type="radio" class="aaaa" name="aaaa" value="Muy bajo">&nbsp;Muy bajo<br>
                  </div>
                  <br>
                  <button type="button" class="btn btn-primary" onclick="registrarDatos()"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Comenzar cuestionario</a>
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
        function registrarDatos(){
            var edad = $('#desplegable0').val();
            var sexo = $("input:radio[name=aa]:checked").val();
            var exp_internet = $("input:radio[name=aaa]:checked").val();
            var exp_sistemas = $("input:radio[name=aaaa]:checked").val();
            var estudios = $('#desplegable').val();
            
            //CAMPOS REQUERIDOS
            if (edad == null && sexo == null && exp_internet == null && exp_sistemas == null && estudios == null) {
                swal ( "¡Error! Formulario no enviado" ,  "Debe completar todas las preguntas" ,  "error" );
                document.getElementById('desplegable0').style.borderColor = "red";
                document.getElementById('desplegable').style.borderColor = "red";
                

            } else if (edad == null || sexo == null || exp_internet == null || exp_sistemas == null || estudios == null) {
                swal ( "¡Error! Formulario no enviado" ,  "Debe completar todas las preguntas" ,  "error" );

            } else {

              $.ajax({
                      type: "POST",
                      url: "ajax_guardar_datos_quiz.php",
                      data: {
                          url: "<?php echo $_REQUEST['url']; ?>",
                          edad: edad,
                          sexo: sexo,
                          estudios: estudios,
                          exp_internet: exp_internet,
                          exp_sistemas: exp_sistemas,
                          url_usuario: "<?php echo $_REQUEST['u']; ?>",
                          id_quiz: "<?php echo $_REQUEST['id_quiz']; ?>"
                      },
                      success: function (data) { 
                        //alert(data); 
                        swal({
                        title: "Success!",
                        text: "Redirecting in 5 seconds.",
                        type: "success",
                        timer: 5000,
                        showConfirmButton: false
                      }, function(){
                        window.location.href='cuestionario_propio.php?url=<?php echo $_REQUEST['url']; ?>'+'&u=<?php echo $_REQUEST['u']; ?>'+'&id_quiz=<?php echo $_REQUEST['id_quiz']; ?>';

                      });       
                        
                      }
                  });

            }
          }
      </script>
    </html>