<li class="nav-item @if($active == 'admin-dashboard') active @endif">
  <a href="{{ route('admin.index') }}">
    <i class="fas fa-home text-dark"></i>
    <p>Dashboard</p>
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
    href="#mhs"
    class="collapsed"
    aria-expanded="false"
  >
    <i class="fas fa-user-tie"></i>
    <p>Mahasiswa</p>
    <span class="caret"></span>
  </a>
  <div class="collapse" id="mhs">
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
<li class="nav-item @if($active == 'Dosen Pembimbing') active @endif">
  <a
    data-bs-toggle="collapse"
    href="#dosen"
    class="collapsed"
    aria-expanded="false"
  >
    <i class="fas fa-user-tie"></i>
    <p>Dosen Pembimbing</p>
    <span class="caret"></span>
  </a>
  <div class="collapse dosen" id="dosen">
    <ul class="nav nav-collapse">
      <li class="nav-item @if($active == 'Dosen Pembimbing') active @endif">
        <a href="{{ route('admin.mahasiswa') }}">
          <i class="icon-arrow-up-circle"></i>
          <p>Pengajuan Dosen</p>
        </a>
      </li>
      <li class="nav-item @if($active == 'Dosen Pembimbing') active @endif">
        <a href="{{ route('admin.dosen.index') }}">
          <i class="icon-people"></i>
          <p>List Dosen</p>
        </a>
      </li>
    </ul>
  </div>
</li>
