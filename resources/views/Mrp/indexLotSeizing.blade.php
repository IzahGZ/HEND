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
                            {!! Form::text('project_id', $projectName, ['class' => 'form-control']) !!}
                          </div>
                        </div>
                        <div class="form-group">
                          {!! Form::label('manufacturing_time', 'Manufacturing Time',['class' => 'col-sm-3 control-label text-left']) !!}
                          <div class="col-sm-6">
                          {!! Form::text('manufacturing_time', $duration, ['class' => 'form-control manufacturing_time']) !!}
                          </div> 
                          <div class="col-sm-2">
                            <a href="{{ route('Mrp.downloadMrpPDF', $product->id ) }}" target="_blank"
                              type="button" class="btn btn-info pull-right"><b>Download Mrp</b>
                            </a>
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
                    @if($days->order_release > 0 && $days->wo_status == 8)
                    <td style="background-color:{{$days->system_status->colour}};">
                      {{$days->order_release}}</td>
                    @endif
                    @if($days->order_release > 0 && $days->wo_status == 11)
                    <td style="background-color:{{$days->system_status->colour}};">
                      {{$days->order_release}}</td>
                    @endif
                    @if($days->order_release > 0 && $days->wo_status == 0)
                    <td style="background-color:{{$days->system_status->colour}};">
                      <a style="color: black;" href="{{ route('workOrder.confirm-wo', $days->id ) }}"
                        data-toggle="modal" data-target="#wo_confirm" data-id="{{ route('workOrder.wo', $days->id ) }}">
                        {{$days->order_release}}</a></td>
                    @endif
                    @if($days->order_release <= 0)
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

              @foreach($project->materials as $item)
              <div class="box-header with-border">
                <?php
                  $lead_time = $item->suppliers;
                  //Find shortest lead time of supplier
                  $shortest_lead_time = 0;
                  foreach ($lead_time as $rms) {
                      $shortest_lead_time = $rms->lead_time;
                      $supplier_lead_time = $rms->lead_time;
                      $current = $supplier_lead_time;

                      if ($current < $shortest_lead_time) {
                          $shortest_lead_time = $current;
                      }
                  }
                ?>
                <h3 class="box-title">{{$item->name}}
                <table>
                  <th width=220><small>Method: {{$item->pivot->lot_sizing->name}}</small></th>
                  <th width=100><small>Lead Time: {{round($shortest_lead_time)}} Days</small> </h3></th>
                </table>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <tr>
                  <td></td>
                  <td>Beginning Inventory</td>
                  @foreach($date_raw_materials as $raw_material)
                    @if($item->id == $raw_material->raw_material_id)
                      <td>{{ date("d M", strtotime($raw_material->date))}}</td>
                    @endif
                  @endforeach
                </tr>
                <tr>
                  <td style="background-color:#bcffd7; color: black;">Gross Requirement</td>
                  <td style="background-color:#bcffd7; color: black;"></td>
                  @foreach($date_raw_materials as $raw_material)
                    @if($item->id == $raw_material->raw_material_id)
                      @if($raw_material->quantity > 0)
                        <td style="background-color:#16e04d; color: black;">{{$raw_material->quantity}}</td>
                      @else
                        <td style="background-color:#bcffd7; color: black;">{{$raw_material->quantity}}</td>
                      @endif
                    @endif
                  @endforeach
                </tr>
                <tr>
                  <td style="background-color:#f2caca; color: black;">Schedule Receipt</td>
                  <td style="background-color:#f2caca; color: black;"></td>
                  @foreach($date_raw_materials as $raw_material)
                    @if($item->id == $raw_material->raw_material_id)
                      <td style="background-color:#f2caca; color: black;">{{$raw_material->schedule_receipt}}</td>
                      @endif
                  @endforeach
                </tr>
                <tr>
                  <td style="background-color:#e2b4f2; color: black;">Projected On Hand</td>
                <td style="background-color:#e2b4f2; color: black;">{{$item->current_stock}}</td>
                  @foreach($date_raw_materials as $raw_material)
                    @if($item->id == $raw_material->raw_material_id)
                      <td style="background-color:#e2b4f2; color: black;">{{$raw_material->on_hand}}</td>
                      @endif
                  @endforeach
                </tr>
                <tr>
                  <td style="background-color:#feffbc; color: black;">Net Requirement</td>
                  <td style="background-color:#feffbc; color: black;"</td>
                  @foreach($date_raw_materials as $raw_material)
                    @if($item->id == $raw_material->raw_material_id)
                      @if($raw_material->net_requirement > 0)
                      <td style="background-color:#f12121; color: black;">
                        {{$raw_material->net_requirement}}</td>
                      @else
                      <td style="background-color:#feffbc; color: black;">{{$raw_material->net_requirement}}</td>
                      @endif
                    @endif
                  @endforeach
                </tr>
                <?php
                  $poItems = App\purchaseOrderItem::all();
                ?>
                <tr>
                  <td style="background-color:#8fb4fa; color: black;">Planned Order Released</td>
                  <td style="background-color:#8fb4fa; color: black;"></td>
                  @foreach($date_raw_materials as $raw_material)
                    @if($item->id == $raw_material->raw_material_id)
                      @if($raw_material->order_release_status == 13 && $raw_material->order_release > 0)
                        <td style="background-color:{{$raw_material->orderRelease_status->colour}}; color: black;">
                        <a style="color: black;" href="{{ route('requestOfPurchaseStore.download', $raw_material->pr_id ) }}" target="_blank">
                        {{$raw_material->order_release}}</a></td>
                      @elseif($raw_material->order_release_status == 7 && $raw_material->order_release > 0) 
                        <?php
                          $poItem = $poItems->where('pr_id', $raw_material->pr_id)->first();
                        ?>
                        <td style="background-color:{{$raw_material->orderRelease_status->colour}};">
                        <a style="color: black;" href="{{ route('purchaseOrder.download', $poItem->po_id ) }}" target="_blank">
                        {{$raw_material->order_release}}</a></td>
                      @elseif($raw_material->order_release_status == 0 && $raw_material->order_release > 0)
                        <td style="background-color:{{$raw_material->orderRelease_status->colour}};">
                        <a style="color: black;" href="{{ route('purchaseRequest.confirm-pr', $raw_material->id ) }}"
                        data-toggle="modal" data-target="#pr_confirm" data-id="{{ route('purchaseRequest.pr', $raw_material->id ) }}">
                      
                        {{$raw_material->order_release}}</a></td>
                      @else
                        <td style="background-color:#8fb4fa; color: black;">{{$raw_material->order_release}}</td>
                      @endif
                    @endif
                  @endforeach
                </tr>
                <tr>
                  <td style="background-color:#bcffd7; color: black;">Planned Order Receipt</td>
                  <td style="background-color:#bcffd7; color: black;"></td>
                  @foreach($date_raw_materials as $raw_material)
                    @if($item->id == $raw_material->raw_material_id)
                      @if($raw_material->order_receipt_status == 0 && $raw_material->order_receipt > 0)
                          <td style="background-color:{{$raw_material->orderReceipt_status->colour}}; color: black;">
                          {{$raw_material->order_receipt}}</td>
                        @else
                          <td style="background-color:#bcffd7; color: black;">{{$raw_material->order_receipt}}</td>
                        @endif
                      @endif
                  @endforeach
                </tr>
              </table>
            @endforeach
          </div>
          
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- The modal Work Order-->
<div class="modal fade" id="wo_confirm" tabindex="-1" role="dialog" aria-labelledby="wo_confirm" aria-hidden="true">
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

<!-- The modal Purchase Request-->
<div class="modal fade" id="pr_confirm" tabindex="-1" role="dialog" aria-labelledby="pr_confirm" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
        <h4 class="modal-title" id="deleteLabel">Purchase Request</h4>
      </div>
        <div class="modal-body">
          Generate Purchase Request?
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

  $('#pr_confirm').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
        var $recipient = button.data('id');
      var modal = $(this);
      modal.find('.modal-footer a').prop("href",$recipient);
  })
</script>
@endpush




