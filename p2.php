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
  padding: 0.2em 0.3em;
  font-size: 0.875em;
  color: #222222;
  border: 0.5px solid #dddddd;
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
      content: "En desacuerdo - 1";
    }
    
    td:nth-of-type(4):before {
      content: "No sé - 2";
    }
    
    td:nth-of-type(5):before {
      content: "De acuerdo - 3";
    }
    
}
      </style>
    </div>
    </style>
    <div class="container"></div>
    <div class="container"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table id="example" class="resp" style="width:100%">
                <thead>
                    <tr>
                        <th>Edad</th>
                        <th>Sexo</th>
                        <th>Estudios</th>
                        <th>Experiencia1</th>
                        <th>Exp2</th>
                    </tr>
                </thead>
                     <tbody>
                </tbody>
            </table>
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
    <script>
  $(document).ready(function() {
      var table = $('#example').DataTable( {
          dom: 'Bfrtip',
          lengthChange: false,
          buttons: [ 'copy', 'excel', 'csv', 'pdf', 'colvis' ],
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          ajax: 'ajax_resultaditos.php'
      } );
   
      table.buttons().container()
          .appendTo( '#example_wrapper .col-md-6:eq(0)' );
  } );
     </script>
</body>
</html>
