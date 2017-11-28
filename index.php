
<?php
$servername = 'localhost';

$username = 'root';

$password = 'root';

$dbname = 'cmpe281proj';



$mysqli = new mysqli($servername, $username, $password, $dbname);
if($mysqli->connect_error){
    die("Connection failed: ". $mysqli->connect_error);
}

//for pie chart
$query = "SELECT instance_name,num_user FROM instance";
$qresult= mysqli_query($mysqli,$query);

//for the first line chart
//$query1 = "select "
// $results = array();

// while ($res = $qresult->fetch_assoc()) {
//     $results[] = $res;
// }

// $line_chart_data = array();
// foreach ($results as $result) {
//     $line_chart_data[] = array($result['instance_name'],(int)$result['num_user']);
    
// }

// $line_chart_data = json_encode($line_chart_data);

// echo $line_chart_data;
// mysqli_free_result($qresult);

// mysqli_close($mysqli);
?>

<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- <script> src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"</script> -->
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

      // Create the data table.
      var data = new google.visualization.arrayToDataTable([
      				['Community', 'Users'],
      				<?php 
      				while ($row = mysqli_fetch_array($qresult)) {
      					echo "['".$row["instance_name"]."',".$row["num_user"]."],";
      				}
      				?>
      			]);

      // Set chart options
      var options = {'title':'Number of Users',
                     'width':700,
                     'height':300};

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
    </script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'San Jose Police Department', 'San Jose State University', 'San Jose Central Hospital'],
          ['2014',  1000,      400,123],
          ['2015',  1170,      460,321],
          ['2016',  660,       1120,1000],
          ['2017',  1030,      540,1234]
        ]);

        var options = {
          title: 'User Activities',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
    
  </head>
<title>DASHBOARD</title>
<h1>DASHBOARD</h1>
  <body>
	<div id="curve_chart" style="width: 1300px; height: 300px"></div>
    <div id="chart_div" style="width:700; height:300"></div>
    <!-- <div id="chart_div" style="width:700; height:300"></div> -->
  </body>
</html>
		
