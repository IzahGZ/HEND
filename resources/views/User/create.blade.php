@extends('layout.template')
@push('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            User Profile
          </h1>
          <ol class="breadcrumb">
              <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Profile</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
          <div class="box box-danger">
            <div class="box-body box-profile">
              {!! Form::open(['route' => 'user.store']) !!}
              <img class="profile-user-img img-responsive img-circle" src="{{asset('dist/img/user4-128x128.jpg')}}" alt="User profile picture">
              <br>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                {!! Form::label('name', 'Name',['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', 'Email',['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                {!! Form::text('email', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- right column -->
                <div class="col-md-6">
                    <div class="box-body">
                        <div class="form-horizontal">
                          <div class="form-group">
                            {!! Form::label('user_type', 'Category',['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                            <select id="supplier_id" class="form-control" name="user_type">
                                <option value="">Please select user category</option>
                                @foreach($user_types as $user_type)
                                    <option value="{{ $user_type->id }}">{{$user_type->name}}</option>
                                @endforeach
                            </select>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>

              {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
              <div class="box-footer text-center">
                {!! Form::submit('Submit', ['class' => 'btn btn-danger']) !!}
                <a href="{{ route('order.index') }}" class="btn btn-default">Cancel</a>
              </div>
              {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
          </div>
            <!-- /.box-body -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
@endpush