<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ url('') }}/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ url('') }}/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="{{ url('') }}/assets/css/kaiadmin.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('') }}/assets/css/style.css" />
    <link rel="stylesheet" href="{{ url('') }}/assets/css/styles.css" />
    <title>Surat Resmi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header img {
            max-width: 50px;
        }
        .header h1 {
            font-size: 14px;
            margin: 0;
        }
        .header p {
            font-size: 10px;
            margin: 0;
        }
        .content {
            margin-bottom: 10px;
        }
        .content .date {
            text-align: right;
            margin-bottom: 5px;
        }
        .content .recipient {
            margin-bottom: 5px;
        }
        .content .body {
            margin-bottom: 5px;
        }
        .content .closing {
            margin-bottom: 5px;
        }
        .content .signature {
            text-align: right;
            margin-top: 10px;
        }
        .content .signature .name {
            margin-top: 15px;
            margin-bottom: 0;
        }
        .wide-column {
            width: 2%; /* Set each column to take up 25% of the table's width */
        }
        
        .nama-penguji {
            margin-top: 30px;
        }
        @media (max-width: 768px) {
            body {
                margin: 10px;
            }
            .wide-column {
                width: auto;
            }
        }
        @media print {
            body {
                margin: 0;
                font-size: 10px;
            }
            .header {
                margin-bottom: 5px;
            }
            .header h1 {
                font-size: 12px;
            }
            .header p {
                font-size: 8px;
            }
            .content {
                margin-bottom: 5px;
            }
            .content .date, .content .recipient, .content .body, .content .closing {
                margin-bottom: 5px;
            }
            .nama-penguji {
                margin-top: 15px;
            }
            .signature {
                margin-top: 5px;
            }
            .signature .name {
                margin-top: 10px;
            }
            .ukuran {
                height: 100vh;
            }
            *, html, body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="col-12 ukuran">
        <div class="row d-flex flex-column justify-content-center align-items-center">
            <div class="border col-md-10 col-lg-9 d-flex flex-column justify-content-center align-items-center">


                <div class="header d-flex gap-5">
                    <div class="logo">
                        <img src="{{ asset('assets/img/logo-untuk-pdf-removebg-preview.png') }}" alt="Logo">
                    </div>
                    <div class="profile">
                        <h6 class="mb-0">UNIVERSITAS WAHID HASYIM SEMARANG</h6>
                        <small>Jl. Menoreh Tengah X / 22 Sampangan - Semarang 50236 Telp.(024) 8505680 - 8505681 Fax. (024) 8315785</small>
                    </div>
                </div>
                <p class="col-11 py-0 bg-dark mb-3">s</p>
                
                <div class="content col-10">
                    <div class="text-header text-center mb-4">
                        <p class="mb-0 d-block">UNIVERSITAS WAHID HASYIM SEMARANG</p>
                        <p class="mb-0 d-block">PROGRAM PASCASARJANA</p>
                        <p class="mb-5 d-block">UJIAN PROPOSAL TESIS</p>
                        <p class="fw-bold d-block">BERITA ACARA</p>
                    </div>
                    
                    <div class="recipient">
                        <p class="mb-0">Bismillahir Rahmaanorrahim</p>
                        <p class="mb-0">Pada hari ini, Rabu dua belas Juni tahun dua ribu dua puluh empat, bertempat di</p>
                        <p class="d-block">Universitas Wahid Hasyim Semarang telah diujikan proposal tesis mahasiswa:</p>
                    </div>
                    
                    <div class="body">
                        <table class="">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>
                                    
                                        << nama >>
                                    
                                </td>
                                    
                            </tr>
                            <tr>
                                <td>NIM</td>
                                <td>:</td>
                                <td><< nim >></td>
                            </tr>
                            <tr>
                                <td>Program Studi</td>
                                <td>:</td>
                                <td><< prodi >></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td><< tanggal >></td>
                            </tr>
                            <tr>
                                <td>Judul</td>
                                <td>:</td>
                                <td><< judul >></td>
                            </tr>
                            <tr>
                                <td>Pembimbing</td>
                                <td>:</td>
                                <td><< pembimbing 1 >></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><< pembimbing 2 >></td>
                            </tr>
                        </table>
                    </div>
                
                <div class="closing">
                    <p class="mb-0">Setelah memperhatikan nilai dari para penguji, maka yang bersangkutan dinyatakan</p>
                    <p class="mb-0">......................... dengan predikat .............................</p>
                </div>

                <p>Adapun rincian Nilai Komulatif :</p>

                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="wide-column text-center"><small>Penguji 1</small></td>
                                <td class="wide-column text-center"><small>Penguji 2</small></td>
                                <td class="wide-column text-center"><small>Pembimbing 1</small></td>
                                <td class="wide-column text-center"><small>Pembimbing 2</small></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border" height="60px"></td>
                                <td class="border"></td>
                                <td class="border"></td>
                                <td class="border"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="signature">
                    <p class="d-block mb-0">Semarang, << D M Y >></p>
                </div>
                <p class="text-center d-block">Dewan Penguji</p>
                
                <div class="row">
                    <div class="col text-center">
                        <p class="d-block">Penguji 1</p>
                        <p class="nama-penguji d-block"><< nama penguji 1 >></p>
                    </div>
                    <div class="col text-center">
                        <p class="d-block">Penguji 2</p>
                        <p class="nama-penguji d-block"><< nama penguji 2 >></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <p class="d-block">Pembimbing 1</p>
                        <p class="nama-penguji d-block"><< nama pembimbing 1 >></p>
                    </div>
                    <div class="col text-center">
                        <p class="d-block">Pembimbing 2</p>
                        <p class="nama-penguji d-block"><< nama pembimbing 2 >></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<!--   Core JS Files   -->
<script src="{{ url('') }}/assets/js/core/jquery-3.7.1.min.js"></script>
<script src="{{ url('') }}/assets/js/core/popper.min.js"></script>
<script src="{{ url('') }}/assets/js/core/bootstrap.min.js"></script>

<!-- Bootstrap Notify -->
<script src="{{ url('') }}/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- jQuery UI -->
<script src="{{ url('') }}/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="{{ url('') }}/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- Bootstrap Toggle -->
<script src="{{ url('') }}/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>

<!-- SweetAlert -->
<script src="{{ url('') }}/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="{{ url('') }}/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<script src="{{ url('') }}/assets/js/atlantis2.min.js"></script>
