<div class="sidebar bg-sidebar">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="text-dark py-5 px-3 ">
          <a
            class="dropdown-toggle profile-pic text-center d-flex flex-column align-items-center justify-content-center"
            data-bs-toggle="dropdown"
            href="#"
            aria-expanded="false"
          >
            <div class="avatar-sm">
              <img
                src="{{ asset('assets/img/default-profile.jpg') }}"
                alt="..."
                class="avatar-img rounded-circle"
              />
            </div>
            <span class="profile-username text-dark d-flex flex-column">
              <span class="">{{ auth()->user()->username }}</span> 
              @if(auth()->user()->role == 3 && auth()->user()->dosen)
                 <span class="fw-bold">{{ auth()->user()->dosen->nama }}</span>
              @elseif(auth()->user()->role == 4 && auth()->user()->mahasiswa)
                <span class="fw-bold">{{ auth()->user()->mahasiswa->nama }}</span>
              @endif
            </span>
          </a>
          <ul class="dropdown-menu dropdown-user animated fadeIn w-25">
            <div class="dropdown-user-scroll scrollbar-outer">
              <li>
                <a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="icon-power mr-4"></i> Logout</a>
              </li>
            </div>
          </ul>
      </div>
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