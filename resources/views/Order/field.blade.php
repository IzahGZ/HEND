<div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('name', 'Order Number',['class' => 'col-sm-12 text-center']) !!}
            </div>
        </div>
    </div>
        
    <div class="row">
        <div class="col-md-12">
            <div class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <div class="col-sm-12">
                            {!! Form::text('order_number', $unique_number, ['class' => 'form-control text-center', 'readonly']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="text" name="cust_id" value="{{auth()->user()->id}}" hidden>
    <div class="box-header with-border"></div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('product', 'Product Name',['class' => 'col-sm-12']) !!}
                        <div class="col-sm-12">
                        <select id="product" class="form-control" name="product">
                            <option value="">Please select Product</option>
                            @foreach($project as $projects)
                                <option value="{{ $projects->products->id }}">{{$projects->products->name}} | RM {{$projects->products->price}} per unit</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-5">
            <div class="box-body">
                <div class="form-horizontal">
                    <!-- textarea -->
                    <div class="form-group">
                        {!! Form::label('address', 'Quantity',['class' => 'col-sm-12']) !!}
                        <div class="col-sm-12">
                        <input type="number" min="0" step="1" class="form-control" name = "quantity" id="quantity"/>
                        </div>
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
                      <button id="addItem" onclick="addProduct(this)" type="button" class="btn btn-primary">
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
                        <table class="table table-striped productTable" id="productTable">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th style="width: 200px">Total (RM)</th>
                            <th style="width: 100px">Action</th>
                        </tr>
                        
                        </table>
                        <table class="table" id="grandTotal">
                            <tr>
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
                            </tr>
                            <tr>
                                <td style="border: none;" width="25px"></td>
                                <td style="border: none" width="1150px"></td>
                                <td style="border: none" class="text-right">Grand Total (RM)</td>
                                <td style="border: none" width="200px" class="text-left">
                                    <input type="text" name='grand_total' placeholder='0.00' class="form-control" id="grand_total" readonly/>
                                </td>
                                <td style="border: none" width="100px"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    