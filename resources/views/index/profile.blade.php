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
              <img class="profile-user-img img-responsive img-circle" src="{{asset('dist/img/user4-128x128.jpg')}}" alt="User profile picture">

              <h3 class="profile-username text-center">{{$user->name}}</h3>

              <p class="text-muted text-center">{{$user->position}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <table>
                    <td width="100"><b>Email</b></td>
                    <td><div class="pull-left">: {{$user->login_info->email}}</div></td>
                  </table>
                </li>
                <li class="list-group-item">
                  <table>
                    <td width="100"><b>Contact No.</b></td>
                    <td><div class="pull-left">: {{$user->phone}}</div></td>
                  </table>
                </li>
                <li class="list-group-item">
                  <table>
                    <td width="100"><b>Office No.</b></td>
                    <td><div class="pull-left">: {{$user->office_no}}</div></td>
                  </table>
                </li>
                <li class="list-group-item">
                  <table>
                    <td width="100"><b>School's Name</b></td>
                    <td><div class="pull-left">: {{$user->school}}</div></td>
                  </table>
                </li>
                <li class="list-group-item">
                  <table>
                    <td width="100"><b>Address</b></td>
                    <td><div class="pull-left">: {{$user->address}}</div></td>
                  </table>
                </li>
              </ul>

              {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
              <div class="box-footer text-center">
                <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-danger">Edit Information</a>
                <a href="{{ route('moq.index') }}" class="btn btn-default">Change Password</a>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
            <!-- /.box-body -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
@endpush