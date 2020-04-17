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
/*
NO BORRAR!!
*/
$cont = 0;
$array2 = array();
$array3 = array();
/*
NO BORRAR!!
*/
$connect = mysqli_connect("localhost", "root", "", "blog");

$sql_id_proyecto = "SELECT c.num_preguntas AS NUM_PREGUNTAS FROM crear_cuestionario c WHERE c.id = ".$_REQUEST['id_quiz']." ";

$reg = mysqli_query($connect, $sql_id_proyecto) or die(mysqli_error($connect));
$row = mysqli_fetch_array($reg);
$num_preguntas = $row['NUM_PREGUNTAS'];

$sql_id_proyecto = "SELECT c.num_opciones AS NUM_OPCIONES FROM crear_cuestionario c WHERE c.id = ".$_REQUEST['id_quiz']." ";

$reg = mysqli_query($connect, $sql_id_proyecto) or die(mysqli_error($connect));
$row = mysqli_fetch_array($reg);
$num_opciones = $row['NUM_OPCIONES'];

//echo $_SERVER['REQUEST_URI'];

$sql_opcion = "SELECT c.formato_respuesta AS FORMATO_RESP FROM crear_cuestionario c WHERE c.url_usuario = '".$_REQUEST['u']."' ";

$reg1 = mysqli_query($connect, $sql_opcion) or die(mysqli_error($connect));
$row = mysqli_fetch_array($reg1);
$formato_resp = $row['FORMATO_RESP'];

?>

