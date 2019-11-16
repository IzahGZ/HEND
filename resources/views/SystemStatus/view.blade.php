@extends('layout.template')
@push('content')
<!-- Content Wrapper. Contains page content -->

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.6/css/bootstrap-colorpicker.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-2.2.2.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.6/js/bootstrap-colorpicker.js"></script>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            System Status Details
            <small>Details</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="{!! URL::to('systemStatus') !!}">System Status</a></li>
              <li class="active">View details</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- SELECT2 EXAMPLE -->
          @include('Project.message')
          <div class="box box-danger">
            <div class="box-header with-border">
              {{-- <h3 class="box-title">Add New Project/h3> --}}
            </div
            <!-- /.box-header -->
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                      <div class="form-horizontal">
                          <div class="box-body">
                            <div class="form-group">
                                {!! Form::label('name', 'Status Name:') !!}
                                {!! Form::text('name', $systemStatus->name, ['class' => 'form-control']) !!}
                            </div>
              
                            {!! Form::label('colour', 'Colour:') !!}
                            <div id="colourPicker" class="input-group form-group">
                              {!! Form::text('colour',  $systemStatus->colour, ['class' => 'form-control']) !!}
                              <span class="input-group-addon"><i></i></span>
                            </div>
                          </div>
                      </div>
                  </div>
                  
                  <!-- /.col -->
                  <!-- right column -->
                  <div class="col-md-6">
                      <div class="box-body">
                        <div class="form-group">
                          {!! Form::label('description', 'Description:') !!}
                          {!! Form::textarea('description',  $systemStatus->description, ['class' => 'form-control','rows' => 5]) !!}
                      </div>
                          </div>
                      </div>
                  </div>
                      <!--/.col (right) -->
                </div>
                <!-- /.row -->
            <div class="box-footer text-center">
              {{-- {!! Form::submit('Submit', ['class' => 'btn btn-danger']) !!} --}}
              <a href="{{ route('systemStatus.index') }}" class="btn btn-default">Back</a>
            </div>
        </div>
            <!-- /.box-body -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
@endpush

<script type="text/javascript">
  $('#colourPicker').colorpicker();
</script>