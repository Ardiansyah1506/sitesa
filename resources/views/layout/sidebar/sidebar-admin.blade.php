<li class="nav-item @if($active == 'admin-dashboard') active @endif">
  <a href="{{ route('admin.index') }}">
    <i class="fas fa-home"></i>
    <p>Dashboard admin</p>
  </a>
</li>
<li class="nav-item @if($active == 'admin-user') active @endif">
  <a href="{{ route('admin.user.index') }}">
    <i class="icon-user"></i>
    <p>User</p>
  </a>
</li>
<li class="nav-item @if($active == 'admin-tesis') active @endif">
  <a href="{{ route('admin.tesis.index') }}">
    <i class="icon-envelope"></i>
    <p>Tesis</p>
  </a>
</li>
<li class="nav-item @if($active == 'admin-ta') active @endif">
  <a href="{{ route('admin.ta.index') }}">
    <i class="icon-book-open"></i>
    <p>Tugas Akhir</p>
  </a>
</li>
<li class="nav-item @if($active == 'admin-mahasiswa' || $active == 'admin-pengajuan') active @endif">
  <a
    data-bs-toggle="collapse"
    href="#dashboard"
    class="collapsed"
    aria-expanded="false"
  >
    <i class="fas fa-user-tie"></i>
    <p>Mahasiswa</p>
    <span class="caret"></span>
  </a>
  <div class="collapse" id="dashboard">
    <ul class="nav nav-collapse">
      <li class="nav-item @if($active == 'admin-mahasiswa') active @endif">
        <a href="{{ route('admin.mahasiswa') }}">
          <i class="icon-people"></i>
          <p>Daftar Mahasiswa</p>
        </a>
      </li>
      <li class="nav-item @if($active == 'admin-pengajuan') active @endif">
        <a href="{{ route('admin.pengajuan') }}">
          <i class="icon-arrow-up-circle"></i>
          <p>Pengajuan Bimbingan</p>
        </a>
      </li>
    </ul>
  </div>
</li>