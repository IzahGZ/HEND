@extends('layout.template')

@push('link')
@endpush

@push('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Finished Goods
          </h1>
          <ol class="breadcrumb">
              <li><a href="{!! URL::to('index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="{!! URL::to('finishGoodProduction') !!}">Finish Good Production</a></li>
              <li class="active">Add Finished Goods</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- SELECT2 EXAMPLE -->
          @include('RequestOfPurchase.message')
          <div class="box box-danger">
          {!! Form::open(['route' => 'finishGoodProduction.store']) !!}
            <div class="box-header with-border">
              <h3 class="box-title">Finished Goods Details</h3>
            </div>

            @include('FinishGoodProduction.field')

            <div class="box-footer text-center">
                    {!! Form::submit('Submit', ['class' => 'btn btn-danger']) !!}
                    <a href="{{ route('workOrder.index') }}" class="btn btn-default">Cancel</a>
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

let workOrders = @JSON($workOrders);
// console.log(raw_material_supplier)

$('#wo_id').on('keyup change',function() {
  var workorder = $(this).val(); 
  const filteredworkOrder = workOrders.filter(m => m.id == workorder)
  console.log(filteredworkOrder[0].quantity)   
  $('#quantity').val(filteredworkOrder[0].quantity);
  $('#item_id').val(filteredworkOrder[0].item_id);
});
</script>
@endpush