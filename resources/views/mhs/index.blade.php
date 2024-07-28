@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h2>Manajemen Tesis</h2>
            <div class="card">
                <div class="card-body">
                    <h3>Tesis</h3>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tesisModal">
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

    <!-- Modal Tambah Tesis -->
    <div class="modal fade" id="tesisModal" tabindex="-1" aria-labelledby="tesisModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="tesisModalLabel">Tambah Tesis</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form id="tesisForm">
                      <input type="hidden" class="form-control" id="nim" name="nim" value="{{ Auth::user()->username }}">
                      <div id="paymentStatus" class="text-danger mt-2"></div> <!-- Menambahkan elemen untuk pesan pembayaran -->
                      <div class="form-group">
                          <label for="judul">Judul</label>
                          <input type="text" class="form-control" id="judul" name="judul" required>
                      </div>
                      <div class="form-group">
                          <label for="abstrak">Abstrak</label>
                          <textarea class="form-control" id="abstrak" name="abstrak" required></textarea>
                      </div>
                      <div class="form-group mt-3">
                          <button type="button" class="btn btn-warning" id="cekPlagiasiBtn">Cek Plagiasi</button>
                          <span id="plagiarismResult" class="ms-3"></span>
                      </div>
                      <div class="modal-footer mt-3">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary" id="saveChangesBtn" disabled>Save changes</button>
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
