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

/*
ESTO ES PARA COMPROBAR QUE EL USUARIO NO PUEDA VOLVER ATRAS UNA VEZ HCHO EL CUESTIONARIO NI TAMPOCO VOLVER A HACERLO AUN COPIANDO LA URL, ESTO LLAMA ABAJO DESPUES DEL WINDOW LOCATION 

BASTA CON QUE LA URL USUARIO ESTE A SI PARA QUE HAYA COMPLETADO EL CUESTIONARIO, SI ES ASI QUE LO CIERRE
*/
$connect = mysqli_connect("localhost", "root", "", "blog");

$sql = "SELECT r.url_usuario AS URL_USUARIO FROM presentacion_usuario r 
          WHERE r.url_usuario = '". $_REQUEST['u'] ."' AND r.def = 'Si'";

$reg = mysqli_query($connect, $sql) or die(mysqli_error($connect));
$row = mysqli_fetch_array($reg);

$sql_q = "SELECT r.id_proyecto AS ID_PROYECTO FROM respuestas r 
    WHERE r.url_usuario = '". $row['URL_USUARIO'] ."' ";

$regw = mysqli_query($connect, $sql_q) or die(mysqli_error($connect));
$roww = mysqli_fetch_array($regw);

if ( $row['URL_USUARIO']!= '' ) {
    ?>
    <script type="text/javascript">
        alert("Cuestionario ya cumplimentado, por favor visualice los resultados");
        alert("./resultados.php?u=<?php echo $_REQUEST['url']; ?>"+'&id='+'<?php echo $roww['ID_PROYECTO']; ?>');
        window.location.href = "./resultados.php?u=<?php echo $_REQUEST['url']; ?>"+'&id='+'<?php echo $roww['ID_PROYECTO']; ?>'+'&p=1';
    </script>
    <?php
}
/* 
 * ESTO ES PARA COMPARAR SI EL USUARIO NO HA PASADO ANTES POR LA PANTALLA DE PRESENTACION DE USUARIO Y NO HA COMPLETADO EL CUESTIONARIO INICIAL Y QUIERE HACER EL FINAL, COSA QUE NO SE PUEDE; TRAS LO CUAL MOSTRAMOS UN SWAL PARA QUE COMPLETE EL INICIAL
 */
if (!isset($_SESSION['am']) || $_SESSION['am'] != 'a' ) {
    Redireccion::redirigir('vistas/404.php');
}
//echo $_REQUEST['url'];

$connect = mysqli_connect("localhost", "root", "", "blog");

$string = $_SERVER['REQUEST_URI'];
//echo $string;
$res = substr($_SERVER['REQUEST_URI'], 67); //u

//echo $res;
//echo "<br>";
$sqll = "SELECT r.url_usuario AS URL_USUARIO FROM presentacion_usuario r 
          WHERE r.url_usuario = '". $res ."' ";

$regl = mysqli_query($connect, $sqll) or die(mysqli_error($connect));
$rowl = mysqli_fetch_array($regl);
//echo $rowl['URL_USUARIO'];

$resultado = substr($_SERVER['REQUEST_URI'], 52, -13); //q

//echo $resultado;
//echo "<br>";
$resultado1 = substr($_SERVER['REQUEST_URI'], 27);
//echo $resultado1;
//echo "<br>";
$resultado2 = substr($_SERVER['REQUEST_URI'], 27, -28); //recortamos 27 caracteres iniciales y quitamos los 15 finales
//echo "<br>";
//echo $resultado2;
$sql = "SELECT r.url_shuffle AS URL_SHUFFLED FROM presentacion_usuario r 
          WHERE r.url_shuffle = '". $resultado ."' ";

$reg = mysqli_query($connect, $sql) or die(mysqli_error($connect));
$row = mysqli_fetch_array($reg);

$sql_r = "SELECT r.url AS URL_N FROM presentacion_usuario r 
          WHERE r.url = '". $resultado2 ."' ";

$regr = mysqli_query($connect, $sql_r) or die(mysqli_error($connect));
$roww = mysqli_fetch_array($regr);
//echo $roww['URL_N'];
//echo $resultado2;

