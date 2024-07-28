@extends('layout.main')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Detail Bimbingan | {{ $nama }}</h4>
        </div>
        <div class="card-body">
            <h3 class="fw-bold mb-3">Judul : {{ $tesis->judul }}</h3>
            <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                @foreach (range(1, 6) as $i)
                    @php
                        $babVar = 'bab' . $i;
                    @endphp

                    @if (isset($$babVar))
                        <div class="col-sm-6 col-md-3 mt-3">
                            <div class="card card-stats card-info card-round mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <h4 class="card-title">BAB {{ $i }}</h4>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="icon-big text-center">
                                                @if($$babVar->status == 1)
                                                    <i class="icon-check"></i>
                                                @else
                                                    <a href="{{ asset("bab$i/" . $$babVar->nama_file) }}">
                                                        <i class="fas fa-file-alt"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-bab-{{ $i }} d-flex gap-3">
                                @if ($$babVar->status == 1)
                                    <button class="btn btn-primary" style="display: none" id="btn-revisi-bab-{{ $i }}"> <i class="fas fa-clock"></i> Revisi</button>
                                @elseif($$babVar->status == 2)
                                    <p class="my-auto"><span class="badge badge-warning">Catatan revisi terkirim</span></p>
                                @else
                                    <button class="btn btn-primary" id="btn-revisi-bab-{{ $i }}"> <i class="fas fa-clock"></i> Revisi</button>
                                @endif

                                <form action="{{ $$babVar->status == 1 || $$babVar->status == 2 ? '#' : route('dosbim.acc-bab') }}" method="POST" id="acc-bab-{{ $i }}" style="{{ $$babVar->status == 1 || $$babVar->status == 2 ? 'display: none' : '' }}">
                                    @method('PUT')
                                    @csrf
                                    <input type="text" value="{{ $nim }}" name="nim" hidden>
                                    <input type="text" value="{{ $$babVar->id_kategori }}" name="babKe" hidden>
                                    <button type="submit" class="btn btn-success"> <i class="fas fa-check"></i> Acc</button>
                                </form>
                            </div>
                            <div class="formBab{{ $i }}" style="display: none">
                                <form action="{{ route("dosbim.store-catatan-bab-$i") }}" class="d-flex" id="catatan-bab-{{ $i }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="bab-{{ $i }}">Catatan</label>
                                        <input type="text" value="{{ $nim }}" name="nim" hidden>
                                        <input type="text" name="catatan" class="form-control" id="bab-{{ $i }}" aria-describedby="catatan" placeholder="Masukkan Catatan" required>
                                    </div>
                                    <button type="submit" class="btn my-auto btn-primary">Kirim</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <p>
                            <span class="badge badge-danger mt-5">Bab {{ $i }} belum di upload</span>
                        </p>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-custom')
<script>
    $(document).ready(function(){
        @foreach (range(1, 6) as $i)
            $('#btn-revisi-bab-{{ $i }}').on('click', function(){
                $('.formBab{{ $i }}').toggle(); // Use class selector and toggle() to show/hide
            });
        @endforeach
    });
</script>
@endsection
