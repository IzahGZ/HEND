@extends('layout.template')
@push('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Raw Material
            <small>Details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{!! URL::to('product') !!}">Raw Material</a></li>
            <li class="active">Edit details</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- SELECT2 EXAMPLE -->
          @include('Product.message')
          <div class="box box-danger">
          {!! Form::model($product, ['route' => ['product.update', $product->id ], 'method' => 'patch']) !!}
            <div class="box-header with-border">
              {{-- <h3 class="box-title">Add New product</h3> --}}
            </div>
            
            @include('Product.editfield')

            <div class="box-footer text-center">
                {{Form::hidden('_method','PUT')}}
                    {!! Form::submit('Save', ['class' => 'btn btn-danger']) !!}
                    <a href="{{ route('product.index') }}" class="btn btn-default">Back</a>
            </div>
        </div>
            <!-- /.box-body -->
        {!! Form::close() !!}
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
@endpush