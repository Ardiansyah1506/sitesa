@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3>List Dosen</h3>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-striped dt-responsive" id="datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nip</th>
                                    <th>Nama Dosen</th>
                                    <th>Aksi</th>
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

    <!-- Modal -->
    <div class="modal fade" id="accModal" tabindex="-1" role="dialog" aria-labelledby="accModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accModalLabel">Atur Pembimbing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="FormModal" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kuota">Kapasitas / Kuota pembimbing</label>
                            <input type="text" id="kuota" name="kuota" class="form-control" required>
                            <input type="hidden" id="nip" name="nip">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
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
        ajax: "{{ route('prodi.dosen.getDataKuota') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'nip', name: 'nip' },
            { data: 'nama', name: 'nama' },
            { data: 'actions', name: 'actions' },
        ],
        language: {
            emptyTable: "Tidak ada data yang tersedia"
        }
    });

    // Event delegation untuk tombol dengan kelas .edit-mhs
    $('#datatable').on('click', '.edit-mhs', function() { // pastikan menggunakan titik (.) untuk kelas
        var nip = $(this).data('id');
        $('#nip').val(nip);
        $('#accModal').modal('show');
    });

    $('#FormModal').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "{{ route('prodi.dosen.updateKuotaPembimbing') }}",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.message) {
                    $('#accModal').modal('hide');
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
