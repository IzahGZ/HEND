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
  #invoice{
    padding: 30px;
}

.invoice {
    position: relative;
    /* background-color: #FFF; */
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #000000
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0;
    font-size: 16px;
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0;
    font-size: 14px;
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6;
    font-size: 16px;
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 11px;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 12px
}

.invoice table {
    width: 100%;
    /* border-collapse: collapse; */
    /* border-spacing: 0; */
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    /* background: #eee; */
    /* border-bottom: 1px; */
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 12px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    /* color: #3989c6; */
    font-size: 12px
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 12px
}

.invoice table .no {
    /* color: #fff; */
    font-size: 11px;
    /* background: #3989c6 */
}

.invoice table .unit {
    /* background: #ddd */
}

.invoice table .total {
    /* background: #3989c6; */
    /* color: #fff */
}

.invoice table tbody tr:last-child td {
    /* border: 1px; */
}

.invoice table tfoot td {
    background: 0 0;
    /* border-bottom: none; */
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 12px;
    /* border-top: 1px solid #aaa */
}

.invoice table tfoot tr:first-child td {
    /* border-top: none */
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 12px;
    /* border-top: 1px solid #3989c6 */
}

.invoice table tfoot tr td:first-child {
    /* border: none */
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 12px!important;
        margin-left: 0px;
        padding-left: 0px;
        /* overflow: hidden!important */
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always;
    }

    /* .invoice>div:last-child {
        page-break-before: always
    } */

    /* .print:last-child {
     page-break-after: auto;
    } */

    .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
        float: left;
   }
   .col-sm-12 {
        width: 100%;
   }
   .col-sm-11 {
        width: 91.66666667%;
   }
   .col-sm-10 {
        width: 83.33333333%;
   }
   .col-sm-9 {
        width: 75%;
   }
   .col-sm-8 {
        width: 66.66666667%;
   }
   .col-sm-7 {
        width: 58.33333333%;
   }
   .col-sm-6 {
        width: 50%;
   }
   .col-sm-5 {
        width: 41.66666667%;
   }
   .col-sm-4 {
        width: 33.33333333%;
   }
   .col-sm-3 {
        width: 25%;
   }
   .col-sm-2 {
        width: 16.66666667%;
   }
   .col-sm-1 {
        width: 8.33333333%;
   }
}
</style>
<body>
<div class="wrapper">
  <!-- Main content -->
  <div id="invoice">
    <div class="invoice">
        <div style="min-width: 800px">
            <header>
                <div class="row" style="margin:0; padding:0;">
                    <div class="col-sm-2">
                    <img  src="{{asset('img/hend.png')}}" data-holder-rendered="true" style="height:60px; float: left;">
                    </div>
                    <div class="col-sm-10 company-details">
                        <div class="name text-left"><b>{{$company[0]->company_name}} </b></div>
                        <div class="text-left">{{$company[0]->address}}</div> 
                        <div class="text-left">Phone No: {{$company[0]->phone}}</div>
                        <div class="text-left">Fax: {{$company[0]->fax}}</div> 
                    </div>
                </div>
            </header>
            <main>
                <p style="font-size:17px"><b>Product Listing</b></p>
                <table>
                    <thead>
                        <tr>
                            <th style="border:1px solid black">#</th>
                            <th class="text-left" style="border:1px solid black">ITEM NAME</th>
                            <th class="text-left" style="border:1px solid black">CODE</th>
                            <th class="text-right" style="border:1px solid black">CURRENT STOCK</th>
                            <th class="text-right" style="border:1px solid black">UOM</th>
                            <th class="text-right" style="border:1px solid black">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $item)
                        <tr>
                        <td class="no"  style="border:1px solid black">{{$loop->iteration}}</td>
                            <td class="text-left" style="border:1px solid black">{{$item->name}}</td>
                            <td class="text-left" style="border:1px solid black">{{$item->code}}</td>
                            <td class="qty" style="border:1px solid black">{{$item->current_stock}}</td>
                            <td class="qty" style="border:1px solid black">{{$item->uoms->code}}</td>
                            <td class="total" style="border:1px solid black">
                                @if($item->current_stock > $item->safety_stock)
                                    <span class="label label-success">In Stock</span></td>
                                @else 
                                    <span class="label label-danger">Critical</span></td>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <?php $delivery_fee = 0;?>
                </table>
            </table>
            </main>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
