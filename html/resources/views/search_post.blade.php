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
            <h1>Search</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Search</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <div class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card card-gray">
                    <div class="card-header">
                        <h3 class="card-title">Search for a period</h3>
                    </div>
                    @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Error!</strong> Please check the message below:<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    {!! Form::open(array('route' => 'auth.search.create','method'=>'POST', 'files' => 'true', 'id' => 'form', 'class' => 'form-horizontal')) !!}
                    <div class="card-body">
                        <div class="row">
                        <div class="form-group" id="data_5">
                        <div class="input-daterange input-group" id="datepicker">
                            <div class="col-1">
                                From
                            </div>
                            <div class="col-4">
                            <input class="input-sm form-control" name="start" value="{{ \Carbon\Carbon::today()->startOfMOnth()->format('Y-m-d')  }}" type="text">
                            </div>
                            <div class="col-1">
                                <p class="text-center">To</p>
                            </div>
                            <div class="col-4">
                            <input class="input-sm form-control" name="end" value="{{ \Carbon\Carbon::today()->endOfMonth()->format('Y-m-d') }}" type="text">
                            </div>
                            <div class="col-2">
                            <button id="js--search" class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card card-gray">
                    <div class="card-header">
                        <h3 class="card-title">Graphs</h3>
                    </div>
                    <div class="card-body">
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
    </div>

  </div>
    {!! Charts::scripts() !!}
    {!! $chart->script() !!}
    {!! $chart2->script() !!}
    <script>
        $(document).ready(function(){

        $('#data_5 .input-daterange').datepicker({
            format: 'yyyy-mm-dd',
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });
            });

    </script>
@endsection
