@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h2>Dosen</h2>
            <div class="card">
                <div class="card-body">
                    <h3>List Dosen</h3>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered dt-responsive" id="datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nip</th>
                                    <th>Nama Dosen</th>
                                    <th>Kuota</th>
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

@endsection

@section('js-custom')
<script>
  $(document).ready(function() {
    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('prodi.kuota.getDataKuota') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'nip', name: 'nip' },
            { data: 'nama', name: 'nama' },
            { data: 'sisa_kuota', name: 'sisa_kuota' },
            { data: 'status', name: 'status' },
        ],
        language: {
            emptyTable: "Tidak ada data yang tersedia"
        }
    });

});

</script>
@endsection
