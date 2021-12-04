@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{asset('/home')}}" class="brand-link">
      <img src="{{asset('/BackEnd')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Food Order</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('/BackEnd')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview {{($prefix=='/category')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Category
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('show_category')}}" class="nav-link {{($route=='show_category')?'active':''}}">
                  <i class="fa fa-plus-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('manage_category')}}" class="nav-link {{($route=='manage_category')?'active':''}}">
                  <i class="far fa-edit nav-icon"></i>
                  <p>Manage Category</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview {{($prefix=='/delivery')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-truck"></i>
              <p>
                Delivery
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('show_delivery')}}" class="nav-link {{($route=='show_delivery')?'active':''}}">
                  <i class="fa fa-plus-circle nav-icon"></i>
                  <p>Add Delivery</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('manage_delivery')}}" class="nav-link {{($route=='manage_delivery')?'active':''}}">
                  <i class="far fa-edit nav-icon"></i>
                  <p>Manage Delivery</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview {{($prefix=='/coupon')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Coupon
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('show_coupon')}}" class="nav-link {{($route=='show_coupon')?'active':''}}">
                  <i class="fa fa-plus-circle nav-icon"></i>
                  <p>Add Coupon</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('manage_coupon')}}" class="nav-link {{($route=='manage_coupon')?'active':''}}">
                  <i class="far fa-edit nav-icon"></i>
                  <p>Manage Coupon</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview {{($prefix=='/dish')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-satellite-dish"></i>
              <p>
                Dish
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('show_dish')}}" class="nav-link {{($route=='show_dish')?'active':''}}">
                  <i class="fa fa-plus-circle nav-icon"></i>
                  <p>Generate Dish</p>
                </a>
              </li>
              <li class="nav-item">
                <a href= "{{route('manage_dish')}}" class="nav-link {{($route=='manage_dish')?'active':''}}">
                  <i class="fa fa-edit nav-icon"></i>
                  <p>Manage Dish</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview {{($prefix=='/order')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fab fa-jedi-order"></i>
              <p>
                Order
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('show_order')}}" class="nav-link {{($route=='show_order')?'active':''}}">
                  <i class="fa fa-edit nav-icon"></i>
                  <p>Manage Order</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>