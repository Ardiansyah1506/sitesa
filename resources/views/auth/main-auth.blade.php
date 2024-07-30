<!DOCTYPE html>
<html lang="en">
  @include('layout.header')
  
  @yield('css-library')
  @yield('css-custom')
  <body>
    <div class="wrapper d-flex justify-content-center align-items-center bg-cuy">
        <div class="container">
          <div class="page-inner">
            @yield('content')
          </div>
        </div>
    </div>
    @yield('js-library')
    @yield('js-custom')
  </body>
</html>
