<div class="sidebar bg-sidebar">
    <div class="sidebar-wrapper scrollbar scrollbar-inner bg-sidebar">
      <div class="text-dark text-center py-5 px-3 ">
        <a class="dropdown-item btn py-2 btn-danger" href="{{ route('logout') }}"><i class="icon-power mr-4"></i> Logout</a>
         
      </div>
    
      <div class="sidebar-content">
        <ul class="nav nav-secondary text-dark">
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