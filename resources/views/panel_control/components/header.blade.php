<nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="nav-item d-flex align-items-center mr-2">
            <a href="{{ route('lang.switch', 'en') }}" class="btn btn-sm btn-outline-light mr-1 {{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
            <a href="{{ route('lang.switch', 'id') }}" class="btn btn-sm btn-outline-light {{ app()->getLocale() === 'id' ? 'active' : '' }}">ID</a>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">{{ __('messages.welcome', ['name' => 'Nabila']) }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">{{ __('messages.logged_in_short') }}</div>
              <div class="dropdown-divider"></div>
              <a href="{{ route('signout') }}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> {{ __('messages.logout') }}
              </a>
            </div>
          </li>
        </ul>
      </nav>