@extends('layout.template')
@push('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Bill Of Materials
            <small>Details</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="{!! URL::to('bom') !!}">BOM</a></li>
              <li class="active">View details</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- SELECT2 EXAMPLE -->
          @include('Customer.message')
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">General Information</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                    
                    <div class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                {!! Form::label('name', 'BOM ID:',['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                {!! Form::text('phone', 'BOM'.$bom->bom_number, ['class' => 'form-control', 'readonly']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', 'Project Name:',['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                {!! Form::text('phone', $bom->project->products->name, ['class' => 'form-control', 'readonly']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                              {!! Form::label('phone', 'Quantity',['class' => 'col-sm-2 control-label']) !!}
                              <div class="col-sm-10">
                              {!! Form::text('phone', $bom->quantity, ['class' => 'form-control', 'readonly']) !!}
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
                                {!! Form::label('address', 'Project Code:',['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                {!! Form::text('address', $bom->project->code , ['class' => 'form-control', 'readonly']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                              {!! Form::label('address', 'Customer Name:',['class' => 'col-sm-2 control-label']) !!}
                              <div class="col-sm-10">
                              {!! Form::text('address', $bom->order->customer->name , ['class' => 'form-control', 'readonly']) !!}
                              </div>
                          </div>
                          <div class="form-group">
                            {!! Form::label('phone', 'Unit Of Measurement',['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-10">
                            {!! Form::text('phone', $bom->project->products->uoms->code, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
              <!--/.col (right) -->
                </div>
              <!-- /.row -->
            </div>
        </div>
            <!-- /.box-body -->
            <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title">Bill Of Materials</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                      <table class="table table-bordered table-striped">
                        <thead>
                          <td>#</td>
                          <td>Raw Material</td>
                          <td>Quantity Needed</td>
                        </thead>
                        <tbody>
                          @foreach($bom->project->materials as $rawMaterial)
                          <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$rawMaterial->name}}</td>
                          <td>{{$rawMaterial->pivot->quantity*$bom->quantity}} {{$rawMaterial->uoms->code}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                  </div>
                </div>
                <!-- /.row -->
              </div>
          </div>

          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Manufacturing Process</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <td>#</td>
                        <td>Process</td>
                        <td>Duration</td>
                      </thead>
                      <tbody>
                        @foreach($bom->project->processes as $process)
                        <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$process->name}}</td>
                        <td>{{$process->pivot->duration}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
              </div>
              <!-- /.row -->
            </div>
            <div class="box-footer text-center">
                    {{-- {!! Form::submit('Submit', ['class' => 'btn btn-danger']) !!} --}}
                    <a href="{{ route('customer.index') }}" class="btn btn-default">Back</a>
            </div>
        </div>
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
@endpush