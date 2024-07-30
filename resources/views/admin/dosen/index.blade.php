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

    <!-- Modal Tambah User -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal">Buat Akun Dosen Pembimbing</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="userForm">
                        <div class="form-group">
                            <label for="username">NIP</label>
                            <input type="password" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save changes</button>
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
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'nip', name: 'nama' },
                    { data: 'nama', name: 'nama' },
                    { data: 'kuota', name: 'kuota' },
                    { data: 'button', name: 'button', orderable: false, searchable: false }
                ]
            });
        }

        
        // // Handle form submit
        // $('#userForm').submit(function(event) {
        //     event.preventDefault();
        //     var formData = {
        //         username: $('#username').val(),
        //         password: $('#password').val(),
        //         role: $('#role').val(),
        //         _token: '{{ csrf_token() }}',
        //     };
        //     $.ajax({
        //         url: "{{ route('admin.user.create') }}",
        //         method: 'POST',
        //         data: formData,
        //         success: function(response) {
        //             alert('User berhasil ditambahkan');
        //             $('#userModal').modal('hide');
        //             loadTableData();
        //         },
        //         error: function(response) {
        //             alert('Gagal menambahkan user');
        //             console.log(response);
        //         }
        //     });
        // });


    
    });
</script>
@endsection
