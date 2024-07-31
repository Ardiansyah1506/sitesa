@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <h2>Dosen Pembimbing</h2>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive" id="datatable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
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

    <!-- Modal Input Password -->
    <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordModalLabel">Input Password</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="passwordForm">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <input type="hidden" id="username" name="username">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-custom')
    <script>
        $(document).ready(function() {
            loadTableData();

            // Load table data
            function loadTableData() {
                var table = $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.dosen.getData') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'nip',
                            name: 'nama'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'kuota',
                            name: 'kuota'
                        },
                        {
                            data: 'button',
                            name: 'button',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            }

            $(document).on('click', '.edit-btn', function() {
                var nip = $(this).data('id');
                $('#username').val(nip); // Set NIP sebagai username di form
                $('#passwordModal').modal('show'); // Tampilkan modal
            });

            // Handle form submit untuk password
            $('#passwordForm').submit(function(event) {
                event.preventDefault();
                var formData = {
                    username: $('#username').val(),
                    password: $('#password').val(),
                    role: 3, // Role untuk dosen
                    _token: '{{ csrf_token() }}'
                };

                $.ajax({
                    url: "{{ route('admin.dosen.accDosen') }}", // Sesuaikan rute ini
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        alert('Akun berhasil dibuat dan status dosen diperbarui');
                        $('#passwordModal').modal('hide');
                        $('#datatable').DataTable().ajax.reload(); // Reload data table
                    },
                    error: function(response) {
                        alert('Gagal memperbarui data');
                        console.log(response);
                    }
                });
            });



        });
    </script>
@endsection
