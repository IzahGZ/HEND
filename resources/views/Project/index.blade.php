@extends('layout.template')

@push('styles')
  <link rel="stylesheet" href="{{('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">  
@endpush  

@push('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Projects
        <small>list</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Project</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <a href="{{ route('Project.create') }}" type="button" class="btn btn-info pull-right"><b>+ Project </b></a>
            </div>
            <div class="box-body">
              @include('Project.table')
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endpush