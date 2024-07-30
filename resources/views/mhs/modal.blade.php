<!-- Modal Tambah Tesis -->
<div class="modal fade" id="tesisModal" tabindex="-1" aria-labelledby="tesisModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tesisModalLabel">Tambah Tesis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="tesisForm">
                    <input type="hidden" class="form-control" id="nim" name="nim" value="{{ Auth::user()->username }}">
                    <div id="paymentStatus" class="text-danger mt-2"></div> <!-- Menambahkan elemen untuk pesan pembayaran -->
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="abstrak">Abstrak</label>
                        <textarea class="form-control" id="abstrak" name="abstrak" required></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <button type="button" class="btn btn-warning" id="cekPlagiasiBtn">Cek Plagiasi</button>
                        <span id="plagiarismResult" class="ms-3"></span>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveChangesBtn" disabled>Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>