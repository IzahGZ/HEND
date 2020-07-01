@extends('layout.template')
<link rel="stylesheet" href="{{('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<!-- DataTables -->
@push('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Product
      <small>list</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Product</li>
    </ol>
  </section>
 
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <a href="{{ route('Product.download') }}" 
              type="button" class="btn btn-info pull-right" style="margin:3px;" target="_blank">
              <b>Download List</b></a>
            <a href="{{ route('Product.create') }}" style="margin:3px;" type="button" class="btn btn-info pull-right"><b>+ Product </b></a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            @include('Product.table')
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endpush