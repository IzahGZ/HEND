<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Address</th>
      <th>Phone No</th>
      <th>Email</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>
      @foreach($customer as $cust)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$cust->name}}</td>
        <td>{{$cust->address}}</td>
        <td>{{$cust->phone}}</td>
        <td>{{$cust->email}}</td>
        <td><span class="label label-default" style="background-color:{{$cust->systemstatus->colour}}; color:white;">{{$cust->systemstatus->name}}</span></td>
        <td>
          <a href="{{ route('customer.edit', $cust->id ) }}">
            <i class="fa fa-edit" data-name="info" data-size="18" data-loop="true" title="view customer"></i>
          </a> &nbsp;
          <a href="{{ route('customer.confirm-delete', $cust->id ) }}" data-toggle="modal" data-target="#delete_confirm" data-id="{{ route('customer.delete', $cust->id ) }}">
          <i class="fa fa-trash" title="delete customer data-name="remove-alt" data-size="18" data-loop="true""></i></a> &nbsp;
          <a href="{{ route('customer.view', $cust->id ) }}">
              <i class="fa fa-info" data-name="info" data-size="18" data-loop="true" title="view customer"></i>
          </a>
      </tr>
      @endforeach
    <tfoot>
      <th>#</th>
      <th>Name</th>
      <th>Address</th>
      <th>Phone No</th>
      <th>Email</th>
      <th>Status</th>
      <th>Action</th>
    </tfoot>
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