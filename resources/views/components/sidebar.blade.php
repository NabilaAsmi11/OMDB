<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ url('/') }}">OMDB nabilaa</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ url('/') }}">OZ</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">PAGES</li>
      <li class="dropdown @yield('movies-menu-active')">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-film"></i><span>Movies</span></a>
        <ul class="dropdown-menu">
          <li class="@yield('dashboard-active')"><a class="nav-link" href="{{ url('/dashboard') }}">Search Movies</a></li>
          <li class="@yield('my-active')"><a class="nav-link" href="{{ url('/my') }}">My Favorites</a></li>
        </ul>
      </li>
    </ul>
  </aside>
</div>