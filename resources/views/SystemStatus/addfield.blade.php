<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.6/css/bootstrap-colorpicker.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-2.2.2.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.6/js/bootstrap-colorpicker.js"></script>

<!-- /.box-header -->
<div class="box-body">
  <div class="row">
    <div class="col-md-6">
        <div class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                  {!! Form::label('name', 'Status Name:') !!}
                  {!! Form::text('name', null, ['class' => 'form-control']) !!}
              </div>

              {!! Form::label('colour', 'Colour:') !!}
              <div id="colourPicker" class="input-group form-group">
                {!! Form::text('colour', '#00AABB', ['class' => 'form-control']) !!}
                <span class="input-group-addon"><i></i></span>
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
            {!! Form::textarea('description', null, ['class' => 'form-control','rows' => 5]) !!}
        </div>
            </div>
        </div>
    </div>
        <!--/.col (right) -->
  </div>
  <!-- /.row -->

  <script type="text/javascript">
    $('#colourPicker').colorpicker();
  </script>
  
      