@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                    <h2 class="p-4">List Dosen Pembimbing</h2>
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
                    <h5 class="modal-title" id="modal">Ubah Kuota</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="userForm">
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" readonly>
                        </div>
                        <div class="form-group">
                            <label for="kuota">Kuota</label>
                            <input type="number" class="form-control" id="kuota" name="kuota" required>
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
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.dosen.getListData') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'nip', name: 'nip' },
                { data: 'nama', name: 'nama' },
                { data: 'kuota', name: 'kuota' },
                { data: 'button', name: 'button', orderable: false, searchable: false }
            ]
        });
    }

    // Event listener untuk tombol "Edit"
    $(document).on('click', '.edit-btn', function() {
        var nip = $(this).data('id');
        var editUrl = "{{ route('admin.dosen.edit', ':nip') }}".replace(':nip', nip);
        $.ajax({
            url: editUrl,
            method: 'GET',
            success: function(response) {
                $('#nip').val(response.nip);
                $('#kuota').val(response.kuota);
                $('#userModal').modal('show');
            }
        });
    });

    // Submit form untuk memperbarui data
    $('#userForm').submit(function(e) {
        e.preventDefault();
        var nip = $('#nip').val();
        var kuota = $('#kuota').val();
        $.ajax({
            url: "{{ route('admin.dosen.updateKuota') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                nip: nip,
                kuota: kuota
            },
            success: function(response) {
                $('#userModal').modal('hide');
                $('#datatable').DataTable().ajax.reload();
                alert('Kuota berhasil diperbarui');
            }
        });
    });
});

</script>
@endsection
