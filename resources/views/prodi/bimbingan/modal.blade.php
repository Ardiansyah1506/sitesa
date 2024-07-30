<div class="modal fade" id="modalEditBimbingan" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pembimbing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('prodi.update-bimbingan') }}" method="POST" id="formEditBimbingan">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="id-edit-mhs" name="nim">
                    <div class="form-group">
                        <label for="nama-mahasiswa">Nama Mahasiswa</label>
                        <input type="text" id="nama-mahasiswa" class="form-control" name="nama" readonly>
                    </div>
                    <div class="form-group">
                        <label for="pembimbing-1">Pembimbing Pertama</label>
                        <select class="form-select mb-2" aria-label="Pembimbing 1" id="pembimbing-1" name="pembimbing1">
                            @foreach ($pembimbing as $bimbing)
                            <option value="{{ $bimbing->nip }}">{{ $bimbing->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pembimbing-2">Pembimbing Kedua</label>
                        <select class="form-select mb-2" aria-label="Pembimbing 1" id="pembimbing-2" name="pembimbing2">
                            @foreach ($pembimbing as $bimbing)
                            <option value="{{ $bimbing->nip }}">{{ $bimbing->nama }}</option>
                            @endforeach
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
