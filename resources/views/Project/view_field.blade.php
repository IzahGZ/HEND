<div class="box-body">
    <div class="row">
      <div class="col-md-6">
        <div class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                {!! Form::label('code', 'Project Code:') !!}
                {!! Form::text('code', $Project->code, ['class' => 'form-control', 'disabled' => true]) !!}
              </div>
            </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="box-body">
          <div class="form-horizontal">
            {!! Form::label('product_id', 'Project Name:') !!}
            {!! Form::text('product_id', $Project->product_id, ['class' => 'form-control', 'disabled' => true]) !!}
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
      <div class="box-body no-padding">
          <table class="table table-striped" id="rawMaterialTable">
            <tr>
              <th style="width: 10px">#</th>
              <th>Raw Material</th>
              <th>Quantity</th>
            </tr>
            @foreach ($Project->materials as $item)
              <tr>
                <input type="hidden" name="material[{{$loop->index}}][id]" value="{{ $item->id }}" />
                <input type="hidden" name="material[{{$loop->index}}][quantity]" value="{{ $item->pivot->quantity }}" />
                <td style="width: 10px">{{ $loop->iteration }}</td>
                <td>{{ $item->name }} | {{ $item->code }}</td>
                <td>{{ $item->pivot->quantity }}</td>
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
      <div class="box-body no-padding">
          <table class="table table-striped" id="processTable">
            <tr>
              <th style="width: 10px">#</th>
              <th>Process</th>
              <th>Duration</th>
            </tr>
            @foreach ($Project->processes as $item)
              <tr>
                <td style="width: 10px">{{ $loop->iteration }}</td>
                <td>{{ $item->name }} | {{ $item->code }}</td>
                <td>{{ $item->pivot->duration }}</td>
              </tr>
            @endforeach
          </table>
        </div>
    </div>
  </div>