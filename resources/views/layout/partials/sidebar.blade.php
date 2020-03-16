<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li>
        <a href="{!! URL::to('index') !!}">
          <i class="fa fa-fw fa-home"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="{!! URL::to('order') !!}">
          <i class="fa fa-fw fa-cart-plus"></i> 
          <span>Orders</span>
          <span class="pull-right-container"></span>
        </a>
      </li>
      <li>
        <a href="{!! URL::to('customer') !!}">
          <i class="fa fa-fw fa-group"></i> 
          <span>Customers</span>
          <span class="pull-right-container"></span>
        </a>
      </li>
      <li>
        <a href="{!! URL::to('supplier') !!}">
          <i class="fa fa-fw fa-user-secret"></i> 
          <span>Suppliers</span>
          <span class="pull-right-container"></span>
        </a>
      </li>
      <li class="treeview">
        <a href="/">
          <i class="fa fa-fw fa-server"></i> <span>Inventory</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{!! URL::to('rawMaterial') !!}"><i class="fa fa-fw fa-angle-right"></i> Raw Materials</a></li>
          <li><a href="{!! URL::to('product') !!}"><i class="fa fa-fw fa-angle-right"></i> Products</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="/">
          <i class="fa fa-fw fa-object-group"></i> <span>Bill of Materials</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{!! URL::to('bom') !!}"><i class="fa fa-fw fa-angle-right"></i> BOM List</a></li>
          <li><a href="{!! URL::to('project') !!}"><i class="fa fa-fw fa-angle-right"></i> Project</a></li>
        </ul>
      </li>
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
      <li class="treeview">
        <a href="/">
          <i class="fa fa-fw fa-building"></i> <span>Stocks</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          
        </a>
        <ul class="treeview-menu">
          <li><a href="{!! URL::to('goodReceiveNote') !!}"><i class="fa fa-fw fa-angle-right"></i> Good Receive Note</a></li>
          {{-- <li><a href="/"><i class="fa fa-fw fa-angle-right"></i> Inventory Stocks</a></li> --}}
          <li><a href="{!! URL::to('inventoryStockTransaction') !!}"><i class="fa fa-fw fa-angle-right"></i> Transaction History</a></li>
        </ul>
      </li>
      <li class="treeview">
          <a href="#">
            <i class="fa fa-fw fa-calculator"></i> <span>MRP</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{!! URL::to('mrp') !!}"><i class="fa fa-fw fa-angle-right"></i> Master Production Schedule</a></li>
            {{-- <li><a href="/"><i class="fa fa-fw fa-angle-right"></i> MRP</a></li> --}}
          </ul>
        </li>
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
              <span>Process</span>
              </a>
          </li>
        </ul>
  </section>
  <!-- /.sidebar -->
</aside>