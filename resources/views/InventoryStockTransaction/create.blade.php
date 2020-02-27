@extends('layout.template')

@push('link')
{{--  --}}
@endpush

@push('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Good Receive Note
          </h1>
          <ol class="breadcrumb">
              <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="{!! URL::to('goodReceiveNote') !!}">Good Receive Note</a></li>
              <li class="active">Add Good Receive Note</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- SELECT2 EXAMPLE -->
          @include('PurchaseOrder.message')
          <div class="box box-danger">
          {!! Form::open(['route' => 'goodReceiveNote.store']) !!}
            <div class="box-header with-border">
              <h3 class="box-title">GRN Details</h3>
            </div>

            @include('GoodReceiveNote.field')

            <div class="box-footer text-center">
                    {!! Form::submit('Submit', ['class' => 'btn btn-danger']) !!}
                    <a href="{{ route('goodReceiveNote.index') }}" class="btn btn-default">Cancel</a>
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
<!-- bootstrap datepicker -->
<script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

<script>

let purchaseOrder = @JSON($purchaseOrders);
let purchaseOrderItem = @JSON($purchaseOrderItems);
let supplier = @JSON($suppliers);
let uom = @JSON($uoms);

$('#po_id').on('keyup change',function() {
  var po_id = $(this).val(); 
  // console.log(po_id)
  const filteredpo = purchaseOrder.filter(m => m.id == po_id && m.status == 2)
  if (!filteredpo.length){
    var options = `<option value="">None</option>`;
    $('#supplier_id').empty().append(options);
    $('#po_item_id').empty().append(options);
    return;
  }

  const supplier_name = supplier.filter(m => m.id == filteredpo[0].supplier_id)
  const po_item = purchaseOrderItem.filter(m => m.po_id == po_id)
  
  console.log(po_item)
  var options1 = `<option value="${supplier_name[0].id}">${supplier_name[0].name}</option>`;
  var options2 = `<option value="">Please select item</option>`;
  for (i = 0; i < po_item.length; i++) {
    const uom_code = uom.filter(m => m.id == po_item[i].raw_material_supplier.uom_id)
    options2 += `<option value="${po_item[i].id}">
      ${po_item[i].raw_material.name} | ${po_item[i].raw_material.code} ||
      Ordered Quantity: ${po_item[i].quantity} ${uom_code[0].code}</option>`;
  }

  $('#supplier_id').empty().append(options1);
  $('#po_item_id').empty().append(options2);
});

// remove row
const removeRow = el => $(el).parents('tr').remove()
const grnTable = $('#grn_table tbody')
$('#po_item_id').on('keyup change',function() {
  var po_item_id = $(this).val();
  const filteredPOI = purchaseOrderItem.filter(m => m.id == po_item_id)
  const childNumber = grnTable.children().length
  grnTable.append(`
    <tr class="row_table">
      <input type="hidden" name="po_item_id[]" value="${filteredPOI[0].id}" />
      <input type="hidden" name="order_quantity[]" value="${filteredPOI[0].quantity}" />
      <td>${childNumber}</td>
      <td>${filteredPOI[0].raw_material.name} | ${filteredPOI[0].raw_material.code}</td>
      <td>${filteredPOI[0].quantity}</td>
      <td><input name="receive_quantity[]" value="" /></td>
      <td>
        <button type="button" onclick="removeRow(this)"class="btn btn-danger remove">
          <i class="fa fa-minus"></i>
        </button
      </td>
    </tr>
    `)
});

</script>
@endpush
