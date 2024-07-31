@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3>Pengajuan Dosen Pembimbing</h3>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered dt-responsive table-striped" id="datatable">
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
    
    // Check pengajuan
    $.ajax({
        url: "{{ route('mhs.pembimbing.cekPengajuan') }}",
        method: 'get',
        success: function(response) {
            console.log(response);
            if (response >= 2) {
                $('.acc-button').prop('disabled', true);
                $('#datatable tbody').append('<tr><td colspan="5">Anda sudah mengajukan 2 dosen pembimbing. Silakan hubungi admin.</td></tr>');
            }
        },
        error: function(response) {
            alert('Terjadi kesalahan');
        }
    });

    // Handle button click for Ajukan
    $(document).on('click', '.acc-button', function() {
        var nip = $(this).data('nip');
        console.log('NIP:', nip);  // Debugging: Log the NIP to the console

        // Implementasi aksi untuk ajukan, misalnya dengan AJAX request
        $.ajax({
            url: "{{ route('mhs.pembimbing.PengajuanBimbingan') }}",
            method: 'POST',
            data: {
                nip: nip,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    alert('Pengajuan berhasil');
                    $('#datatable').DataTable().ajax.reload();
                } else {
                    alert('Pengajuan gagal: ' + response.error);
                }
            },
            error: function(response) {
                alert('Terjadi kesalahan');
                console.err(response)
            }
        });
    });
});
</script>
@endsection
