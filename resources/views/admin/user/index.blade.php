@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="d-flex justify-content-between p-4">
                    <h2>Manajemen User</h2>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#userModal">
                        Tambah User
                    </button>
                </div>
                <div class="card-body">
                 
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive" id="datatable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>NIM/NIP</th>
                                    <th>Role</th>
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
                    <h5 class="modal-title" id="modal">Tambah User</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="userForm">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="3">Dosen Pembimbing</option>
                                <option value="4">Mahasiswa</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="username">NIP/NIM</label>
                            <select class="form-control" id="username" name="username" required>
                                <!-- Options will be populated by JavaScript -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit User -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <input type="hidden" id="edit_user_id">
                    
                        <div class="form-group">
                            <label for="edit_username">Username</label>
                            <input type="text" class="form-control" id="edit_username" name="edit_username" readonly>
                        </div>
                        <div class="form-group">
                            <label for="edit_password">Password</label>
                            <input type="password" class="form-control" id="edit_password" name="edit_password">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
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
                ajax: "{{ route('admin.user.getdata') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'nama', name: 'nama' },
                    { data: 'username', name: 'username' },
                    { data: 'role', name: 'role' },
                    { data: 'button', name: 'button', orderable: false, searchable: false }
                ]
            });
        }

        // Handle role change
        $('#role').change(function() {
            var role = $(this).val();
            if (role == '3') {
                loadNipOptions();
            } else if (role == '4') {
                loadNimOptions();
            }
        });

        // Load NIP options
        function loadNipOptions() {
            $.ajax({
                url: "{{ route('admin.user.nip') }}",
                method: 'GET',
                success: function(response) {
                    var options = '<option value="" disabled selected>Pilih NIP</option>';
                    response.forEach(function(dosen) {
                        options += '<option value="' + dosen.nip + '">' + dosen.nip + ' - ' + dosen.nama + '</option>';
                    });
                    $('#username').html(options);
                }
            });
        }

        // Load NIM options
        function loadNimOptions() {
            $.ajax({
                url: "{{ route('admin.user.nim') }}",
                method: 'GET',
                success: function(response) {
                    var options = '<option value="" disabled selected>Pilih NIM</option>';
                    response.forEach(function(mahasiswa) {
                        options += '<option value="' + mahasiswa.nim + '">' + mahasiswa.nim + ' - ' + mahasiswa.nama + '</option>';
                    });
                    $('#username').html(options);
                }
            });
        }

        // Initial load based on default role
        if ($('#role').val() == '3') {
            loadNipOptions();
        } else if ($('#role').val() == '4') {
            loadNimOptions();
        }

        // Handle form submit
        $('#userForm').submit(function(event) {
            event.preventDefault();
            var formData = {
                username: $('#username').val(),
                password: $('#password').val(),
                role: $('#role').val(),
                _token: '{{ csrf_token() }}',
            };
            $.ajax({
                url: "{{ route('admin.user.create') }}",
                method: 'POST',
                data: formData,
                success: function(response) {
                    alert('User berhasil ditambahkan');
                    $('#userModal').modal('hide');
                    loadTableData();
                },
                error: function(response) {
                    alert('Gagal menambahkan user');
                    console.log(response);
                }
            });
        });

         // Edit button click
         $(document).on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            $.ajax({
                url: `/admin/user/edit/${id}`,
                method: 'GET',
                success: function(response) {
                    $('#edit_user_id').val(response.id);
                    $('#edit_username').val(response.username + ' - '+response.nama);
                    $('#edit_password').val('');
                    $('#editModal').modal('show');
                },
                error: function(response) {
                    alert('Gagal mengambil data user');
                    console.log(response);
                }
            });
        });

        // Handle edit form submit
        $('#editUserForm').submit(function(event) {
            event.preventDefault();
            var id = $('#edit_user_id').val();
            var formData = {
                id: id,
                password: $('#edit_password').val(),
                role: $('#edit_role').val(),
                _token: '{{ csrf_token() }}',
            };
            $.ajax({
                url: `/admin/user/update/${id}`,
                method: 'POST',
                data: formData,
                success: function(response) {
                    alert('User berhasil diperbarui');
                    $('#editModal').modal('hide');
                    loadTableData();
                },
                error: function(response) {
                    alert('Gagal memperbarui user');
                    console.log(response);
                }
            });
        });

        // Delete button click
        $(document).on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
                $.ajax({
                    url: `/admin/user/delete/${id}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        alert('User berhasil dihapus');
                        loadTableData();
                    },
                    error: function(response) {
                        alert('Gagal menghapus user');
                        console.log(response);
                    }
                });
            }
        });
    });
</script>
@endsection
