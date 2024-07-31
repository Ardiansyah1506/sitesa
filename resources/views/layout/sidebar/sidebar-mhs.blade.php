<li class="nav-item  @if ($active == 'home-mhs') active @endif">
    <a href="{{ route('mhs.index') }}">
      <i class="fas fa-home"></i>
      <p class="text-white">Dashboard</p>
    </a>
</li>
<li class="nav-item @if ($active == 'pembimbing-mhs') active @endif">
    <a href="{{ route('mhs.pembimbing.index') }}">
      <i class="icon-people"></i>
      <p class="text-white">Pengajuan Pembimbing</p>
    </a>
</li>
<li class="nav-item @if ($active == 'bimbingan-mhs') active @endif">
    <a href="{{ route('mhs.bimbingan.index') }}">
      <i class="icon-user-following"></i>
      <p class="text-white">Bimbingan</p>
    </a>
</li>