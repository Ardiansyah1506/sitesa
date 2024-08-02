<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Generator" content="Microsoft Word 15 (filtered)">
<style>
 /* Font Definitions */
 @font-face {
     font-family: "Cambria Math";
     panose-1: 2 4 5 3 5 4 6 3 2 4;
 }
 /* Style Definitions */
 h1 {
     margin-top: 0in;
     margin-right: 0in;
     margin-bottom: 0in;
     margin-left: 5.0pt;
     text-autospace: none;
     font-size: 12.0pt;
     font-family: "Times New Roman", serif;
 }

 p.MsoBodyText, li.MsoBodyText, div.MsoBodyText {
     margin: 0in;
     text-autospace: none;
     font-size: 12.0pt;
     font-family: "Times New Roman", serif;
 }

 .MsoChpDefault {
     font-family: "Calibri", sans-serif;
 }

 .MsoPapDefault {
     text-autospace: none;
 }

 @page WordSection1 {
     size: 595.5pt 842.0pt;
     margin: 68.0pt 66.0pt 14.0pt 67.0pt;
 }

 div.WordSection1 {
     page: WordSection1;
 }

 /* Custom Flexbox for justify-between */
 .justify-between {
     display: flex;
     justify-content: space-between;
     align-items: center; /* Align items vertically center */
     margin-bottom: 10px;
 }
</style>

</head>

<body lang=EN-US style='word-wrap:break-word'>

<div class=WordSection1>

<h1 align=center style='margin-top:3.1pt;margin-right:96.95pt;margin-bottom:0in;margin-left:96.3pt;margin-bottom:.0001pt;text-align:center'>
    <span lang=id>LEMBAR<span style='letter-spacing:-.25pt'> </span>PENGESAHAN<span style='letter-spacing:-.2pt'> </span>PROPOSAL<span style='letter-spacing:-.15pt'> </span>TESIS</span>
</h1>

<p class=MsoBodyText style='margin-top:.1pt'><b><span lang=id style='font-size:14.0pt'>&nbsp;</span></b></p>

<p class=MsoBodyText style='margin-top:0in;margin-right:5.85pt;margin-bottom:0in;margin-left:5.0pt;margin-bottom:.0001pt;text-align:justify;text-justify:inter-ideograph'>
    <span lang=id>Proposal<span style='letter-spacing:.05pt'> </span>Tesis<span style='letter-spacing:.05pt'> </span>dengan<span style='letter-spacing:.05pt'> </span>{{ $judul }}<span style='letter-spacing:.05pt'> </span>judul<span style='letter-spacing:-.05pt'> </span>atas nama {{ $nama }}
</p>

<p class=MsoBodyText style='margin-top:0in;margin-right:6.0pt;margin-bottom:0in;margin-left:5.0pt;margin-bottom:.0001pt;text-align:justify;text-justify:inter-ideograph'>
    <span lang=id>(NIM: {{ $nim }}) mahasiswa {{$prodi}}, telah<span style='letter-spacing:.05pt'> </span>diujikan<span style='letter-spacing:-.2pt'> </span>pada<span style='letter-spacing:.05pt'> </span>tanggal:</span>
</p>

<h1 align=center style='margin-top:8.05pt;margin-right:97.3pt;margin-bottom:0in;margin-left:96.3pt;margin-bottom:.0001pt;text-align:center'>
    <span lang=id>{{ Carbon\Carbon::parse($tanggal)->locale('id')->translatedFormat('l, d F Y') }}<span style='letter-spacing:-.05pt'> </span></h1>

<p class=MsoBodyText style='margin-top:7.9pt;margin-right:0in;margin-bottom:0in;margin-left:5.0pt;margin-bottom:.0001pt'>
    <span lang=id>Dinyatakan<span style='letter-spacing:1.05pt'> </span>layak<span style='letter-spacing:1.1pt'> </span>sebagai<span style='letter-spacing:.95pt'> </span>salah<span style='letter-spacing:1.1pt'> </span>satu<span style='letter-spacing:1.1pt'> </span>syarat<span style='letter-spacing:1.05pt'> </span>untuk<span style='letter-spacing:.95pt'> </span>melakukan<span style='letter-spacing:1.15pt'> </span>penelitian<span style='letter-spacing:.95pt'> </span>dan<span style='letter-spacing:1.1pt'> </span>penulisan<span style='letter-spacing:1.05pt'> </span>Tesis <span style='letter-spacing:-2.85pt'> </span>pada Program Pacasarjana Universitas Wahid Hasyim<span style='letter-spacing:-.05pt'> </span>Semarang.</span>
