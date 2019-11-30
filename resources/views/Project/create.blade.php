@extends('layout.template')

@push('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add New Project
      </h1>
      <ol class="breadcrumb">
          <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="{!! URL::to('project') !!}">Project</a></li>
          <li class="active">Add Project</li>
      </ol>
    </section>
    <section class="content">
      @include('Project.message')
      <div class="box box-danger">
      {!! Form::open(['route' => 'projects.store']) !!}
        <div class="box-header with-border">
          <h3 class="box-title">Project Information</h3>
        </div>

        @include('Project.addfield')

        <div class="box-footer text-center">
          {!! Form::submit('Submit', ['class' => 'btn btn-danger']) !!}
          <a href="{{ route('project.index') }}" class="btn btn-default">Cancel</a>
        </div>
      {!! Form::close() !!}
      </div>
    </section>
  </div>
@endpush