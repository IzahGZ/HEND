<!-- /.box-header -->
<div class="box-body">
    <div class="row">
      <div class="col-md-6">
          <div class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                    {!! Form::label('name', 'Item name:') !!}
                    {!! Form::text('name', $rawMaterial->name, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('shelf_life', 'Shelf Life:') !!}
                  {!! Form::text('shelf_life', $rawMaterial->shelf_life, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('inventory_cost', 'Inventory Cost (RM):') !!}
                  {!! Form::text('inventory_cost', $rawMaterial->inventory_cost, ['class' => 'form-control']) !!}
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
                    {!! Form::text('code', $rawMaterial->code, ['class' => 'form-control']) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('uom', 'Unit of Measurement:') !!}
                      <select name="uom" id="uom" class="form-control uom" required>
                          <option value="">Please select UOM</option>
                            @foreach($uoms as $uom)
                            <option value="{{ $rawMaterial->uom }}"{{ $rawMaterial->uom == $uom->id ? 'selected' : '' }}>{{$uom->name}}</option>
                            @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                    {!! Form::label('set_up_cost', 'Set Up Cost (RM):') !!}
                    {!! Form::text('set_up_cost', $rawMaterial->set_up_cost, ['class' => 'form-control']) !!}
                  </div>
              </div>
          </div>
      </div>
      {{-- {{dd($rawMaterial)}} --}}
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
                                  <th>Lead Time (Days)</th>
                                  <th>MOQ</th>
                                  <th>Action</th>
                              </tr>
                              @foreach($rawMaterial->raw_material_suppliers as $supplier_information)
                              <tr>
                                <input type="hidden" name="supplier[{{ $loop->index }}][supplier_id]" value="{{$supplier_information->id}}" />
                                <input type="hidden" name="supplier[{{ $loop->index }}][uom_id]" value="{{$supplier_information->pivot->uom->id}}" />
                                <input type="hidden" name="supplier[{{ $loop->index }}][price_per_unit]" value="{{$supplier_information->pivot->price_per_unit}}" />
                                <input type="hidden" name="supplier[{{ $loop->index }}][lead_time]" value="{{$supplier_information->pivot->lead_time}}" />
                                <input type="hidden" name="supplier[{{ $loop->index }}][moq_id]" value="{{$supplier_information->pivot->moq->id}}" />
                                <td>{{$loop->iteration}}</td>
                                <td>{{$supplier_information->name}}</td>
                                <td>{{$supplier_information->pivot->uom->code}}</td>
                                <td>{{$supplier_information->pivot->price_per_unit}}</td>
                                <td>{{$supplier_information->pivot->lead_time}}</td>
                                <td>{{$supplier_information->pivot->moq->name}} | &nbsp;&nbsp; 
                                  <b><small>Minimum Quantity: {{$supplier_information->pivot->moq->min_quantity}} 
                                    Maximum Quantity: {{$supplier_information->pivot->moq->max_quantity}}&nbsp;&nbsp;</small> </b> </td>
                                <td>
                                  <button type="button" onclick="removeRow(this)"class="btn btn-danger">
                                    <i class="fa fa-minus"></i>
                                  </button>
                                </td>
                              </tr>
                              @endforeach
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          </div>
        </div>