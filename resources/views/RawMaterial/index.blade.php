@extends('layout.template')
<link rel="stylesheet" href="{{('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<!-- DataTables -->
@push('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Raw Materials
      <small>list</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Raw Material</li>
    </ol>
  </section>
 
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            {{-- <h3 class="box-title">Data Table With Full Features</h3> --}}
            <a href="{{ route('RawMaterial.download') }}" 
              type="button" class="btn btn-info pull-right" style="margin:3px;" target="_blank">
              <b>Download List</b></a>
            @if(auth()->user()->user_type == 3 || auth()->user()->user_type == 4 || auth()->user()->user_type == 2)
            <a href="{{ route('RawMaterial.create') }}" 
              type="button" class="btn btn-info pull-right" style="margin:3px;">
              <b>+ Raw Material</b></a>
            @endif
            
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            @include('RawMaterial.table')
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