<li class="nav-item  @if ($active == 'home-mhs') active @endif">
    <a href="{{ route('mhs.index') }}">
      <i class="fas fa-home"></i>
      <p>Dashboard</p>
    </a>
</li>
<li class="nav-item @if ($active == 'pembimbing-mhs') active @endif">
    <a href="{{ route('mhs.pembimbing.index') }}">
      <i class="icon-people"></i>
      <p>Pengajuan Pembimbing</p>
    </a>
</li>
<li class="nav-item @if ($active == 'bimbingan-mhs') active @endif">
    <a href="{{ route('mhs.bimbingan.index') }}">
      <i class="icon-user-following"></i>
      <p>Bimbingan</p>
    </a>
</li>