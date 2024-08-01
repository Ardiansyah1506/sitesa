@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="p-4">
                    <h2>Tugas Akhir</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Judul</th>
                                    <th>TA</th>
                                    <th>File</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Tanggal Sidang</th>
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

    <!-- Modal -->
    <div class="modal fade" id="accModal" tabindex="-1" role="dialog" aria-labelledby="accModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accModalLabel">Set Tanggal Sidang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="accForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tanggal_sidang">Tanggal Sidang</label>
                            <select class="form-control" id="tanggal_sidang" name="tanggal_sidang" required>
                                <!-- Options will be populated by JavaScript -->
                            </select>
                            <input type="hidden" id="tesis_id" name="tesis_id">
                            <input type="hidden" id="mhs_nim" name="mhsNim">
                            {{-- <input type="hidden" id="kode_ta" name="kode_ta"> --}}
                        </div>
                        <div class="form-group">
                            <label for="penguji-1">Penguji 1</label>
                            <select class="form-control" id="penguji-1" name="penguji1" required>
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->nip }}">{{ $dosen->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="penguji-2">Penguji 2</label>
                            <select class="form-control" id="penguji-2" name="penguji2" required>
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->nip }}">{{ $dosen->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label for="penguji-3">Penguji 3</label>
                            <select class="form-control" id="penguji-3" name="penguji3" required>
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->nip }}">{{ $dosen->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="penguji-4">Penguji 4</label>
                            <select class="form-control" id="penguji-4" name="penguji4" required>
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->nip }}">{{ $dosen->nama }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js-custom')
    <script>
        $(function() {
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.ta.getdata') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'nim',
                        name: 'nim'
                    },
                    {
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'kode_ta',
                        name: 'kode_ta'
                    },
                    {
                        data: 'nama_file',
                        name: 'nama_file',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal_daftar',
                        name: 'tanggal_daftar'
                    },
                    {
                        data: 'tanggal_sidang',
                        name: 'tanggal_sidang'
                    },
                    
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Event listener untuk tombol Acc
          // Event listener untuk tombol Acc
          $(document).on('click', '.acc-button', function() {
                var idTesis = $(this).data('id');
                var nim = $(this).data('another-id');
                var tanggalDaftar = $(this).data('third-id');
                
                $('#tesis_id').val(idTesis);
                $('#mhs_nim').val(nim);
                // $('#kode_ta').val(kode_ta);
                // console.log('kode ta', kode_ta);

                // Mendapatkan tanggal sidang dari controller
                $.ajax({
                    url: "{{ route('admin.ta.gettanggal', ['tanggalDaftar' => ':tanggalDaftar']) }}".replace(':tanggalDaftar', tanggalDaftar),
                    method: 'GET',
                    success: function(response) {
                        var options = '';
                        response.forEach(function(tanggal) {
                            options += '<option value="' + tanggal + '">' + tanggal + '</option>';
                        });
                        $('#tanggal_sidang').html(options);
                        $('#accModal').modal('show');
                    },
                    error: function(response) {
                        var errorMessage = response.responseJSON ? response.responseJSON.message : 'An error occurred';
                        alert('Error: ' + errorMessage);
                    }
                });
            });


            // Handle form submission untuk update status
            $('#accForm').on('submit', function(e) {
                e.preventDefault();
                var id = $('#tesis_id').val();
                var mhsNim = $('#mhs_nim').val();
                // var kodeTA = $('#kode_ta').val();
                var tanggal_sidang = $('#tanggal_sidang').val();
                var penguji1 = $('#penguji-1').val();
                var penguji2 = $('#penguji-2').val();
                // var penguji3 = $('#penguji-3').val();
                // var penguji4 = $('#penguji-4').val();


                $.ajax({
                    url: "{{ route('admin.ta.updatestatus') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        tanggal_sidang: tanggal_sidang,
                        penguji1 : penguji1,
                        penguji2 : penguji2,
                        // penguji3 : penguji3,
                        // penguji4 : penguji4,
                        mhsNim : mhsNim,
                    },
                    success: function(response) {
                        $('#accModal').modal('hide');
                        table.ajax.reload();
                        alert(response.message);
                    },
                    error: function(response) {
                        var errorMessage = response.responseJSON ? response.responseJSON
                            .message : 'An error occurred';
                        alert('Error: ' + errorMessage);
                    }
                });

            });
            $(document).on('click', '.selesai-button', function() {
                var id = $(this).data('id');
                var nim = $(this).data('another-id');
                console.log(nim)
                // Menampilkan konfirmasi
                var confirmation = confirm("Apakah Anda yakin ingin menyelesaikan TA ini?");

                // Jika pengguna mengonfirmasi, jalankan AJAX
                if (confirmation) {
                    $.ajax({
                        url: "{{ route('admin.ta.updateSelesaiTa') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            nim: nim,
                        },
                        success: function(response) {
                            table.ajax.reload();
                            alert(response.message);
                        },
                        error: function(response) {
                            var errorMessage = response.responseJSON ? response.responseJSON.message : 'An error occurred';
                            alert('Error: ' + errorMessage);
                        }
                    });
                }
            });

        });
    </script>
@endsection
