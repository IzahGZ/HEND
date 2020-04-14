@extends('layout.template')
@push('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Customer
            <small>Details</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="{!! URL::to('customer') !!}">Customer</a></li>
              <li class="active">View details</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- SELECT2 EXAMPLE -->
          @include('Customer.message')
          <div class="box box-danger">
            <div class="box-header with-border">
              {{-- <h3 class="box-title">Add New Customer</h3> --}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                    
                    <div class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                {!! Form::label('name', 'Name',['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                {!! Form::text('phone', $customer->name, ['class' => 'form-control', 'readonly']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', 'Email',['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                {!! Form::text('phone', $customer->email, ['class' => 'form-control', 'readonly']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                              {!! Form::label('phone', 'Phone NO.',['class' => 'col-sm-2 control-label']) !!}
                              <div class="col-sm-10">
                              {!! Form::text('phone', $customer->phone, ['class' => 'form-control', 'readonly']) !!}
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <!-- right column -->
                <div class="col-md-6">
                    <div class="box-body">
                        <div class="form-horizontal">
                            <!-- textarea -->
                            <div class="form-group">
                                {!! Form::label('address', 'Address',['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                {!! Form::textarea('address',  $customer->address , ['class' => 'form-control','rows' => 5, 'readonly']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              <!--/.col (right) -->
                </div>
              <!-- /.row -->
            </div>
            <div class="box-footer text-center">
                    {{-- {!! Form::submit('Submit', ['class' => 'btn btn-danger']) !!} --}}
                    <a href="{{ route('customer.index') }}" class="btn btn-default">Back</a>
            </div>
        </div>
            <!-- /.box-body -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
@endpush