<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>การใช้งาน Highcharts JS With PHP MySQL</title>

  <!-- Bootstrap -->
  <!-- Latest compiled and minified CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  <h1>Hello, world!</h1>
  <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  <table class="table" id="datatable">
    <thead>
      <tr>
        <th></th>
        <th>Mr.A</th>
        <th>Mr.B</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th>PHP Skills</th>
        <td>3</td>
        <td>4</td>
      </tr>
      <tr>
        <th>MySql Skills</th>
        <td>2</td>
        <td>0</td>
      </tr>
      <tr>
        <th>Boostarp Skills</th>
        <td>5</td>
        <td>11</td>
      </tr>
      <tr>
        <th>Javascript Skills</th>
        <td>1</td>
        <td>1</td>
      </tr>

    </tbody>
  </table>

  <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/data.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>

  <script>
    $(function() {
      $('#container').highcharts({
        data: {
          table: 'datatable'
        },
        chart: {
          type: 'column'
        },
        title: {
          text: 'Data extracted from a HTML table in the page'
        },
        yAxis: {
          allowDecimals: false,
          title: {
            text: 'Units'
          }
        },
        tooltip: {
          formatter: function() {
            return '<b>' + this.series.name + '</b><br/>' +
              this.point.y + ' ' + this.point.name.toLowerCase();
          }
        }
      });
    });
  </script>
</body>

</html>