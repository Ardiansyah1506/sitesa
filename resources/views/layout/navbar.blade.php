<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
    <div class="container-fluid">
      <nav
        class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
      >
        <img src="{{ asset('assets/img/logo-program-pascasarjana.png') }}" alt="" height="50">
      </nav>

      <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
        <li
          class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none"
        >
          <a
            class="nav-link dropdown-toggle"
            data-bs-toggle="dropdown"
            href="#"
            role="button"
            aria-expanded="false"
            aria-haspopup="true"
          >
            <i class="fa fa-search"></i>
          </a>
          <ul class="dropdown-menu dropdown-search animated fadeIn">
            <form class="navbar-left navbar-form nav-search">
              <div class="input-group">
                <input
                  type="text"
                  placeholder="Search ..."
                  class="form-control"
                />
              </div>
            </form>
          </ul>
        </li>

        <li class="nav-item topbar-user dropdown hidden-caret">
          <a
            class="dropdown-toggle profile-pic"
            data-bs-toggle="dropdown"
            href="#"
            aria-expanded="false"
          >
            <div class="avatar-sm">
              <img
                src="{{ asset('assets/img/profile.jpg') }}"
                alt="..."
                class="avatar-img rounded-circle"
              />
            </div>
            <span class="profile-username">
              <span class="">{{ auth()->user()->username }}</span> 
              @if(auth()->user()->role == 3 && auth()->user()->dosen)
                | <span class="fw-bold">{{ auth()->user()->dosen->nama }}</span>
              @elseif(auth()->user()->role == 4 && auth()->user()->mahasiswa)
                | <span class="fw-bold">{{ auth()->user()->mahasiswa->nama }}</span>
              @endif
            </span>
          </a>
          <ul class="dropdown-menu dropdown-user animated fadeIn">
            <div class="dropdown-user-scroll scrollbar-outer">
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}"><i class="icon-power mr-4"></i> Logout</a>
              </li>
            </div>
          </ul>
        </li>
      </ul>
    </div>
  </nav>