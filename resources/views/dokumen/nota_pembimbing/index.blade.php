<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2cm;
        }
        .title {
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 30px;
        }
        .content {
            margin-top: 30px;
        }
        .details {
            margin-top: 20px;
        }
        .signature {
            margin-top: 40px;
            text-align: right;
        }
        .signature-name {
            margin-top: 80px;
            font-weight: bold;
        }
        .details-table td:first-child {
            width: 200px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">
            <h2>{{ $title }}</h2>
        </div>

        <div class="content">
            <p>Kepada Yth</p>
            <p>Direktur Program Pascasarjana</p>
            <p>Universitas Wahid Hasyim</p>
            <p>Di Semarang</p>

            <p>Assalamu’alaikum Wr. Wb</p>

            <p>
                Disampaikan dengan hormat setelah melakukan bimbingan koreksi dan penilaian terhadap naskah Proposal Tesis yang berjudul:
            </p>

            <p class="font-weight-bold">
                {{ $tesis->judul ?? 'Judul tidak ditemukan' }}
            </p>

            <p>Yang ditulis oleh:</p>

            <table class="table details-table">
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $mahasiswa->nama ?? 'Nama tidak ditemukan' }}</td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td>: {{ $mahasiswa->nim ?? 'NIM tidak ditemukan' }}</td>
                    </tr>
                    <tr>
                        <td>Program</td>
                        <td>: S1</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>: {{ $mahasiswa->prodi ?? 'Prodi tidak ditemukan' }}</td>
                    </tr>
                </tbody>
            </table>

            <p>
                Selanjutnya saya berpendapat bahwa Proposal Tesis tersebut sudah dapat diajukan ke Program Pascasarjana Universitas Wahid Hasyim untuk diujikan/disidangkan dalam rangka memperoleh gelar Magister Pendidikan.
            </p>

            <p>Wassalamu’alaikum Wr. Wb.</p>

            <div class="signature">
                <p>Semarang, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
                <p>Pembimbing</p>
                <p class="signature-name">{{ $dosenPembimbing->nama_pembimbing ?? 'Nama Pembimbing tidak ditemukan' }}</p>
                <p>NIP: {{ $dosenPembimbing->nip ?? 'NIP tidak ditemukan' }}</p>
            </div>
        </div>
    </div>
</body>
</html>
