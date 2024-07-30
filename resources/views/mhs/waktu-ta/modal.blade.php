<div class="modal fade" id="modalEditTA" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Waktu TA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('prodi.update-waktu-ta') }}" method="POST"  id="formEditTA" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="id-edit-ta" name="id">
                    <div class="form-group">
                        <label for="tanggal-mulai">Tanggal Mulai</label>
                        <input type="date" id="tanggal-mulai" name="tanggalMulai" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tanggal-akhir">Tanggal Akhir</label>
                        <input type="date" id="tanggal-akhir" name="tanggalAkhir" class="form-control">
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