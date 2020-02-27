<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th>#</th>
      <th>BOM ID</th>
      <th>Project Code</th>
      <th>Project Name</th>
      <th>Delivery Date</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>
      @foreach($boms as $bom)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>BOM{{$bom->bom_number}}</td>
        <td>{{$bom->project->code}}</td>
        <td>{{$bom->project->products->name}}</td>
        <td>{{$bom->order->delivery_date}}</td>
        <td class="">
          <span class="label label-default" style="background-color:{{$bom->systemstatus->colour}}; color:white;">{{$bom->systemstatus->name}}
        </td>
        <td>
          {{-- <a href="{{ route('customer.edit', $bom->id ) }}">
            <i class="fa fa-edit" data-name="info" data-size="18" data-loop="true" title="view customer"></i>
        </a> &nbsp; --}}
          <a href="{{ route('bom.view', $bom->id ) }}">
              <i class="fa fa-info" data-name="info" data-size="18" data-loop="true" title="view customer"></i>
          </a>
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