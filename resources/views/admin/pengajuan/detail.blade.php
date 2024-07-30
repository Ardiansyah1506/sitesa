@extends('layout.main')

@section('content')
<div class="page-header">
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Pengajuan Bimbingan | {{ $namaDosen }}</h4>
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
                  <th>Nim</th>
                  <th>Nama Mahasiswa</th>
                  <th>No Hp</th>
                  <th>Judul</th>
                  <th>Abstrak</th>
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
    let nip = '{{ $nip }}';
    let urlDeclaration = baseUrl + '{{ $url }}' + 'get-data-detail/' + nip;
    $.ajax({
                url: urlDeclaration,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                  console.log("respon ",response)
                    // Inisialisasi DataTable dengan data yang diterima dari server
                    var table = $("#dataTables1").DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: urlDeclaration,

                        },
                        columns: [
                          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                          {data: 'nim', name: 'nim'},
                          {data: 'nama', name: 'nama'},
                          {data: 'no_hp', name: 'no_hp'},
                          {data: 'judul', name: 'judul'},
                          {data: 'abstrak', name: 'abstrak'},
                          {data: 'actions', name: 'actions', orderable: false, searchable: false},
                        ],
                    });
                },
                error: function(err) {
                    console.error('Error:', err);
                }
            });
  });


    $(document).on('submit', '#accBimbingan', function(event) {
    event.preventDefault(); // Prevent default form submission

    // JavaScript confirm dialog
    if (confirm('Acc Pengajuan mahasiswa?')) {
        // If user confirms, submit the form
        $(this)[0].submit();
    } else {
        // If user cancels, show an alert
        alert('Batal Acc Mahasiswa');
    }
});
</script>

@endsection