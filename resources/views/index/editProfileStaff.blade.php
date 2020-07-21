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
              {!! Form::model($user, ['route' => ['profile.update', $user->id ], 'method' => 'patch']) !!}
              <img class="profile-user-img img-responsive img-circle" src="{{asset('dist/img/user4-128x128.jpg')}}" alt="User profile picture">

              <h3 class="profile-username text-center">{{$user->name}}</h3>

              <div class="text-center">{{$user->categories->name}}</div><br>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <table>
                    <td width="100"><b>Email</b></td>
                    <td  width="1000"><input  style="width:400px;"class="pull-left" value="{{$user->email}}" name="email"></td>
                  </table>
                </li>
              </ul>

              {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
              <div class="box-footer text-center">
                {{Form::hidden('_method','PUT')}}
                {!! Form::submit('Save', ['class' => 'btn btn-danger']) !!}
                <a href="{{ route('profile.index', $user->id) }}" class="btn btn-default">Back</a>
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