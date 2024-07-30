@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h2>Manajemen Tesis</h2>
            <div class="card">
                <div class="card-body">
                    <h3>Tesis</h3>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tesisModal">
                        Tambah Tesis
                    </button>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered dt-responsive" id="datatable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Judul</th>
                                    <th>Translate</th>
                                    <th>Abstrak</th>
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
@include('mhs.modal')
@endsection

@section('js-custom')
<script>
    $(document).ready(function() {
        // Load table data
        function loadTableData() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('mhs.tesis.getdata') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'judul', name: 'judul' },
                    { data: 'translate', name: 'translate' },
                    { data: 'abstrak', name: 'abstrak' },
                ]
            });
        }

        loadTableData();

        function checkPaymentStatus() {
            $.ajax({
                url: "{{ route('mhs.checkPaymentStatus') }}",
                method: 'GET',
                success: function(response) {
                    if(response.status) {
                        $('#paymentStatus').text('');
                        $('#saveChangesBtn').prop('disabled', false);
                      checkTesis();
                    } else {
                        $('#paymentStatus').text('Tidak Bisa menambahkan tesis. Pembayaran belum terpenuhi atau SKS kurang dari 144.');
                        $('#saveChangesBtn').prop('disabled', true);
                    }
                },
                error: function(response) {
                    alert('Gagal memeriksa status pembayaran');
                    console.log(response);
                }
            });
        }
        function checkTesis() {
            $.ajax({
                url: "{{ route('mhs.checkTesis') }}",
                method: 'GET',
                success: function(response) {
                    if(response.status) {
                        $('#paymentStatus').text('Anda Sudah Mendaftarkan Tesis anda Silahkan Ajukan Dosen Pembimbing.');
                        $('#saveChangesBtn').prop('disabled', true);
                    } else {
                        checkPaymentStatus(); // Panggil checkPaymentStatus jika tesis belum ada
                    }
                },
                error: function(response) {
                    alert('Gagal memeriksa status tesis');
                    console.log(response);
                }
            });
        }

        checkPaymentStatus();
        
        // Handle form submit for adding new tesis
        $('#tesisForm').submit(function(event) {
            event.preventDefault();
            var formData = {
                judul: $('#judul').val(),
                abstrak: $('#abstrak').val(),
                _token: '{{ csrf_token() }}',
            };
            $.ajax({
                url: "{{ route('mhs.tesis.daftartesis') }}",
                method: 'POST',
                data: formData,
                success: function(response) {
                    if(response.status === 'success') {
                        alert(response.message);
                        $('#tesisModal').modal('hide');
                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(response) {
                    alert('Gagal menambahkan tesis');
                    console.log(response);
                }
            });
        });

        // Handle plagiarism check
        $('#cekPlagiasiBtn').click(function() {
            var formData = {
                judul: $('#judul').val(),
                abstrak: $('#abstrak').val(),
                _token: '{{ csrf_token() }}',
            };
            $.ajax({
                url: "{{ route('mhs.tesis.cekplagiasi') }}",
                method: 'POST',
                data: formData,
                success: function(response) {
                    $('#plagiarismResult').text('Persentase plagiarisme: ' + response.similarity + '%');
                },
                error: function(response) {
                    alert('Gagal memeriksa plagiarisme');
                    console.log(response);
                }
            });
        });
    });
</script>
@endsection
