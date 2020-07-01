@extends('layout.template')
@push('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add New Raw Material
          </h1>
          <ol class="breadcrumb">
              <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="{!! URL::to('rawMaterial') !!}">Raw Material</a></li>
              <li class="active">Add RawMaterial</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- SELECT2 EXAMPLE -->
          @include('RawMaterial.message')
          <div class="box box-danger">
          {!! Form::open(['route' => 'rawMaterials.store']) !!}
            <div class="box-header with-border">
              <h3 class="box-title">Raw Material Information</h3>
            </div>

            @include('RawMaterial.addfield')

            <div class="box-footer text-center">
                    {!! Form::submit('Submit', ['class' => 'btn btn-danger']) !!}
                    <a href="{{ route('rawMaterial.index') }}" class="btn btn-default">Cancel</a>
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
let moq_list = @JSON($moqs);
let supplier_list = @JSON($suppliers);
let uom_list = @JSON($uoms);
console.log(uom_list)
const supplierTable = $('#supplier_table tbody')

const addSupplier = el => {
const parent = $(el).parents('.box-body')
const supplier = parent.find('#supplier_id')
const uom = parent.find('#uom_id')
const price = parent.find('#price_per_unit')
const lead_time = parent.find('#lead_time')
const moq = parent.find('#moq_id')
const childNumber = supplierTable.children().length
const filteredUom = uom_list.filter(m => m.id == uom.val())
const filteredMoq = moq_list.filter(m => m.id == moq.val()) 
const selectedSupplierText = supplier.find(`option[value=${supplier.val()}]`).text()
var uom_code =  filteredUom[0].code;
console.log(moq.val())
supplierTable.append(`
  <tr>
    <input type="hidden" name="suppliers[${childNumber-1}][supplier_id]" value="${supplier.val()}" />
    <input type="hidden" name="suppliers[${childNumber-1}][uom_id]" value="${uom.val()}" />
    <input type="hidden" name="suppliers[${childNumber-1}][price_per_unit]" value="${price.val()}" />
    <input type="hidden" name="suppliers[${childNumber-1}][lead_time]" value="${lead_time.val()}" />
    <input type="hidden" name="suppliers[${childNumber-1}][moq_id]" value="${moq.val()}" />
    <td>${childNumber}</td>
    <td>${selectedSupplierText}</td>
    <td>${uom_code}</td>
    <td>${price.val()}</td>
    <td>${lead_time.val()}</td>
    <td>
      ${filteredMoq[0].name} | &nbsp;&nbsp;&nbsp;
      <b><small>Min Quantity: ${filteredMoq[0].min_quantity} &nbsp;&nbsp;
      Max Quantity: ${filteredMoq[0].max_quantity}  </small></b>
    </td>
    <td>
      <button type="button" onclick="removeRow(this)"class="btn btn-danger">
        <i class="fa fa-minus"></i>
      </button>
    </td>
  </tr>
`)
supplier.val('')
uom.val('')
lead_time.val('')
price.val('')
moq.val('')
$("#min_quantity").val('')
$("#max_quantity").val('')
}

// remove row
const removeRow = el => $(el).parents('tr').remove()

$('#moq_id').on('keyup change',function() {
  var moq_id = $(this).val(); 
  const filteredMoq = moq_list.filter(m => m.id == moq_id)     
      $("#min_quantity").val(filteredMoq[0].min_quantity);
      $("#max_quantity").val(filteredMoq[0].max_quantity);    
});

</script>
@endpush