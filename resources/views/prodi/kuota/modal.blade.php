
<div class="modal fade" id="modalEditKuota" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kuota Pembimbing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('prodi.update-kuota-pembimbing') }}" method="POST"  id="formEditTA" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="text" id="id-edit-kouta" name="nip" style="display: none">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label for="sisa-kuota">Sisa Kuota</label>
                        <input type="number" id="sisa-kuota" name="sisaKuota" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>   
                </div>
            </form>
        </div>
    </div>
</div>