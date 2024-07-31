
<div class="modal fade" id="modalEditMhs" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.update-mhs') }}" method="POST"  id="formEditMhs" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="text" id="id-edit-mhs" name="nim" style="display: none">
                    <div class="form-group">
                        <label for="jumlah-sks">Jumlah SKS</label>
                        <input type="number" id="jumlah-sks" name="jumlahSks" class="form-control">
                    </div>
                    <div class="form-group">
                        <select class="form-select mb-2" aria-label="status pembayaran" id="status-pembayaran" name="statusPembayaran">
                            <option selected disabled>status pembayaran</option>
                            <option value="0">Belum Lunas</option>
                            <option value="1">Lunas</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>   
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal Tambah Mahasiswa -->
<div class="modal fade" id="modalTambahMhs" tabindex="-1" aria-labelledby="modalTambahMhsLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahMhsLabel">Tambah Mahasiswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formTambahMhs">
            @csrf
            <div class="mb-3">
              <label for="nim" class="form-label">NIM</label>
              <input type="text" class="form-control" id="nim" name="nim" required>
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
              <label for="jk" class="form-label">Jenis Kelamin</label>
              <select name="jk" id="jk" class="form-control">
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
</div>
