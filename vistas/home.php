<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';


include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com -->
  <title>Quiz Manager</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <!-- Este LINK cambia la letra de la barra -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  body {
    font: 400 15px Lato, sans-serif;
    line-height: 1.8;
    color: #818181;
  }
  h2 {
    font-size: 24px;
    text-transform: uppercase;
    color: #303030;
    font-weight: 600;
    margin-bottom: 30px;
  }
  h4 {
    font-size: 19px;
    line-height: 1.375em;
    color: #303030;
    font-weight: 400;
    margin-bottom: 30px;
  }  
  .jumbotron {
    background-color: deepskyblue;
    color: #fff;
    padding: 100px 25px;
    font-family: Montserrat, sans-serif;
  }
  .container-fluid {
    padding: 60px 50px;
  }
  .bg-grey {
    background-color: #f6f6f6;
  }
  .logo-small {
    color: deepskyblue;
    font-size: 50px;
  }
  .logo {
    color: deepskyblue;
    font-size: 200px;
  }
  .logo1 {
    color: deepskyblue;
    font-size: 200px;
  }
  .logo2 {
    color: deepskyblue;
    font-size: 200px;
  }
  .thumbnail {
    padding: 0 0 15px 0;
    border: none;
    border-radius: 0;
  }
  .thumbnail img {
    width: 100%;
    height: 100%;
    margin-bottom: 10px;
  }
  .carousel-control.right, .carousel-control.left {
    background-image: none;
    color: deepskyblue;
  }
  .carousel-indicators li {
    border-color: deepskyblue;
  }
  .carousel-indicators li.active {
    background-color: deepskyblue;
  }
  .item h4 {
    font-size: 19px;
    line-height: 1.375em;
    font-weight: 400;
    font-style: italic;
    margin: 70px 0;
  }
  .item span {
    font-style: normal;
  }
  .panel {
    border: 1px solid deepskyblue; 
    border-radius:0 !important;
    transition: box-shadow 0.5s;
  }
  .panel:hover {
    box-shadow: 5px 0px 40px rgba(0,0,0, .2);
  }
  .panel-footer .btn:hover {
    border: 1px solid deepskyblue;
    background-color: #fff !important;
    color: deepskyblue;
  }
  .panel-heading {
    color: #fff !important;
    background-color: deepskyblue;
    padding: 25px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
  }
  .panel-footer {
    background-color: white !important;
  }
  .panel-footer h3 {
    font-size: 32px;
  }
  .panel-footer h4 {
    color: #aaa;
    font-size: 14px;
  }
  .panel-footer .btn {
    margin: 15px 0;
    background-color: deepskyblue;
    color: #fff;
  }
  /*.navbar {
    margin-bottom: 0;
    background-color: #f4511e;
    z-index: 9999;
    border: 0;
    font-size: 12px !important;
    line-height: 1.42857143 !important;
    letter-spacing: 4px;
    border-radius: 0;
    font-family: Montserrat, sans-serif;
  }
  .navbar li a, .navbar .navbar-brand {
    color: #fff !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
    color: #f4511e !important;
    background-color: #fff !important;
  }
  .navbar-default .navbar-toggle {
    border-color: transparent;
    color: #fff !important;
  }*/
  footer .glyphicon {
    font-size: 20px;
    margin-bottom: 20px;
    color: deepskyblue;
  }
  .slideanim {visibility:hidden;}
  .slide {
    animation-name: slide;
    -webkit-animation-name: slide;
    animation-duration: 1s;
    -webkit-animation-duration: 1s;
    visibility: visible;
  }
  @keyframes slide {
    0% {
      opacity: 0;
      transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      transform: translateY(0%);
    }
  }
  @-webkit-keyframes slide {
    0% {
      opacity: 0;
      -webkit-transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      -webkit-transform: translateY(0%);
    }
  }
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
    .btn-lg {
      width: 100%;
      margin-bottom: 35px;
    }
  }
  @media screen and (max-width: 480px) {
    .logo {
      font-size: 150px;
    }
  }
  </style>
