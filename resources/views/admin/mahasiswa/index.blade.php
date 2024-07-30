@extends('layout.main')

@section('content')
<div class="page-header">
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="p-4">
          <h4 class="card-title">Daftar Mahasiswa</h4>
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
                  <th>Nama</th>
                  <th>Status Pembayaran</th>
                  <th>Jumlah SKS</th>
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
  @include('admin.mahasiswa.modal')
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
                {data: 'status', name: 'status'},
                {data: 'jumlah', name: 'jumlah'},
                {data: 'actions', name: 'actions'},
            ]
        });
    });

    $("#dataTables1").on("click", ".edit-mhs", function() {
                $("#modalEditMhs").modal("show")
                let dataId = $(this).data("id")
                $.ajax({
                    url: baseUrl + '{{ $url }}' + 'edit/' + dataId,
                    type: "GET",
                    dataType: "JSON",
                    success: (result) => {
                        console.log(result.data);
                        if (result.status == true) {
                            $("#id-edit-mhs").val(result.data.nim)
                            $("#status-pembayaran").val(result.data.status)
                            $("#jumlah-sks").val(result.data.jumlah)
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
</script>

@endsection