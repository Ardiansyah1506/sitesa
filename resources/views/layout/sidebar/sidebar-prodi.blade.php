<li class="nav-item">
    <a href="#">
      <i class="fas fa-home"></i>
      <p>Dashboard</p>
    </a>
  </li>

  <li class="nav-item">
    <a data-bs-toggle="collapse" href="#bimbingan">
      <i class="fas fa-layer-group"></i>
      <p>Bimbingan</p>
      <span class="caret"></span>
    </a>
    <div class="collapse" id="bimbingan">
      <ul class="nav nav-collapse">
        <li>
          <a href="{{ route('prodi.pengajuan') }}">
            <span class="sub-item">Pengajuan Pembimbing</span>
          </a>
        </li>
      </ul>
    </div>
  </li>