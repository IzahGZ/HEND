<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th>#</th>
      <th>Purchase Order Number</th>
      <th>General Information</th>
      <th>Purchaser</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>
      @foreach($purchaseOrders as $purchaseOrder)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>PO{{$purchaseOrder->po_number}}</td>
        <td>
          <b>Supplier : </b>{{$purchaseOrder->suppliers->name}}<br>
          <b>Purchase Order Date : </b>{{$purchaseOrder->po_date}} <br>
          <table class="table table-bordered table-striped">
            <thead>
              <th>#</th>
              <th>Item Name</th>
              <th>Item Code</th>
              <th>Quantity</th>
              <th>Delivery Date</th>
              <th>GRN Number</th>
              <th>Status</th>
            </thead>
            <tbody>
              @foreach($purchaseOrder->purchase_order_items as $item)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->raw_material->name}}</td>
                <td>{{$item->raw_material->code}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->delivery_date}}</td>
                <td>{{$item->grn_item}}</td>
                <td><span class="label label-default" style="background-color:{{$item->system_status->colour}}; color:white;">{{$item->system_status->name}}</span></td>
              </tr>
              @endforeach
            </tbody>
            
          </table>
        </td>
        <td>{{$purchaseOrder->purchase_by}}</td>
        <td class="text-center">
          <span class="label label-default" style="background-color:{{$purchaseOrder->system_status->colour}}; color:white;">{{$purchaseOrder->system_status->name}}</span></td>
        </td>
        <td> 
          {{-- <a href="{{ route('order.download', $orders->id ) }}" target="_blank">
            <i class="fa fa-info" data-name="info" data-size="18" data-loop="true" title="view customer"></i>
          </a> --}}
          <a href="{{ route('purchaseOrder.download', $purchaseOrder->id ) }}" target="_blank">
            <i class="fa fa-info" data-name="info" data-size="18" data-loop="true" title="view Purchase Request"></i>
          </a>
        </td>
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