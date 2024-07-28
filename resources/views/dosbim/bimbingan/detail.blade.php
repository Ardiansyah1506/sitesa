@extends('layout.main')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Detail Bimbingan | {{ $nama }}</h4>
        </div>
        <div class="card-body">
            <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                @if (isset($bab1))
                <div class="col-sm-6 col-md-3 mt-3">
                    <div class="card card-stats card-info card-round mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <h4 class="card-title">BAB 1</h4>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="icon-big text-center">
                                        @if($bab1->status == 1)
                                            <i class="icon-check"></i>
                                        @else
                                            <a href="{{ asset('bab1/'.$bab1->nama_file) }}">
                                                <i class="fas fa-file-alt"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-bab-1 d-flex gap-3">
                        @if ($bab1->status == 1)
                            <button class="btn btn-primary" style="display: none" id="btn-revisi-bab-1"> <i class="fas fa-clock"></i> Revisi</button>
                        @elseif($bab1->status == 2)
                            <p class="my-auto"><span class="badge badge-warning">Catatan revisi terkirim</span></p>
                        @else
                            <button class="btn btn-primary" id="btn-revisi-bab-1"> <i class="fas fa-clock"></i> Revisi</button>
                        @endif

                        <form action="{{ $bab1->status == 1 || $bab1->status == 2 ? '#' : route('dosbim.acc-bab') }}" method="POST" id="acc-bab-1" style="{{ $bab1->status == 1 || $bab1->status == 2 ? 'display: none' : '' }}">
                            @method('PUT')
                            @csrf
                            <input type="text" value="{{ $nim }}" name="nim" hidden>
                            <input type="text" value="{{ $bab1->id_kategori }}" name="babKe" hidden>
                            <button type="submit" class="btn btn-success"> <i class="fas fa-check"></i> Acc</button>
                        </form>
                    </div>
                    <div class="formBab1" style="display: none">
                        <form action="{{ route('dosbim.store-catatan-bab-1') }}" class="d-flex" id="catatan-bab-1" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="bab-1">Catatan</label>
                                <input type="text" value="{{ $nim }}" name="nim" hidden>
                                <input type="text" name="catatan" class="form-control" id="bab-1" aria-describedby="catatan" placeholder="Masukkan Catatan" required>
                            </div>
                            <button type="submit" class="btn my-auto btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
                @else
                    <p>
                        <span class="badge badge-danger mt-5">Bab 1 belum di upload</span>
                    </p>
                @endif

                @if (isset($bab2))
                <div class="col-sm-6 col-md-3 mt-3">
                    <div class="card card-stats card-info card-round mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <h4 class="card-title">BAB 1</h4>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="icon-big text-center">
                                        @if($bab1->status == 1)
                                            <i class="icon-check"></i>
                                        @else
                                            <a href="{{ asset('bab1/'.$bab1->nama_file) }}">
                                                <i class="fas fa-file-alt"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-bab-1 d-flex gap-3">
                        @if ($bab1->status == 1)
                            <button class="btn btn-primary" style="display: none" id="btn-revisi-bab-1"> <i class="fas fa-clock"></i> Revisi</button>
                        @elseif($bab1->status == 2)
                            <p class="my-auto"><span class="badge badge-warning">Catatan revisi terkirim</span></p>
                        @else
                            <button class="btn btn-primary" id="btn-revisi-bab-1"> <i class="fas fa-clock"></i> Revisi</button>
                        @endif

                        <form action="{{ $bab1->status == 1 || $bab1->status == 2 ? '#' : route('dosbim.acc-bab') }}" method="POST" id="acc-bab-1" style="{{ $bab1->status == 1 || $bab1->status == 2 ? 'display: none' : '' }}">
                            @method('PUT')
                            @csrf
                            <input type="text" value="{{ $nim }}" name="nim" hidden>
                            <input type="text" value="{{ $bab1->id_kategori }}" name="babKe" hidden>
                            <button type="submit" class="btn btn-success"> <i class="fas fa-check"></i> Acc</button>
                        </form>
                    </div>
                    <div class="formBab1" style="display: none">
                        <form action="{{ route('dosbim.store-catatan-bab-1') }}" class="d-flex" id="catatan-bab-1" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="bab-1">Catatan</label>
                                <input type="text" value="{{ $nim }}" name="nim" hidden>
                                <input type="text" name="catatan" class="form-control" id="bab-1" aria-describedby="catatan" placeholder="Masukkan Catatan" required>
                            </div>
                            <button type="submit" class="btn my-auto btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
                @else
                    <p>
                        <span class="badge badge-danger mt-5">Bab 2 belum di upload</span>
                    </p>
                @endif

                @if (isset($bab3))
                <div class="col-sm-6 col-md-3 mt-3">
                    <div class="card card-stats card-info card-round mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <h4 class="card-title">BAB 1</h4>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="icon-big text-center">
                                        @if($bab1->status == 1)
                                            <i class="icon-check"></i>
                                        @else
                                            <a href="{{ asset('bab1/'.$bab1->nama_file) }}">
                                                <i class="fas fa-file-alt"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-bab-1 d-flex gap-3">
                        @if ($bab1->status == 1)
                            <button class="btn btn-primary" style="display: none" id="btn-revisi-bab-1"> <i class="fas fa-clock"></i> Revisi</button>
                        @elseif($bab1->status == 2)
                            <p class="my-auto"><span class="badge badge-warning">Catatan revisi terkirim</span></p>
                        @else
                            <button class="btn btn-primary" id="btn-revisi-bab-1"> <i class="fas fa-clock"></i> Revisi</button>
                        @endif

                        <form action="{{ $bab1->status == 1 || $bab1->status == 2 ? '#' : route('dosbim.acc-bab') }}" method="POST" id="acc-bab-1" style="{{ $bab1->status == 1 || $bab1->status == 2 ? 'display: none' : '' }}">
                            @method('PUT')
                            @csrf
                            <input type="text" value="{{ $nim }}" name="nim" hidden>
                            <input type="text" value="{{ $bab1->id_kategori }}" name="babKe" hidden>
                            <button type="submit" class="btn btn-success"> <i class="fas fa-check"></i> Acc</button>
                        </form>
                    </div>
                    <div class="formBab1" style="display: none">
                        <form action="{{ route('dosbim.store-catatan-bab-1') }}" class="d-flex" id="catatan-bab-1" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="bab-1">Catatan</label>
                                <input type="text" value="{{ $nim }}" name="nim" hidden>
                                <input type="text" name="catatan" class="form-control" id="bab-1" aria-describedby="catatan" placeholder="Masukkan Catatan" required>
                            </div>
                            <button type="submit" class="btn my-auto btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
                @else
                    <p>
                        <span class="badge badge-danger mt-5">Bab 3 belum di upload</span>
                    </p>
                @endif
                @if (isset($bab4))
                <div class="col-sm-6 col-md-3 mt-3">
                    <div class="card card-stats card-info card-round mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <h4 class="card-title">BAB 1</h4>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="icon-big text-center">
                                        @if($bab1->status == 1)
                                            <i class="icon-check"></i>
                                        @else
                                            <a href="{{ asset('bab1/'.$bab1->nama_file) }}">
                                                <i class="fas fa-file-alt"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-bab-1 d-flex gap-3">
                        @if ($bab1->status == 1)
                            <button class="btn btn-primary" style="display: none" id="btn-revisi-bab-1"> <i class="fas fa-clock"></i> Revisi</button>
                        @elseif($bab1->status == 2)
                            <p class="my-auto"><span class="badge badge-warning">Catatan revisi terkirim</span></p>
                        @else
                            <button class="btn btn-primary" id="btn-revisi-bab-1"> <i class="fas fa-clock"></i> Revisi</button>
                        @endif

                        <form action="{{ $bab1->status == 1 || $bab1->status == 2 ? '#' : route('dosbim.acc-bab') }}" method="POST" id="acc-bab-1" style="{{ $bab1->status == 1 || $bab1->status == 2 ? 'display: none' : '' }}">
                            @method('PUT')
                            @csrf
                            <input type="text" value="{{ $nim }}" name="nim" hidden>
                            <input type="text" value="{{ $bab1->id_kategori }}" name="babKe" hidden>
                            <button type="submit" class="btn btn-success"> <i class="fas fa-check"></i> Acc</button>
                        </form>
                    </div>
                    <div class="formBab1" style="display: none">
                        <form action="{{ route('dosbim.store-catatan-bab-1') }}" class="d-flex" id="catatan-bab-1" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="bab-1">Catatan</label>
                                <input type="text" value="{{ $nim }}" name="nim" hidden>
                                <input type="text" name="catatan" class="form-control" id="bab-1" aria-describedby="catatan" placeholder="Masukkan Catatan" required>
                            </div>
                            <button type="submit" class="btn my-auto btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
                @else
                    <p>
                        <span class="badge badge-danger mt-5">Bab 4 belum di upload</span>
                    </p>
                @endif
                @if (isset($bab5))
                <div class="col-sm-6 col-md-3 mt-3">
                    <div class="card card-stats card-info card-round mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <h4 class="card-title">BAB 1</h4>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="icon-big text-center">
                                        @if($bab1->status == 1)
                                            <i class="icon-check"></i>
                                        @else
                                            <a href="{{ asset('bab1/'.$bab1->nama_file) }}">
                                                <i class="fas fa-file-alt"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-bab-1 d-flex gap-3">
                        @if ($bab1->status == 1)
                            <button class="btn btn-primary" style="display: none" id="btn-revisi-bab-1"> <i class="fas fa-clock"></i> Revisi</button>
                        @elseif($bab1->status == 2)
                            <p class="my-auto"><span class="badge badge-warning">Catatan revisi terkirim</span></p>
                        @else
                            <button class="btn btn-primary" id="btn-revisi-bab-1"> <i class="fas fa-clock"></i> Revisi</button>
                        @endif

                        <form action="{{ $bab1->status == 1 || $bab1->status == 2 ? '#' : route('dosbim.acc-bab') }}" method="POST" id="acc-bab-1" style="{{ $bab1->status == 1 || $bab1->status == 2 ? 'display: none' : '' }}">
                            @method('PUT')
                            @csrf
                            <input type="text" value="{{ $nim }}" name="nim" hidden>
                            <input type="text" value="{{ $bab1->id_kategori }}" name="babKe" hidden>
                            <button type="submit" class="btn btn-success"> <i class="fas fa-check"></i> Acc</button>
                        </form>
                    </div>
                    <div class="formBab1" style="display: none">
                        <form action="{{ route('dosbim.store-catatan-bab-1') }}" class="d-flex" id="catatan-bab-1" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="bab-1">Catatan</label>
                                <input type="text" value="{{ $nim }}" name="nim" hidden>
                                <input type="text" name="catatan" class="form-control" id="bab-1" aria-describedby="catatan" placeholder="Masukkan Catatan" required>
                            </div>
                            <button type="submit" class="btn my-auto btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
                @else
                    <p>
                        <span class="badge badge-danger mt-5">Bab 5 belum di upload</span>
                    </p>
                @endif
                @if (isset($bab6))
                <div class="col-sm-6 col-md-3 mt-3">
                    <div class="card card-stats card-info card-round mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <h4 class="card-title">BAB 1</h4>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="icon-big text-center">
                                        @if($bab1->status == 1)
                                            <i class="icon-check"></i>
                                        @else
                                            <a href="{{ asset('bab1/'.$bab1->nama_file) }}">
                                                <i class="fas fa-file-alt"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-bab-1 d-flex gap-3">
                        @if ($bab1->status == 1)
                            <button class="btn btn-primary" style="display: none" id="btn-revisi-bab-1"> <i class="fas fa-clock"></i> Revisi</button>
                        @elseif($bab1->status == 2)
                            <p class="my-auto"><span class="badge badge-warning">Catatan revisi terkirim</span></p>
                        @else
                            <button class="btn btn-primary" id="btn-revisi-bab-1"> <i class="fas fa-clock"></i> Revisi</button>
                        @endif

                        <form action="{{ $bab1->status == 1 || $bab1->status == 2 ? '#' : route('dosbim.acc-bab') }}" method="POST" id="acc-bab-1" style="{{ $bab1->status == 1 || $bab1->status == 2 ? 'display: none' : '' }}">
                            @method('PUT')
                            @csrf
                            <input type="text" value="{{ $nim }}" name="nim" hidden>
                            <input type="text" value="{{ $bab1->id_kategori }}" name="babKe" hidden>
                            <button type="submit" class="btn btn-success"> <i class="fas fa-check"></i> Acc</button>
                        </form>
                    </div>
                    <div class="formBab1" style="display: none">
                        <form action="{{ route('dosbim.store-catatan-bab-1') }}" class="d-flex" id="catatan-bab-1" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="bab-1">Catatan</label>
                                <input type="text" value="{{ $nim }}" name="nim" hidden>
                                <input type="text" name="catatan" class="form-control" id="bab-1" aria-describedby="catatan" placeholder="Masukkan Catatan" required>
                            </div>
                            <button type="submit" class="btn my-auto btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
                @else
                    <p>
                        <span class="badge badge-danger mt-5">Bab 6 belum di upload</span>
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-custom')
<script>
    $(document).ready(function(){
        $('#btn-revisi-bab-1').on('click', function(){
            $('.formBab1').toggle(); // Use class selector and toggle() to show/hide
        });
        $('#btn-revisi-bab-2').on('click', function(){
            $('.formBab2').toggle(); // Use class selector and toggle() to show/hide
        });
        $('#btn-revisi-bab-3').on('click', function(){
            $('.formBab3').toggle(); // Use class selector and toggle() to show/hide
        });
        $('#btn-revisi-bab-4').on('click', function(){
            $('.formBab4').toggle(); // Use class selector and toggle() to show/hide
        });
        $('#btn-revisi-bab-5').on('click', function(){
            $('.formBab5').toggle(); // Use class selector and toggle() to show/hide
        });
        $('#btn-revisi-bab-6').on('click', function(){
            $('.formBab6').toggle(); // Use class selector and toggle() to show/hide
        });
    });
</script>
@endsection
