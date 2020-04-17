<?php

include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/config.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

$titulo = 'Blog de JavaDevOne';

include_once 'plantillas/documento-declaracion.inc3.php';
//include_once 'plantillas/navbar.inc.php';
session_start();
//echo "<pre>";
//print_r($_SESSION);
// SI NO EXISTE LA SESION IR A LOGIN
// if (!isset($_SESSION['nombre_usuario'])) {
//   Redireccion :: redirigir(RUTA_LOGIN);
// }
//print_r($_REQUEST);
print_r($_SESSION);
if (!isset($_SESSION['am']) || $_SESSION['am'] != 'a' ) {
    Redireccion::redirigir('vistas/404.php');
}
//echo $_REQUEST['url'];

$connect = mysqli_connect("localhost", "root", "", "blog");

/*
 * ESTO ES PARA COMPARAR SI HAY LAS MISMAS FILAS EN LA BBDD, SI NO LAS HAY, ENTONCES ES QUE EL USUARIO NO HA COMPLETADO EL CUESTIONARIO INICIAL Y QUIERE HACER EL FINAL, COSA QUE NO SE PUEDE; TRAS LO CUAL MOSTRAMOS UN SWAL PARA QUE COMPLETE EL INICIAL
 */
$sql = "SELECT COUNT(participante)+1 AS NUM_PART FROM respuestas";

$registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

$row = mysqli_fetch_array($registro);
$a = $row['NUM_PART'];
//echo $a;
$sql_q = "SELECT COUNT(participante)+1 AS NUM_PRT FROM presentacion_usuario";

$registr = mysqli_query($connect, $sql_q) or die(mysqli_error($connect));

$row = mysqli_fetch_array($registr);
$b = $row['NUM_PRT'];

$string = $_SERVER['REQUEST_URI'];
//echo $string;
$resultado = substr($_SERVER['REQUEST_URI'], 52); //q
// echo "URL introducida al Chrome: <br>";
//echo $resultado;

$resultado1 = substr($_SERVER['REQUEST_URI'], 27);
// echo "URL introducida al Chrome: <br>";
$resultado2 = substr($_SERVER['REQUEST_URI'], 27, -15); //recortamos 27 caracteres iniciales y quitamos los 15 finales
// echo "<br>";
//echo $resultado2;
$sql = "SELECT r.url_shuffle AS URL_SHUFFLED FROM presentacion_usuario r 
          WHERE r.url_shuffle = '". $resultado ."' ";

$reg = mysqli_query($connect, $sql) or die(mysqli_error($connect));
$row = mysqli_fetch_array($reg);

$sql_r = "SELECT r.url AS URL_N FROM presentacion_usuario r 
          WHERE r.url = '". $resultado2 ."' ";

$regr = mysqli_query($connect, $sql_r) or die(mysqli_error($connect));
$roww = mysqli_fetch_array($regr);
echo $roww['URL_N'];
echo $resultado2;

echo $row['URL_SHUFFLED'];
echo $resultado;

if ($row['URL_SHUFFLED'] != $resultado || $roww['URL_N'] != $resultado2 || $roww['URL_N']=='' || $row['URL_SHUFFLED'] == '') {
  Redireccion::redirigir('vistas/404.php');
}

?>

<!doctype html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="datatables_intro/bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="datatables_intro/main.css">  
      
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables_intro/datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
   <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

   <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
 
  </head>
    
  <body> 
    <div class="container">
    <h1>Cuestionario System Usability Scale (SUS)</h1>
    <div id="h" class="container">
      <style>
        .h {
          text-align: center;
        }
      </style>
    </div>
   <div style="height:50px"></div>
     <div class="container" style="background-color: #ffffff; padding: 20px; margin: auto; ">  
    <!--Ejemplo tabla con DataTables-->
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="example" class="table table-striped table-bordered" style="width:100%" >
                        <thead>
                            <tr>
                                <th>Número</th>
                                <th>Pregunta</th>
                                <th><img src="images_caras/sonrisa5.png" width="75" height="75">Muy malo</th>
                                <th><img src="images_caras/sonrisa4.png" width="75" height="75">Malo</th>
                                <th><img src="images_caras/sonrisa3.png" width="75" height="75">Medio</th>
                                <th><img src="images_caras/sonrisa2.png" width="75" height="75">Bueno</th>
                                <th><img src="images_caras/sonrisa1.png" width="75" height="75">Excelente</th>
                            </tr>
                        </thead>
            <tbody>
