@extends('layout.main')

@section('content')
<div class="page-header">
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Mahasiswa Sedang Bimbingan</h4>
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
                  <th>TA 1</th>
                  <th>TA 2</th>
                  <th>Nama Pembimbing</th>
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
@include('prodi.bimbingan.modal')
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
                {data: 'nim', name: 'nim'},
                {data: 'nama', name: 'nama'},
                {data: 'ta_1', name: 'ta_1'},
                {data: 'ta_2', name: 'ta_2'},
                {data: 'nama_pembimbing', name: 'nama_pembimbing'},
                {data: 'actions', name: 'actions'},
            ]
        });
});
$('#dataTables1').on('click', '.ubah-bimbingan', function() {
    $('#modalEditBimbingan').modal('show'); // Use Bootstrap modal method

    let dataNim = $(this).data('id');
    console.log('clicked', dataNim);

    // Buat URL secara dinamis
    let url = "{{ route('prodi.ubah-bimbingan', ':dataNim') }}";
    url = url.replace(':dataNim', dataNim);

    $.ajax({
        url: url,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            let isi = response.data;
            if (isi.length > 0) {
                // Set the nim and name value only once
                $('#id-edit-mhs').val(isi[0].nim);
                $('#nama-mahasiswa').val(isi[0].nama);
            }
            isi.forEach((element, index) => {
              console.log('#pembimbing-' + (index + 1))
                $('#pembimbing-' + (index + 1)).val(element.nip);
            });
        },
        error: function(xhr, status, error) {
            alert('Terjadi kesalahan. Silakan coba lagi.');
        }
    });
});


</script>

@endsection