</p>

<p class=MsoBodyText><span lang=id style='font-size:13.0pt'>&nbsp;</span></p>

<p class=MsoBodyText align=right style='margin-top:8.0pt;margin-right:5.25pt;margin-bottom:0in;margin-left:0in;margin-bottom:.0001pt;text-align:right'>
    <span lang=id>Semarang,<span style='letter-spacing:.05pt'> </span>{{ Carbon\Carbon::parse($tanggal)->locale('id')->translatedFormat('d F Y') }}</span>
</p>

<p class=MsoBodyText style='margin-top:.45pt'><span lang=id style='font-size:14.5pt'>&nbsp;</span></p>

<h1><span lang=id>Tim<span style='letter-spacing:-.3pt'> </span>Penguji:</span></h1>

<div class="justify-between">
    <p class=MsoBodyText>{{$penguji1}}</p>
    <p class=MsoBodyText>(........................................................... )</p>
</div>
<p class=MsoBodyText><span lang=id>(Ketua/Penguji I)</span></p>

<p class=MsoBodyText><span lang=id style='font-size:13.0pt'>&nbsp;</span></p>

<div class="justify-between">
    <p class=MsoBodyText>Dr. {{ $penguji2 }}</p>
    <p class=MsoBodyText>(................................................ )</p>
</div>
<p class=MsoBodyText><span lang=id>(Anggota/Penguji II)</span></p>

<p class=MsoBodyText><span lang=id style='font-size:13.0pt'>&nbsp;</span></p>

<h1><span lang=id>Dosen<span style='letter-spacing:-.15pt'> </span>Pembimbing:</span></h1>

<div class="justify-between">
    <p class=MsoBodyText>{{$pembimbing1}}</p>
    <p class=MsoBodyText>(........................................................... )</p>
</div>
<p class=MsoBodyText><span lang=id>(Dosen Pembimbing I)</span></p>

<p class=MsoBodyText><span lang=id style='font-size:13.0pt'>&nbsp;</span></p>

<div class="justify-between">
    <p class=MsoBodyText>Dr. {{$pembimbing2}}</p>
    <p class=MsoBodyText>(................................................ )</p>
</div>
<p class=MsoBodyText><span lang=id>(Dosen Pembimbing II)</span></p>

<p class=MsoBodyText><span lang=id style='font-size:13.0pt'>&nbsp;</span></p>

<p class=MsoBodyText><span lang=id style='font-size:13.0pt'>&nbsp;</span></p>

<p class=MsoBodyText><span lang=id style='font-size:12.5pt'>&nbsp;</span></p>

<p class=MsoBodyText align=center style='margin-top:.05pt;margin-right:211.6pt;margin-bottom:0in;margin-left:145.6pt;margin-bottom:.0001pt;text-align:center;text-indent:-.05pt'>
    <span lang=id>Mengesahkan,<span style='letter-spacing:.05pt'> </span>Direktur<span style='letter-spacing:-.6pt'> </span>Pascasarjana</span>
</p>

<p class=MsoBodyText><span lang=id style='font-size:13.0pt'>&nbsp;</span></p>

<p class=MsoBodyText><span lang=id style='font-size:13.0pt'>&nbsp;</span></p>

<p class=MsoBodyText><span lang=id style='font-size:13.0pt'>&nbsp;</span></p>

<p class=MsoBodyText><span lang=id style='font-size:13.0pt'>&nbsp;</span></p>

<p class=MsoBodyText align=center style='margin-top:9.2pt;margin-right:162.2pt;margin-bottom:0in;margin-left:96.3pt;margin-bottom:.0001pt;text-align:center'>
    <u><span lang=id>{{ $direkturPascaSarjana ?? 'nama direkur pasca sarjana' }}</span></u><span lang=id style='letter-spacing:-2.85pt'> </span><span lang=id>NIP.<span style='letter-spacing:-.2pt'> </span>{{ $nipDirekturPascaSarjana ?? 'nip direktur pasca sarjana' }}</span>
</p>

</div>

</body>

</html>
