@extends('layout.main')


@section('content')
<div class="page-header">
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Pengajuan Bimbingan Mahasiswa</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table
              id="dataTables1"
              class="display table table-striped table-hover"
            >
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
@endsection

{{-- tempat js custom --}}
@section('js-custom')
<script>
    $(document).ready(function () {
        $("#dataTables1").DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: baseUrl + '{{ $url }}' + 'get-data',
                type: 'GET',
                dataSrc: function (json) {
                    return json.data;
                },
                error: function (xhr, error, thrown) {
                    console.error("Failed to retrieve data:", xhr.responseText);
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nip', name: 'nip'},
                {data: 'nama', name: 'nama'},
                {data: 'actions', name: 'actions'},
            ]
        });
    });

    $(document).on('submit', '#accBimbingan', function(event) {
    event.preventDefault(); 

    if (confirm('Acc Pengajuan mahasiswa?')) {
        $(this)[0].submit();
    } else {
        alert('Batal Acc Mahasiswa');
    }
  });
</script>

@endsection