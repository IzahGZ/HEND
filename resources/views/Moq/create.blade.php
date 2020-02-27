@extends('layout.template')
@push('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add New MOQ
          </h1>
          <ol class="breadcrumb">
              <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="{!! URL::to('moq') !!}">MOQ</a></li>
              <li class="active">Add MOQ</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- SELECT2 EXAMPLE -->
          @include('moq.message')
          <div class="box box-danger">
          {!! Form::open(['route' => 'moq.store']) !!}
            <div class="box-header with-border">
              <h3 class="box-title">MOQ Information</h3>
            </div>

            @include('Moq.addfield')

            <div class="box-footer text-center">
                    {!! Form::submit('Submit', ['class' => 'btn btn-danger']) !!}
                    <a href="{{ route('moq.index') }}" class="btn btn-default">Cancel</a>
            </div>
        {!! Form::close() !!}
        </div>
            <!-- /.box-body -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
@endpush