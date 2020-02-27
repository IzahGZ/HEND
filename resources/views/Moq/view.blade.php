@extends('layout.template')
@push('content')
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Minimum Order Quantity Details
            <small>Details</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="{!! URL::to('moq') !!}">MOQ</a></li>
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
                                {!! Form::label('name', 'Name:') !!}
                                {!! Form::text('name', $moq->name, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                              {!! Form::label('min_quantity', 'Minimum Quantity:') !!}
                              {!! Form::text('min_quantity', $moq->min_quantity, ['class' => 'form-control']) !!}
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
                          {!! Form::text('description', $moq->description, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                          {!! Form::label('max_quantity', 'Maximum Quantity:') !!}
                          {!! Form::text('max_quantity', $moq->max_quantity, ['class' => 'form-control']) !!}
                      </div>
                      </div>
                  </div>
                </div>
                      <!--/.col (right) -->
                </div>
                <!-- /.row -->
            <div class="box-footer text-center">
              {{-- {!! Form::submit('Submit', ['class' => 'btn btn-danger']) !!} --}}
              <a href="{{ route('moq.index') }}" class="btn btn-default">Back</a>
            </div>
        </div>
            <!-- /.box-body -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
@endpush