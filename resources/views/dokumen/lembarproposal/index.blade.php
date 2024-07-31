<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembar Pengesahan Proposal Tesis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            font-size: 15px;
            margin: 40px;
        }
        .container {
            max-width: 800px;
            margin: auto;
        }
        h3, p {
            text-align: center;
        }
        .signature-section {
            margin-top: 40px;
        }
        .text-end {
            text-align: right;
        }
        table {
            width: 100%;
            margin-top: 20px;
        }
        td {
            vertical-align: top;
            padding: 10px;
        }
        .sign-name {
            width: 60%;
        }
        .sign-line {
            width: 40%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>LEMBAR PENGESAHAN PROPOSAL TESIS</h3>
        <p>
            Proposal Tesis dengan judul “<strong>{{ $judul }}</strong>” atas nama {{ $author }} (NIM: {{ $nim }}) mahasiswa Program Studi Magister Pendidikan Agama Islam, telah diujikan pada tanggal:
        </p>
        <p>{{ $date }}</p>
        <p>Dinyatakan layak sebagai salah satu syarat untuk melakukan penelitian dan penulisan Tesis pada Program Pascasarjana Universitas Wahid Hasyim Semarang.</p>
        <div class="signature-section">
            <p class="text-end">Semarang, {{ $date }}</p>
            <table>
                <tr>
                    <td class="sign-name">{{ $examiners[0] }}<br>(Ketua/Penguji I)</td>
                    <td class="sign-line">(...............................................)</td>
                </tr>
                <tr>
                    <td class="sign-name">{{ $examiners[1] }}<br>(Anggota/Penguji II)</td>
                    <td class="sign-line">(...............................................)</td>
                </tr>
                <tr>
                    <td class="sign-name">{{ $supervisors[0] }}<br>(Dosen Pembimbing I)</td>
                    <td class="sign-line">(...............................................)</td>
                </tr>
                <tr>
                    <td class="sign-name">{{ $supervisors[1] }}<br>(Dosen Pembimbing II)</td>
                    <td class="sign-line">(...............................................)</td>
                </tr>
            </table>
            <br><br>
            <p class="text-center">Mengesahkan,<br>Direktur Pascasarjana</p>
            <br><br>
            <p class="text-center">{{ $director }}<br>NPP. 01.99.0.0005</p>
        </div>
    </div>
</body>
</html>
