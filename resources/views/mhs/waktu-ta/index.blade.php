@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>Pengajuan TA</h2>
        <div class="card">
           
            <div class="card-body">
                <h3>List Sidang TA</h3>
                <button class="btn btn-primary tambah-ta" {{ !$canSubmitTA ? 'disabled' : '' }}>Tambah TA</button>
                @if(!$canSubmitTA)
                    <div class="alert alert-warning mt-3">{{ $message }}</div>
                @endif
                <div class="table-responsive mt-3">
                    <table class="table table-bordered dt-responsive" id="datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nim</th>
                                <th>Judul</th>
                                <th>File</th>
                                <th>Tanggal Daftar</th>
                                <th>Tanggal Sidang</th>
                                <th>Penguji 1</th>
                                <th>Penguji 2</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pilih Kategori TA -->
<div class="modal fade" id="kategoriTAModal" tabindex="-1" aria-labelledby="kategoriTAModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kategoriTAModalLabel">Pilih Kategori TA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formKategoriTA" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori TA</label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="1">Sidang Proposal</option>
                            <option value="2">Sidang Tesis</option>
                        </select>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-custom')
<script>
$(document).ready(function() {
    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('mhs.ta.getData') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'nama', name: 'nama' },
            { data: 'nim', name: 'nim' },
            { data: 'judul', name: 'judul' },
            { data: 'file', name: 'file' },
            { data: 'tanggal_daftar', name: 'tanggal_daftar' },
            { data: 'tanggal_sidang', name: 'tanggal_sidang' },
            { data: 'penguji_1', name: 'penguji_1' },
            { data: 'penguji_2', name: 'penguji_2' },
            { data: 'status', name: 'status' }
        ],
        language: {
            emptyTable: "Tidak ada data yang tersedia"
        }
    });

    // Tampilkan modal untuk memilih kategori TA
    $('.tambah-ta').on('click', function() {
        $('#kategoriTAModal').modal('show');
    });

    // Form submit untuk memilih kategori TA
    $('#formKategoriTA').on('submit', function(e) {
    e.preventDefault();

    var formData = new FormData(this); // Gunakan FormData

    $.ajax({
        url: "{{ route('mhs.ta.createPengajuan') }}",
        method: 'POST',
        data: formData,
        processData: false, // Jangan proses data
        contentType: false, // Jangan tentukan tipe konten
        success: function(response) {
            if (response.message) {
                $('#kategoriTAModal').modal('hide');
                table.ajax.reload();

                // Tampilkan SweetAlert untuk pesan sukses
                swal({
                    text: response.message,
                    icon: "success",
                    buttons: {
                        confirm: {
                            text: "OK",
                            value: true,
                            visible: true,
                            className: "btn btn-success",
                            closeModal: true,
                        },
                    },
                });
            } else {
                alert(response.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Terjadi kesalahan. Silakan coba lagi.');
        }
    });
});

});
</script>
@endsection
