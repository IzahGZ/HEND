<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th>#</th>
      <th>Work Order Number</th>
      <th>Project Name</th>
      <th>Recipee Information</th>
      <th>Quantity</th>
      <th>Due Date</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>
      @foreach($workOrders as $workOrder)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>WO{{$workOrder->work_order_no}}</td>
        <td>{{$workOrder->product->name}}</td>
        <td>
          <table class="table table-bordered table-striped">
            <thead>
              <th>#</th>
              <th>Ingredients</th>
              <th>Quantity</th>
              <th>UOM</th>
            </thead>
            <tbody>
              @foreach($workOrder->project->materials as $item)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->pivot->quantity*$workOrder->quantity}}</td>
                <td>{{$item->uoms->code}}</td>
              </tr>
              @endforeach
            </tbody>
            
          </table>
        </td>
        <td>{{$workOrder->quantity}}</td>
        <td>{{$workOrder->due_date}}</td>
        <td class="text-center">
          <span class="label label-default" style="background-color:{{$workOrder->system_status->colour}}; color:white;">{{$workOrder->system_status->name}}</span></td>
        </td>
        <td> 
          @if($workOrder->system_status->id == 2) 
          <a href="{{ route('workOrder.confirm-production', $workOrder->id ) }}" class="label label-default" 
            style="background-color:#16e04d; color:white;" data-toggle="modal" data-target="#production_confirm" 
            data-id="{{ route('workOrder.production', $workOrder->id ) }}">Run Production</a><br>
          @endif
          <a href="{{ route('workOrder.download', $workOrder->id ) }}" target="_blank">
            <i class="fa fa-info" data-name="info" data-size="18" data-loop="true" title="view Work Order"></i>
          </a>
          @if($workOrder->system_status->id != 2) 
          <a href="{{ route('workOrder.downloadProcessTravellerPDF', $workOrder->id ) }}" target="_blank">
            <i class="fa fa-fw fa-map" data-name="info" data-size="18" data-loop="true" title="view Process Traveller"></i>
          </a>
          @endif
        </td>
      </tr>
      @endforeach
  </table>

  <!-- The modal -->
<div class="modal fade" id="production_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
        <h4 class="modal-title" id="deleteLabel">Run Production</h4>
      </div>
        <div class="modal-body">
          Stock out raw materials for this work order?
        </div>
          <div class="modal-footer">
            <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
            <a  type="button" class="btn btn-danger Remove_square">Yes</a>
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

  $('#production_confirm').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
          var $recipient = button.data('id');
        var modal = $(this);
        modal.find('.modal-footer a').prop("href",$recipient);
    })
</script>
@endpush