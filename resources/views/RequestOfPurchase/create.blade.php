@extends('layout.template')

@push('link')
@endpush

@push('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Request Of Purchase
          </h1>
          <ol class="breadcrumb">
              <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="{!! URL::to('requestOfPurchase') !!}">Purchase Request</a></li>
              <li class="active">Add Purchase Request</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- SELECT2 EXAMPLE -->
          @include('RequestOfPurchase.message')
          <div class="box box-danger">
          {!! Form::open(['route' => 'requestOfPurchase.store']) !!}
            <div class="box-header with-border">
              <h3 class="box-title">Order Details</h3>
            </div>

            @include('RequestOfPurchase.field')

            <div class="box-footer text-center">
                    {!! Form::submit('Submit', ['class' => 'btn btn-danger']) !!}
                    <a href="{{ route('requestOfPurchase.index') }}" class="btn btn-default">Cancel</a>
            </div>
        {!! Form::close() !!}
        </div>
            <!-- /.box-body -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
@endpush

@push('script')
<script>

let raw_material_supplier = @JSON($raw_material_suppliers);
console.log(raw_material_supplier)

$('#item_id').on('keyup change',function() {
  var product = $(this).val(); 
  const filteredproduct = raw_material_supplier.filter(m => m.raw_material_id == product)
  // console.log(filteredproduct[0].supplier.name)  

  var options = `<option value="">Please select supplier</option>`;
  for (i = 0; i < filteredproduct.length; i++) {
  // console.log();
  options += `<option value="${filteredproduct[i].id}">${filteredproduct[i].supplier.name}
    | ${filteredproduct[i].moq.name}||
    <b><small>Min:${filteredproduct[i].moq.min_quantity} &nbsp; Max:${filteredproduct[i].moq.max_quantity}</small></b>
    | RM${filteredproduct[i].price_per_unit}</option>`;
  }

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