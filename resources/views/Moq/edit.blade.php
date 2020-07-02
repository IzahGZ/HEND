@extends('layout.template')
@push('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Minimum Order Quantity
            <small>Details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{!! URL::to('moq') !!}">MOQ</a></li>
            <li class="active">Edit details</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- SELECT2 EXAMPLE -->
          @include('Project.message')
          <div class="box box-danger">
          {!! Form::model($moq, ['route' => ['moq.update', $moq->id ], 'method' => 'patch']) !!}
            <div class="box-header with-border">
            </div>
            
            @include('Moq.editfield')

            <div class="box-footer text-center">
                {{Form::hidden('_method','PUT')}}
                {!! Form::submit('Save', ['class' => 'btn btn-danger']) !!}
                <a href="{{ route('moq.index') }}" class="btn btn-default">Back</a>
            </div>
        </div>
            <!-- /.box-body -->
        {!! Form::close() !!}
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
@endpush