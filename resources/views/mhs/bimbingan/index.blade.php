@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <!-- Bab 1 -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h2>Bab 1</h2>
        @if(!$showBab2)
                   
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bab1Modal">Upload File</button>
                @endif
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered dt-responsive table-striped" id="datatable1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Catatan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if($showBab2)
        <!-- Bab 2 -->
        <div class="card mt-5">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h2>Bab 2</h2>
        @if(!$showBab3)
                   
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bab2Modal">Upload File</button>
                @endif
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered dt-responsive" id="datatable2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Catatan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        @if($showBab3)
        <!-- Bab 3 -->
        <div class="card mt-5">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h2>Bab 3</h2>
        @if(!$showBab4)
                   
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bab3Modal">Upload File</button>
                @endif
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered dt-responsive" id="datatable3">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Catatan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        @if($showBab4)
        <!-- Bab 4 -->
        <div class="card mt-5">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h2>Bab 4</h2>
        @if(!$showBab5)
                   
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bab4Modal">Upload File</button>
                @endif
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered dt-responsive" id="datatable4">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Catatan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        @if($showBab5)
        <!-- Bab 5 -->
        <div class="card mt-5">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h2>Bab 5</h2>
        @if(!$showBab6)
                   
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bab5Modal">Upload File</button>
                @endif
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered dt-responsive" id="datatable5">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Catatan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        @if($showBab6)
        <!-- Bab 6 -->
        <div class="card mt-5">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h2>Bab 6</h2>
        @if(!$showBab6)
                   
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bab6Modal">Upload File</button>
                @endif
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered dt-responsive" id="datatable6">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Catatan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@include('mhs.bimbingan.modal')

@endsection

@section('js-custom')
<script>
$(document).ready(function() {
    // Load table data for Bab 1
    $('#datatable1').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('mhs.bimbingan.getDataBimbingan', 1) }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'nip', name: 'nip' },
            { data: 'nama_pembimbing', name: 'nama_pembimbing' },
            { data: 'catatan', name: 'catatan' },
            { data: 'status', name: 'status' },
        ],
        language: {
            emptyTable: "Anda Belum Upload File Materi Bab"
        },
        paging: false,
        searching: false,
        lengthChange: false
    });

    @if($showBab2)
    $('#datatable2').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('mhs.bimbingan.getDataBimbingan', 2) }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'nip', name: 'nip' },
            { data: 'nama_pembimbing', name: 'nama_pembimbing' },
            { data: 'catatan', name: 'catatan' },
            { data: 'status', name: 'status' },
        ],
        language: {
            emptyTable: "Anda Belum Upload File Materi Bab"
        },
        paging: false,
        searching: false,
        lengthChange: false
    });
    @endif

    @if($showBab3)
    $('#datatable3').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('mhs.bimbingan.getDataBimbingan', 3) }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'nip', name: 'nip' },
            { data: 'nama_pembimbing', name: 'nama_pembimbing' },
            { data: 'catatan', name: 'catatan' },
            { data: 'status', name: 'status' },
        ],
        language: {
            emptyTable: "Anda Belum Upload File Materi Bab"
        },
        paging: false,
        searching: false,
        lengthChange: false
    });
    @endif

    @if($showBab4)
    $('#datatable4').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('mhs.bimbingan.getDataBimbingan', 4) }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'nip', name: 'nip' },
            { data: 'nama_pembimbing', name: 'nama_pembimbing' },
            { data: 'catatan', name: 'catatan' },
            { data: 'status', name: 'status' },
        ],
        language: {
            emptyTable: "Anda Belum Upload File Materi Bab"
        },
        paging: false,
        searching: false,
        lengthChange: false
    });
    @endif

    @if($showBab5)
    $('#datatable5').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('mhs.bimbingan.getDataBimbingan', 5) }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'nip', name: 'nip' },
            { data: 'nama_pembimbing', name: 'nama_pembimbing' },
            { data: 'catatan', name: 'catatan' },
            { data: 'status', name: 'status' },
        ],
        language: {
            emptyTable: "Anda Belum Upload File Materi Bab"
        },
        paging: false,
        searching: false,
        lengthChange: false
    });
    @endif

    @if($showBab6)
    $('#datatable6').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('mhs.bimbingan.getDataBimbingan', 6) }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'nip', name: 'nip' },
            { data: 'nama_pembimbing', name: 'nama_pembimbing' },
            { data: 'catatan', name: 'catatan' },
            { data: 'status', name: 'status' },
        ],
        language: {
            emptyTable: "Anda Belum Upload File Materi Bab"
        },
        paging: false,
        searching: false,
        lengthChange: false
    });
    @endif

    // Handle form submissions for uploads
    function handleUploadForm(formId, modalId, datatableId, route) {
        $(formId).submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: route,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        $(modalId).modal('hide');
                        $(datatableId).DataTable().ajax.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(response) {
                    alert('Gagal mengunggah file');
                    console.log(response);
                }
            });
        });
    }

    handleUploadForm('#uploadFormBab1', '#bab1Modal', '#datatable1', "{{ route('mhs.bimbingan.uploadBab', 1) }}");

    @for ($i = 2; $i <= 6; $i++)
        handleUploadForm('#uploadFormBab{{ $i }}', '#bab{{ $i }}Modal', '#datatable{{ $i }}', "{{ route('mhs.bimbingan.uploadBab', $i) }}");
    @endfor
});
</script>
@endsection
