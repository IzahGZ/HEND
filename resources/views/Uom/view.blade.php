@extends('layout.template')
@push('content')
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Unit of Measurement Details
            <small>Details</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="{!! URL::to('uom') !!}">Unit of Measurement</a></li>
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
                                {!! Form::label('code', 'Status Name:') !!}
                                {!! Form::text('code', $uom->code, ['class' => 'form-control']) !!}
                            </div>
                          </div>
                      </div>
                  </div>
                  
                  <!-- /.col -->
                  <!-- right column -->
                  <div class="col-md-6">
                      <div class="box-body">
                        <div class="form-group">
                          {!! Form::label('name', 'Status Name:') !!}
                          {!! Form::text('name', $uom->name, ['class' => 'form-control']) !!}
                        </div>
                      </div>
                  </div>
                </div>
                      <!--/.col (right) -->
                </div>
                <!-- /.row -->
            <div class="box-footer text-center">
              {{-- {!! Form::submit('Submit', ['class' => 'btn btn-danger']) !!} --}}
              <a href="{{ route('uom.index') }}" class="btn btn-default">Back</a>
            </div>
        </div>
            <!-- /.box-body -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
@endpush