@extends('layout.template')

@push('link')
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endpush

@push('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Order
          </h1>
          <ol class="breadcrumb">
              <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="{!! URL::to('order') !!}">Order</a></li>
              <li class="active">Add Order</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- SELECT2 EXAMPLE -->
          @include('Order.message')
          <div class="box box-danger">
          {!! Form::open(['route' => 'orders.store']) !!}
            <div class="box-header with-border">
              <h3 class="box-title">Order Details</h3>
            </div>

            @include('Order.field')

            <div class="box-footer text-center">
                    {!! Form::submit('Submit', ['class' => 'btn btn-danger']) !!}
                    <a href="{{ route('order.index') }}" class="btn btn-default">Cancel</a>
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
  $('#datepicker').datepicker({
  autoclose: true
})

let customers = @JSON($customer);
let products = @JSON($product);
console.log(products);

const productTable = $('#productTable tbody')
const grandTotal = $('#grandTotal tbody')

const addProduct = el => {
const parent = $(el).parents('.row')
const product = parent.find('#product')
console.log(product)
const quantity = parent.find('#quantity')
const childNumber = productTable.children().length
const filteredProduct = products.filter(m => m.id == product.val())
if (!product.val() || !quantity.val())
  return;
const selectedProductText = product.find(`option[value=${product.val()}]`).text()
var total =  parseInt(quantity.val()*filteredProduct[0].price);
productTable.append(`
  <tr class="row_table">
    <input type="hidden" name="product_id[]" value="${product.val()}" />
    <input type="hidden" name="quantity[]" value="${quantity.val()}" />
    <input type="hidden" id="Total" value="${total}" value="${total}"/>
    <td>${childNumber}</td>
    <td>${selectedProductText}</td>
    <td >${quantity.val()}</td>
    <td class="Total">${total}</td>
    <td>
      <button type="button" onclick="removeRow(this)"class="btn btn-danger">
        <i class="fa fa-minus"></i>
      </button
    </td>
  </tr>
`)
product.val('')
quantity.val('')

calculateSum()
}

function calculateSum() {
  var total = 0;
  var delivery = 7;
  $(".Total").each(function () {
    total += parseFloat($(this).text());
  });

  var grand_total = delivery + total;
  $('#sub_total').val(total.toFixed(2));
  $('#delivery_fee').val(delivery.toFixed(2));
  $('#grand_total').val(grand_total.toFixed(2));
}

// remove row
// const removeRow = el => $(el).parents('tr').remove()
function removeRow(el){
  const container = $(el).parents('.row_table')
  const container2 = $(el).parents('.row')
  const total = $(container).find('#Total')
  const sub_total = $(container2).find('#sub_total')
  const grand_total = $(container2).find('#grand_total')
  const delivery_fee = $(container2).find('#delivery_fee')
  var update_subtotal = sub_total.val()-total.val();
  if(update_subtotal ==0)
    var update_grand_total = grand_total.val()-total.val()-delivery_fee.val();
  else
    var update_grand_total = grand_total.val()-total.val();
  console.log("subtotal: " + sub_total.val())
  console.log("total: " + total.val())
  $('#sub_total').val(update_subtotal);
  $('#grand_total').val(update_grand_total);
  $(el).parents('tr').remove();
}
</script>
@endpush