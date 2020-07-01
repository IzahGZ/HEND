@extends('layout.template')
@push('content')
{{-- Content Start --}}
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    {{-- Call From DB --}}
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h4>Orders</h4>
              <h3> &nbsp;&nbsp; {{count($AllOrders)}}</h3>
            </div>
            <div class="icon">
              <i class="fa fa-fw fa-cart-plus"></i>
            </div>
            <div class="small-box-footer">
              <div class="col-lg-4 col-xs-6 bg-aqua">
                <div class="text-center small-box-footer"> 
                  This Week <br>
                  <div><b>{{count($thisWeekOrders)}}</b></div>
                </div>
              </div>
              <div class="col-lg-4 col-xs-6 bg-aqua">
                <div class="text-center small-box-footer"> 
                  Last Week <br>
                  <div><b>{{count($lastWeekOrders)}}</b></div>
                </div>
              </div>
              <div class="col-lg-4 col-xs-6 bg-aqua">
                <div class="text-center small-box-footer"> 
                  Last Month <br>
                <div><b>{{count($lastMonthOrders)}}</b></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h4>Purchase Orders</h4>
              <h3> &nbsp;&nbsp; {{count($AllPo)}}</h3>
            </div>
            <div class="icon">
              <i class="fa fa-fw fa-shopping-cart"></i>
            </div>
            <div class="small-box-footer">
              <div class="col-lg-4 col-xs-6 bg-green">
                <div class="text-center small-box-footer"> 
                  This Week <br>
                  <div><b>{{count($thisWeekPO)}}</b></div>
                </div>
              </div>
              <div class="col-lg-4 col-xs-6 bg-green">
                <div class="text-center small-box-footer"> 
                  Last Week <br>
                  <div><b>{{count($lastWeekPO)}}</b></div>
                </div>
              </div>
              <div class="col-lg-4 col-xs-6 bg-green">
                <div class="text-center small-box-footer"> 
                  Last Month <br>
                  <div><b>{{count($lastMonthPO)}}</b></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h4>Good Receive Note</h4>
              <h3> &nbsp;&nbsp; {{count($AllGrn)}}</h3>
            </div>
            <div class="icon">
              <i class="fa fa-fw fa-building"></i>
            </div>
            <div class="small-box-footer">
              <div class="col-lg-4 col-xs-6 bg-yellow">
                <div class="text-center small-box-footer"> 
                  This Week <br>
                  <div><b>{{count($thisWeekGrn)}}</b></div>
                </div>
              </div>
              <div class="col-lg-4 col-xs-6 bg-yellow">
                <div class="text-center small-box-footer"> 
                  Last Week <br>
                  <div><b>{{count($lastWeekGrn)}}</b></div>
                </div>
              </div>
              <div class="col-lg-4 col-xs-6 bg-yellow">
                <div class="text-center small-box-footer"> 
                  Last Month <br>
                  <div><b>{{count($lastMonthGrn)}}</b></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h4>Work Orders</h4>
              <h3> &nbsp;&nbsp; {{count($AllWo)}}</h3>
            </div>
            <div class="icon">
              <i class="fa fa-fw fa-tasks"></i>
            </div>
            <div class="small-box-footer">
              <div class="col-lg-4 col-xs-6 bg-red">
                <div class="text-center small-box-footer"> 
                  This Week <br>
                  <div><b>{{count($thisWeekWo)}}</b></div>
                </div>
              </div>
              <div class="col-lg-4 col-xs-6 bg-red">
                <div class="text-center small-box-footer"> 
                  Last Week <br>
                  <div><b>{{count($lastWeekWo)}}</b></div>
                </div>
              </div>
              <div class="col-lg-4 col-xs-6 bg-red">
                <div class="text-center small-box-footer"> 
                  Last Month <br>
                  <div><b>{{count($lastMonthWo)}}</b></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div><br>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Profit (RM)</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart4" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

      <div class="row">
        <div class="col-md-6">
          <!-- LINE CHART ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Total Orders(RM) Vs Month</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart1" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- LINE CHART PURCHASE ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Total Purchase Orders(RM) Vs Month</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart2" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- LINE CHART PRODUCTION -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Total Production(Unit) Vs Month</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart3" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-6">
          <!-- BAR CHART ORDERS-->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Total Orders (unit) Vs Month</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart1" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- BAR CHART PURCHASE ORDERS-->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Purchase Orders (unit) Vs Month</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart2" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- BAR CHART PRODUCTION-->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Purchase Orders (unit) Vs Month</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart3" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  {{-- Content End --}}
