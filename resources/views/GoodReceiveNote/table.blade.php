<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th>#</th>
      <th>GRN Number</th>
      <th>PO Number</th>
      <th>Supplier Name</th>
      <th>Supplier DO Number</th>
      <th>Supplier DO Date</th>
      {{-- <th>Total GRN (RM)</th> --}}
      <th>Action</th>
    </tr>
    </thead>
    <tbody>
      @foreach($goodReceiveNotes as $goodReceiveNote)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>GRN{{$goodReceiveNote->grn_number}}</td>
        <td>{{$goodReceiveNote->purchaseorder->po_number}}</td>
        <td>{{$goodReceiveNote->purchaseorder->suppliers->name}}</td>
        <td>{{$goodReceiveNote->supplier_do_number}}</td>
      <td>{{$goodReceiveNote->supplier_do_date}}</td>
      {{-- <td></td> --}}
        <td> 
          {{-- <a href="{{ route('order.download', $orders->id ) }}" target="_blank">
            <i class="fa fa-info" data-name="info" data-size="18" data-loop="true" title="view customer"></i>
          </a> --}}
          <a href="{{ route('goodReceiveNoteStore.download', $goodReceiveNote->id ) }}" target="_blank">
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