</head>
<div class="container">
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<!-- <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#about">ABOUT</a></li>
        <li><a href="#services">SERVICES</a></li>
        <li><a href="#portfolio">PORTFOLIO</a></li>
        <li><a href="#pricing">PRICING</a></li>
        <li><a href="#contact">CONTACT</a></li>
      </ul>
    </div> 
  </div>
</nav> -->

<div class="jumbotron text-center">
  <h1>QuizManager</h1> 
  <p>Especialistas en ofrecer cuestionarios a medida para sus soluciones software</p> 
      
        <button type="button" class="btn btn-danger" onclick="location.href='./crear_proyecto.php'">ÚNETE AHORA</button>
     
</div>

<div class="container-fluid bg-grey">
  <div class="row">
    <div class="col-sm-8">
      <h2>Sobre la página web</h2><br>
      <h4 align="justify">QuizManager es una aplicación web dedicada a la gestión de cuestionarios de satisfacción, una empresa o particular puede optar por la realización de un determinado cuestionario que se ajuste a sus necesidades de negocio. Entre los cuestionarios que ofrecemos se encuentran los siguientes: SUS, Smileyometer, SUMMI, etc.</h4><br>
      <p align="justify"><strong>FUNCIONAMIENTO:</strong> En primer lugar, el usuario debe registrarse aportando los datos relativos a usuario, correo electrónico y contraseña. Después creará un proyecto que asociará a un determinado cuestionario. En este momento, se ofrecerá una URL, que podrá compartir con otros usuarios. La idea principal es que varios usuarios realicen el cuestionario, y una vez cumplimentado, se mostrarán los resultados individuales de cada participante así como una media de los resultados obtenidos.</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-signal logo slideanim"></span>
      <i class="icon-pie-chart logo1"></i>
      <span class="fa fa-line-chart logo2 slideanim"></span>
      <i class="icon-large icon-search"></i>
    </div>
  </div>
</div>

<!-- Container (Services Section) -->
<div id="services" class="container-fluid text-center">
  <h2>SERVICIOS</h2>
  <h4>¿Qué podemos ofrecerle?</h4>
  <br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-lock logo-small"></span>
      <h4>SERIEDAD</h4>
      <p align="justify">Nos comprometemos enormemente a brindar nuestros servicios de la manera más rápida y eficaz, de tal forma que pueda visualizar resultados una vez haya utilizado nuestros servicios. En concreto, los usuarios podrán seleccionar las fechas de publicación y/o cierre de los cuestionarios, así como la visualización de sus resultados. Todo ello ajustándonos a sus necesidades.</p>
    </div>
    <div class="col-sm-4">
      <span class="fa fa-send logo-small"></span>
      <h4>EFICACIA</h4>
      <p align="justify">Nuestra página web es una solución software específica que funciona de manera rápida y eficaz, tratando de dar los mejores resultados, o al menos, los más aproximados en base a los datos que nos proporcionan nuestros clientes. Para ello damos a elegir entre distintos tipos de cuestionarios, mediante los cuales, tras su cumplimentación, se listarán los resultados oportunos.</p>
    </div>
    
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-warning-sign logo-small"></span>
      <h4>SEGURIDAD</h4>
      <p align="justify"> Sus datos de registro, así como los datos personales (excepto los datos relativos al cuestionario, que serán objeto de uso de la aplicación y serán vistos por cualquier persona) serán tratados adecuadamente, cumpliendo con la Ley Orgánica de Protección de Datos (LOPD) y en concreto las contraseñas serán encriptadas con código hash una vez guardadas en nuestra base de datos.</p>
    </div>
  </div>
  <br><br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-ok logo-small"></span>
      <h4>ATENCIÓN</h4>
      <p align="justify">Siempre hemos sido una empresa que apuesta por sus clientes, ofreciendo cuestionarios a medida para sus soluciones software. Con nosotros dispondrás de distintos cuestionarios para medir la usabilidad de su aplicación y poder sacar conclusiones de la viabilidad de su proyecto.</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-certificate logo-small"></span>
      <h4>CERTIFICACIÓN</h4>
      <p align="justify">Nuestra aplicación cuenta con excelentes medidas de calidad para brindarle una experiencia de usuario eficiente e intuitiva. Además, nuestra página web está programada de tal forma que, incluso usuarios con pocos conocimientos informáticos puedan hacer un uso exitoso y conseguir los resultados requeridos.</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-wrench logo-small"></span>
      <h4 style="color:#303030;">EFICIENCIA</h4>
      <p align="justify">Mostramos nuestra preocupación de que el usuario se sienta seguro utilizando nuestra herramienta, por ello podemos ofrecerle de una manera muy sencilla, la realización de un cuestionario que se ajuste a sus necesidades de negocio y a la medición e interpretación de sus resultados.</p>
    </div>
  </div>
