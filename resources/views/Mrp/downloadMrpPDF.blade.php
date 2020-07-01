<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style>
    th,td{
        border: 1px solid black;
    }

    table tr td{
    border:1px solid black;
    page-break-inside: avoid !important;
    }

    @media  print {
        .tfoot {
            position: absolute;
            bottom: 10px;
            page-break-after: always
        }

        .traveller>div:last-child {
            page-break-before: always
        }

        .breakAfter {
            page-break-inside: avoid;
            page-break-after: always;
        }

        @page  {
            size: landscape
        }

    }
</style>
<?php 
        $hour = intdiv($duration, 60);
        $minute = $duration % 60;
?>
<div class="breakAfter">
    {{-- border:1px solid black --}}
    <table style="padding-left:-25;" class="traveller">
        <thead>
            <tr>
                <th colspan="8" style="text-align:center; font-size:18; font-weight:bold; border:none" height="70" width="1200";>
                    <img  src="{{asset('img/hend.png')}}" data-holder-rendered="true" style="height:60px; float: center;">
                    <b>{{$company[0]->company_name}} </b> ({{$company[0]->registration_number}})
                </th>
            </tr>
        </thead>
    </table> <br>
    <table style="padding-left:-25; " class="traveller">
        <tr>
            <td style="text-align:left; width:200px; border:none">Month :&nbsp;</td>
            <td style="text-align:right; width:5px; border:none">:&nbsp;</td>
        <td style="text-align:left; width:400px; border:1px solid black">&nbsp;{{date('F')}}</td>
        </tr>
        <tr>
            <td style="text-align:left; width:200px; border:none">Current Week</td>
            <td style="text-align:right; width:5px; border:none">:&nbsp;</td>
        <td style="text-align:left; width:400px; border:1px solid black">&nbsp;Week {{date('W')}}</td>
        </tr>
        <tr>
            <td style="text-align:left; width:200px; border:none">Project</td>
            <td style="text-align:right; width:5px; border:none">:&nbsp;</td>
        <td style="text-align:left; width:400px; border:1px solid black">&nbsp;{{$product->name}}</td>
        </tr>
        <tr>
            <td style="text-align:left; width:200px; border:none">Manufacturing Cycle</td>
            <td style="text-align:right; width:5px; border:none">:&nbsp;</td>
        <td style="text-align:left; width:400px; border:1px solid black">&nbsp;{{$hour}} hour {{$minute}} minute</td>
        </tr>
        <tr>
            <td style="text-align:left; width:200px; border:none">Page</td>
            <td style="text-align:right; width:5px; border:none">:&nbsp;</td>
            <td style="text-align:left; width:400px; border:1px solid black">&nbsp;1 of 8</td>
        </tr>
    </table> <br>
    <div class="box-header with-border">
        <p style="font-size:17px"><b>Master Production Schedule (MPS)</b></p>
      </div>
    <table id="example1" class="table table-bordered table-striped">
        <tr>
          <td></td>
          <td>Beginning Inventory</td>
          @foreach($dates as $days)
          <td>{{ date("d M", strtotime($days->date))}}</td>
          @endforeach
        </tr>
        <tr>
          <td>Gross Requirement</td>
          <td></td>
          @foreach($dates as $days)
          <td>{{$days->quantity}}</td>
          @endforeach
        </tr>
        <tr>
          <td>Projected On Hand</td> 
          <?php 
            $on_hand = $product->current_stock;
          ?>
          <td>{{$product->current_stock}}</td>
          @foreach($dates as $days)
          <td>{{$days->on_hand}}</td>
          @endforeach
        </tr>
        <tr>
          <td>Net Requirement</td>
          <td></td>
          <?php $net_req = $product->current_stock ?>
          @foreach($dates as $days)
          <td>{{$days->net_requirement}}</td>
          @endforeach
        </tr>
        
        <tr>
          <td>Production Schedule</td>
          <td></td>
          @foreach($dates as $days)
          @if($days->order_release>0 && $days->wo_status == 8)
          <td>
            {{$days->order_release}}</td>
          @endif
          @if($days->order_release>0 && $days->wo_status != 8)
          <td>
            {{$days->order_release}}</td>
          @endif
          @if($days->order_release<=0)
          <td>{{$days->order_release}}</td>
          @endif
          @endforeach
        </tr>
    
        <tr>
          <td>To Be Delivered</td>
          <td></td>
          @foreach($dates as $days)
          <td>
            {{$days->order_receipt}}</td>
          @endforeach
        </tr>
      </table>

      {{-- New Page --}}
    <?php $page = 1?>
    @foreach($project->materials as $item)
    <?php $page++?>
    <table style="padding-left:-25; page-break-before: always" class="traveller">
        <thead>
            <tr>
                <th colspan="8" style="text-align:center; font-size:18; font-weight:bold; border:none" height="70" width="1200";>
                    <img  src="{{asset('img/hend.png')}}" data-holder-rendered="true" style="height:60px; float: center;">
                    <b>{{$company[0]->company_name}} </b> ({{$company[0]->registration_number}})
                </th>
            </tr>
        </thead>
    </table> <br>
    <table style="padding-left:-25; " class="traveller">
        <tr>
            <td style="text-align:left; width:200px; border:none">Month :&nbsp;</td>
            <td style="text-align:right; width:5px; border:none">:&nbsp;</td>
        <td style="text-align:left; width:400px; border:1px solid black">&nbsp;{{date('F')}}</td>
        </tr>
        <tr>
            <td style="text-align:left; width:200px; border:none">Current Week</td>
            <td style="text-align:right; width:5px; border:none">:&nbsp;</td>
        <td style="text-align:left; width:400px; border:1px solid black">&nbsp;Week {{date('W')}}</td>
        </tr>
        <tr>
            <td style="text-align:left; width:200px; border:none">Project</td>
            <td style="text-align:right; width:5px; border:none">:&nbsp;</td>
        <td style="text-align:left; width:400px; border:1px solid black">&nbsp;{{$product->name}}</td>
        </tr>
        <tr>
            <td style="text-align:left; width:200px; border:none">Manufacturing Cycle</td>
            <td style="text-align:right; width:5px; border:none">:&nbsp;</td>
        <td style="text-align:left; width:400px; border:1px solid black">&nbsp;{{$hour}} hour {{$minute}} minute</td>
        </tr>
        <tr>
            <td style="text-align:left; width:200px; border:none">Page</td>
            <td style="text-align:right; width:5px; border:none">:&nbsp;</td>
            <td style="text-align:left; width:400px; border:1px solid black">&nbsp{{$page}} of 8</td>
        </tr>
    </table> <br>
        <?php
            $lead_time = $item->suppliers;
            //Find shortest lead time of supplier
            $shortest_lead_time = 0;
            foreach ($lead_time as $rms) {
                $shortest_lead_time = $rms->lead_time;
                $supplier_lead_time = $rms->lead_time;
                $current = $supplier_lead_time;

                if ($current < $shortest_lead_time) {
                    $shortest_lead_time = $current;
                }
            }
        ?>
        <p style="font-size:17px"><b class="box-title" >Raw Material Order Planning </b></p style="text-size:15px">
        <p style="font-size:15px"><b class="box-title" >{{$item->name}}</b></p style="text-size:15px">
        <table>
            <td style="border:none" width=400><small>Method: {{$item->pivot->lot_sizing->name}}</small></td>
            <td style="border:none" width=220><small>Lead Time: {{round($shortest_lead_time)}} Days</small></td>
        </table>
        <table id="example1" class="table table-bordered table-striped">
        <tr>
            <td></td>
            <td>Beginning Inventory</td>
            @foreach($date_raw_materials as $raw_material)
            @if($item->id == $raw_material->raw_material_id)
                <td>{{ date("d M", strtotime($raw_material->date))}}</td>
            @endif
            @endforeach
        </tr>
        <tr>
            <td>Gross Requirement</td>
            <td></td>
            @foreach($date_raw_materials as $raw_material)
            @if($item->id == $raw_material->raw_material_id)
                @if($raw_material->quantity > 0)
                <td>{{$raw_material->quantity}}</td>
                @else
                <td>{{$raw_material->quantity}}</td>
                @endif
            @endif
            @endforeach
        </tr>
        <tr>
            <td>Schedule Receipt</td>
            <td></td>
            @foreach($date_raw_materials as $raw_material)
            @if($item->id == $raw_material->raw_material_id)
                <td>{{$raw_material->schedule_receipt}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <td>Projected On Hand</td>
        <td>{{$item->current_stock}}</td>
            @foreach($date_raw_materials as $raw_material)
            @if($item->id == $raw_material->raw_material_id)
                <td>{{$raw_material->on_hand}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <td>Net Requirement</td>
            <td></td>
            @foreach($date_raw_materials as $raw_material)
            @if($item->id == $raw_material->raw_material_id)
                @if($raw_material->net_requirement > 0)
                <td>
                {{$raw_material->net_requirement}}</td>
                @else
                <td>{{$raw_material->net_requirement}}</td>
                @endif
            @endif
            @endforeach
        </tr>
        <tr>
            <td>Planned Order Released</td>
            <td></td>
            @foreach($date_raw_materials as $raw_material)
                @if($item->id == $raw_material->raw_material_id)
                    <td>{{$raw_material->order_release}}</td>
                @endif
            @endforeach
        </tr>
        <tr>
            <td>Planned Order Receipt</td>
            <td></td>
            @foreach($date_raw_materials as $raw_material)
                @if($item->id == $raw_material->raw_material_id)
                    <td>{{$raw_material->order_receipt}}</td>
                @endif
            @endforeach
        </tr>
        </table>
    @endforeach
</div>
</body>
</html>
