@extends('layout.template')
@push('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Product
      <small>Details</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{!! URL::to('supplier') !!}">Product</a></li>
        <li class="active">View details</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- SELECT2 EXAMPLE -->
  @include('Product.message')
  <div class="box box-danger">
    <div class="box-header with-border"></div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                    {!! Form::label('name', 'Item name:') !!}
                    {!! Form::text('name', $product->name, ['class' => 'form-control', 'readonly']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('shelf_life', 'Shelf Life:') !!}
                  {!! Form::text('shelf_life', $product->shelf_life, ['class' => 'form-control','readonly']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('holding_cost', 'Holding Cost:') !!}
                  {!! Form::text('holding_cost', $product->holding_cost, ['class' => 'form-control','readonly']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('lead_time', 'Lead Time:') !!}
                  {!! Form::text('lead_time', $product->lead_time, ['class' => 'form-control','readonly']) !!}
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
                  {!! Form::text('name', $product->code, ['class' => 'form-control','readonly']) !!}
                </div>
                <div class="form-group">
                {!! Form::label('uom', 'Unit of Measurement:') !!}
                  <select name="uom" id="uom" class="form-control uom" required  disabled="disabled">
                      <option value="">Please select UOM</option>
                      @foreach($uoms as $uom)
                      <option value="{{ $uom->id }}"{{ $product->uom == $uom->id ? 'selected' : '' }}>{{$uom->name}}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  {!! Form::label('safety_stock', 'Safety Stock:') !!}
                  {!! Form::text('safety_stock', $product->safety_stock, ['class' => 'form-control','readonly']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('price', 'Price (RM):') !!}
                  {!! Form::text('price', $product->price, ['class' => 'form-control', 'readonly']) !!}
                </div>
              </div>
            </div>
          </div>
              <!--/.col (right) -->
        </div>
              <!-- /.row -->
      </div>
  <!-- /.box header -->
        <div class="box-footer text-center">
        <a href="{{ route('product.index') }}" class="btn btn-default">Back</a>
        </div>
    </div>
      <!-- /.box-body -->
  </section>
        <!-- /.content -->
</div>
      <!-- /.content-wrapper -->
@endpush