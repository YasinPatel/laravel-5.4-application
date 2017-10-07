<header class="main-header">
  <a href="{{ route('admin_home')}}" class="logo">
    <span class="logo-mini"><b>L</b>C</span>
    <span class="logo-lg">{{ config('params.appTitle') }}</span>
  </a>
  <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ asset('img/logo.png') }}" class="user-image" alt="User Image">
            <span class="hidden-xs">Yasin Patel</span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
              <img src="{{ asset('img/logo.png') }}" class="img-circle" alt="User Image">
              <p>
              Yasin Patel
              </p>
            </li>

            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="{{ URL::to('admin/logout')}}" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