</div>       
            
            <form action="/action_page.php" required>
              
                <td>1</td>
                <td>Creo que me gustará visitar con frecuencia este sistema</td>
                <td><input type="radio" id="p1_1" name="gender" value="1"></div></td>
                <td><input type="radio" class="gender" id="p1_2" name="gender" value="2"></div></td>
                <td><input type="radio" class="gender" id="p1_3" name="gender" value="3"></td>
                <td><input type="radio" class="gender" id="p1_4" name="gender" value="4"></td>
                <td><input type="radio" class="gender" id="p1_5" name="gender" value="5"></td>
                
            </tr>
            </form>
            
            <form action="/action_page.php">
            <tr>
                <td>2</td>
                <td>Encontré este sistema innecesariamente complejo</td>
                <td><input type="radio" class="age" id="p2_1" name="age" value="1" required></td>
                <td><input type="radio" class="age" id="p2_2" name="age" value="2"></td>
                <td><input type="radio" class="age" id="p2_3" name="age" value="3"></td>
                <td><input type="radio" class="age" id="p2_4" name="age" value="4"></td>
                <td><input type="radio" class="age" id="p2_5" name="age" value="5"></td>
            </tr>
            </form>
         <form action="/action_page.php">
            <tr>
                <td>3</td>
                <td>Pensé que era fácil utilizar el sistema</td>
                <td><input type="radio" class="hola" id="p3_1" name="hola" value="1" required></td>
                <td><input type="radio" class="hola" id="p3_2" name="hola" value="2"></td>
                <td><input type="radio" class="hola" id="p3_3" name="hola" value="3"></td>
                <td><input type="radio" class="hola" id="p3_4" name="hola" value="4"></td>
                <td><input type="radio" class="hola" id="p3_5" name="hola" value="5"></td>
            </tr>
            </form>
        <form action="/action_page.php">
            <tr>
                <td>4</td>
                <td>Creo que necesitaría del apoyo de un experto para recorrer el sistema</td>
                <td><input type="radio" class="d" id="p4_1" name="d" value="1"></td>
                <td><input type="radio" class="d" id="p4_2" name="d" value="2"></td>
                <td><input type="radio" class="d" id="p4_3" name="d" value="3"></td>
                <td><input type="radio" class="d" id="p4_4" name="d" value="4"></td>
                <td><input type="radio" class="d" id="p4_5" name="d" value="5"></td>
            </tr>
            </form>
        <form action="/action_page.php">
            <tr>
                <td>5</td>
                <td>Encontré las diversas posibilidades del sistema bastante bien integradas</td>
                <td><input type="radio" class="a" id="p5_1" name="a" value="1"></td>
                <td><input type="radio" class="a"  id="p5_2" name="a" value="2"></td>
                <td><input type="radio" class="a" id="p5_3" name="a" value="3"></td>
                <td><input type="radio" class="a" id="p5_4" name="a" value="4"></td>
                <td><input type="radio" class="a" id="p5_5"name="a" value="5"></td>
            </tr>
            </form>
        <form action="/action_page.php">
            <tr>
                <td>6</td>
                <td>Pensé que había demasiada inconsistencia en el sistema</td>
                <td><input type="radio" class="ge" name="ge" value="1"></td>
                <td><input type="radio" class="ge" name="ge" value="2"></td>
                <td><input type="radio" class="ge" name="ge" value="3"></td>
                <td><input type="radio" class="ge" name="ge" value="4"></td>
                <td><input type="radio" class="ge" name="ge" value="5"></td>
            </tr>
            </form>
        <form action="/action_page.php">
            <tr>
                <td>7</td>
                <td>Imagino que la mayoría de las personas aprenderían muy rápidamente a utilizar el sistema</td>
                <td><input type="radio" class="g" name="g" value="1"></td>
                <td><input type="radio" class="g" name="g" value="2"></td>
                <td><input type="radio" class="g" name="g" value="3"></td>
                <td><input type="radio" class="g" name="g" value="4"></td>
                <td><input type="radio" class="g" name="g" value="5"></td>
            </tr>
            </form>
        <form action="/action_page.php">
            <tr>
                <td>8</td>
                <td>Encontré el sistema muy grande al recorrerlo</td>
                <td><input type="radio" class="ag" name="ag" value="1"></td>
                <td><input type="radio" class="ag" name="ag" value="2"></td>
                <td><input type="radio" class="ag" name="ag" value="3"></td>
                <td><input type="radio" class="ag" name="ag" value="4"></td>
                <td><input type="radio" class="ag" name="ag" value="5"></td>
            </tr>
            </form>
      <form action="/action_page.php">
            <tr>
                <td>9</td>
                <td>Me sentí muy confiado en el manejo del sistema</td>
                <td><input type="radio" class="ae" name="ae" value="1"></td>
                <td><input type="radio" class="ae" name="ae" value="2"></td>
                <td><input type="radio" class="ae" name="ae" value="3"></td>
                <td><input type="radio" class="ae" name="ae" value="4"></td>
                <td><input type="radio" class="ae" name="ae" value="5"></td>
            </tr>
            </form>
     <form action="/action_page.php">
            <tr>
                <td>10</td>
                <td>Necesito aprender muchas cosas antes de manejarme en el sistema</td>
                <td><input type="radio" class="o" name="o" value="1"></td>
                <td><input type="radio" class="o" name="o" value="2"></td>
                <td><input type="radio" class="o" name="o" value="3"></td>
                <td><input type="radio" class="o" name="o" value="4"></td>
                <td><input type="radio" class="o" name="o" value="5"></td>
            </tr>
      </form>
        </form>
        </tbody>
                       </table>                  
                    </div>
                </div>
        </div>  
    </div> 
    </div>
    <br>
    <div id="h" class="container">
         <button type="submit" id="nuevo_proy" class="btn btn-primary pull-right menu" onclick="javascript:registrarResultado()">&nbsp;Enviar cuestionario</a>
    </div>
    <br>
    <br>
    <br>

    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="datatables_intro/jquery/jquery-3.3.1.min.js"></script>
    <script src="datatables_intro/popper/popper.min.js"></script>

    <!-- datatables JS -->
    <script type="text/javascript" src="datatables_intro/datatables/datatables.min.js"></script>    

    <script>
    $(document).ready(function() {    
        var x = $('#example').DataTable({
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
    });

  </script>

  <script type="text/javascript">
    function registrarResultado(){

        var a = "<?php echo $a; ?>";
        var b = "<?php echo $b; ?>";

        if (a == b) {
          swal ( "¡Error! Cuestionario no enviado" ,  "Debes completar primero el cuestionario de presentación de usuario" ,  "error" );
          return; //Nos salimos de la función completa
        }

        var p1 = $("input:radio[name=gender]:checked").val();
        var p2 = $("input:radio[name=age]:checked").val();
        var p3 = $("input:radio[name=hola]:checked").val();
        var p4 = $("input:radio[name=d]:checked").val();
        var p5 = $("input:radio[name=a]:checked").val();
        var p6 = $("input:radio[name=ge]:checked").val();
        var p7 = $("input:radio[name=g]:checked").val();
        var p8 = $("input:radio[name=ag]:checked").val();
        var p9 = $("input:radio[name=ae]:checked").val();
        var p10 = $("input:radio[name=o]:checked").val();

        if (p1 == null && p2 == null && p3 == null && p4 == null && p5 == null && p6 == null && p7 == null && p8 == null && p9 == null && p10 == null) {
            swal ( "¡Error! Cuestionario no enviado" ,  "Debes completar todas las preguntas" ,  "error" );
          // p1.style.borderColor = "red";
          // document.getElementByClassName("age").required;
          // document.getElementById("p1_1").required;
          // document.getElementById("mogambo").style.borderColor = "red";
          // document.getElementById("myDiv").style.borderColor = "red";
          // //alert("hoola");
          // var x = document.getElementByClassName("age").required;

        } else if (p1 == null || p2 == null || p3 == null || p4 == null || p5 == null || p6 == null || p7 == null || p8 == null || p9 == null || p10 == null) {
            swal ( "¡Error! Cuestionario no enviado" ,  "Debes completar todas las preguntas" ,  "error" );

        } else {

          var valor_total;
        //PREGUNTAS IMPARES valor -1
        var valor1, valor3, valor5, valor7, valor9;
        valor1 = p1 - 1;
        valor3 = p3 - 1;
        valor5 = p5 - 1;
        valor7 = p7 - 1;
        valor9 = p9 - 1;

        //PREGUNTAS PARES 5 - valor
        var valor2, valor4, valor6, valor8, valor10;
        valor2 = 5 - p2;
        valor4 = 5 - p4;
        valor6 = 5 - p6;
        valor8 = 5 - p8;
        valor10 = 5 - p10;

        valor_total =  valor1 +  valor2 +  valor3 +  valor4 +  valor5 +  valor6 +  valor7 +  valor8 +  valor9 +  valor10;

        //MULTIPLICAMOS EL VALOR TOTAL  x 2,5
        valor_total = valor_total * 2.5;
        

        // $("form input[name=gender]").css("border", "3px solid red");
        // document.getElementsByName("gender")[0].required = true;

        // //document.getElementByClassName("gender")[0].style.borderColor = "red";
        //     document.getElementById('p1_1').style.border = "red";
            //alert("hola");

          //alert(valor_total);
          
          
          $.ajax({
                  type: "POST",
                  url: "ajax_resultados_cuestionario_sus.php",
                  data: {
                      url: "<?=$_REQUEST['url']?>",
                      p1: p1,
                      p2: p2,
                      p3: p3,
                      p4: p4,
                      p5: p5,
                      p6: p6,
                      p7: p7,
                      p8: p8,
                      p9: p9,
                      p10: p10,
                      puntuacion: valor_total
                  },
                  success: function (data) {         
                        swal({
                            title: "Cuestionario enviado con éxito",
                            text: "Visualice los resultados",
                            type: "success",
                            confirmButtonText: "Aceptar"
                          },
                          function(isConfirm){
                            if (isConfirm) {
                              setTimeout(function () {
                              window.location.href = "./resultados.php?u=<?php echo $_REQUEST['url']; ?>";
                            }, 100);
                            }
                          });
                  }
              });

        }

        }
  </script>
  </body>
</html>