@endpush

@push('script')

<!-- ChartJS -->
<script src={{asset('bower_components/chart.js/Chart.js')}}></script>
<!-- Morris.js charts -->
<script src={{asset('bower_components/raphael/raphael.min.js')}}></script>
<script src={{asset('bower_components/morris.js/morris.min.js')}}></script>

<script>


  $(function () {

    const getRandomColor = () => {
      var letters = '0123456789ABCDEF';
      var color = '#';
      for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
      }
      return color;
    }

    //- BAR CHART PRODUCTION WO-
    const WoArray = @JSON($WoArray);
    var barChartCanvas3 = $('#barChart3').get(0).getContext('2d')
    var barChart3        = new Chart(barChartCanvas3)
    var barChartData3    =
                          {
                            labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August'],
                            datasets: [
                              {
                                label               : 'Purchase Orders',
                                fillColor           : '#cd4414',
                                strokeColor         : '#cd4414',
                                pointColor          : '#cd4414',
                                pointStrokeColor    : '#cd4414',
                                pointHighlightFill  : '#fff',
                                pointHighlightStroke: 'rgba(220,220,220,1)',
                                data                : WoArray
                              }
                            ]
                          }

    //- BAR CHART PURCHASE ORDERS-
    const PoArray = @JSON($PoArray);
    var barChartCanvas2 = $('#barChart2').get(0).getContext('2d')
    var barChart2        = new Chart(barChartCanvas2)
    var barChartData2    =
                          {
                            labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August'],
                            datasets: [
                              {
                                label               : 'Purchase Orders',
                                fillColor           : '#89fffe',
                                strokeColor         : '#89fffe',
                                pointColor          : '#89fffe',
                                pointStrokeColor    : '#89fffe',
                                pointHighlightFill  : '#fff',
                                pointHighlightStroke: 'rgba(220,220,220,1)',
                                data                : PoArray
                              }
                            ]
                          }
    //- BAR CHART ORDERS-
    var barChartCanvas = $('#barChart1').get(0).getContext('2d')
    var barChart       = new Chart(barChartCanvas)
    const productsByMonth = @JSON($productsByMonth);
    const BarChartData = Object.entries(productsByMonth).reduce((acc, [month, item]) => {
    const carry = Object.entries(item).map(([name, quantity]) => { 
      const index = acc.findIndex(({label}) => label === name);
      const total = acc[index]?.data || Array(12).fill().map(() => 0); 
      console.log({index, total})

      if (index !== -1) {
        total[month-1] = total[month-1] ? total[month-1] + quantity : quantity;
        console.log({index});
        acc[index] = {...acc[index], data: total};
      } else {
        total[month-1] = quantity;
        const color = getRandomColor();
        acc = [
          ...acc,
          {
            label               : name,
            fillColor           : color,
            strokeColor         : color,
            pointColor          : color,
            pointStrokeColor    : color,
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : total
          },
        ]
      }
    })
      return acc;
    }, [])
    var barChartData = {  labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August'],
                          datasets: BarChartData
                        }
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
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
    barChart2.Bar(barChartData2, barChartOptions)
    barChart3.Bar(barChartData3, barChartOptions)

    //- LINE CHART PRODUCTION -
    const ProductionArray = @JSON($ProductionArray);
    console.log(ProductionArray)
    var areaChartCanvas3 = $('#lineChart3').get(0).getContext('2d')
    var areaChart3       = new Chart(areaChartCanvas3)
    var areaChartData3 = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August'],
      datasets: [
        {
          label               : 'Purchase Orders',
          fillColor           : '#1ebabe',
          strokeColor         : '#1ebabe',
          pointColor          : '#1ebabe',
          pointStrokeColor    : '#1ebabe',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : ProductionArray
        }
      ]
    }

    //- LINE CHART PURCHASE ORDERS -
    const PoRmArray = @JSON($PoRmArray);
    console.log(PoRmArray)
    var areaChartCanvas2 = $('#lineChart2').get(0).getContext('2d')
    var areaChart2       = new Chart(areaChartCanvas2)
    var areaChartData2 = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August'],
      datasets: [
        {
          label               : 'Purchase Orders',
          fillColor           : '#ff705e',
          strokeColor         : '#ff705e',
          pointColor          : '#ff705e',
          pointStrokeColor    : '#ff705e',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : PoRmArray
        }
      ]
    }

    //- LINE CHART PROFIT -
    const ProfitArray = @JSON($ProfitArray);
    console.log(ProfitArray)
    var areaChartCanvas4 = $('#lineChart4').get(0).getContext('2d')
    var areaChart4       = new Chart(areaChartCanvas4)
    var areaChartData4 = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August'],
      datasets: [
        {
          label               : 'Purchase Orders',
          fillColor           : '#ff705e',
          strokeColor         : '#ff705e',
          pointColor          : '#ff705e',
          pointStrokeColor    : '#ff705e',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : ProfitArray
        }
      ]
    }

    //- LINE CHART ORDERS -
    var areaChartCanvas = $('#lineChart1').get(0).getContext('2d')
    var areaChart       = new Chart(areaChartCanvas)
    
    const productsByMonthRM = @JSON($productsByMonthRM);
    const chartData = Object.entries(productsByMonthRM).reduce((acc, [month, item]) => {
    const carry = Object.entries(item).map(([name, quantity]) => { 
      const index = acc.findIndex(({label}) => label === name);
      const total = acc[index]?.data || Array(12).fill().map(() => 0); 
      console.log({index, total})

      if (index !== -1) {
        total[month-1] = total[month-1] ? total[month-1] + quantity : quantity;
        console.log({index});
        acc[index] = {...acc[index], data: total};
      } else {
        total[month-1] = quantity;
        const color = getRandomColor();
        acc = [
          ...acc,
          {
            label               : name,
            fillColor           : color,
            strokeColor         : color,
            pointColor          : color,
            pointStrokeColor    : color,
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : total
          },
        ]
      }
    })
      return acc;
    }, [])
    console.log({chartData})

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August'],
      datasets: chartData
    }

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions)
    areaChart2.Line(areaChartData2, areaChartOptions)
    areaChart3.Line(areaChartData3, areaChartOptions)
    areaChart4.Line(areaChartData4, areaChartOptions)

    //-------------
    //- LINE CHART -
    //--------------
    // LINE CHART ORDERS
    var lineChartCanvas          = $('#lineChart1').get(0).getContext('2d')
    var lineChart                = new Chart(lineChartCanvas)
    var lineChartOptions         = areaChartOptions
    lineChartOptions.datasetFill = false
    lineChart.Line(areaChartData, lineChartOptions)

    // LINE CHART PURCHASE ORDERS
    var lineChartCanvas2          = $('#lineChart2').get(0).getContext('2d')
    var lineChart2                = new Chart(lineChartCanvas2)
    var lineChartOptions         = areaChartOptions
    lineChartOptions.datasetFill = false
    lineChart2.Line(areaChartData2, lineChartOptions)

    // LINE CHART PRODUCTION
    var lineChartCanvas3          = $('#lineChart3').get(0).getContext('2d')
    var lineChart3                = new Chart(lineChartCanvas3)
    var lineChartOptions         = areaChartOptions
    lineChartOptions.datasetFill = false
    lineChart3.Line(areaChartData3, lineChartOptions)
   
    // LINE CHART PROFIT
    var lineChartCanvas4          = $('#lineChart4').get(0).getContext('2d')
    var lineChart4                = new Chart(lineChartCanvas4)
    var lineChartOptions         = areaChartOptions
    lineChartOptions.datasetFill = true
    lineChart4.Line(areaChartData4, lineChartOptions)
    
  })
</script>
@endpush