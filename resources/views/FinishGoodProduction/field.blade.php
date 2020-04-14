<div class="row">
    <div class="col-md-12">
        <div class="form-horizontal">
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('wo_id', 'Work Order Number',['class' => 'col-sm-12 text-center']) !!}
                    <div class="col-sm-12">
                    <select id="wo_id" class="form-control text-center" name="wo_id">
                        <option value="">Please select Work Order</option>
                        @foreach($workOrders as $workOrder)
                            <option value="{{ $workOrder->id }}">{{$workOrder->work_order_no}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    {!! Form::label('quantity', 'BOM Quantity:',['class' => 'col-sm-12', 'readonly']) !!}
                    <div class="col-sm-12">
                        {!! Form::text('quantity', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    {!! Form::label('production_quantity', 'Production Quantity:',['class' => 'col-sm-12']) !!}
                    <div class="col-sm-12">
                        {!! Form::text('production_quantity', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden"id="item_id" name="item_id" value="">
    