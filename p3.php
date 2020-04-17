<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <title>Bootstrap 4 Responsive Datatable and Export to PDF, CSV</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
      
</head>
<body>
<style type="text/css">
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
  padding: 0.3em 0.4em;
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
      content: "Usuario";
    }
    
    td:nth-of-type(2):before {
      content: "Eficiencia";
    }
    
    td:nth-of-type(3):before {
      content: "Afecto";
    }
    
    td:nth-of-type(4):before {
      content: "Ayuda";
    }
    
    td:nth-of-type(5):before {
      content: "Control";
    }

    td:nth-of-type(6):before {
      content: "Aprendizaje";
    }

    td:nth-of-type(7):before {
      content: "Usabilidad Global";
    }
    
}
</style>
    <h5><strong>Contenidos del informe: </strong></h5>
        <section class="botones">
            <div class="bloque_btn1">
                <div class="btn btn_izq">
                    <a onClick="myFunction()" style="color:#007bff;">Datos por participante por escalas</a>
                </div>
            </div>
            
            <div id="bloque_enlaces" style="display: none">
                <h2>AAA</h2>
            </div>
            
            <div class="bloque_btn1">
                <div class="btn btn_izq">
                    <a onClick="myFunction1()" style="color:#007bff;">Datos por participante por escalas</a>
                </div>
            </div>
          
            <div id="bloque_enlaces1" style="display: none">
                <h2>BBB</h2>
            </div>
             
        </section>
      
        <script type="text/javascript">
          
            function myFunction() {
                var x = document.getElementById("bloque_enlaces");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }

            }
            function myFunction1(){
              var y = document.getElementById("bloque_enlaces1");
                if (y.style.display === "none") {
                    y.style.display = "block";
                } else {
                    y.style.display = "none";
                }
            }
        </script>
</body>
</html>
