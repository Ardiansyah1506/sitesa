@extends('auth.main-auth')

@section('css-custom')
<style>
  .title-login{
    font-size: 100px;
    margin-bottom: 0px;
  }
</style>
@endsection

@section('content')
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <p class="text-center text-warning fw-bold title-login">SITESA</p>
          <p class="text-center text-white fs-4">Sistem Informasi Tesis Aswaja</p>
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
            <img src="{{ asset('assets/img/logo-unwahas.png') }}" class="img-fluid mb-5">
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
                  <p class="form-text text-muted text-danger">{{ $message }}</p>
                @enderror
                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-lg btn-block" type="submit">Login</button>
            </form>
            </div>
          </div>
        </div>
      </div>
  @endsection