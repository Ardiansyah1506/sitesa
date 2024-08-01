@extends('layout.main')
@section('css-custom')

<style>
    .info-akademik {
        background-color: #0e5102; /* Menyesuaikan warna latar */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }
    
    .item {
        border-bottom: 1px solid #ddd;
        padding: 10px 0;
    }
    
    .label {
        font-size: 1.2em;
        color: #fff; /* Menyesuaikan warna teks */
    }
    
    .btn-download {
        background-color: #28a745; /* Warna hijau untuk tombol */
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }
    
    .btn-download:hover {
        background-color: #218838; /* Warna hijau lebih gelap saat hover */
    }
</style>
@endsection

@section('content')
<div class="card p-4">
    <h2>Informasi Akademik {{ $nim }} | {{ $nama }}</h2>
</div>
<div class="page-header">
  <div class="info-akademik d-flex flex-column gap-3">
    <div class="item d-flex justify-content-between align-items-center">
        <span class="label">Lembar Pengesahan</span>
        <a href="{{ route('admin.lembar-pengesahan', ['nim' => $nim ]) }}" class="btn btn-download" target="_blank">
            Download
        </a>
    </div>
    <div class="item d-flex justify-content-between align-items-center">
        <span class="label">Formulir Tugas Akhir</span>
        <a href="{{ asset('storage/dokumen/tesisPAI2023.pdf') }}" class="btn btn-download" target="_blank">
            Download
        </a>
    </div>
    <div class="item d-flex justify-content-between align-items-center">
        <span class="label">Lembar Nota Pembimbing</span>
        <a href="{{ route('admin.nota-pembimbing', ['nim' => $nim ]) }}" class="btn btn-download" target="_blank">
            Download
        </a>
    </div>
    <div class="item d-flex justify-content-between align-items-center">
        <span class="label">Form Sempro/Tesis</span>
        <a href="{{ asset('storage/dokumen/tesisPAI2023.pdf') }}" class="btn btn-download" target="_blank">
            Download
        </a>
</div>
    <div class="item d-flex justify-content-between align-items-center">
        <span class="label">Form Ujian Proposal</span>
        <a href="{{ route('admin.ujian-proposal', ['nim' => $nim ]) }}" class="btn btn-download" target="_blank">
            Download
        </a>
    </div>
  </div>
</div>
@endsection
