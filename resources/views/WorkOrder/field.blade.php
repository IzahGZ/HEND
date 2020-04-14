<div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('po_number', 'Purchase Order Number',['class' => 'col-sm-12 text-center']) !!}
            </div>
        </div>
    </div>
        
    <div class="row">
        <div class="col-md-12">
            <div class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <div class="col-sm-12">
                            {!! Form::text('po_number', $unique_number, ['class' => 'form-control text-center', 'readonly']) !!}
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
                        {!! Form::label('supplier_id', 'Supplier',['class' => 'col-sm-12']) !!}
                        <div class="col-sm-12">
                        <select id="supplier_id" class="form-control" name="supplier_id">
                            <option value="">Please select supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{$supplier->name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        {!! Form::label('delivery_address', 'Delivery Address:',['class' => 'col-sm-12']) !!}
                        <div class="col-sm-12">
                            {!! Form::textarea('delivery_address', $company[0]->address, ['class' => 'form-control','rows' => 5, 'id' => 'delivery_address']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Request of Purchase To Be Processed</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-horizontal">
                <div class="box-body">
                  <div class="form-group">
                  {!! Form::label('pr_id', 'Purchase Request:') !!}
                    <select name="pr_id" id="pr_id" class="form-control supplier"></select>
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
                            <table class="table table-striped supplier_table" id="pr_table">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>PR Number</th>
                                <th>Item Name | Code</th>
                                <th>Delivery Date</th>
                                <th>Quantity</th>
                                <th>Unit Price (RM)</th>
                                <th>Total (RM)</th>
                                <th>Action</th>
                            </tr>
                            </table>
                            <table class="table table_footer" id="grandTotal">
                                {{-- <tr>
                                    <td style="border: none;" width="25px"></td>
                                    <td style="border: none" width="1150px"></td>
                                    <td style="border: none" class="text-right">SubTotal (RM)</td>
                                    <td style="border: none" width="200px" class="text-left">
                                        <input type="text" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/>
                                    </td>
                                    <td style="border: none" width="100px"></td>
                                </tr>
                                <tr>
                                    <td style="border: none;" width="25px"></td>
                                    <td style="border: none" width="1150px"></td>
                                    <td style="border: none" class="text-right">Delivery Fee (RM)</td>
                                    <td style="border: none" width="200px" class="text-left">
                                        <input type="text" name='delivery_fee' placeholder='0.00' class="form-control" id="delivery_fee" readonly/>
                                    </td>
                                    <td style="border: none" width="100px"></td>
                                </tr> --}}
                                <tr>
                                    <td style="border: none;" width="25px"></td>
                                    <td style="border: none" width="1150px"></td>
                                    <td style="border: none" class="text-right">Grand Total (RM)</td>
                                    <td style="border: none" width="200px" class="text-left">
                                        <input type="text" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/>
                                    </td>
                                    <td style="border: none" width="100px"></td>
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
    <input type="hidden" id="purchase_by" name="purchase_by" value="Izah Atirah">
    