<?php
  if ($formato_resp == 'Opción múltiple'){
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
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <div class="container">
    <div class="jumbotron text-center">
      <h1>Creación de cuestionario</h1> 
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
                <?php for ($i = 0; $i <= $num_preguntas -1; $i++){  ?>
                  <label for="tituloo"><b>Pregunta <?php echo $i+1; ?>:</b></label>
                  <label for="tituloo"><?php  

                  $connect = mysqli_connect("localhost", "root", "", "blog");

                  $sql = "SELECT p.pregunta AS PREGUNTA FROM pregunta_crear_cuestionario p WHERE p.id_quiz = ".$_REQUEST['id_quiz']." AND p.url_usuario = '".$_REQUEST['u']."' ";

                  $reg = mysqli_query($connect, $sql) or die(mysqli_error($connect));

                  $sql_count = "SELECT COUNT(p.pregunta) AS COUNT FROM pregunta_crear_cuestionario p WHERE p.id_quiz = ".$_REQUEST['id_quiz']." AND p.url_usuario = '".$_REQUEST['u']."' ";

                  $regg = mysqli_query($connect, $sql_count) or die(mysqli_error($connect));
                  $roww = mysqli_fetch_array($regg);
                  $cont_consulta = $roww['COUNT'];

                for ($w = 0; $w <= $cont_consulta -1; $w++){
                    $row = mysqli_fetch_array($reg);
                    $array2[$w] = $row['PREGUNTA'];
                }
                  echo $array2[$i];
                  
                  //echo "<pre>";
                  //print_r($array2);

                  ?></label>
                  <br>
                  <label for="url"><b>Respuesta: </b></label><br>
                <?php 
                  //$cont = 0;
                for ($j = 0; $j <= $num_opciones-1; $j++){  
                    $cont = $cont + 1;

                    $connect = mysqli_connect("localhost", "root", "", "blog");

                  $sql = "SELECT p.opciones_respuesta AS RESPUESTA FROM respuesta_crear_cuestionario p WHERE p.id_quiz = ".$_REQUEST['id_quiz']." AND p.url_usuario = '".$_REQUEST['u']."' ";

                  $reg = mysqli_query($connect, $sql) or die(mysqli_error($connect));

                  //$row = mysqli_fetch_array($reg);
                  
                  $sql_countt = "SELECT COUNT(p.opciones_respuesta) AS COUNTT FROM respuesta_crear_cuestionario p WHERE p.id_quiz = ".$_REQUEST['id_quiz']." AND p.url_usuario = '".$_REQUEST['u']."' ";

                  $reggt = mysqli_query($connect, $sql_countt) or die(mysqli_error($connect));
                  $roww = mysqli_fetch_array($reggt);
                  $cont_consultaa = $roww['COUNTT'];

                for ($y = 0; $y <= $cont_consultaa -1; $y++){
                    $row = mysqli_fetch_array($reg);
                    $array3[$y] = $row['RESPUESTA'];

                }

                  ?>

                  <input type="radio" class="aaa<?php echo $cont; ?>" name="aaa<?php echo $i; ?>" value="<?php echo $array3[$cont-1]; ?>"><label name="<?php echo $array3[$cont-1]; ?>">&nbsp;<?php echo $array3[$cont-1]; ?></label>
                  <br>
                  <?php } ?>
                  <?php } ?>
              </div>
           
              <br>
              <button type="button" class="btn btn-primary" onclick="registrarRes()"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Terminar cuestionario</a>
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
    

    function registrarRes(){
      var control = false;
      array22 = new Array();
      num_preguntas = "<?php echo $num_preguntas; ?>";
      num_opciones = "<?php echo $num_opciones; ?>";
      num_for = num_preguntas * num_opciones;
      for (var i = 1; i <= num_for; i++){
        array22[i] = $("input:radio[class=aaa"+i+"]:checked").val();
      }
      array22 = array22.filter(function(dato){
          return dato != undefined
      });
      for (var i = 0; i < num_for; i++){
        if (array22[i] == ''){
          alert(array22);
          control = true;
          swal ( "¡Error! Cuestionario no finalizado" ,  "Debe seleccionar las respuestas a las preguntas" ,  "error" );
        }
      }
    //alert(array22);
      if (control == false){
        //alert(array22);
      
      $.ajax({
            type: "POST",
            url: "ajax_guardar_cuestionario_respuestas.php",
            data: {
                id_quiz: "<?php echo $_REQUEST['id_quiz'] ?>",
                url_usuario: "<?php echo $_REQUEST['u'] ?>",
                array22:array22
            },
            success: function (data) { 
                //window.location.href='gestion_cuestionarios.php';      
                    
            }
        });


      }

    }
  </script>
</html>
    <?php
  }

  if ($formato_resp == 'Respuesta corta'){
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
                <?php for ($i = 0; $i <= $num_preguntas -1; $i++){  ?>
                  <label for="tituloo"><b>Pregunta <?php echo $i+1; ?>:</b></label>
                  <label for="tituloo"><?php  

                  $connect = mysqli_connect("localhost", "root", "", "blog");

                  $sql = "SELECT p.pregunta AS PREGUNTA FROM pregunta_crear_cuestionario p WHERE p.id_quiz = ".$_REQUEST['id_quiz']." AND p.url_usuario = '".$_REQUEST['u']."' ";

                  $reg = mysqli_query($connect, $sql) or die(mysqli_error($connect));

                  $sql_count = "SELECT COUNT(p.pregunta) AS COUNT FROM pregunta_crear_cuestionario p WHERE p.id_quiz = ".$_REQUEST['id_quiz']." AND p.url_usuario = '".$_REQUEST['u']."' ";

                  $regg = mysqli_query($connect, $sql_count) or die(mysqli_error($connect));
                  $roww = mysqli_fetch_array($regg);
                  $cont_consulta = $roww['COUNT'];

                for ($w = 0; $w <= $cont_consulta -1; $w++){
                    $row = mysqli_fetch_array($reg);
                    $array2[$w] = $row['PREGUNTA'];
                }
                  echo $array2[$i];
                  
                  //echo "<pre>";
                  //print_r($array2);

                  ?></label>
                  <br>
                  <label for="url"><b>Respuesta: </b></label><br>
                <?php 
                  //$cont = 0;
                for ($j = 0; $j <= $num_opciones-1; $j++){  
                    $cont = $cont + 1;

                    $connect = mysqli_connect("localhost", "root", "", "blog");

                  $sql = "SELECT p.opciones_respuesta AS RESPUESTA FROM respuesta_crear_cuestionario p WHERE p.id_quiz = ".$_REQUEST['id_quiz']." AND p.url_usuario = '".$_REQUEST['u']."' ";

                  $reg = mysqli_query($connect, $sql) or die(mysqli_error($connect));

                  //$row = mysqli_fetch_array($reg);
                  
                  $sql_countt = "SELECT COUNT(p.opciones_respuesta) AS COUNTT FROM respuesta_crear_cuestionario p WHERE p.id_quiz = ".$_REQUEST['id_quiz']." AND p.url_usuario = '".$_REQUEST['u']."' ";

                  $reggt = mysqli_query($connect, $sql_countt) or die(mysqli_error($connect));
                  $roww = mysqli_fetch_array($reggt);
                  $cont_consultaa = $roww['COUNTT'];

                for ($y = 0; $y <= $cont_consultaa -1; $y++){
                    $row = mysqli_fetch_array($reg);
                    $array3[$y] = $row['RESPUESTA'];

                }

                  ?>

                  <label name="<?php echo $array3[$cont-1]; ?>">&nbsp;<?php echo $array3[$cont-1]; ?></label>
                  <br>
                  <?php } ?>
                  <?php } ?>
              </div>
           
              <br>
              <button type="button" class="btn btn-primary" onclick="registrarRes()"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Terminar cuestionario</a>
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
    

    function registrarRes(){
        window.location.href='gestion_cuestionarios.php';      
    }
  </script>
</html>
    <?php
  }
  ?>