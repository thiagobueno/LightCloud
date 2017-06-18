<?php
$this->layout('layouts::app');

$pdo = Database::instance();

?>

<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Day', 'Users'],
          ['Monday', 12.2],
          ['Tuesay', 9.1],
          ['Wednesday', 9],
          ['Thuesay', 8],
          ['Friday', 7],
          ['Saturday', 11],
          ['Sunday', 10],
        ]);

        var options = {
          title: 'SOON',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
</script>

  <div class="page-title">
    <div class="title_left">
      <h3>Stats</h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Users</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div id="chart_div" style="width: 900px; height: 500px;"></div>
        </div>
      </div>
    </div>

  </div>
