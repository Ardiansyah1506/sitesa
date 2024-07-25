<form action="{{ route('process-login') }}" method="POST">
    @csrf
    <div class="form-group @error('username') has-error @enderror has-feedback">
        <label for="username">Username</label>
        <input
        type="text"
        id="username"
        value="{{ old('username') }}"
        class="form-control"
        name="username"
        />
        @error('username')
        <small class="form-text text-muted" >{{ $message }}</small>
        @enderror
    </div>
    
    <div class="form-group @error('password') has-error @enderror has-feedback">
        <label for="password">Password</label>
        <input
        type="password"
        id="password"
        class="form-control"
        name="password"
        />
        @error('password')
        <small class="form-text text-muted" >{{ $message }}</small>
        @enderror
    </div>
    <button type="submit">masuk</button>
</form>