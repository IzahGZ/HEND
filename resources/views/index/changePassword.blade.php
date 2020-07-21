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
              {!! Form::open(['route' => 'changePassword.store']) !!}
              <br>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputPassword1" class="col-sm-2 control-label">Password</label>
                              <div class="col-sm-10">
                                <input type="password" minlength="8" class="form-control text-left" required autocomplete="off" name="password"
                                id="password" style="background-color: #fff; text-align: left;">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword2" class="col-sm-2 control-label">Confirm Password</label>
                              <div class="col-sm-10">
                                <input type="password" class="form-control text-left" required autocomplete="off" id="confirm_password"
                                oninput="check(this)" name="confirm_password" style="background-color: #fff; text-align: left;">
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

              {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
              <div class="box-footer text-center">
                {!! Form::submit('Submit', ['class' => 'btn btn-danger']) !!}
                <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
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

<script language='javascript' type='text/javascript'>
  function check(input) {
      // console.log(input.value)
      // console.log(document.getElementById('password').value)
      if (input.value != document.getElementById('password').value) {
          input.setCustomValidity('Password is not match');
      } else {
          // input is valid -- reset the error message
          input.setCustomValidity('');
      }
  }
</script>
@endpush