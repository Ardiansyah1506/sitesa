@extends('layout.main')

@section('content')
<div class="page-header">
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Kuota Pembimbing</h4>
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
                  <th>Nama Pembimbing</th>
                  <th>Kuota</th>
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
  @include('prodi.kuota.modal')
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
                {data: 'sisa_kuota', name: 'sisa_kuota'},
                {data: 'actions', name: 'actions'},
            ]
        });

        $("#dataTables1").on("click", ".edit-kuota", function() {
                $("#modalEditKuota").modal("show")
                let dataId = $(this).data("id")
                $.ajax({
                    url: baseUrl + '{{ $url }}' + 'edit/' + dataId,
                    type: "GET",
                    dataType: "JSON",
                    success: (result) => {
                        if (result.status == true) {
                          $("#id-edit-kouta").val(result.data.nip)
                          $("#nama").val(result.data.nama)
                          $("#sisa-kuota").val(result.data.sisa_kuota)
                        } else {
                            $("#modalEditKuota").modal("hide")
                            alert("Data Not Found")
                        }
                    },
                    error: (err) => {
                        alert("Data Not Found")
                        $("#modalEditKuota").modal("hide")
                        console.log(err)
                        console.log(err.responseJSON)
                    }
                })
            });
    });

</script>

@endsection