</div>

<!-- Container (Portfolio Section) -->
<div id="portfolio" class="container-fluid text-center bg-grey">
 <h2>¿QUÉ OPINAN NUESTROS CLIENTES?</h2>
  <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <h4>"Estoy muy convencido con los resultados obtenidos."<br><span>Michael Roe, Vice President, Comment Box</span></h4>
      </div>
      <div class="item">
        <h4>"Una palabra... GUAU!!"<br><span>John Doe, Salesman, Rep Inc</span></h4>
      </div>
      <div class="item">
        <h4>"Podría... ESTAR más contento con esta compañía?"<br><span>Sandra Delgado, Ingeniera del Software, España</span></h4>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
</div>

<div class="container">
<!-- Container (Pricing Section) -->
<div id="pricing" class="container-fluid">
  <div class="text-center">
    <h2>PRECIO</h2>
    <h4>Elija el plan que más se ajuste a sus necesidades</h4>
  </div>
  <div class="row slideanim">
    <div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h1>Gratis</h1>
        </div>
        <div class="panel-body">
          <p><strong>20</strong> Lorem</p>
          <p><strong>15</strong> Ipsum</p>
          <p><strong>5</strong> Dolor</p>
          <p><strong>2</strong> Sit</p>
          <p><strong>Endless</strong> Amet</p>
        </div>
        <div class="panel-footer">
          <h3>0€</h3>
          <h4>por mes</h4>
          <button class="btn btn-lg" onclick="location.href='./registro'">Registro</button>
        </div>
      </div>      
    </div>     
    <div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h1>Básico</h1>
        </div>
        <div class="panel-body">
          <p><strong>50</strong> Lorem</p>
          <p><strong>25</strong> Ipsum</p>
          <p><strong>10</strong> Dolor</p>
          <p><strong>5</strong> Sit</p>
          <p><strong>Endless</strong> Amet</p>
        </div>
        <div class="panel-footer">
          <h3>5€</h3>
          <h4>por mes</h4>
          <button class="btn btn-lg" onclick="location.href='./registro'">Registro</button>
        </div>
      </div>      
    </div>       
    <div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h1>Avanzado</h1>
        </div>
        <div class="panel-body">
          <p><strong>100</strong> Lorem</p>
          <p><strong>50</strong> Ipsum</p>
          <p><strong>25</strong> Dolor</p>
          <p><strong>10</strong> Sit</p>
          <p><strong>Endless</strong> Amet</p>
        </div>
        <div class="panel-footer">
          <h3>10€</h3>
          <h4>por mes</h4>
          <button class="btn btn-lg" onclick="location.href='./registro'">Registro</button>
        </div>
      </div>      
    </div>    
  </div>
</div>

</div>

<div class="container">
<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid bg-grey">
  <h2 class="text-center">CONTACTO</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Contacta con nosotros y responderemos en menos de 24 horas.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Albacete, España</p>
      <p><span class="glyphicon glyphicon-phone"></span> +34 674 46 91 97</p>
      <p><span class="glyphicon glyphicon-envelope"></span> jramtor97@gmail.com</p>
    </div>
    <div class="col-sm-7 slideanim">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Nombre" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comentario" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit">Enviar</button>
        </div>
      </div>
    </div>
  </div>
</div>
</body></div>

</div>

<!-- Image of location/map -->
<!-- <img src="/w3images/map.jpg" class="w3-image w3-greyscale-min" style="width:100%"> -->

<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
</footer>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>

<?php
//PARA MOSTRAR LA BARRA DE NAVEGACIÓN RESPONSIVE!!!!!!!!
include_once 'plantillas/documento-cierre.inc.php';
?>