@extends('layout.main')

@section('content')
<div class="page-header">
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Sidang TA</h4>
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
                  <th>Nama</th>
                  <th>Gelombang</th>
                  <th>Tanggal Awal</th>
                  <th>Tanggal Akhir</th>
                  <th>Status</th>
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
  @include('prodi.waktu-ta.modal')
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
                {data: 'nama', name: 'nama'},
                {data: 'gelombang', name: 'gelombang'},
                {data: 'tanggal_awal', name: 'tanggal_awal'},
                {data: 'tanggal_akhir', name: 'tanggal_akhir'},
                {data: 'status', name: 'status'},
                {data: 'actions', name: 'actions'},
            ]
        });
    });

    $("#dataTables1").on("click", ".edit-ta", function() {
                $("#modalEditTA").modal("show")
                let dataId = $(this).data("id")
                $.ajax({
                    url: baseUrl + '{{ $url }}' + 'edit/' + dataId,
                    type: "GET",
                    dataType: "JSON",
                    success: (result) => {
                        console.log(result.data.tanggal_awal);
                        if (result.status == true) {
                            $("#id-edit-ta").val(result.data.id)
                            $("#nama").val(result.data.nama)
                            $("#gelombang").val(result.data.gelombang)
                            $("#tanggal-mulai").val(result.data.tanggal_awal)
                            $("#tanggal-akhir").val(result.data.tanggal_akhir)
                        } else {
                            $("#modalEditTA").modal("hide")
                            alert("Data Not Found")
                        }
                    },
                    error: (err) => {
                        alert("Data Not Found")
                        $("#modalEditTA").modal("hide")
                        console.log(err)
                        console.log(err.responseJSON)
                    }
                })
            });

    $(document).on('submit', '#delete-ta', function(event) {
    event.preventDefault(); // Mencegah submit form langsung

    // Menampilkan dialog konfirmasi menggunakan confirm
    var confirmDelete = confirm('Anda tidak dapat mengembalikan data yang telah dihapus! Apakah Anda yakin?');

    if (confirmDelete) {
        // Jika user mengklik "OK", kirimkan form
        $(this)[0].submit(); // Menggunakan [0] untuk merujuk ke elemen DOM form
    } else {
        // Jika user mengklik "Cancel", tampilkan informasi
        alert('Data tidak dihapus');
    }
});


</script>

@endsection