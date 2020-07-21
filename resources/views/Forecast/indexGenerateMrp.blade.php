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
                            {!! Form::text('month', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                          {!! Form::label('current_week', 'Current Week',['class' => 'col-sm-3 control-label text-left']) !!}
                          <div class="col-sm-6">
                          {!! Form::text('current_week', null, ['class' => 'form-control']) !!}
                          </div>
                        </div>
                        <div class="form-group">
                          {!! Form::label('project_id', 'Project',['class' => 'col-sm-3 text-right']) !!}
                          <div class="col-sm-6">
                            {!! Form::text('current_week', null, ['class' => 'form-control']) !!}
                          </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('manufacturing_time', 'Manufacturing Time',['class' => 'col-sm-3 control-label text-left']) !!}
                          <div class="col-sm-6">
                            {!! Form::text('manufacturing_time', null, ['class' => 'form-control manufacturing_time']) !!}
                          </div>
                          <div class="col-sm-2">
                            <a href="{{ route('mrp.index') }}" type="button" class="btn btn-info pull-right"><b>Back</b></a>
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
                    {{-- @foreach($dates as $days)
                    <td>{{ date("d M", strtotime($days->date))}}</td>
                    @endforeach --}}
                  </tr>
                  <tr>
                    <td>Gross Requirement</td>
                    <td></td>
                    {{-- @foreach($dates as $days)
                    <td>{{$days->quantity}}</td>
                    @endforeach --}}
                  </tr>
                  <tr>
                    <td>Projected On Hand</td> 
                    <?php 
                      //$on_hand = $product->current_stock;
                    ?>
                    {{-- <td>{{$product->current_stock}}</td>
                    @foreach($dates as $days)
                    <td>{{$days->on_hand}}</td>
                    @endforeach --}}
                  </tr>
                  <tr>
                    <td>Net Requirement</td>
                    <td></td>
                    <?php //$net_req = $product->current_stock ?>
                    {{-- @foreach($dates as $days)
                    <td>{{$days->net_requirement}}</td>
                    @endforeach --}}
                  </tr>
                  
                  <tr>
                    <td>Production Schedule</td>
                    <td></td>
                    {{-- @foreach($dates as $days)
                    @if($days->order_release>0 && $days->wo_status == 8)
                    <td style="background-color:{{$days->system_status->colour}};">
                      {{$days->order_release}}</td>
                    @endif
                    @if($days->order_release>0 && $days->wo_status != 8)
                    <td style="background-color:{{$days->system_status->colour}};">
                      {{$days->order_release}}</td>
                    @endif
                    @if($days->order_release<=0)
                    <td>{{$days->order_release}}</td>
                    @endif
                    @endforeach --}}
                  </tr>
              
                  <tr>
                    <td>To Be Delivered</td>
                    <td></td>
                    {{-- @foreach($dates as $days)
                    <td @if($days->order_receipt>0)style="background-color:#ecff89;" @endif>
                      {{$days->order_receipt}}</td>
                    @endforeach --}}
                  </tr>
                </table>
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
@endpush




