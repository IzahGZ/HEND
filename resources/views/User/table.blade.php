<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>User Type</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->categories->name}}</td>
        <td> 
          <a href="{{ route('user.confirm-reset', $user->id ) }}" class="btn btn-warning"
            data-toggle="modal" data-target="#reset" data-id="{{ route('user.reset', $user->id ) }}">Reset Password</a>
        </td>
      </tr>
      @endforeach
  </table>

<!-- The modal -->
<div class="modal fade" id="reset" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
          <h4 class="modal-title" id="deleteLabel">Reset Password</h4>
        </div>
          <div class="modal-body">
            Are you sure to reset this account to default password?
          </div>
            <div class="modal-footer">
              <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
              <a  type="button" class="btn btn-danger Remove_square">Reset</a>
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

  $('#reset').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
        var $recipient = button.data('id');
      var modal = $(this);
      modal.find('.modal-footer a').prop("href",$recipient);
  })
</script>
@endpush