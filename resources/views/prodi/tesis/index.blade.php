@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>Verifikasi Tesis</h2>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table class="table table-bordered dt-responsive" id="datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Judul</th>
                                <th>Verifikasi</th>
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
@endsection

@section('js-custom')
<script>
$(document).ready(function() {
    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('prodi.verif-tesis.getData') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'nama', name: 'nama' },
            { data: 'nim', name: 'nim' },
            { data: 'judul', name: 'judul' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        language: {
            emptyTable: "Tidak ada data yang tersedia"
        }
    });

    // Handle ACC Tesis button click
    $('#datatable').on('click', '.acc-tesis', function() {
        var id = $(this).data('id');
        if (confirm('Apakah Anda yakin ingin meng-ACC tesis ini?')) {
            $.ajax({
                url: "{{ route('prodi.verif-tesis.acc', '') }}/" + id,
                method: 'PUT',
                data: { _token: '{{ csrf_token() }}' },
                success: function(response) {
                    alert(response.success);
                    table.ajax.reload();
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        }
    });
});
</script>
@endsection
