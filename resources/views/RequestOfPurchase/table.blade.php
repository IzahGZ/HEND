<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th>#</th>
      <th>Purchase Request Number</th>
      <th>General Information</th>
      <th>Requestor</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>
      @foreach($rop as $request)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>ROP{{$request->pr_number}}</td>
        <td>
          <b>Supplier : </b>{{$request->raw_material_supplier->supplier->name}}<br>
          <b>Request Date : </b>{{$request->request_date}} <br>
          <b>Estimated Delivery Date : </b>{{$request->estimated_date}} <br>
          <table class="table table-bordered table-striped">
            <thead>
              <th>#</th>
              <th>Item Name</th>
              <th>Item Code</th>
              <th>Quantity</th>
              <th>Price per Unit (RM)</th>
              <th>Total (RM)</th>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>{{$request->raw_material->name}}</td>
                <td>{{$request->raw_material->code}}</td>
                <td>{{$request->quantity}}</td>
                <td>{{$request->raw_material_supplier->price_per_unit}}</td>
                <td>{{$request->raw_material_supplier->price_per_unit*$request->quantity}}</td>
              </tr>
            </tbody>
            
          </table>
        </td>
        <td>{{$request->request_by}}</td>
        <td class="text-center">
          <span class="label label-default" style="background-color:{{$request->system_status->colour}}; color:white;">{{$request->system_status->name}}</span></td>
        </td>
        <td> 
          @if($request->system_status->id != 7)
          <a href="{{ route('requestOfPurchase.edit', $request->id ) }}">
            <i class="fa fa-edit" data-name="info" data-size="18" data-loop="true" title="view Purchase Request"></i>
          </a> &nbsp;
          @endif
          <a href="{{ route('requestOfPurchaseStore.download', $request->id ) }}" target="_blank">
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