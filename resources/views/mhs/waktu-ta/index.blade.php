@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h2>Pengajuan TA</h2>
            <div class="card">
                <div class="card-body">
                    <h3>List Sidang TA</h3>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered dt-responsive" id="datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori TA</th>
                                    <th>Tanggal Sidang</th>
                                    <th>Nama File</th>
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
@include('prodi.waktu-ta.modal')
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
                { data: 'kategori_sidang', name: 'kategori_sidang' },
                { data: 'tanggal_sidang', name: 'tanggal_sidang' },
                { data: 'nama_file', name: 'nama_file' },
                { data: 'status', name: 'status' },
            ],
            language: {
                emptyTable: "Tidak ada data yang tersedia"
            }
        });

        // Event listener untuk tombol Ajukan
        $(document).on('click', '.btn-modal', function() {
            var kategori = $(this).data('id');
            $('#kategori').val(kategori);
            $('#accModal').modal('show');
        });

        $('#FormModal').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('mhs.ta.createPengajuan') }}",
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
