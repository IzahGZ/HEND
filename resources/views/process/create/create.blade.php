@extends('layout.template')

@push('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add New Process
      </h1>
      <ol class="breadcrumb">
          <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="{!! route('process.index') !!}">Processes</a></li>
          <li class="active">Create Process</li>
      </ol>
    </section>
    <section class="content">
      @include('Product.message')
      <div class="box box-danger">
      {!! Form::open([
        'route' => 'process.store',
        'class' => 'form-horizontal p-r-md'
      ]) !!}
        <div class="box-header with-border">
          <h3 class="box-title">Create New Process</h3>
        </div>
        @include('process.create.add_fields')
        <div class="box-footer text-center">
          {!! Form::submit('Submit', ['class' => 'btn btn-danger']) !!}
          <a href="{{ route('process.index') }}" class="btn btn-default">Cancel</a>
        </div>
    {!! Form::close() !!}
    </div>
    </section>
  </div>
@endpush