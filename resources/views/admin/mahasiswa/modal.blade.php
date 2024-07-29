
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