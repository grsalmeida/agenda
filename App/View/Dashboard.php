
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">


    <!-- Custom styles for this template -->
    <link href="<?= self::asset("css/dashboard.css") ?>" rel="stylesheet" type="text/css"/>
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(hour);


      function hour() {
        var jsonData = $.ajax({
          type: "GET",
          url: "/hour",
          dataType: "json",
          async: false
          }).responseText;      
        var data = new google.visualization.DataTable(jsonData);
        var options = {title:'Total de cadastro por Hora',
                       width:600,
                       height:500};

        var chart = new google.visualization.BarChart(document.getElementById('1'));
        chart.draw(data, options);

              var dataPoints = [
          { x: 10, y: 10 },{ x: 20, y: 15 },{ x: 30, y: 25 },{ x: 40, y: 30 },{ x: 50, y: 28 } ];
        
      renderMyChart(chartContainer1, dataPoints);
      renderMyChart(chartContainer2, dataPoints);
      renderMyChart(chartContainer3, dataPoints);


      function renderMyChart(theDIVid, myData) {
          var chart = new CanvasJS.Chart(theDIVid, {
              data: [
                  {
                      type: "column",
                      dataPoints: myData
                  }
              ]
          });
          chart.render();
      }
            }
    </script>
  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="\lista">Agenda <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <div class="container-fluid">
      <div class="row">
        <main role="main" class="col-sm-12 ml-sm-auto col-md-12 pt-3">
          <h1>Dashboard</h1>

          <section class="row text-center placeholders">
            <div class="col-12 col-sm-12 placeholder">
              <div id="1"></div>
              <div id="chartContainer1" style="width:100%; height:300px"></div>
<div id="chartContainer2" style="width:100%; height:300px"></div>
<div id="chartContainer3" style="width:100%; height:300px"></div>
            </div>
          </section>
        </main>
      </div>
    </div>
  </body>
</html>
