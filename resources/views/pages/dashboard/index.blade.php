@extends('layouts.admin')
@section('title', 'Dashboard | MY HELPDESK')
@section('title-sub', 'Dashboard')
{{-- @section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">DataTables</li>
</ol>
@endsection --}}

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h6 align="right">
                <?php
                    $tgl=date('l, d-m-Y');
                    echo $tgl;
                ?>
            </h6>
            <h5 class="card-title">IT Asset Management</h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-desktop"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Computer</span>
                <span class="info-box-number">
                  {{$countk}}
                  <small>Unit</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-laptop"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Laptop</span>
                <span class="info-box-number">{{$countl}} <small>Unit</small></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-print"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Printer</span>
                <span class="info-box-number">{{$countp}} <small>Unit</small></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-tv"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">TV</span>
                <span class="info-box-number">2 <small>Unit</small></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <div class="card">
      <div class="card-header">
          <h5 class="card-title">Eticket</h5>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
          <!-- Info boxes -->
      <div class="row">
        <div id="chart-ticket"></div>
      </div>
      <!-- /.row -->

      </div>
      <!-- /.card-body -->
  </div>
</div>

@endsection

@push('page-script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
  var total_case = <?php echo json_encode($total_case) ?>;
  var bulan = <?php echo json_encode($bulan) ?>;
  Highcharts.chart('chart-ticket', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Monthly Problem Tickets'
    },
    subtitle: {
        text: 'IT Technical Support'
    },
    xAxis: {
        categories:  bulan,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Case'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} case</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Services',
        data: total_case,

    }]
});
</script>
@endpush
