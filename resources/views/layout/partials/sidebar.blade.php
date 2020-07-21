<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      @if(auth()->user()->user_type == 2 || auth()->user()->user_type == 4 || 
          auth()->user()->user_type == 6 || auth()->user()->user_type == 8)
      <li>
        <a href="{!! URL::to('index') !!}">
          <i class="fa fa-fw fa-home"></i>
          <span>Dashboard</span>
        </a>
      </li>
      @endif
      @if(auth()->user()->user_type == 1 || auth()->user()->user_type == 2 || 
          auth()->user()->user_type == 3 || auth()->user()->user_type == 4)
      <li>
        <a href="{!! URL::to('order') !!}">
          <i class="fa fa-fw fa-archive"></i> 
          <span>Order History</span>
          <span class="pull-right-container"></span>
        </a>
      </li>
      @endif
      @if(auth()->user()->user_type == 1)
      <li>
        <a href="{!! URL::to('order/create') !!}">
          <i class="fa fa-fw fa-cart-plus "></i>
          <span>Add New Order</span>
        </a>
      </li>
      @endif
      @if(auth()->user()->user_type == 2 || auth()->user()->user_type == 3 || auth()->user()->user_type == 4)
      <li>
        <a href="{!! URL::to('customer') !!}">
          <i class="fa fa-fw fa-group"></i> 
          <span>Customers</span>
          <span class="pull-right-container"></span>
        </a>
      </li>
      @endif
      @if(auth()->user()->user_type == 2 || auth()->user()->user_type == 3 || auth()->user()->user_type == 4)
      <li>
        <a href="{!! URL::to('supplier') !!}">
          <i class="fa fa-fw fa-user-secret"></i> 
          <span>Suppliers</span>
          <span class="pull-right-container"></span>
        </a>
      </li>
      @endif
      @if(auth()->user()->user_type == 2 || auth()->user()->user_type == 3 || auth()->user()->user_type == 4)
      <li class="treeview">
        <a href="/">
          <i class="fa fa-fw fa-shopping-cart"></i> <span>Purchases</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{!! URL::to('requestOfPurchase') !!}"><i class="fa fa-fw fa-angle-double-right"></i> Request Of Purchase</a></li>
          <li><a href="{!! URL::to('purchaseOrder') !!}"><i class="fa fa-fw fa-angle-right"></i> Purchase Order</a></li>
        </ul>
      </li>
      @endif
      @if(auth()->user()->user_type == 2 || auth()->user()->user_type == 3 || 
          auth()->user()->user_type == 4 || auth()->user()->user_type == 7 ||
          auth()->user()->user_type == 8)
      <li class="treeview">
        <a href="/">
          <i class="fa fa-fw fa-building"></i> <span>Stocks</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="treeview">
            <a href="/">
              <i class="fa fa-fw fa-angle-right"></i> <span>Inventory</span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{!! URL::to('rawMaterial') !!}"><i class="fa fa-fw fa-angle-right"></i> Raw Materials</a></li>
              <li><a href="{!! URL::to('product') !!}"><i class="fa fa-fw fa-angle-right"></i> Products</a></li>
            </ul>
          </li>
          @if(auth()->user()->user_type == 2 || auth()->user()->user_type == 7 ||
          auth()->user()->user_type == 8)
          <li><a href="{!! URL::to('goodReceiveNote') !!}"><i class="fa fa-fw fa-angle-right"></i> Good Receive Note</a></li>
          {{-- <li><a href="/"><i class="fa fa-fw fa-angle-right"></i> Inventory Stocks</a></li> --}}
          <li><a href="{!! URL::to('inventoryStockTransaction') !!}"><i class="fa fa-fw fa-angle-right"></i> Transaction History</a></li>
          @endif
        </ul>
      </li>
      @endif
      @if(auth()->user()->user_type == 2 || auth()->user()->user_type == 3 || 
          auth()->user()->user_type == 4 || auth()->user()->user_type == 5 ||
          auth()->user()->user_type == 6)
      <li class="treeview">
        <a href="#">
          <i class="fa fa-fw fa-calculator"></i> <span>MRP</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @if(auth()->user()->user_type == 2 || auth()->user()->user_type == 5 ||
              auth()->user()->user_type == 6)
          <li class="treeview">
            <a href="/"><i class="fa fa-fw fa-angle-right"></i><span>Bill of Materials</span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{!! URL::to('project') !!}"><i class="fa fa-fw fa-angle-right"></i> BOM List</a></li>
              <li><a href="{!! URL::to('project/create') !!}"><i class="fa fa-fw fa-angle-right"></i> Create BOM</a></li>
            </ul>
          </li>
          @endif
          <li><a href="{!! URL::to('mrp') !!}"><i class="fa fa-fw fa-angle-right"></i> Master Production Schedule</a></li>
          {{-- @if(auth()->user()->user_type == 2)
          <li><a href="{!! URL::to('forecast') !!}"><i class="fa fa-fw fa-angle-right"></i>Forecasting</a></li>
          @endif --}}
        </ul>
      </li>
      @endif
      @if(auth()->user()->user_type == 2 || auth()->user()->user_type == 5 ||
      auth()->user()->user_type == 6)
      <li class="treeview">
        <a href="#">
          <i class="fa fa-fw fa-tasks"></i> <span>Production</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{!! URL::to('workOrder') !!}"><i class="fa fa-fw fa-angle-right"></i> Work Orders</a></li>
          <li><a href="{!! URL::to('finishGoodProduction') !!}"><i class="fa fa-fw fa-angle-right"></i> Finish Good Production</a></li>
        </ul>
      </li>
      @endif
      @if(auth()->user()->user_type == 2)
      <li class="header">Settings</li>
        <ul class="sidebar-menu" data-widget="tree">
          <li><a href="{!! URL::to('systemStatus') !!}">
              <i class="fa fa-fw fa-info-circle"></i>
              <span>System Statuses</span>
              </a>
          </li>
          <li><a href="{!! URL::to('uom') !!}">
            <i class="fa fa-fw fa-balance-scale"></i>
            <span>Unit of Measurement</span>
            </a>
          </li>
          <li><a href="{!! URL::to('moq') !!}">
            <i class="fa fa-fw fa-truck"></i>
            <span>Minimum Order Quantity</span>
            </a>
          </li>
          <li><a href="{{ route('process.index') }}">
              <i class="fa fa-fw fa-object-group"></i>
              <span>Processes</span>
              </a>
          </li>
          <li><a href="{{ route('user.index') }}">
            <i class="fa fa-fw fa-user"></i>
            <span>Users</span>
            </a>
        </li>
        </ul>
        @endif
  </section>
  <!-- /.sidebar -->
</aside>