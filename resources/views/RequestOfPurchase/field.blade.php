<div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('pr_number', 'Purchase Request Number',['class' => 'col-sm-12 text-center']) !!}
            </div>
        </div>
    </div>
        
    <div class="row">
        <div class="col-md-12">
            <div class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <div class="col-sm-12">
                            {!! Form::text('pr_number', $unique_number, ['class' => 'form-control text-center', 'readonly']) !!}
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
                        {!! Form::label('item_id', 'Item',['class' => 'col-sm-12']) !!}
                        <div class="col-sm-12">
                        <select id="item_id" class="form-control" name="item_id">
                            <option value="">Please select raw material</option>
                            @foreach($raw_materials as $raw_material)
                                <option value="{{ $raw_material->id }}">{{$raw_material->name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('raw_material_supplier_id', 'Supplier',['class' => 'col-sm-12']) !!}
                        <div class="col-sm-12">
                            <select id="raw_material_supplier_id" class="form-control" name="raw_material_supplier_id">
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
                        {!! Form::label('quantity', 'Quantity:',['class' => 'col-sm-12']) !!}
                        <div class="col-sm-12">
                            {!! Form::text('quantity', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('estimated_date', 'Estimated Delivery Date:',['class' => 'col-sm-12']) !!}
                        <div class="col-sm-12">
                            {!! Form::text('estimated_date', null, ['class' => 'form-control', 'id' => 'estimated_date', 'readonly']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="request_date" name="request_date" value="{{$date_today}}">
    <input type="hidden" id="status" name="status" value="2">
    <input type="hidden" id="request_by" name="request_by" value="Izah Atirah">
    