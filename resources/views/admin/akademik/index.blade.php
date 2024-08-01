@extends('layout.main')

@section('content')
<div class="page-header">
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="p-4">
          <h4 class="card-title">Akademik Mahasiswa</h4>
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
                {data: 'actions', name: 'actions'},
            ]
        });

        // $(document).on('click', '.detail-mhs-akademik', function(){
        //     let nim = $(this).data('id'); // Mengambil data nim dari elemen yang diklik
        //     let url = routeDetailAkademik.replace(':nim', nim);

        //     $.ajax({
        //         url: url, // Pastikan URL sesuai format dan endpoint benar
        //         type: "GET",
        //         dataType: "JSON",
        //         success: (result) => {
        //             if (result.status === true) {
        //                 // Mengisi nilai ke elemen dengan ID yang sesuai
        //                 $("#id-edit-ta").val(result.data.tanggal_akhir);
        //             } else {
        //                 alert("Data Not Found");
        //             }
        //         },
        //         error: (err) => {
        //             console.log(err);
        //             console.log(err.responseJSON);
        //         }
        //     });
        // });

</script>
<script>
    var routeDetailAkademik = "{{ route('admin.detail-akademik-mhs', ['nim' => ':nim']) }}";
</script>


@endsection