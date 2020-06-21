<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
      <br />
      <div class="center"><img src="/authenticate/images/logo.png"></div>
      <br />
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/home" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="/search" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Search
              </p>
            </a>
        </li>
        <li class="nav-header">Account</li>
        <li class="nav-item">
            <a href="{{ url('/logout') }}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
            </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
        </ul>
      </nav>
    </div>
  </aside>