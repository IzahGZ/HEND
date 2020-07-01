@extends('layout.template')

@push('link')
<!-- DataTables -->
<link rel="stylesheet" href="{{('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@endpush

@push('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Material Requirement Planning
      <small>(MRP)</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">MRP</li>
    </ol>
  </section>
 
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header"></div>
          <div class="box-body">

            <div class="row">
              <div class="col-md-6">
                  <div class="form-horizontal">
                      <div class="box-body">
                      {!! Form::open(['route' => 'generateMrp.store']) !!}
                          <div class="form-group">
                              {!! Form::label('month', 'Month',['class' => 'col-sm-3 control-label text-left']) !!}
                              <div class="col-sm-6">
                              {!! Form::text('month', $current_month, ['class' => 'form-control']) !!}
                              </div>
                          </div>
                          <div class="form-group">
                            {!! Form::label('current_week', 'Current Week',['class' => 'col-sm-3 control-label text-left']) !!}
                            <div class="col-sm-6">
                            {!! Form::text('current_week', 'Week '.$current_week_number, ['class' => 'form-control']) !!}
                            </div>
                          </div>
                        <div class="form-group">
                          {!! Form::label('project_id', 'Project',['class' => 'col-sm-3 text-right']) !!}
                          <div class="col-sm-6">
                              <select id="project_id" class="form-control" name="project_id" required>
                                  <option value="">Please select project</option>
                                  @foreach($projects as $project)
                                      <option value="{{ $project->id }}">{{$project->products->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                          {!! Form::label('manufacturing_time', 'Manufacturing Time',['class' => 'col-sm-3 control-label text-left']) !!}
                          <div class="col-sm-6">
                          {!! Form::text('manufacturing_time', "-", ['class' => 'form-control manufacturing_time']) !!}
                          </div>
                          <div class="col-sm-2">
                            {!! Form::submit('Calculate MRP', ['class' => 'btn btn-info pull-right']) !!}
                          </div>
                        </div>
                        {!! Form::close() !!}
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endpush

@push('script')
<!-- DataTables -->
<script src="{{('bower_components/datatables.net/js/jquery.dataTables.min.js')}}" defer></script>
<script src="{{('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}" defer></script>
<!-- bootstrap datepicker -->
<script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

<script>

$('#wo_confirm').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
        var $recipient = button.data('id');
      var modal = $(this);
      modal.find('.modal-footer a').prop("href",$recipient);
  })

let project = @JSON($projects);
let process = @JSON($processes);
console.log(process)

$('#project_id').on('keyup change',function() {
  var project_id = $(this).val(); 
  var total_duration = 0;
  const filteredprocess = process.filter(m => m.project_id == project_id)
  for (i = 0; i < filteredprocess.length; i++) {
    total_duration =  total_duration + parseInt(filteredprocess[i].duration);
  }
var hour = Math.floor(total_duration/60)
var minute = total_duration % 60
  $('.manufacturing_time').val(hour + " hour  " + minute + " minutes");
});

</script>
@endpush




