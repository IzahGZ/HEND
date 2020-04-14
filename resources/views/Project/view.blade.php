@extends('layout.template')

@push('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        BOM Details
      </h1>
      <ol class="breadcrumb">
          <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="{!! URL::to('project') !!}">BOM List</a></li>
          <li class="active">BOM</li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">BOM Information</h3>
        </div>
        @include('Project.view_field')
      </div>
    </section>
  </div>
@endpush