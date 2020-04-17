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
$cont = 0;
$connect = mysqli_connect("localhost", "root", "", "blog");

$sql_id_proyecto = "SELECT c.num_preguntas AS NUM_PREGUNTAS FROM crear_cuestionario c WHERE c.id = ".$_REQUEST['id_quiz']." ";

$reg = mysqli_query($connect, $sql_id_proyecto) or die(mysqli_error($connect));
$row = mysqli_fetch_array($reg);
$num_preguntas = $row['NUM_PREGUNTAS'];

$sql_id_proyecto = "SELECT c.num_opciones AS NUM_OPCIONES FROM crear_cuestionario c WHERE c.id = ".$_REQUEST['id_quiz']." ";

$reg = mysqli_query($connect, $sql_id_proyecto) or die(mysqli_error($connect));
$row = mysqli_fetch_array($reg);
$num_opciones = $row['NUM_OPCIONES'];

$sql_opcion = "SELECT c.formato_respuesta AS FORMATO_RESP FROM crear_cuestionario c WHERE c.url_usuario = '".$_REQUEST['u']."' ";

$reg1 = mysqli_query($connect, $sql_opcion) or die(mysqli_error($connect));
$row = mysqli_fetch_array($reg1);
$formato_resp = $row['FORMATO_RESP'];
//echo "hola";

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
                <?php for ($i = 1; $i <= $num_preguntas; $i++){  ?>
                  <label for="tituloo"><b>Pregunta <?php echo $i; ?>:</b></label>
                  <input type="text" class="form-control" id="titulo_preg<?php echo $i; ?>" name="titulo" placeholder="Título pregunta">
                  <br>
                  <label for="url"><b>Respuesta: </b></label><br>
                  
                <?php 
                  //$cont = 0;
                for ($j = 1; $j <= $num_opciones; $j++){  
                    $cont = $cont + 1;

                  ?>
                  <li>
                  <!-- <input type="radio" class="aaa" name="radio<?php echo $i; ?>"> -->&nbsp;<input type="text" id="titulo_resp<?php echo $cont; ?>" placeholder="Respuesta <?php echo $j; ?>"><br>
                  <br>
                </li>
                
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
        var valor = "<?php echo $num_preguntas; ?>";
        var respuestas = "<?php echo ($num_opciones * $num_preguntas);  ?>";
        var num_opciones = "<?php echo $num_opciones;  ?>";

        var array = new Array(valor);
        var array_resp = new Array(respuestas);
        var arr_inputs = new Array();

        for (var i = 0; i <= valor; i++) {
          array[i] = $('#titulo_preg'+(i+1)).val();
        }
        //HASTA RESPUESTAS -1 pq al final se me mete un undefined que no se porqué, por eso le resto 1
        for (var j = 0; j <= respuestas - 1; j++) {
          array_resp[j] = $('#titulo_resp'+(j+1)).val();
        }

        for (var i = 0; i <= valor; i++) {
          if (array[i] == ''){
            document.getElementById('titulo_preg'+(i+1)).style.borderColor = "red";
            control = true;
          }
        }
        
        for (var j = 0; j <= respuestas - 1; j++) {
          if (array_resp[j] == '') {
            document.getElementById('titulo_resp'+(j+1)).style.borderColor = "red";
            control = true;
          }
        }

        if (!control){

          $.ajax({
            type: "POST",
            url: "ajax_guardar_crear_cuestionario.php?u="+"<?php echo $_REQUEST['u']; ?>",
            data: {
                id_quiz: "<?php echo $_REQUEST['id_quiz'] ?>",
                url_usuario: "<?php echo $_REQUEST['u'] ?>",
                formato_resp: "<?php echo $formato_resp; ?>",
                respuestas: respuestas,
                num_preguntas: valor,
                array: array,
                array_resp: array_resp,
                arr_inputs: arr_inputs
            },
            success: function (data) { 
                window.location.href='cuestionario_final.php?url=<?php echo $_REQUEST['url']; ?>'+'&u=<?php echo $_REQUEST['u']; ?>'+'&id_quiz=<?php echo $_REQUEST['id_quiz']; ?>';      
                    
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
                <?php for ($i = 1; $i <= $num_preguntas; $i++){  ?>
                  <label for="tituloo"><b>Pregunta <?php echo $i; ?>:</b></label>
                  <input type="text" class="form-control" id="titulo_preg<?php echo $i; ?>" name="titulo" placeholder="Título pregunta <?php echo $i; ?>">
                  <br>
                  <div class="container">
                  <label for="url"><b>Respuesta: </b></label><br>
                <?php 
                  //$cont = 0;
                for ($j = 1; $j <= $num_opciones; $j++){  
                    $cont = $cont + 1;

                  ?>
                  <input type="text" class="form-control" id="titulo_resp<?php echo $cont; ?>" placeholder="Respuesta pregunta <?php echo $i; ?>">
                  <br>
                </div>
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
        
        
        var valor = "<?php echo $num_preguntas; ?>";
        var respuestas = "<?php echo ($num_opciones * $num_preguntas);  ?>";
        var num_opciones = "<?php echo $num_opciones;  ?>";

        var array = new Array(valor);
        var array_resp = new Array(respuestas);
        var arr_inputs = new Array();

        for (var i = 0; i <= valor; i++) {
          array[i] = $('#titulo_preg'+(i+1)).val();
        }
        //HASTA RESPUESTAS -1 pq al final se me mete un undefined que no se porqué, por eso le resto 1
        for (var j = 0; j <= respuestas - 1; j++) {
          array_resp[j] = $('#titulo_resp'+(j+1)).val();
        }
        alert(array);
        alert(array_resp);
        $.ajax({
            type: "POST",
            url: "ajax_guardar_crear_cuestionario.php",
            data: {
                id_quiz: "<?php echo $_REQUEST['id_quiz'] ?>",
                url_usuario: "<?php echo $_REQUEST['u'] ?>",
                formato_resp: "<?php echo $formato_resp; ?>",
                respuestas: respuestas,
                num_preguntas: valor,
                array: array,
                array_resp: array_resp
            },
            success: function (data) { 
                window.location.href='cuestionario_final.php?url=<?php echo $_REQUEST['url']; ?>'+'&u=<?php echo $_REQUEST['u']; ?>'+'&id_quiz=<?php echo $_REQUEST['id_quiz']; ?>';      
                    
            }
        });

    }
     </script>
</html>

    <?php
  }
?>