//echo $row['URL_SHUFFLED'];
//echo $resultado;

if ($row['URL_SHUFFLED'] != $resultado || $roww['URL_N'] != $resultado2 || $roww['URL_N']=='' || $row['URL_SHUFFLED'] == '' || $rowl['URL_USUARIO'] != $res || $rowl['URL_USUARIO'] == '') {
  Redireccion::redirigir('vistas/404.php');
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
         table {
  width: 100%;
  background: white;
  margin-bottom: 1.25em;
  border: solid 1px #dddddd;
  border-collapse: collapse;
  border-spacing: 0;
}

table tr th,
table tr td {
  padding: 0.5625em 0.625em;
  font-size: 0.875em;
  color: #222222;
  border: 1px solid #dddddd;
}

table tr.even,
table tr.alt,
table tr:nth-of-type(even) {
  background: #f9f9f9;
}
@media only screen and (max-width: 768px) {
    table.resp,
    .resp thead,
    .resp tbody,
    .resp tr,
    .resp th,
    .resp td,
    .resp caption {
      display: block;
    }
    
    table.resp {
      border: none
    }
    
    .resp thead tr {
      display: none;
    }
    
    .resp tbody tr {
      margin: 1em 0;
      border: 1px solid #2ba6cb;
    }
    
    .resp td {
      border: none;
      border-bottom: 1px solid #dddddd;
      position: relative;
      padding-left: 45%;
      text-align: left;
    }
    
    .resp tr td:last-child {
      border-bottom: 1px double #dddddd;
    }
    
    .resp tr:last-child td:last-child {
      border: none;
    }
    
    .resp td:before {
      position: absolute;
      top: 6px;
      left: 6px;
      width: 45%;
      padding-right: 10px;
      white-space: nowrap;
      text-align: left;
      font-weight: bold;
    }

    td:nth-of-type(1):before {
      content: "ID";
    }
    
    td:nth-of-type(2):before {
      content: "Pregunta";
    }
    
    td:nth-of-type(3):before {
      content: "1";
    }
    
    td:nth-of-type(4):before {
      content: "2";
    }
    
    td:nth-of-type(5):before {
      content: "3";
    }

    td:nth-of-type(6):before {
      content: "4";
    }
    
    td:nth-of-type(7):before {
      content: "5";
    }
    
}
      </style>
    </div>
   <div style="height:50px"></div>

   <div class="container" style="background-color: #ffffff; padding: 20px; margin: auto; "> 
     <h5><strong>Responda a las cuestiones: </strong></h5>
     <br>
    <!--Ejemplo tabla con DataTables-->
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="example" class="resp" style="width:100%">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>Pregunta</th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                            </tr>
                          </thead>

                          <tbody>     
            
            <form action="/action_page.php" required>
              
                <td>1</td>
                <td>Considero que me gustará visitar con frecuencia este sistema</td>
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
                <td>Necesitaría del apoyo de un experto para recorrer el sistema</td>
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
                <td>Me pareció difícil utilizar el sistema desde el principio hasta el final</td>
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
        </tbody>    
                       </table>                  
                    </div>
                </div>
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

    <br>

    <div id="h" class="container">
         <button type="submit" id="nuevo_proy" class="btn btn-primary pull-right menu" onclick="javascript:registrarResultado()">&nbsp;Enviar cuestionario</a>
    </div>
    <br>
    <br>
    <br>
    <script>
    $(document).ready(function() {    
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
            paging: false,
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
    //Oculto el boton para que no haya 80 solicitudes
    var boton = document.getElementById('nuevo_proy');
    function registrarResultado(){
        boton.style.display = 'none';

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

          //alert(valor_total);
          
                $.ajax({
                  type: "POST",
                  url: "ajax_resultados_cuestionario_sus.php",
                  data: {
                      url: "<?=$_REQUEST['url']?>",
                      url_usuario: "<?php echo $_REQUEST['u']; ?>",
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
                                //alert(data);
                              window.location.href = "./resultados.php?u=<?php echo $_REQUEST['url']; ?>"+'&id='+data+'&p=1';
                              
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