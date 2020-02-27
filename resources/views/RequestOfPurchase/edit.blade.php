@extends('layout.template')
@push('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Purchase Request
            <small>Details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{!! URL::to('requestOfPurchase') !!}">Purchase Request</a></li>
            <li class="active">Edit details</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- SELECT2 EXAMPLE -->
          @include('RequestOfPurchase.message')
          <div class="box box-danger">
          {!! Form::model($purchaseRequest, ['route' => ['requestOfPurchase.update', $purchaseRequest->id ], 'method' => 'patch']) !!}
            <div class="box-header with-border">
            </div>
            
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
                                  {!! Form::text('pr_number', $purchaseRequest->pr_number, ['class' => 'form-control text-center', 'readonly']) !!}
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
                                      <option value="{{ $raw_material->id }}" {{ $purchaseRequest->item_id == $raw_material->id ? 'selected' : '' }}>{{$raw_material->name}}</option>
                                  @endforeach
                              </select>
                              </div>
                          </div>
                          <div class="form-group">
                              {!! Form::label('raw_material_supplier_id', 'Supplier',['class' => 'col-sm-12']) !!}
                              <div class="col-sm-12">
                                  <select id="raw_material_supplier_id" class="form-control" name="raw_material_supplier_id">
                                    @foreach($raw_material_suppliers as $raw_material_supplier)
                                      <option class="remove_option" value="{{ $raw_material_supplier->id }}"{{ ($purchaseRequest->id == $raw_material_supplier->id) ? 'selected' : '' }}>
                                        {{$raw_material_supplier->supplier->name}}
                                        | {{$raw_material_supplier->moq->name}} ||
                                        <b><small>Min:{{$raw_material_supplier->moq->min_quantity}} &nbsp; Max:{{$raw_material_supplier->moq->max_quantity}}</small></b>
                                        | RM{{$raw_material_supplier->price_per_unit}}</option>
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
            <?php $date_today = date('Y-m-d');?>
            <input type="hidden" id="request_date" name="request_date" value="{{$date_today}}">
            <input type="hidden" id="status" name="status" value="2">
            <input type="hidden" id="request_by" name="request_by" value="Izah Atirah">            

            <div class="box-footer text-center">
                {{Form::hidden('_method','PUT')}}
                    {!! Form::submit('Save', ['class' => 'btn btn-danger']) !!}
                    <a href="{{ route('requestOfPurchase.index') }}" class="btn btn-default">Back</a>
            </div>
        </div>
            <!-- /.box-body -->
        {!! Form::close() !!}
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
@endpush

@push('script')
<script>

let raw_material_supplier = @JSON($raw_material_suppliers_all);
console.log(raw_material_supplier)

$('#item_id').on('keyup change',function() {
  var product = $(this).val(); 
  const filteredproduct = raw_material_supplier.filter(m => m.raw_material_id == product)
  console.log(filteredproduct[0].supplier.name)  

  var options = `<option value="">Please select supplier</option>`;
  for (i = 0; i < filteredproduct.length; i++) {
  options += `<option value="${filteredproduct[i].id}">${filteredproduct[i].supplier.name}
    | ${filteredproduct[i].moq.name}||
    <b><small>Min:${filteredproduct[i].moq.min_quantity} &nbsp; Max:${filteredproduct[i].moq.max_quantity}</small></b>
    | RM${filteredproduct[i].price_per_unit}</option>`;
  }
  // console.log(filteredproduct[0].id);
  
  $( "option" ).removeClass("remove_option");
  $('#raw_material_supplier_id').empty().append(options);
});

$('#raw_material_supplier_id').on('keyup change',function() {
  var supplier = $(this).val(); 
  const filteredRMS = raw_material_supplier.filter(m => m.id == supplier)     
  var lead_time = parseInt(filteredRMS[0].lead_time);
  var today=new Date();
  today.setDate(today.getDate() + lead_time);
  var todate=new Date(today).getDate();
  var tomonth=new Date(today).getMonth()+1;
  var toyear=new Date(today).getFullYear();
  var original_date= toyear+'-'+tomonth+'-'+todate;
  console.log(original_date)
  $('#estimated_date').val(original_date);
});
</script>
@endpush