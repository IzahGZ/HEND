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
              <div class="col-md-4">
                  <div class="form-horizontal">
                      <div class="box-body">
                          <div class="form-group">
                              {!! Form::label('month', 'Month',['class' => 'col-sm-4 control-label text-left']) !!}
                              <div class="col-sm-6">
                              {!! Form::text('month', $current_month, ['class' => 'form-control']) !!}
                              </div>
                          </div>
                          <div class="form-group">
                            {!! Form::label('current_week', 'Current Week',['class' => 'col-sm-4 control-label text-left']) !!}
                            <div class="col-sm-6">
                            {!! Form::text('current_week', 'Week '.$current_week_number, ['class' => 'form-control']) !!}
                            </div>
                          </div>
                        <div class="form-group">
                          {!! Form::label('project_id', 'Project',['class' => 'col-sm-4 text-right']) !!}
                          <div class="col-sm-6">
                              <select id="project_id" class="form-control" name="project_id">
                                  <option value="">Please select project</option>
                                  @foreach($projects as $project)
                                      <option value="{{ $project->id }}">{{$project->products->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                          {!! Form::label('manufacturing_time', 'Manufacturing Time',['class' => 'col-sm-4 control-label text-left']) !!}
                          <div class="col-sm-6">
                          {!! Form::text('manufacturing_time', "-", ['class' => 'form-control manufacturing_time']) !!}
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Master Production Schedule (MPS)</h3>
                </div>
                {{-- table --}}
                <table id="example1" class="table table-bordered table-striped">
                  <tr>
                    <td></td>
                    <td>Beginning Inventory</td>
                    @foreach($dates as $days)
                    <td>{{ date("d M", strtotime($days->date))}}</td>
                    @endforeach
                  </tr>
                  <tr>
                    <td>Gross Requirement</td>
                    <td></td>
                    @foreach($dates as $days)
                    <td>{{$days->quantity}}</td>
                    @endforeach
                  </tr>
                  {{-- <tr>
                    <td>Schedule Receipt</td>
                    <td></td>
                    @foreach($dates as $days)
                    <td>0</td>
                    @endforeach
                  </tr> --}}
                  <tr>
                    <td>Projected On Hand</td> 
                    <?php 
                      $on_hand = $product->current_stock;
                    ?>
                    <td>{{$product->current_stock}}</td>
                    @foreach($dates as $days)
                    <td>{{$days->on_hand}}</td>
                    @endforeach
                  </tr>
                  <tr>
                    <td>Net Requirement</td>
                    <td></td>
                    <?php $net_req = $product->current_stock ?>
                    @foreach($dates as $days)
                    <td>{{$days->net_requirement}}</td>
                    @endforeach
                  </tr>
                  
                  <tr>
                    <td>Production Schedule</td>
                    <td></td>
                    @foreach($dates as $days)
                    @if($days->order_release>0 && $days->wo_status == 8)
                    <td style="background-color:{{$days->system_status->colour}};">
                      {{$days->order_release}}</td>
                    @endif
                    @if($days->order_release>0 && $days->wo_status != 8)
                    <td style="background-color:{{$days->system_status->colour}};">
                      <a style="color: black;" href="{{ route('workOrder.confirm-wo', $days->id ) }}" 
                        data-toggle="modal" data-target="#wo_confirm" data-id="{{ route('workOrder.wo', $days->id ) }}">
                      {{$days->order_release}} </a></td>
                    @endif
                    @if($days->order_release<=0)
                    <td>{{$days->order_release}}</td>
                    @endif
                    @endforeach
                  </tr>
              
                  <tr>
                    <td>To Be Delivered</td>
                    <td></td>
                    @foreach($dates as $days)
                    <td @if($days->order_receipt>0)style="background-color:#ecff89;" @endif>
                      {{$days->order_receipt}}</td>
                    @endforeach
                  </tr>
                </table>
            </div>

            <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title">Raw Material Order Planning</h3>
              </div>

              <table id="example1" class="table table-bordered table-striped">
                <tr>
                  <td></td>
                  <td>Beginning Inventory</td>
                  <td>1</td>
                  <td>2</td>
                  <td>3</td>
                  <td>4</td>
                  <td>5</td>
                  <td>6</td>
                  <td>7</td>
                  <td>8</td>
                  <td>9</td>
                  <td>10</td>
                  <td>11</td>
                  <td>12</td>
                  <td>13</td>
                  <td>14</td>
                </tr>
                <tr>
                  <td>Gross Requirement</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>Schedule Receipt</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>Projected On Hand</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>Net Requirement</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>Planned Order Receipt</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td>Planned Order Released</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
          </div>
          
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- The modal -->
<div class="modal fade" id="wo_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
        <h4 class="modal-title" id="deleteLabel">Work Order</h4>
      </div>
        <div class="modal-body">
          Generate Work Order?
        </div>
          <div class="modal-footer">
            <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
            <a  type="button" class="btn btn-danger Remove_square">Yes</a>
          </div>
     </div>
  </div>
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




