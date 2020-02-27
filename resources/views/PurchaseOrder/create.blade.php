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
            Add Purchase Order
          </h1>
          <ol class="breadcrumb">
              <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="{!! URL::to('purchaseOrder') !!}">Purchase Order</a></li>
              <li class="active">Add Purchase Order</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- SELECT2 EXAMPLE -->
          @include('PurchaseOrder.message')
          <div class="box box-danger">
          {!! Form::open(['route' => 'purchaseOrder.store']) !!}
            <div class="box-header with-border">
              <h3 class="box-title">Order Details</h3>
            </div>

            @include('PurchaseOrder.field')

            <div class="box-footer text-center">
                    {!! Form::submit('Submit', ['class' => 'btn btn-danger']) !!}
                    <a href="{{ route('purchaseOrder.index') }}" class="btn btn-default">Cancel</a>
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

let purchaseRequest = @JSON($purchaseRequests);
let uom = @JSON($uoms);

$('#supplier_id').on('keyup change',function() {
  var supplier_id = $(this).val(); 
  console.log(supplier_id)
  const filteredpr = purchaseRequest.filter(m => m.raw_material_supplier.supplier_id == supplier_id && m.status == 2)
  if (!filteredpr.length){
    var options = `<option value="">None</option>`;
    $('#pr_id').empty().append(options);
    return;
  }
  const uom_code = uom.filter(m => m.id == filteredpr[0].raw_material_supplier.uom_id)
  var options = `<option value="">Please select purchase request</option>`;
  for (i = 0; i < filteredpr.length; i++) {
  options += `<option value="${filteredpr[i].id}">ROP${filteredpr[i].pr_number}
    | ${filteredpr[i].raw_material.name} |
    ${filteredpr[i].quantity} ${uom_code[0].code}</option>`;
  }

  $('#pr_id').empty().append(options);
});

// remove row
// const removeRow = el => $(el).parents('tr').remove()
function removeRow(el){
  const container = $(el).parents('.row_table')
  const container2 = $(el).parents('.row')
  const total = $(container).find('#total_price')
  const sub_total = $(container2).find('#sub_total')
  var update_subtotal = sub_total.val()-total.val();
  console.log("subtotal: "+sub_total.val())
  console.log("total: "+total.val())
  $('#sub_total').val(update_subtotal);
  $(el).parents('tr').remove();
}
const prTable = $('#pr_table tbody')

$('#pr_id').on('keyup change',function() {
  var pr_id = $(this).val(); 
  const filteredpr = purchaseRequest.filter(m => m.id == pr_id)
  const childNumber = prTable.children().length
  var total = filteredpr[0].quantity*filteredpr[0].raw_material_supplier.price_per_unit;
  prTable.append(`
    <tr class="row_table">
      <input type="hidden" name="pr_id[]" value="${filteredpr[0].id}" />
      <input type="hidden" name="item_id[]" value="${filteredpr[0].item_id}" />
      <input type="hidden" name="quantity[]" id="quantity" value="${filteredpr[0].quantity}"/>
      <input type="hidden" name="delivery_date[]" id="" value="${filteredpr[0].estimated_date}"/>
      <input type="hidden" name="raw_material_supplier_id[]" id="" value="${filteredpr[0].raw_material_supplier_id}"/>
      <input type="hidden" name="total_price" id="total_price" value="${total}"/>
      <td>${childNumber}</td>
      <td>ROP${filteredpr[0].pr_number}</td>
      <td> ${filteredpr[0].raw_material.name} | ${filteredpr[0].raw_material.code}</td>
      <td>${filteredpr[0].estimated_date}</td>
      <td>${filteredpr[0].quantity}</td>
      <td>${filteredpr[0].raw_material_supplier.price_per_unit}</td>
      <td class="Total">${total}</td>
      <td>
        <button type="button" onclick="removeRow(this)"class="btn btn-danger remove">
          <i class="fa fa-minus"></i>
        </button
      </td>
    </tr>
    `)
  calculateSum()
});

function calculateSum() {
  var total = 0;
  var delivery = 7;
  $(".Total").each(function () {
    total += parseFloat($(this).text());
  });

  var grand_total = delivery + total;
  console.log("total sum:"+total)
  $('#sub_total').val(total.toFixed(2));
  // $('#delivery_fee').val(delivery.toFixed(2));
  // $('#grand_total').val(grand_total.toFixed(2));
}

</script>
@endpush