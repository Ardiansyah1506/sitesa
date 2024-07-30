<!DOCTYPE html>
<html lang="en">
  @include('layout.header')
  
  @yield('css-library')
  @yield('css-custom')
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      @include('layout.sidebar')
      <!-- End Sidebar -->

      <div class="main-panel bg-main">
        <div class="main-header">
          <div class="main-header-logo">
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
          <!-- Navbar Header -->
          @include('layout.navbar')
          <!-- End Navbar -->
        </div>

        <div class="container">
          <div class="page-inner">
            @yield('content')
          </div>
        </div>

        @include('layout.footer')
      </div>

    </div>
    <script>
      let baseUrl = '{{ url('') }}/'
    </script>
    @include('layout.js-library')
    @yield('js-library')
    @yield('js-custom')
  </body>
</html>
