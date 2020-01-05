@extends('layouts.default')
@section('title')
    {{$title}}
@endsection
@section('main')
  <div class="">
    <div class="row">
    <div class="x_panel">
      <div class="x_title">
        <h2>Executive Report</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li style="float: right;">
              <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      @if(session('message'))
          <div class="alert alert-{{session('message')['status']}}">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{ session('message')['info'] }}
          </div>
      @endif
      <div class="x_content">
        <div class="row">
        
        </div>
        <div class="row">
           <div class="col-md-6">
             <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
           </div>
           <div class="col-md-6">
             <div id="monthly" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
           </div>
        </div>
      </div>
    </div>
    </div>
  </div>
@endsection
@push('js')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script type="text/javascript">
  Highcharts.chart('container', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Pengunjung Harian Bulan Juni 2018'
    },
    // subtitle: {
    //     text: 'Juni'
    // },
    xAxis: {
        categories: ['23', '24', '25', '26', '27', '28',
            '29', '30']
    },
    yAxis: {
        title: {
            text: 'Orang'
        },
        labels: {
            formatter: function () {
                return this.value + '';
            }
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#FFFFFF',
                lineWidth: 1
            }
        }
    },
    series: [{
        name: 'Pengunjung',
        marker: {
            symbol: 'diamond'
        },
        data: [{
            y: 3.9,
            marker: {
                symbol: 'url(https://www.highcharts.com/samples/graphics/snow.png)'
            }
        }, 20, 50, 30, 40, 60, 50, 100, 50, 200, 300, 350]
    }]
});
  Highcharts.chart('monthly', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Pengunjung Per Bulan 2018'
    },
    // subtitle: {
    //     text: '2018'
    // },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        title: {
            text: 'Orang'
        },
        labels: {
            formatter: function () {
                return this.value + '';
            }
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [{
        name: 'Pengunjung',
        marker: {
            symbol: 'square'
        },
        data: [400, 900, 800, 1000, 1100, 1500, 2000, {
            y: 2000,
            marker: {
                symbol: 'url(https://www.highcharts.com/samples/graphics/sun.png)'
            }
        }, 1000, 1100, 1500, 2000]

    }]
});
</script>
@endpush

