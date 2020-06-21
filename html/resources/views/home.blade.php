@extends('layouts.app')
@section('title')
    Temperature DataCenter
@endsection
@section('content')
    {!! Charts::styles() !!}

    <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="content">
      <div class="container-fluid">


      <div class="row justify-content-center">
          <div class="col-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h2 class="center">Sensor I</h2>
                <br />
                <h5 class="widget-user-desc">{{ $sensor1->dateandtime->format('d-m-Y H:i:s') }}</h5>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{ $sensor1->temperature }} °C</h5>
                      <span class="description-text">Temperature</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header">{{ $sensor1->humidity }} %</h5>
                      <span class="description-text">Humidity</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>

          <div class="col-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h2 class="center">Sensor II</h2>
                <br />
                <h5 class="widget-user-desc">{{ $sensor2->dateandtime->format('d-m-Y H:i:s') }}</h5>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{ $sensor2->temperature }} °C</h5>
                      <span class="description-text">Temperature</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header">{{ $sensor2->humidity }} %</h5>
                      <span class="description-text">Humidity</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
        </div>
      </div>

    <br />

      <div class="row justify-content-center">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="app">
                            <center>
                                {!! $chart->html() !!}
                            </center>
                            <br />
                            <center>
                                {!! $chart2->html() !!}
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br /><br />

    </div>
  </div>
    {!! Charts::scripts() !!}
    {!! $chart->script() !!}
    {!! $chart2->script() !!}

@endsection
