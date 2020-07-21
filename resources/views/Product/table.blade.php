<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Current Stock</th>
      <th>Safety Stock</th>
      <th>Unit</th>
      <th>Price (RM)</th>
      <th>Status</th>
      @if(auth()->user()->user_type == 3 || auth()->user()->user_type == 4)
      <th>Action</th>
      @endif
    </tr>
    </thead>
    <tbody>
        @foreach($product as $product)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$product->name}}</td>
          <td>
            @if($product->current_stock > $product->safety_stock)
            <span style="color:#00a65a">{{$product->current_stock}}</span></td>
          @else 
          <span style="color:#dd4b39">{{$product->current_stock}}</span></td>
          @endif
          <td>{{$product->safety_stock}}</td>
          <td>{{$product->uoms->name}}</td>
          <td>{{$product->price}}</td>
          <td>
            @if($product->current_stock > $product->safety_stock)
              <span class="label label-success">In Stock</span></td>
            @else 
              <span class="label label-danger">Critical</span></td>
            @endif
          @if(auth()->user()->user_type == 3 || auth()->user()->user_type == 4 || auth()->user()->user_type == 2)
          <td><a href="{{ route('product.edit', $product->id ) }}">
              <i class="fa fa-edit" data-name="info" data-size="18" data-loop="true" title="view product"></i>
              </a> &nbsp;
              @if(auth()->user()->user_type == 4)
              <a href="{{ route('product.confirm-delete', $product->id ) }}" data-toggle="modal" data-target="#delete_confirm" data-id="{{ route('product.delete', $product->id ) }}">
              <i class="fa fa-trash" title="delete product data-name="remove-alt" data-size="18" data-loop="true""></i></a> &nbsp;
              @endif
              <a href="{{ route('product.view', $product->id ) }}">
                <i class="fa fa-info" data-name="info" data-size="18" data-loop="true" title="view product"></i>
            </a>
          </td>
          @endif
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