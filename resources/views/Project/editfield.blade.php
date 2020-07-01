<div class="box-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              {!! Form::label('code', 'Project Code:') !!}
              {!! Form::text('code', $Project->code, ['class' => 'form-control', 'required' => true]) !!}
            </div>
          </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="box-body">
        <div class="form-horizontal">
          {!! Form::label('product_id', 'Project Name:') !!}
            <select name="product_id" id="Product_id" class="form-control product_id" required>
              <option value="">Please select project name</option>
              @foreach($products as $product)
                <option
                  value="{{ $product->id }}"
                  @if ($Project->product_id == $product->id)
                      selected
                  @endif
                >
                  {{$product->name}}
                </option>
              @endforeach
            </select>
            
        </div>
      </div>
    </div>
  </div>
</div>
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
              <select
                id="product_id"
                class="form-control product_id"
                onchange="rawMaterialChanged(this)"
              >
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
                    {!! Form::text(null, null, [
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
                        <i class="fa fa-plus"></i> Add
                      </button>
                    </div>
                  </div>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="box-body no-padding">
        <table class="table table-striped" id="rawMaterialTable">
          <tr>
            <th style="width: 10px">#</th>
            <th>Raw Material</th>
            <th>Quantity</th>
            <th style="width: 40px">Action</th>
          </tr>
          @foreach ($Project->materials as $item)
            <tr>
              <input type="hidden" name="material[{{$loop->index}}][id]" value="{{ $item->id }}" />
              <input type="hidden" name="material[{{$loop->index}}][quantity]" value="{{ $item->pivot->quantity }}" />
              <td style="width: 10px">{{ $loop->iteration }}</td>
              <td>{{ $item->name }} | {{ $item->code }}</td>
              <td>{{ $item->pivot->quantity }}</td>
              <td style="width: 40px">
                <button type="button" onclick="removeRow(this)"class="btn btn-danger">
                  <i class="fa fa-minus"></i>
                </button>
              </td>
            </tr>
          @endforeach
        </table>
      </div>
  </div>
</div>
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
            {!! Form::label('supplier', 'Process:') !!}
            <select id="process" class="form-control">
                <option value="">Please select process</option>
                @foreach($process as $proc)
                  <option value="{{ $proc->id }}">{{$proc->name}}</option>
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
                {!! Form::label('duration', 'Duration:') !!}
                {!! Form::text('', null, ['class' => 'form-control', 'id' => 'duration', 'placeholder' => 'minute']) !!}
              </div>
          </div>
        </div>
      </div>
      <div class="col-md-1">
        <div class="box-body">
            <div class="form-horizontal">
              <div class="form-group">
                {!! Form::label('action', 'Action') !!}
                <div>
                  <button onclick="addProcess(this)" type="button" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add
                  </button>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box-body no-padding">
        <table class="table table-striped" id="processTable">
          <tr>
            <th style="width: 10px">#</th>
            {{-- <th>Raw Material</th> --}}
            <th>Process</th>
            <th>Duration</th>
            <th style="width: 40px">Action</th>
          </tr>
          @foreach ($Project->processes as $item)
            <tr>
              <td style="width: 10px">{{ $loop->iteration }}</td>
              <input type="hidden" name="process[{{ $loop->index }}][process]" value="{{ $item->id }}" />
              <input type="hidden" name="process[{{ $loop->index }}][duration]" value="{{ $item->pivot->duration }}" />
              <td>{{ $item->name }} | {{ $item->code }}</td>
              <td>{{ $item->pivot->duration }}</td>
              <td style="width: 40px">
                <button type="button" onclick="removeRow(this)"class="btn btn-danger">
                  <i class="fa fa-minus"></i>
                </button>
              </td>
            </tr>
          @endforeach
        </table>
      </div>
  </div>
</div>

@push('script')
  <script>
    let rawMaterials = @JSON($rawMaterials);
    console.log(rawMaterials);

    const rawMaterialChanged = el => {
      const rawMaterialId = el.value
      const filteredRawMaterials = rawMaterials
        .filter(m => m.id == rawMaterialId)

      if (!filteredRawMaterials.length)
        return;

      $('input#quantity')
        .attr('placeholder', `in ${filteredRawMaterials[0].uoms.code}`)
    }
    
    const rawMaterialTable = $('#rawMaterialTable tbody')
    const processTable = $('#processTable tbody')
    const parentMaterial = $('#parentMaterial')

    // add to the table
    const addRow = el => {
      const container = $(el).parents('.row')
      const childNumber = rawMaterialTable.children().length
      const productEl = $(container).find('#product_id')
      const quantityEl = $(container).find('#quantity')

      if (!productEl.val() || !quantityEl.val())
        return;
      const selectedProductText = productEl.find(`option[value=${productEl.val()}]`).text()
      
      rawMaterialTable.append(`
        <tr>
          <input type="hidden" name="material[${childNumber-1}][id]" value="${productEl.val()}" />
          <input type="hidden" name="material[${childNumber-1}][quantity]" value="${quantityEl.val()}" />
          <td>${childNumber}</td>
          <td>${selectedProductText}</td>
          <td>${quantityEl.val()}</td>
          <td>
            <button type="button" onclick="removeRow(this)"class="btn btn-danger">
              <i class="fa fa-minus"></i>
            </button
          </td>
        </tr>
      `)
      productEl.val('')
      quantityEl.attr('placeholder', null)
      quantityEl.val('')
    }

    // remove row
    const removeRow = el => $(el).parents('tr').remove()

    const addProcess = el => {
      const parent = $(el).parents('.row')
      // const rawMaterial = parent.find('#product_id')
      const process = parent.find('#process')
      console.log(process)
      const duration = parent.find('#duration')
      const childNumber = processTable.children().length
      if (!process.val() || !duration.val())
        return;
      const selectedProcessText = process.find(`option[value=${process.val()}]`).text()
      processTable.append(`
        <tr>
          <input type="hidden" name="process[${childNumber-1}][process]" value="${process.val()}" />
          <input type="hidden" name="process[${childNumber-1}][duration]" value="${duration.val()}" />
          <td>${childNumber}</td>
          <td>${selectedProcessText}</td>
          <td>${duration.val()}</td>
          <td>
            <button type="button" onclick="removeRow(this)"class="btn btn-danger">
              <i class="fa fa-minus"></i>
            </button
          </td>
        </tr>
      `)
      // rawMaterial.val('')
      process.val('')
      duration.val('')
    }
  </script>
@endpush