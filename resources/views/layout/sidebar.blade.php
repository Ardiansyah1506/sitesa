<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="#" class="logo">
          <img
            src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}"
            alt="navbar brand"
            class="navbar-brand"
            height="20"
          />
        </a>
        <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar">
            <i class="gg-menu-right"></i>
          </button>
          <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left"></i>
          </button>
        </div>
        <button class="topbar-toggler more">
          <i class="gg-more-vertical-alt"></i>
        </button>
      </div>
      <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        <ul class="nav nav-secondary">
            @if (auth()->user()->role == 1)
              @include('layout.sidebar.sidebar-admin')
            @elseif (auth()->user()->role == 2)
              @include('layout.sidebar.sidebar-prodi')
            @elseif (auth()->user()->role == 3)
              @include('layout.sidebar.sidebar-dosbim')
            @elseif (auth()->user()->role == 4)
              @include('layout.sidebar.sidebar-mhs')
            @endif
        </ul>
      </div>
    </div>
  </div>