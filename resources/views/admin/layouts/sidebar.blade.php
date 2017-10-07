<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>

      <li class="treeview">
        <a href="{{ route('admin_home') }}">
          <i class="fa fa-home"></i><span>Dashboard</span>
        </a>
      </li>
      <li class="treeview">
        <a href="{{ URL::to('admin/user') }}">
          <i class="fa fa-users"></i><span>Users</span>
        </a>
      </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
