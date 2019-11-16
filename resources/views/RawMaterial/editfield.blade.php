<!-- /.box-header -->
<div class="box-body">
    <div class="row">
      <div class="col-md-6">
          <div class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                    {!! Form::label('name', 'Item name:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('shelf_life', 'Shelf Life:') !!}
                  {!! Form::text('shelf_life', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('holding_cost', 'Holding Cost:') !!}
                  {!! Form::text('holding_cost', null, ['class' => 'form-control']) !!}
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
                    {!! Form::text('code', null, ['class' => 'form-control']) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('uom', 'Unit of Measurement:') !!}
                      <select name="uom" id="uom" class="form-control uom" required>
                          <option value="">Please select UOM</option>
                            @foreach($uoms as $uom)
                            <option value="{{ $uom->id }}"{{ $rawMaterial->uom == $uom->id ? 'selected' : '' }}>{{$uom->name}}</option>
                            @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                    {!! Form::label('safety_stock', 'Safety Stock:') !!}
                    {!! Form::text('safety_stock', null, ['class' => 'form-control']) !!}
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
                <select name="supplier" id="supplier" class="form-control supplier" required>
                    <option value="">Please select supplier</option>
                      @foreach($suppliers as $supplier)
                      <option value="{{ $supplier->id }}"{{ $rawMaterial->supplier == $supplier->id ? 'selected' : '' }}>{{$supplier->name}}</option>
                      @endforeach
                </select>
              </div>
              <div class="form-group">
                {!! Form::label('lead_time', 'Lead Time:') !!}
                {!! Form::text('lead_time', null, ['class' => 'form-control']) !!}
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
            <div class="box-body">
                <div class="form-horizontal">
                  <div class="form-group">
                    {!! Form::label('price', 'Price (RM):') !!}
                    {!! Form::text('price', null, ['class' => 'form-control']) !!}
                  </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
        <!-- /.box header -->