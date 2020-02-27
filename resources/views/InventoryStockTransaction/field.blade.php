<div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('grn_number', 'Good Receive Note Number',['class' => 'col-sm-12 text-center']) !!}
            </div>
        </div>
    </div>
        
    <div class="row">
        <div class="col-md-12">
            <div class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <div class="col-sm-12">
                            {!! Form::text('grn_number', $unique_number, ['class' => 'form-control text-center', 'readonly']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('po_id', 'Purchase Order',['class' => 'col-sm-12']) !!}
                        <div class="col-sm-12">
                            <select id="po_id" class="form-control" name="po_id">
                                <option value="">Please select purchase order</option>
                                @foreach($purchaseOrders as $purchaseOrder)
                                    <option value="{{ $purchaseOrder->id }}">{{$purchaseOrder->po_number}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('supplier_do_number', 'Supplier DO Number:',['class' => 'col-sm-12']) !!}
                        <div class="col-sm-12">
                            {!! Form::text('supplier_do_number', null, ['class' => 'form-control', 'id' => 'supplier_do_number']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('receiving_area', 'Receiving Area:',['class' => 'col-sm-12']) !!}
                        <div class="col-sm-12">
                            {!! Form::text('receiving_area', null, ['class' => 'form-control', 'id' => 'receiving_area']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        {!! Form::label('supplier_id', 'Supplier',['class' => 'col-sm-12']) !!}
                        <div class="col-sm-12">
                            <select id="supplier_id" class="form-control" name="supplier_id">
                                {{-- <option value="">Please select supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{$supplier->name}}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('supplier_do_date', 'Supplier DO Date:',['class' => 'col-sm-12']) !!}
                        <div class="col-sm-12">
                            {!! Form::text('supplier_do_date', $date_today, ['class' => 'form-control', 'id' => 'supplier_do_date']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Item Details</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-horizontal">
                <div class="box-body">
                  <div class="form-group">
                  {!! Form::label('po_item_id', 'Select Item Name | Code:') !!}
                    <select name="po_item_id" id="po_item_id" class="form-control"></select>
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
                            <table class="table table-striped grn_table" id="grn_table">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Item Name | Code</th>
                                <th>Ordered Quantity</th>
                                <th>Received Quantity</th>
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

    <input type="hidden" id="po_date" name="po_date" value="{{$date_today}}">
    <input type="hidden" id="status" name="status" value="2">
    <input type="hidden" id="receive_by" name="receive_by" value="Izah Atirah">
    