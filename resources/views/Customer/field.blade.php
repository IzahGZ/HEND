<!-- /.box-header -->
<div class="box-body">
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
                      <div class="form-group">
                        {!! Form::label('phone', 'Phone NO.',['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                        </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- /.col -->
          <!-- right column -->
          <div class="col-md-6">
              <div class="box-body">
                  <div class="form-horizontal">
                      <!-- textarea -->
                      <div class="form-group">
                          {!! Form::label('address', 'Address',['class' => 'col-sm-2 control-label']) !!}
                          <div class="col-sm-10">
                          {!! Form::textarea('address', null, ['class' => 'form-control','rows' => 5]) !!}
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.box header -->