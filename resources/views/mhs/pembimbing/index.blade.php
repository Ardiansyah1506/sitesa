@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h2>Pengajuan Dosen Pembimbing</h2>
            <div class="card">
                <div class="card-body">
                    <h3>List Dosen Pembimbing</h3>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered dt-responsive" id="datatable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Sisa Kuota</th>
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
@endsection

@section('js-custom')
<script>
    $(document).ready(function() {
        // Load table data
         $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('mhs.pembimbing.getDataPembimbing') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'nip', name: 'nip' },
                { data: 'nama', name: 'nama' },
                { data: 'sisa_kuota', name: 'sisa_kuota' },
                { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
            ],
            language: {
                emptyTable: "Tidak ada data pembimbing yang tersedia"
            }
        });

        // Handle button click for Ajukan
        // $(document).on('click', '.acc-button', function() {
        //     var id = $(this).data('id');
        //     // Implementasi aksi untuk ajukan, misalnya dengan AJAX request
        //     $.ajax({
        //         url: '/ajukan', // Ganti dengan URL yang sesuai
        //         method: 'POST',
        //         data: {
        //             id: id,
        //             _token: '{{ csrf_token() }}'
        //         },
        //         success: function(response) {
        //             if (response.success) {
        //                 alert('Pengajuan berhasil');
        //                 $('#datatable').DataTable().ajax.reload();
        //             } else {
        //                 alert('Pengajuan gagal');
        //             }
        //         },
        //         error: function(response) {
        //             alert('Terjadi kesalahan');
        //         }
        //     });
        // });
    });
</script>
@endsection
