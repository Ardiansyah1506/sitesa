<!DOCTYPE html>
<html>
<head>
    <title>Import Mahasiswa</title>
</head>
<body>
    <h1>Import Mahasiswa</h1>

    @if ($errors->any())
        <div>
            <h3>Errors:</h3>
            <ul>
                @foreach ($errors as $error)
                    <li>Row {{ $error['row'] }}: {{ implode(', ', $error['errors']) }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div>
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Import</button>
    </form>
</body>
</html>
