<li class="nav-item active">
    <a data-bs-toggle="collapse" href="#bimbingan">
      <i class="fas fa-layer-group"></i>
      <p>Bimbingan</p>
      <span class="caret"></span>
    </a>
    <div class="collapse" id="bimbingan">
      <ul class="nav nav-collapse">
        <li class=" @if ($active == 'bimbingan') active @endif">
          <a href="{{ route('dosbim.bimbingan') }}">
            <span class="sub-item">Mahasiswa Bimbingan</span>
          </a>
        </li>
        <li class=" @if ($active == 'pengajuan') active @endif">
          <a href="{{ route('dosbim.pengajuan') }}">
            <span class="sub-item text-white">Pengajuan Bimbingan</span>
          </a>
        </li>
      </ul>
    </div>
  </li>