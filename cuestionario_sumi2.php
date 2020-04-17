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
        //alert("./resultados.php?u=<?php //echo $_REQUEST['url']; ?>"+'&id='+'<?php //echo $roww['ID_PROYECTO']; ?>');
        window.location.href = "./resultados_sumi.php?u=<?php echo $_REQUEST['url']; ?>"+'&id='+'<?php echo $roww['ID_PROYECTO']; ?>'+'&p=1';
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
$res = substr($_SERVER['REQUEST_URI'], 72); //u

//echo $res;
//echo "<br>";
$sqll = "SELECT r.url_usuario AS URL_USUARIO FROM presentacion_usuario r 
          WHERE r.url_usuario = '". $res ."' ";

$regl = mysqli_query($connect, $sqll) or die(mysqli_error($connect));
$rowl = mysqli_fetch_array($regl);
//echo $rowl['URL_USUARIO'];

$resultado = substr($_SERVER['REQUEST_URI'], 57, -13); //q

//echo $resultado;
//echo "<br>";
$resultado1 = substr($_SERVER['REQUEST_URI'], 32);
//echo $resultado1;
//echo "<br>";
$resultado2 = substr($_SERVER['REQUEST_URI'], 32, -28); //recortamos 27 caracteres iniciales y quitamos los 15 finales
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
    <h1>Cuestionario Software Measurement Inventory (SUMI)</h1>
    <div id="h" class="container">
      <style>
        .h {
          text-align: center;
        }
      </style>
    </div>
   <div style="height:50px"></div>

   <div class="container" style="background-color: #ffffff; padding: 20px; margin: auto; "> 
     <h5><strong>Datos por participante: </strong></h5>
     <br>
    <!--Ejemplo tabla con DataTables-->
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>Pregunta</th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                            </tr>
                          </thead>

                          <tbody>     
            
            <form action="/action_page.php" id="hh">
                <td>1</td>
                <td>Este sistema responde muy lentamente a las entradas</td>
                <td><input type="radio" class="g1" name="p1" value="1"></div></td>
                <td><input type="radio" class="g1" name="p1" value="2"></div></td>
                <td><input type="radio" class="g1" name="p1" value="3"></td>
            </tr>
            </form>
            
            <form action="/action_page.php">
            <tr><td>2</td>
                <td>Recomendaría este sistema a mis amigos</td>
                <td><input type="radio" class="g2"name="p2" value="1"></td>
                <td><input type="radio" class="g2"name="p2" value="2"></td>
                <td><input type="radio" class="g2"name="p2" value="3"></td>
            </tr>
            </form>
         <form action="/action_page.php">
            <tr><td>3</td>
                <td>Las instrucciones y las indicaciones de este sistema son útiles</td>
                <td><input type="radio" class="g3"name="p3" value="1"></td>
                <td><input type="radio" class="g3"name="p3" value="2"></td>
                <td><input type="radio" class="g3"name="p3" value="3"></td>
            </tr>
            </form>
        <form action="/action_page.php">
            <tr><td>4</td>
                <td>Este sistema se ha detenido inesperadamente en algún momento</td>
                <td><input type="radio" class="g4" id="p4_1" name="p4" value="1"></td>
                <td><input type="radio" class="g4" id="p4_2" name="p4" value="2"></td>
                <td><input type="radio" class="g4" id="p4_3" name="p4" value="3"></td>
            </tr>
            </form>
        <form action="/action_page.php">
            <tr><td>5</td>
                <td>Me costó mucho utilizar el sistema antes de aprenderlo</td>
                <td><input type="radio" class="g5" name="p5" value="1"></td>
                <td><input type="radio" class="g5" name="p5" value="2"></td>
                <td><input type="radio" class="g5" name="p5" value="3"></td>
            </tr>
            </form>
        <form action="/action_page.php">
            <tr><td>6</td>
                <td>A veces no sé como continuar utilizando el sistema</td>
                <td><input type="radio" class="g6" name="p6" value="1"></td>
                <td><input type="radio" class="g6" name="p6" value="2"></td>
                <td><input type="radio" class="g6" name="p6" value="3"></td>
            </tr>
            </form>
        <form action="/action_page.php">
            <tr><td>7</td>
                <td>Disfruto el tiempo que paso utilizando este sistema</td>
                <td><input type="radio" class="g7" name="p7" value="1"></td>
                <td><input type="radio" class="g7" name="p7" value="2"></td>
                <td><input type="radio" class="g7" name="p7" value="3"></td>
            </tr>
            </form>
        <form action="/action_page.php">
            <tr><td>8</td>
                <td>La información de ayuda proporcionada por este sistema no es muy útil.</td>
                <td><input type="radio" class="g8" name="p8" value="1"></td>
                <td><input type="radio" class="g8" name="p8" value="2"></td>
                <td><input type="radio" class="g8" name="p8" value="3"></td>
            </form>
      <form action="/action_page.php">
            <tr><td>9</td>
                <td>Si este sistema se detiene, no es fácil reiniciarlo</td>
                <td><input type="radio" class="g9" name="p9" value="1"></td>
                <td><input type="radio" class="g9" name="p9" value="2"></td>
                <td><input type="radio" class="g9" name="p9" value="3"></td>
            </tr>
            </form>
     <form action="/action_page.php">
            <tr><td>10</td>
                <td>Se tarda demasiado en aprender las funciones básicas del sistema</td>
                <td><input type="radio" class="g10" name="p10" value="1"></td>
                <td><input type="radio" class="g10" name="p10" value="2"></td>
                <td><input type="radio" class="g10" name="p10" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>11</td>
                <td>A veces me pregunto si estoy utilizando la función correcta del sistema</td>
                <td><input type="radio" class="g11" name="p11" value="1"></td>
                <td><input type="radio" class="g11" name="p11" value="2"></td>
                <td><input type="radio" class="g11" name="p11" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>12</td>
                <td>Trabajar con el sistema es satisfactorio</td>
                <td><input type="radio" class="g12" name="p12" value="1"></td>
                <td><input type="radio" class="g12" name="p12" value="2"></td>
                <td><input type="radio" class="g12" name="p12" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>13</td>
                <td>La forma en la que el sistema presenta la información del sistema es clara y comprensible</td>
                <td><input type="radio" class="g13" name="p13" value="1"></td>
                <td><input type="radio" class="g13" name="p13" value="2"></td>
                <td><input type="radio" class="g13" name="p13" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>14</td>
                <td>Me siento más seguro si utilizo solamente unas las funciones que me resultan más familiares del sistema</td>
                <td><input type="radio" class="g14" name="p14" value="1"></td>
                <td><input type="radio" class="g14" name="p14" value="2"></td>
                <td><input type="radio" class="g14" name="p14" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>15</td>
                <td>La documentación del sistema es muy informativa</td>
                <td><input type="radio" class="g15" name="p15" value="1"></td>
                <td><input type="radio" class="g15" name="p15" value="2"></td>
                <td><input type="radio" class="g15" name="p15" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>16</td>
                <td>Este sistema parece interrumpir la forma en que normalmente me gusta organizar mi trabajo</td>
                <td><input type="radio" class="g16" name="p16" value="1"></td>
                <td><input type="radio" class="g16" name="p16" value="2"></td>
                <td><input type="radio" class="g16" name="p16" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>17</td>
                <td>Trabajar con este sistema es mentalmente estimulante</td>
                <td><input type="radio" class="g17" name="p17" value="1"></td>
                <td><input type="radio" class="g17" name="p17" value="2"></td>
                <td><input type="radio" class="g17" name="p17" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>18</td>
                <td>Nunca hay suficiente información en la pantalla del sistema cuando se necesita</td>
                <td><input type="radio" class="g18" name="p18" value="1"></td>
                <td><input type="radio" class="g18" name="p18" value="2"></td>
                <td><input type="radio" class="g18" name="p18" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>19</td>
                <td>Me siento al mando de este sistema cuando lo estoy usando</td>
                <td><input type="radio" class="g19" name="p19" value="1"></td>
                <td><input type="radio" class="g19" name="p19" value="2"></td>
                <td><input type="radio" class="g19" name="p19" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>20</td>
                <td>Prefiero utilizar las funciones que mejor conozco del sistema a todas las funciones que incluye</td>
                <td><input type="radio" class="g20" name="p20" value="1"></td>
                <td><input type="radio" class="g20" name="p20" value="2"></td>
                <td><input type="radio" class="g20" name="p20" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>21</td>
                <td>Creo que este sistema es inconsistente</td>
                <td><input type="radio" class="g21" name="p21" value="1"></td>
                <td><input type="radio" class="g21" name="p21" value="2"></td>
                <td><input type="radio" class="g21" name="p21" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>22</td>
                <td>No me gustaría usar este sistema todos los días</td>
                <td><input type="radio" class="g22" name="p22" value="1"></td>
                <td><input type="radio" class="g22" name="p22" value="2"></td>
                <td><input type="radio" class="g22" name="p22" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>23</td>
                <td>Puedo entender correctamente la información proporcionada por este software</td>
                <td><input type="radio" class="g23" name="p23" value="1"></td>
                <td><input type="radio" class="g23" name="p23" value="2"></td>
                <td><input type="radio" class="g23" name="p23" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>24</td>
                <td>Este sistema es incómodo cuando quiero hacer otra tarea fuera de los límites especificados</td>
                <td><input type="radio" class="g24" name="p24" value="1"></td>
                <td><input type="radio" class="g24" name="p24" value="2"></td>
                <td><input type="radio" class="g24" name="p24" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>25</td>
                <td>Hay mucha información que leer para poder aprender a utilizar el sistema correctamente</td>
                <td><input type="radio" class="g25" name="p25" value="1"></td>
                <td><input type="radio" class="g25" name="p25" value="2"></td>
                <td><input type="radio" class="g25" name="p25" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>26</td>
                <td>Las tareas se pueden realizar de manera directa utilizando este sistema</td>
                <td><input type="radio" class="g26" name="p26" value="1"></td>
                <td><input type="radio" class="g26" name="p26" value="2"></td>
                <td><input type="radio" class="g26" name="p26" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>27</td>
                <td>Resulta frustrante utilizar este sistema</td>
                <td><input type="radio" class="g27" name="p27" value="1"></td>
                <td><input type="radio" class="g27" name="p27" value="2"></td>
                <td><input type="radio" class="g27" name="p27" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>28</td>
                <td>El sistema me ha guiado a superar cualquier problema que haya tenido al utilizarlo</td>
                <td><input type="radio" class="g28" name="p28" value="1"></td>
                <td><input type="radio" class="g28" name="p28" value="2"></td>
                <td><input type="radio" class="g28" name="p28" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>29</td>
                <td>La velocidad de este sistema es lo suficientemente rápida para su uso</td>
                <td><input type="radio" class="g29" name="p29" value="1"></td>
                <td><input type="radio" class="g29" name="p29" value="2"></td>
                <td><input type="radio" class="g29" name="p29" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>30</td>
                <td>Necesito volver a mirar la información requerida para seguir utilizando este sistema</td>
                <td><input type="radio" class="g30" name="p30" value="1"></td>
                <td><input type="radio" class="g30" name="p30" value="2"></td>
                <td><input type="radio" class="g30" name="p30" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>31</td>
                <td>Las necesidades del usuario se han tenido plenamente en cuenta a la hora de desarrollar este sistema</td>
                <td><input type="radio" class="g31" name="p31" value="1"></td>
                <td><input type="radio" class="g31" name="p31" value="2"></td>
                <td><input type="radio" class="g31" name="p31" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>32</td>
                <td>Ha habido momentos en los que el uso de este sistema cuando me ha causado tensión</td>
                <td><input type="radio" class="g32" name="p32" value="1"></td>
                <td><input type="radio" class="g32" name="p32" value="2"></td>
                <td><input type="radio" class="g32" name="p32" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>33</td>
                <td>La organización de los menus de este sistema parece bastante lógica</td>
                <td><input type="radio" class="g33" name="p33" value="1"></td>
                <td><input type="radio" class="g33" name="p33" value="2"></td>
                <td><input type="radio" class="g33" name="p33" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>34</td>
                <td>El sistema permite al usuario ser práctico con las pulsaciones de teclas</td>
                <td><input type="radio" class="g34" name="p34" value="1"></td>
                <td><input type="radio" class="g34" name="p34" value="2"></td>
                <td><input type="radio" class="g34" name="p34" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>35</td>
                <td>Aprender a usar nuevas funciones del sistema es difícil</td>
                <td><input type="radio" class="g35" name="p35" value="1"></td>
                <td><input type="radio" class="g35" name="p35" value="2"></td>
                <td><input type="radio" class="g35" name="p35" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>36</td>
                <td>Hay demasiados pasos necesarios para que algo funcione correctamente</td>
                <td><input type="radio" class="g36" name="p36" value="1"></td>
                <td><input type="radio" class="g36" name="p36" value="2"></td>
                <td><input type="radio" class="g36" name="p36" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>37</td>
                <td>Considero que este sistema a veces me ha dado dolor de cabeza</td>
                <td><input type="radio" class="g37" name="p37" value="1"></td>
                <td><input type="radio" class="g37" name="p37" value="2"></td>
                <td><input type="radio" class="g37" name="p37" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>38</td>
                <td>Los mensajes de error del sistema no son adecuados</td>
                <td><input type="radio" class="g38" name="p38" value="1"></td>
                <td><input type="radio" class="g38" name="p38" value="2"></td>
                <td><input type="radio" class="g38" name="p38" value="3"></td>
            </tr>
        </form>
        <form action="/action_page.php">
            <tr><td>39</td>
                <td>Es fácil hacer que el sistema haga exactamente lo que quiere</td>
                <td><input type="radio" class="g39" name="p39" value="1"></td>
                <td><input type="radio" class="g39" name="p39" value="2"></td>
                <td><input type="radio" class="g39" name="p39" value="3"></td>
            </tr>
        </form>
        <form action="/action_page.php">
            <tr><td>40</td>
                <td>Nunca aprenderé a usar todo lo que se ofrece en este sistema</td>
                <td><input type="radio" class="g40" name="p40" value="1"></td>
                <td><input type="radio" class="g40" name="p40" value="2"></td>
                <td><input type="radio" class="g40" name="p40" value="3"></td>
            </tr>
        </form>
        <form action="/action_page.php">
            <tr><td>41</td>
                <td>El sistema no siempre ha hecho lo que esperaba</td>
                <td><input type="radio" class="g41" name="p41" value="1"></td>
                <td><input type="radio" class="g41" name="p41" value="2"></td>
                <td><input type="radio" class="g41" name="p41" value="3"></td>
            </tr>
        </form>


        <form action="/action_page.php">
            <tr><td>42</td>
                <td>El sistema se presenta de una manera muy atractiva</td>
                <td><input type="radio" class="g42" name="p42" value="1"></td>
                <td><input type="radio" class="g42" name="p42" value="2"></td>
                <td><input type="radio" class="g42" name="p42" value="3"></td>
            </tr>
        </form>

        <form action="/action_page.php">
            <tr><td>43</td>
                <td>La cantidad o la calidad de la información de ayuda varía según el sistema</td>
                <td><input type="radio" class="g43" name="p43" value="1"></td>
                <td><input type="radio" class="g43" name="p43" value="2"></td>
                <td><input type="radio" class="g43" name="p43" value="3"></td>
            </tr>
        </form>
        <form action="/action_page.php" id="hola">
            <tr><td>44</td>
                <td>Es relativamente fácil pasar de una parte de una tarea a otra dentro del sistema</td>
                <td><input type="radio" class="g44" name="p44" value="1"></td>
                <td><input type="radio" class="g44" name="p44" value="2"></td>
                <td><input type="radio" class="g44" name="p44" value="3"></td>
            </tr>
        </form>
        <form action="/action_page.php">
            <tr><td>45</td>
                <td>Es fácil olvidar cómo hacer las cosas con este sistema</td>
                <td><input type="radio" class="g45" name="p45" value="1"></td>
                <td><input type="radio" class="g45" name="p45" value="2"></td>
                <td><input type="radio" class="g45" name="p45" value="3"></td>
            </tr>
        </form>
        <form action="/action_page.php">
            <tr><td>46</td>
                <td>Este sistema ocasionalmente se comporta de una manera incomprensible</td>
                <td><input type="radio" class="g46" name="p46" value="1"></td>
                <td><input type="radio" class="g46" name="p46" value="2"></td>
                <td><input type="radio" class="g46" name="p46" value="3"></td>
            </tr>
        </form>
        <form action="/action_page.php">
            <tr><td>47</td>
                <td>Este sistema es realmente muy incómodo</td>
                <td><input type="radio" class="g47" name="p47" value="1"></td>
                <td><input type="radio" class="g47" name="p47" value="2"></td>
                <td><input type="radio" class="g47" name="p47" value="3"></td>
            </tr>
        </form>
        <form action="/action_page.php">
            <tr><td>48</td>
                <td>Es fácil echar un vistazo a cuáles son las opciones en cada etapa del sistema</td>
                <td><input type="radio" class="g48" name="p48" value="1"></td>
                <td><input type="radio" class="g48" name="p48" value="2"></td>
                <td><input type="radio" class="g48" name="p48" value="3"></td>
            </tr>
        </form>
        <form action="/action_page.php">
            <tr><td>49</td>
                <td>La entrada y salida de archivos de datos del sistema no es nada fácil</td>
                <td><input type="radio" class="g49" name="p49" value="1"></td>
                <td><input type="radio" class="g49" name="p49" value="2"></td>
                <td><input type="radio" class="g49" name="p49" value="3"></td>
            </tr>
        </form>
        <form action="/action_page.php">
            <tr><td>50</td>
                <td>Tengo que buscar ayuda la mayoría de las veces cuando uso este sistema</td>
                <td><input type="radio" class="g50" name="p50" value="1"></td>
                <td><input type="radio" class="g50" name="p50" value="2"></td>
                <td><input type="radio" class="g50" name="p50" value="3"></td>
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
    //var boton = document.getElementById('nuevo_proy');
    function registrarResultado(){
        //boton.style.display = 'none';
        //var radios = JQuery("input[type='radio']");
        //radios.filter(":checked");
        //alert(radios);
        var p1 = Number($("input:radio[name=p1]:checked").val());
        var p2 = Number($("input:radio[name=p2]:checked").val());
        var p3 = Number($("input:radio[name=p3]:checked").val());
        var p4 = Number($("input:radio[name=p4]:checked").val());
        var p5 = Number($("input:radio[name=p5]:checked").val());
        var p6 = Number($("input:radio[name=p6]:checked").val());
        var p7 = Number($("input:radio[name=p7]:checked").val());
        var p8 = Number($("input:radio[name=p8]:checked").val());
        var p9 = Number($("input:radio[name=p9]:checked").val());
        var p10 = Number($("input:radio[name=p10]:checked").val());

        var p11 = Number($("input:radio[name=p11]:checked").val());
        var p12 = Number($("input:radio[name=p12]:checked").val());
        var p13 = Number($("input:radio[name=p13]:checked").val());
        var p14 = Number($("input:radio[name=p14]:checked").val());
        var p15 = Number($("input:radio[name=p15]:checked").val());
        var p16 = Number($("input:radio[name=p16]:checked").val());
        var p17 = Number($("input:radio[name=p17]:checked").val());
        var p18 = Number($("input:radio[name=p18]:checked").val());
        var p19 = Number($("input:radio[name=p19]:checked").val());
        var p20 = Number($("input:radio[name=p20]:checked").val());

        var p21 = Number($("input:radio[name=p21]:checked").val());
        var p22 = Number($("input:radio[name=p22]:checked").val());
        var p23 = Number($("input:radio[name=p23]:checked").val());
        var p24 = Number($("input:radio[name=p24]:checked").val());
        var p25 = Number($("input:radio[name=p25]:checked").val());
        var p26 = Number($("input:radio[name=p26]:checked").val());
        var p27 = Number($("input:radio[name=p27]:checked").val());
        var p28 = Number($("input:radio[name=p28]:checked").val());
        var p29 = Number($("input:radio[name=p29]:checked").val());
        var p30 = Number($("input:radio[name=p30]:checked").val());

        var p31 = Number($("input:radio[name=p31]:checked").val());
        var p32 = Number($("input:radio[name=p32]:checked").val());
        var p33 = Number($("input:radio[name=p33]:checked").val());
        var p34 = Number($("input:radio[name=p34]:checked").val());
        var p35 = Number($("input:radio[name=p35]:checked").val());
        var p36 = Number($("input:radio[name=p36]:checked").val());
        var p37 = Number($("input:radio[name=p37]:checked").val());
        var p38 = Number($("input:radio[name=p38]:checked").val());
        var p39 = Number($("input:radio[name=p39]:checked").val());
        var p40 = Number($("input:radio[name=p40]:checked").val());

        var p41 = Number($("input:radio[name=p41]:checked").val());
        var p42 = Number($("input:radio[name=p42]:checked").val());
        var p43 = Number($("input:radio[name=p43]:checked").val());
        var p44 = Number($("input:radio[name=p44]:checked").val());
        var p45 = Number($("input:radio[name=p45]:checked").val());
        var p46 = Number($("input:radio[name=p46]:checked").val());
        var p47 = Number($("input:radio[name=p47]:checked").val());
        var p48 = Number($("input:radio[name=p48]:checked").val());
        var p49 = Number($("input:radio[name=p49]:checked").val());
        var p50 = Number($("input:radio[name=p50]:checked").val());
        // alert(p1);
        //     alert(p44);

        // if (p1 == null && p2 == null && p3 == null && p4 == null && p5 == null && p6 == null && p7 == null && p8 == null && p9 == null && p10 == null && p11 == null && p12 == null && p13 == null && p14 == null && p15 == null && p16 == null && p17 == null && p18 == null && p19 == null && p20 == null && p21 == null && p22 == null && p23 == null && p24 == null && p25 == null && p26 == null && p27 == null && p28 == null && p29 == null && p30 == null && p31 == null && p32 == null && p33 == null && p34 == null && p35 == null && p36 == null && p37 == null && p38 == null && p39 == null && p40 == null && p41 == null && p42 == null && p43 == null && p44 == null && p45 == null && p46 == null && p47 == null && p48 == null && p49 == null && p50 == null) {
            
        //     swal ( "¡Error! Cuestionario no enviado" ,  "Debes completar todas las preguntas" ,  "error" );

        // } else if (p1 == null || p2 == null || p3 == null || p4 == null || p5 == null || p6 == null || p7 == null || p8 == null || p9 == null || p10 == null || p11 == null || p12 == null || p13 == null || p14 == null || p15 == null || p16 == null || p17 == null || p18 == null || p19 == null || p20 == null || p21 == null || p22 == null || p23 == null || p24 == null || p25 == null || p26 == null || p27 == null || p28 == null || p29 == null || p30 == null || p31 == null || p32 == null || p33 == null || p34 == null || p35 == null || p36 == null || p37 == null || p38 == null || p39 == null || p40 == null || p41 == null || p42 == null || p43 == null || p44 == null || p45 == null || p46 == null || p47 == null || p48 == null || p49 == null || p50 == null) {
        //     swal ( "¡Error! Cuestionario no enviado" ,  "Debes completar todas las preguntas" ,  "error" );
            

        // } else {

        var valor_eficiencia;
        var valor_afecto;
        var valor_ayuda;
        var valor_control;
        var valor_aprendizaje;
        
        var valor_usabilidad_global;
        var valor_puntuacion_final;
      
        valor_eficiencia = (((p1 + p6 + p11 + p16 + p21 + p26 + p31 + p36 + p41 + p46)/10)/3)*100;
        alert(valor_eficiencia);
        valor_afecto = (((p2 + p7 + p12 + p17 + p22 + p27 + p32 + p37 + p42 + p47)/10)/3)*100;
        alert(valor_afecto);
        valor_ayuda = (((p3 + p8 + p13 + p18 + p23 + p28 + p33 + p38 + p43 + p48)/10/3) )*100;
        valor_control = (((p4 + p9 + p14 + p19 + p24 + p29 + p34 + p39 + p44 + p49)/10)/3 )*100;
        valor_aprendizaje = (((p5 + p10 + p15 + p20 + p25 + p30 + p35 + p40 + p45 + p50)/100)/3)*10;
        
        valor_usabilidad_global = (((p7 + p8 + p15 + p18 + p19 + p21 + p23 + p24 + p26 + p27 + p28 + p31 + p35 + p36 + p37 + p38 + p39 + p41 + p42 + p43 + p44 + p45 + p46+ p48 + p49)/25)/3)*100;

        valor_puntuacion_final = ((valor_eficiencia+valor_afecto+valor_ayuda+valor_control+valor_aprendizaje+valor_usabilidad_global)/6);
        
                $.ajax({
                  type: "POST",
                  url: "ajax_resultados_cuestionario_sumi.php",
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
                      p11: p11,
                      p12: p12,
                      p13: p13,
                      p14: p14,
                      p15: p15,
                      p16: p16,
                      p17: p17,
                      p18: p18,
                      p19: p19,
                      p20: p20,
                      p21: p21,
                      p22: p22,
                      p23: p23,
                      p24: p24,
                      p25: p25,
                      p26: p26,
                      p27: p27,
                      p28: p28,
                      p29: p29,
                      p30: p30,
                      p31: p31,
                      p32: p32,
                      p33: p33,
                      p34: p34,
                      p35: p35,
                      p36: p36,
                      p37: p37,
                      p38: p38,
                      p39: p39,
                      p40: p40,
                      p41: p41,
                      p42: p42,
                      p43: p43,
                      p44: p44,
                      p45: p45,
                      p46: p46,
                      p47: p47,
                      p48: p48,
                      p49: p49,
                      p50: p50,
                      valor_eficiencia: valor_eficiencia,
                      valor_afecto: valor_afecto,
                      valor_ayuda: valor_ayuda,
                      valor_control: valor_control,
                      valor_aprendizaje: valor_aprendizaje,
                      valor_usabilidad_global: valor_usabilidad_global,
                      valor_puntuacion_final: valor_puntuacion_final

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
                              window.location.href = "./resultados_sumi.php?u=<?php echo $_REQUEST['url']; ?>"+'&id='+data+'&p=1';
                              
                            }, 100);
                            }
                          });
                  }
              });
          

            //}

        }
  </script>
  </body>
</html>