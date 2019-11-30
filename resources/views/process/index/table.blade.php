<div class="table-responsive">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Code</th>
        <th>Name</th>
        <th>Station</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($processes as $process)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$process->code}}</td>
            <td>{{$process->name}}</td>
            <td>{{$process->station}}</td>
            <td>
              <a href="{{ route('process.edit', $process->id ) }}">
                <i class="fa fa-edit" data-name="info" data-size="18" data-loop="true" title="view process"></i>
              </a> &nbsp;
              <a href="#" data-toggle="modal" data-target="#delete_confirm" onclick="selectItem(this, {{$process}})">
                <i class="fa fa-trash" title="delete process" data-name="remove-alt" data-size="18" data-loop="true"></i>
              </a> &nbsp;
              <a href="{{ route('process.show', $process->id ) }}">
                <i class="fa fa-info" data-name="info" data-size="18" data-loop="true" title="view process"></i>
              </a>
          </tr>
        @endforeach
    </tbody>
    <tfoot>
      <th>#</th>
      <th>Code</th>
      <th>Name</th>
      <th>Station</th>
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
              <a  type="button" onclick="deleteProcess()" data-dismiss="modal" class="btn btn-danger Remove_square">Delete</a>
            </div>
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
    let selectedItem = null
    let selectedRowEl = null
    const selectItem = (el, process) => {
      selectedItem = process
      selectedRowEl = $(el).parents('tr')
    }
    const deleteProcess = async () => {
      try {
        const response = await fetch(`{{URL::to('process')}}/${selectedItem.id}`, {
          method: 'delete',
          body: JSON.stringify({_token: '{{ csrf_token() }}'}),
          headers: {
            'Content-Type': 'application/json',
          }
        })
        const success = await response.json()
        if(!success) {
          alert('Something went wrong in performing the action, please try again')
          return;
        }

        selectedRowEl.remove()
        selectedItem = null
        selectedRowEl = null
      } catch(err) {
        console.error(err)
        alert('Something went wrong in performing the action, please try again')
      }
    }
  </script>
@endpush