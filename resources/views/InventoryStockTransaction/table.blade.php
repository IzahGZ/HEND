<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th>#</th>
      <th>Transaction</th>
      <th>Category</th>
      <th>Item Name | Code</th>
      <th>GRN Number</th>
      <th>Work Order Number</th>
      <th>Quantity</th>
      <th>Transaction By</th>
      <th>Transaction Made On</th>
    </tr>
    </thead>
    <tbody>
      @foreach($inventoryStockTransactions as $inventoryStockTransaction)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$inventoryStockTransaction->transaction_type->name}}
        </td>
        <td>{{$inventoryStockTransaction->inventory_category->name}}</td>
        <td>@if( !empty($inventoryStockTransaction->grn->grn_number)) 
          {{$inventoryStockTransaction->po_item->raw_material->name}} @endif
          @if( !empty($inventoryStockTransaction->wo->work_order_no)) 
            @if($inventoryStockTransaction->category_id == 1)
              {{$inventoryStockTransaction->raw_material_wo->name}} 
            @endif
            @if($inventoryStockTransaction->category_id == 2)
              {{$inventoryStockTransaction->product->name}} 
            @endif
          @endif
        </td>
        <td>@if( !empty($inventoryStockTransaction->grn->grn_number)) 
          <a href="{{ route('goodReceiveNoteStore.download', $inventoryStockTransaction->grn->id ) }}" target="_blank">
            GRN{{$inventoryStockTransaction->grn->grn_number}}
          </a> @endif
          @if( empty($inventoryStockTransaction->grn->grn_number)) 
          - @endif
        </td>
        <td>@if( !empty($inventoryStockTransaction->wo->work_order_no))
          <a href="{{ route('workOrder.download', $inventoryStockTransaction->wo->id ) }}" target="_blank">
            WO{{$inventoryStockTransaction->wo->work_order_no}}
          </a>@endif
          @if( empty($inventoryStockTransaction->wo->work_order_no))                                                                                                                                                                                                                                                                                                                                                                                                                            
          - @endif
        </td>
        <td>{{$inventoryStockTransaction->quantity}}</td>
        <td>{{$inventoryStockTransaction->transaction_by}}</td>
        <td>{{$inventoryStockTransaction->created_at}}</td>
      </tr>
      @endforeach
  </table>

<!-- The modal -->
<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
          <h4 class="modal-title" id="deleteLabel">Delete Item</h4>
        </div>
          <div class="modal-body">
            Are you sure to delete this Item?
          </div>
            <div class="modal-footer">
              <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
              <a  type="button" class="btn btn-danger Remove_square">Delete</a>
            </div>
       </div>
    </div>
  </div>

@push('script')
<!-- DataTables -->
<script src="{{('bower_components/datatables.net/js/jquery.dataTables.min.js')}}" defer></script>
<script src="{{('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}" defer></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
  })

  $('#delete_confirm').on('show.bs.modal', function (event) {
                      var button = $(event.relatedTarget)
                       var $recipient = button.data('id');
                      var modal = $(this);
                      modal.find('.modal-footer a').prop("href",$recipient);
                  })
</script>
@endpush