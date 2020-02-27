<!-- /.box-header -->
<div class="box-body">
  <div class="row">
    <div class="col-md-6">
        <div class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                  {!! Form::label('name', 'Name:') !!}
                  {!! Form::text('name', null, ['class' => 'form-control']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('min_quantity', 'Minimum Quantity:') !!}
                {!! Form::text('min_quantity', null, ['class' => 'form-control']) !!}
            </div>
            </div>
        </div>
    </div>
    
    <!-- /.col -->
    <!-- right column -->
    <div class="col-md-6">
        <div class="box-body">
          <div class="form-group">
            {!! Form::label('description', 'Description:') !!}
            {!! Form::text('description', null, ['class' => 'form-control']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('max_quantity', 'Maximum Quantity:') !!}
            {!! Form::text('max_quantity', null, ['class' => 'form-control']) !!}
        </div>
        </div>
        </div>
    </div>
        <!--/.col (right) -->
  </div>
  <!-- /.row -->
  
      