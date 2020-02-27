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
                    <select name="uom" id="uom" class="form-control uom">
                        <option value="">Please select UOM</option>
                          @foreach($uoms as $uom)
                          <option value="{{ $uom->id }}">{{$uom->name}}</option>
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
            {!! Form::label('supplier_id', 'Supplier Name:') !!}
              <select name="supplier_id" id="supplier_id" class="form-control supplier">
                  <option value="">Please select supplier</option>
                    @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{$supplier->name}}</option>
                    @endforeach
              </select>
            </div>
            <div class="form-group">
              {!! Form::label('uom_id', 'Unit of Measurement:') !!}
                <select name="uom_id" id="uom_id" class="form-control uom">
                    <option value="">Please select UOM</option>
                      @foreach($uoms as $uom)
                      <option value="{{ $uom->id }}">{{$uom->name}}</option>
                      @endforeach
                </select>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
          <div class="box-body">
              <div class="form-horizontal">
                <div class="form-group">
                  {!! Form::label('lead_time', 'Lead Time:') !!}
                  {!! Form::text('lead_time', null, ['class' => 'form-control', 'id' => 'lead_time']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('price_per_unit', 'Price (RM):') !!}
                  {!! Form::text('price_per_unit', null, ['class' => 'form-control', 'id' => 'price_per_unit']) !!}
                </div>
            </div>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-5">
        <div class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              {!! Form::label('moq_id', 'Unit of Measurement:') !!}
                <select name="moq_id" id="moq_id" class="form-control moq" >
                    <option value="">Please select MOQ</option>
                      @foreach($moqs as $moq)
                      <option value="{{ $moq->id }}">{{$moq->name}}</option>
                      @endforeach
                </select>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              {!! Form::label('min_quantity', 'Minimum Quantity:') !!}
              {!! Form::text('min_quantity', null, ['class' => 'form-control']) !!}
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              {!! Form::label('max_quantity', 'Maximum Quantity:') !!}
              {!! Form::text('max_quantity', null, ['class' => 'form-control']) !!}
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-1">
        <div class="box-body">
            <div class="form-horizontal">
              <div class="form-group">
                {!! Form::label('action', 'Action',['class' => 'col-sm-12']) !!}
                <div class="col-sm-12">
                  <button id="addItem" onclick="addSupplier(this)" type="button" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add
                  </button>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
          <div class="form-horizontal">
              <div class="box-body">
                  <div class="box-body no-padding">
                      <table class="table table-striped supplier_table" id="supplier_table">
                      <tr>
                          <th style="width: 10px">#</th>
                          <th>Supplier</th>
                          <th>UOM</th>
                          <th>Price Per Unit</th>
                          <th>Lead Time</th>
                          <th>MOQ</th>
                          <th>Action</th>
                      </tr>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
  </div>
</div>
      <!-- /.box header -->