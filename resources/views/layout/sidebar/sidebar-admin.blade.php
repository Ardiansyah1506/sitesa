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