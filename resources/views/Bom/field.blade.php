<!-- /.box-header -->
<div class="box-body">
        <div class="row">
          <div class="col-md-6">
              <div class="form-horizontal">
                  <div class="box-body">
                      <div class="form-group">
                          {!! Form::label('name', 'SO Number:',['class' => 'col-sm-2 control-label']) !!}
                          <div class="col-sm-10">
                          {!! Form::text('name', null, ['class' => 'form-control']) !!}
                          </div>
                      </div>
                      <div class="form-group">
                          {!! Form::label('email', 'Customer:',['class' => 'col-sm-2 control-label']) !!}
                          <div class="col-sm-10">
                          {!! Form::text('email', null, ['class' => 'form-control']) !!}
                          </div>
                      </div>
                      <div class="form-group">
                        {!! Form::label('phone', 'Delivery Address: ',['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                        {!! Form::textarea('phone', null, ['class' => 'form-control']) !!}
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
                        {!! Form::label('email', 'Remark:',['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                        </div>
                      </div>
                      <div class="form-group">
                        {!! Form::label('email', 'Customer Request Date:',['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                  </div>
              </div>
          </div>
        <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.box header -->

      <br>
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Product Details Information</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-horizontal">
                <div class="box-body">
                  <div class="form-group">
                  {!! Form::label('supplier', 'Product Name | Code:') !!}
                  <select
                    id="product_id"
                    class="form-control product_id"
                  >
                    <option value="">Please select product</option>
                    {{-- @foreach($rawMaterials as $material)
                      <option value="{{ $material->id }}">{{$material->name}}</option>
                    @endforeach --}}
                  </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="box-body">
                  <div class="form-horizontal">
                    <div class="form-group">
                      {!! Form::label('duration', 'Quantity:') !!}
                      {!! Form::text('', null, ['class' => 'form-control', 'id' => 'duration']) !!}
                    </div>
                </div>
              </div>
            </div>
            <div class="col-md-1">
              <div class="box-body">
                  <div class="form-horizontal">
                    <div class="form-group">
                      {!! Form::label('action', 'Action') !!}
                      <div>
                        <button onclick="addProcess(this)" type="button" class="btn btn-primary">
                          <i class="fa fa-plus"></i> Add
                        </button>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="box-body no-padding">
              <table class="table table-striped" id="processTable">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Product Name | Code</th>
                  <th>Quantity</th>
                  <th style="width: 40px">Action</th>
                </tr>
              </table>
            </div>
        </div>
      </div>