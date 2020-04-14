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

<div class="breakAfter">
    <table style="padding-left:-25; border:1px solid black;" class="traveller">
        <thead>
            <tr>
                <th colspan="8" style="text-align:center; font-size:18; font-weight:bold;" height="70">
                    <img  src="{{asset('img/hend.png')}}" data-holder-rendered="true" style="height:60px; float: center;">
                    <b>{{$company[0]->company_name}} </b> ({{$company[0]->registration_number}})
                </th>
            </tr>
            <tr>
                <th style="text-align:left; width:143px;" colspan="2">Code :</th>
                <th style="text-align:left; width:188px;" colspan="1"> {{$workOrders->project->code}}</th>
                <th colspan="3" rowspan="3" style="font-size:26px; font-weight:bold; vertical-align:center; width:517px; font-family:Arial, Helvetica, sans-serif ;">
                    <div class="row col-12" style=" ">
                        <div class="col-9 text-center" >Process Traveller </div>
                    </div>
                </th>
                <th style="text-align:left; width:124px;" colspan="1">WO Number :</th>
                <th style="text-align:left; width:105px;" colspan="1">WO{{$workOrders->work_order_no}}</th>
            </tr>
            <tr>
                <th style="text-align:left; width:143px;" colspan="2">Project:</th>
                <th style="text-align:left; width:188px;" colspan="1">{{$workOrders->product->name}}</th>
                <th style="text-align:left; width:124px;" colspan="1">Release Date :</th>
                <th style="text-align:left; width:105px;" colspan="1"> {{ date("d-m-Y", strtotime($workOrders->created_at))}}</th>
            </tr>
            <tr>
                <th style="text-align:left; width:143px;" colspan="2">Quantity :</th>
                <th style="text-align:left; width:188px;" colspan="1">{{$workOrders->quantity}} {{$workOrders->product->uoms->code}}</th>
                <th style="text-align:left; width:124px;" colspan="1">Due Date : </th>
                <th style="text-align:left; width:105px;" colspan="1"> {{$workOrders->due_date}}</th>
            </tr>
            <tr>
                <th style="text-align:left; width:188px;" colspan="3"></th>
                <th colspan="3" rowspan="1" style="width: 500px; text-align:center; font-size:14px; font-weight:bold;">PRODUCTION DEPARTMENT</th>
                <th style="text-align:center; width:124px;" colspan="2"> page 1 of 1</th>
            </tr>
            <tr>
                <th style="text-align:center;" colspan="1" >#</th>
                <th style="text-align:center;" colspan="2">Process</th>
                <th style="text-align:center;" colspan="1">Name of Operator</th>
                <th style="text-align:center;" colspan="1">Date & Time*</th>
                <th style="text-align:center;" colspan="1">PASS/FAIL</th>
                <th style="text-align:center;" colspan="2">Remark</th>

            </tr>
        </thead>
        <tbody>
            @foreach($workOrders->project->processes as $item)
            <tr>
            <td style="text-align:center; "colspan="1">{{$loop->iteration}}</td>
                <td style="text-align:center;" colspan="2">{{$item->name}}</td>
                <td style="text-align:left;" colspan="1"></td>
                <td style="text-align:left;" colspan="1"></td>
                <td style="text-align:left;" colspan="1"></td>
                <td style="text-align:left;" colspan="2"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
