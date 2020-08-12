<script src="<?= base_url();?>assets/bower_components/chart.js/Chart.js"></script>
<script type="text/javascript">
  <?php

    foreach ($dataunit as $key => $value) {
      $data[] = $cart[$value->nama_unit];
    }
  ?>
  $(function(){
    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'Sept', 'Oct', 'Nov', 'Dec'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : <?= $data[0];?>
        },
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(0, 92, 231,1.0)',
          strokeColor         : 'rgba(9, 92, 231,1.0)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(0, 92, 231,1.0)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : <?= $data[1];?>
        },
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(0, 92, 231,1.0)',
          strokeColor         : 'rgba(9, 92, 231,1.0)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(0, 92, 231,1.0)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : <?= $data[2];?>
        },
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(0, 92, 231,1.0)',
          strokeColor         : 'rgba(9, 92, 231,1.0)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(0, 92, 231,1.0)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : <?= $data[3];?>
        }
      ]
    }
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
      barChartData.datasets[0].fillColor   = '#345ceb'
    barChartData.datasets[0].strokeColor = '#345ceb'
    barChartData.datasets[0].pointColor  = '#345ceb'
    barChartData.datasets[1].fillColor   = '#34eb37'
    barChartData.datasets[1].strokeColor = '#34eb37'
    barChartData.datasets[1].pointColor  = '#34eb37'
     barChartData.datasets[2].fillColor   = '#eb4034'
    barChartData.datasets[2].strokeColor = '#eb4034'
    barChartData.datasets[2].pointColor  = '#eb4034'
     barChartData.datasets[3].fillColor   = '#f5ac25'
    barChartData.datasets[3].strokeColor = '#f5ac25'
    barChartData.datasets[3].pointColor  = '#f5ac25'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : false,
       beginAtZero: false,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  });
</script>
     