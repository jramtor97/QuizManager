<?php

include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/config.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

$titulo = 'Lista de proyectos';

//EN CONCRETO ESTA BARRA NO SALE EL PARTICIPANTE (Q ES LO QUE QUIERO; QUE NO SALGA EN ESTADÍSTICAS)
include_once 'plantillas/documento-declaracion.inc4.php';
//include_once 'plantillas/navbar.inc.php';

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
   
  <link rel="stylesheet" type="text/css" href="plotly/bootstrap/css/bootstrap.css">
  <script src="plotly/jquery-3.3.1.min.js"></script>
  <script src="plotly/plotly-latest.min.js"></script>
  <div class="container">
    <div class="row">
      <div id='myDivv'></div>
    </div>
  </div>
  </head>
<?php
            $connect = mysqli_connect("localhost", "root", "", "blog");

            $sql = "SELECT r.valor AS EFI FROM prueba_sumi r
            WHERE r.id_proyecto = 2
            AND r.id_pregunta IN(1,6,11,16,21,26,31,36,41,46)";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $valor_efi=array(); 

            while($row = mysqli_fetch_array($registro)){
                  $valor_efi[] = $row['EFI'];
            };
          
            echo "<pre>";
            print_r($valor_efi);
            
            $valor_efi=json_encode($valor_efi);

            $sql = "SELECT r.id_pregunta AS ID_EFI FROM prueba_sumi r
            WHERE r.id_proyecto = 2
            AND r.id_pregunta IN(1,6,11,16,21,26,31,36,41,46)";

            $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            $valor_efi_id=array(); 

            while($row = mysqli_fetch_array($registro)){
                  $valor_efi_id[] = $row['ID_EFI'];
            };
          
            echo "<pre>";
            print_r($valor_efi_id);
            
            $valor_efi_id=json_encode($valor_efi_id);

            // $sql = "SELECT r.valor_afecto AS AFEC FROM respuestas_sumi r
            // WHERE r.id_proyecto = 6";

            // $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            // $valor_afec=array(); 

            // while($row = mysqli_fetch_array($registro)){
            //       $valor_afec[] = $row['AFEC'];
            // };
          
            // echo "<pre>";
            // print_r($valor_afec);
            
            // $valor_afec=json_encode($valor_afec);

            // $sql = "SELECT r.valor_ayuda AS AYUDA FROM respuestas_sumi r
            // WHERE r.id_proyecto = 6";

            // $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            // $valor_ayu=array(); 

            // while($row = mysqli_fetch_array($registro)){
            //       $valor_ayu[] = $row['AYUDA'];
            // };
          
            // echo "<pre>";
            // print_r($valor_ayu);
            
            // $valor_ayu=json_encode($valor_ayu);

            // $sql = "SELECT r.valor_control AS CONTROL FROM respuestas_sumi r
            // WHERE r.id_proyecto = 6";

            // $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            // $valor_control=array(); 

            // while($row = mysqli_fetch_array($registro)){
            //       $valor_control[] = $row['CONTROL'];
            // };
          
            // echo "<pre>";
            // print_r($valor_control);
            
            // $valor_control=json_encode($valor_control);

            // $sql = "SELECT r.valor_aprendizaje AS APR FROM respuestas_sumi r
            // WHERE r.id_proyecto = 6";

            // $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            // $valor_apr=array(); 

            // while($row = mysqli_fetch_array($registro)){
            //       $valor_apr[] = $row['APR'];
            // };
          
            // echo "<pre>";
            // print_r($valor_apr);
            
            // $valor_apr=json_encode($valor_apr);

            // $sql = "SELECT r.valor_usabilidad_global AS USB FROM respuestas_sumi r
            // WHERE r.id_proyecto = 6";

            // $registro = mysqli_query($connect, $sql) or die(mysqli_error($connect));

            // $valor_usab_gl=array(); 

            // while($row = mysqli_fetch_array($registro)){
            //       $valor_usab_gl[] = $row['USB'];
            // };
          
            // echo "<pre>";
            // print_r($valor_usab_gl);
            
            // $valor_usab_gl=json_encode($valor_usab_gl);

?>
    <script type="text/javascript">
        function crearCadenaLineal(json){
          var parsed = JSON.parse(json);
          var arr = [];
          for (var x in parsed){
            arr.push(parsed[x]);
          }
          return arr;
        }
</script>
<script type="text/javascript">
    valor_efi = crearCadenaLineal('<?php echo $valor_efi; ?>');
    valor_efi_id = crearCadenaLineal('<?php echo $valor_efi_id; ?>');
    // valor_afec = crearCadenaLineal('<?php //echo $valor_afec; ?>');
    // valor_ayu = crearCadenaLineal('<?php //echo $valor_ayu; ?>');
    // valor_control = crearCadenaLineal('<?php //echo $valor_control; ?>');
    // valor_apr = crearCadenaLineal('<?php //echo $valor_apr; ?>');
    // valor_usab_gl = crearCadenaLineal('<?php //echo $valor_usab_gl; ?>');

    var trace1 = {
        x: valor_efi_id,
        y: valor_efi,
        type: 'box',
        name: 'Mean and Standard Deviation',
        marker: {
          color: 'rgb(10,140,208)'
        },
        boxmean: 'sd'
      };

      // var trace2 = {
      //   x: ['Afecto'],
      //   y: valor_afec,
      //   type: 'box',
      //   //name: 'Mean and Standard Deviation',
      //   marker: {
      //     color: 'rgb(10,140,208)'
      //   },
      //   boxmean: 'sd'
      // };

      // var trace3 = {
      //   x: ['Ayuda'],
      //   y: valor_ayu,
      //   type: 'box',
      //   //name: 'Mean and Standard Deviation',
      //   marker: {
      //     color: 'rgb(10,140,208)'
      //   },
      //   boxmean: 'sd'
      // };

      // var trace4 = {
      //   x: ['Control'],
      //   y: valor_control,
      //   type: 'box',
      //   //name: 'Mean and Standard Deviation',
      //   marker: {
      //     color: 'rgb(10,140,208)'
      //   },
      //   boxmean: 'sd'
      // };

      // var trace5 = {
      //   x: ['Aprendizaje'],
      //   y: valor_apr,
      //   type: 'box',
      //   //name: 'Mean and Standard Deviation',
      //   marker: {
      //     color: 'rgb(10,140,208)'
      //   },
      //   boxmean: 'sd'
      // };

      // var trace6 = {
      //   x: ['Usabilidad global'],
      //   y: valor_usab_gl,
      //   type: 'box',
      //   //name: 'Mean and Standard Deviation',
        
      //   boxmean: 'sd'
      // };


      var data = [trace1];

      var layout = {
        responsive: true,
        title: 'Diagrama de cajas por pregunta para la media y la desviación estándar',
        xaxis:{
          title: 'Preguntas'
        },
        yaxis:{
          title: 'Puntuación pregunta'
        }
      };
      var config2 = {responsive: true};
      Plotly.newPlot('myDivv', data, layout, config2);
  </script>

</body>
</html>

