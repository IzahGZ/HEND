@extends('layout.template')

@push('styles')
  <link rel="stylesheet" href="{{('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">  
@endpush

@push('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Processes
        <small>list</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Process</li>
      </ol>
    </section>
  
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <a href="{{ route('process.create') }}" class="btn btn-info pull-right"><b><i class="fa fa-plus m-r-md"></i> Process </b></a>
            </div>
            <div class="box-body">
              @include('process.index.table')
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endpush