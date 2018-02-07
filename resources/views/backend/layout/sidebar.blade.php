<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      {{-- <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('bower_components/AdminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> --}}
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="{{url('/home')}}"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-cutlery"></i> <span>Manage Recipes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/recipes')}}">View All Recipes</a></li>
            <li><a href="{{url('/addrecipe')}}">Add New Recipe</a></li>
          </ul>
        </li>
        <li><a href="{{url('/categories')}}"><i class="fa fa-code-fork"></i> <span>Categories</span></a></li>
        {{-- <li class="treeview">
          <a href="#"><i class="fa fa-code-fork"></i> <span>Manage Categories</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/categories')}}">View All Categories</a></li>
            <li><a href="{{url('/addcategory')}}">Add New Category</a></li>
          </ul>
        </li> --}}
        <li><a href="{{url('/reservations')}}"><i class="fa fa-dot-circle-o"></i> <span>Reservations</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-flag"></i> <span>Manage Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/reports')}}">View Revenue Report</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-bell"></i> <span>Manage Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('orders')}}">View All Orders</a></li>
            <li><a href="{{url('/order')}}">Order</a></li>
          </ul>
        </li>
        <li><a href="{{url('/tables')}}"><i class="fa fa-dot-circle-o"></i> <span>Tables</span></a></li>
        <li><a href="{{url('policy-pricing')}}"><i class="fa fa-money" aria-hidden="true"></i><span>Pricing Policy</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
      
    </section>
    <!-- /.sidebar -->
  </aside>