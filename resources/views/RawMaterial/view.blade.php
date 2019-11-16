@extends('layout.template')
@push('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Raw Material
            <small>Details</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="{!! URL::to('supplier') !!}">Raw Material</a></li>
              <li class="active">View details</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- SELECT2 EXAMPLE -->
          @include('RawMaterial.message')
          <div class="box box-danger">
            <div class="box-header with-border">
              {{-- <h3 class="box-title">Add New RawMaterial</h3> --}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                    <div class="form-horizontal">
                        <div class="box-body">
                          <div class="form-group">
                              {!! Form::label('name', 'Item name:') !!}
                              {!! Form::text('name', $rawMaterial->name, ['class' => 'form-control', 'readonly', 'required']) !!}
                          </div>
                          <div class="form-group">
                            {!! Form::label('shelf_life', 'Shelf Life:') !!}
                            {!! Form::text('shelf_life', $rawMaterial->shelf_life, ['class' => 'form-control','readonly']) !!}
                          </div>
                          <div class="form-group">
                            {!! Form::label('holding_cost', 'Holding Cost:') !!}
                            {!! Form::text('holding_cost', $rawMaterial->holding_cost, ['class' => 'form-control','readonly']) !!}
                          </div>
                        </div>
                    </div>
                </div>
                
                <!-- /.col -->
                <!-- right column -->
                <div class="col-md-6">
                    <div class="box-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                              {!! Form::label('code', 'Item Code:') !!}
                              {!! Form::text('name', $rawMaterial->code, ['class' => 'form-control','readonly']) !!}
                            </div>
                            <div class="form-group">
                              {!! Form::label('uom', 'Unit of Measurement:') !!}
                                <select name="uom" id="uom" class="form-control uom" required  disabled="disabled">
                                    <option value="">Please select UOM</option>
                                      @foreach($uoms as $uom)
                                      <option value="{{ $uom->id }}"{{ $rawMaterial->uom == $uom->id ? 'selected' : '' }}>{{$uom->name}}</option>
                                      @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                              {!! Form::label('safety_stock', 'Safety Stock:') !!}
                              {!! Form::text('safety_stock', $rawMaterial->safety_stock, ['class' => 'form-control','readonly']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                    <!--/.col (right) -->
              </div>
                    <!-- /.row -->
                  </div>
            <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title">Supplier Information</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-horizontal">
                      <div class="box-body">
                        <div class="form-group">
                        {!! Form::label('supplier', 'Supplier Name:') !!}
                          <select name="supplier" id="supplier" class="form-control supplier" required disabled="disabled">
                              <option value="">Please select supplier</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"{{ $rawMaterial->supplier == $supplier->id ? 'selected' : '' }}>{{$supplier->name}}</option>
                                @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          {!! Form::label('lead_time', 'Lead Time:') !!}
                          {!! Form::text('lead_time', $rawMaterial->lead_time, ['class' => 'form-control','readonly']) !!}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                      <div class="box-body">
                          <div class="form-horizontal">
                            <div class="form-group">
                              {!! Form::label('price', 'Price (RM):') !!}
                              {!! Form::text('price', $rawMaterial->price, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        <!-- /.box header -->
            <div class="box-footer text-center">
                    {{-- {!! Form::submit('Submit', ['class' => 'btn btn-danger']) !!} --}}
                    <a href="{{ route('rawMaterial.index') }}" class="btn btn-default">Back</a>
            </div>
        </div>
            <!-- /.box-body -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
@endpush