<li class="nav-item @if ($active == "dashboard") active @endif">
    <a href="{{ route('prodi.index') }}">
      <i class="fas fa-home"></i>
      <p class="text-white">Dashboard</p>
    </a>
  </li>

  <li class="nav-item @if ($active == "pengajuan-prodi" || $active == "bimbingan-langsung") active @endif">
    <a data-bs-toggle="collapse" href="#bimbingan">
      <i class="icon-people"></i>
      <p class="text-white">Bimbingan</p>
      <span class="caret"></span>
    </a>
    <div class="collapse" id="bimbingan">
      <ul class="nav nav-collapse">
        <li class="@if ($active == "pengajuan-prodi") active @endif">
          <a href="{{ route('prodi.pengajuan') }}">
            <span class="sub-item text-white">Pengajuan Pembimbing</span>
          </a>
        </li>
        <li class="@if ($active == "bimbingan-langsung") active @endif">
          <a href="{{ route('prodi.bimbingan') }}">
            <span class="sub-item text-white">Sedang Bimbingan</span>
          </a>
        </li>
      </ul>
    </div>
  </li>

  <li class="nav-item @if ($active == "waktu-ta") active @endif">
    <a href="{{ route('prodi.waktu-ta') }}">
      <i class="icon-hourglass"></i>
      <p class="text-white">Waktu TA</p>
    </a>
  </li>

  <li class="nav-item @if ($active == "kuota-pembimbing") active @endif">
    <a href="{{ route('prodi.kuota-pembimbing') }}">
      <i class="icon-calculator"></i>
      <p class="text-white">Kuota Pembimbing</p>
    </a>
  </li>

  <li class="nav-item @if ($active == "Dosen") active @endif">
    <a href="{{ route('prodi.dosen.index') }}">
      <i class="icon-user-following"></i>
      <p class="text-white">Dosen Pembimbing</p>
    </a>
  </li>