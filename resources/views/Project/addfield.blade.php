<!-- /.box-header -->
<div class="box-body">
  <div class="row">
    <div class="col-md-6">
        <div class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                  {!! Form::label('code', 'Project Code:') !!}
                  {!! Form::text('code', null, ['class' => 'form-control']) !!}
              </div>
            </div>
        </div>
    </div>
    
    <!-- /.col -->
    <!-- right column -->
    <div class="col-md-6">
        <div class="box-body">
            <div class="form-horizontal">
                  {!! Form::label('product_id', 'Project Name:') !!}
                    <select name="product_id" id="product_id" class="form-control product_id" required>
                        <option value="">Please select project name</option>
                          @foreach($products as $product)
                            <option value="{{ $product->id }}">{{$product->name}}</option>
                          @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
        <!--/.col (right) -->
</div>
        <!-- /.row -->
<div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title">BOM Information</h3>
  </div>
  <div class="box-body">
    <div id="parentMaterial">
      <div class="row">
        <div class="col-md-6">
          <div class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
              {!! Form::label('supplier', 'Raw Material:') !!}
              <select name="material[0].name" id="product_id" class="form-control product_id" required>
                  <option value="">Please select raw material</option>
                  @foreach($rawMaterials as $rawMaterial)
                    <option value="{{ $rawMaterial->id }}">{{$rawMaterial->name}}</option>
                  @endforeach
              </select>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5">
            <div class="box-body">
                <div class="form-horizontal">
                  <div class="form-group">
                    {!! Form::label('quantity', 'Quantity:') !!}
                    {!! Form::text('material[0].quantity', null, [
                      'class' => 'form-control',
                      'id' => 'quantity'
                      ]) !!}
                  </div>
              </div>
            </div>
        </div>
        <div class="col-md-1">
            <div class="box-body">
                <div class="form-horizontal">
                  <div class="form-group">
                    <label>action</label>
                    <div>
                      <button id="addRowButton" type="button" onclick="addRow(this)" class="btn btn-circle btn-primary">
                        <i class="fa fa-plus"></i>
                      </button>
                    </div>
                  </div>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="box-body no-padding">
        <table class="table table-striped">
          <tr>
            <th style="width: 10px">#</th>
            <th>Task</th>
            <th>Progress</th>
            <th style="width: 40px">Label</th>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </table>
      </div>
  </div>
</div>
      <!-- /.box header -->
<div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title">Manufacturing Process Information</h3>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-md-6">
        <div class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
            {!! Form::label('supplier', 'Raw Material:') !!}
            <select name="product_id" id="product_id" class="form-control product_id" required>
                <option value="">Please select process</option>
                @foreach($process as $process)
                <option value="{{ $process->id }}">{{$process->name}}</option>
                @endforeach
            </select>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
          <div class="box-body">
              <div class="form-horizontal">
                <div class="form-group">
                  {!! Form::label('duration', 'Duration (in hours):') !!}
                  {!! Form::text('duration', null, ['class' => 'form-control']) !!}
                </div>
            </div>
          </div>
      </div>
    </div>
    <div class="box-body no-padding">
        <table class="table table-striped">
          <tr>
            <th style="width: 10px">#</th>
            <th>Task</th>
            <th>Progress</th>
            <th style="width: 40px">Label</th>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </table>
      </div>
  </div>
</div>

@push('script')
  <script>
    const rawMaterials = @JSON($rawMaterials);
    console.log(rawMaterials)

    $(document).change('.product_id', function(e) {
      console.log(e.target.value)
    })

    const parentMaterial = $('#parentMaterial')
    const addRow = el => {
      const container = $(el).parents('.row')
      const duplicated = container[0].cloneNode(true)
      const addRowButton = $(duplicated).find('#addRowButton')
      const childNumber = parentMaterial.children().length
      // copy then change attribute to avoid duplication
      addRowButton.attr('onclick', 'removeRow(this)')
      addRowButton.removeClass('btn-primary')
      addRowButton.addClass('btn-danger')
      addRowButton.empty()
      addRowButton.append('<i class="fa fa-minus"></i>')
      const quantityEl = $(duplicated).find('#quantity')
      quantityEl.attr('name', `material[${childNumber}].quantity`)
      quantityEl.val('')
      const productEl = $(duplicated).find('#product_id')
      productEl.attr('name', `material[${childNumber}].name`)
      parentMaterial.append($(duplicated))
    }

    // remove row
    const removeRow = el => $(el).parents('.row').remove()
  </script>
@endpush
  
      