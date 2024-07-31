<!DOCTYPE html>
<html lang="en">

@php
    Carbon\Carbon::setLocale('id');
@endphp
    @include('layout.header')
    <body class="d-flex flex-column justify-content-center align-items-center bg-cuy">
        <div class="container">
        <section class="pt-4 mt-5">
            <div class="container px-lg-5">
                <!-- Page Features-->
                <div class="row gx-lg-5">
                    <div class="col-lg-6 col-xxl-4 mb-5">
                        <div class="card bg-light border-0 h-100">
                            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                                <div class="feature bg-success bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-clock"></i></div>
                                <h2 class="fs-4 fw-bold mb-5">Jadwal Sidang</h2>
                                <div>
                                    @foreach ($sidangs as $sidang)
                                    <p>{{ $sidang->nama }} | {{ \Carbon\Carbon::parse($sidang->tanggal_awal)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($sidang->tanggal_akhir)->translatedFormat('d F Y') }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xxl-4 mb-5">
                        <div class="card bg-light border-0 h-100">
                            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                                <div class="feature bg-success bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-calendar-event"></i></div>
                                <h2 class="fs-4 fw-bold mb-5">SITESA</h2>
                                <p>Pembimbing : {{ $jumlahPembimbing }}</p>
                                <p>Mahasiswa sedang bimbingan : {{ $jumlahBimbingan }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xxl-4 mb-5">
                        <div class="card bg-light border-0 h-100" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                            <img src="{{ asset('assets/img/logo-unwahas.png') }}" class="img-fluid mb-5">
                              {{-- <h3 class="mb-5 fw-bold">Log In</h3> --}}
                                
                              <form action="{{ route('process-login') }}" method="POST">
                                @csrf
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="text" id="username" class="form-control form-control-lg" name="username" value="{{ old('username') }}" placeholder="NIP/NIM"/>
                                    <label class="form-label" for="username">NIP/NIM</label>
                                </div>
                    
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="password" id="password" class="form-control form-control-lg" name="password" placeholder="Password"/>
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                @error('username')
                                  <p class="form-text text-muted text-danger" >{{ $message }}</p>
                                @enderror
                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-lg btn-block" type="submit">Login</button>
                            </form>
                            </div>
                          </div>
                    </div>
                    
                </div>
            </div>
        </section>
    </div>
        @include('layout.js-library')
    </body>
</html>
