<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Sakit - {{ $surat->nama }}</title>
    <style>
        @page {
            size: A5 portrait;
            margin: 0.7cm;
        }
        body {
            font-family: Arial, sans-serif;
            background: #ffffff;
            color: #000;
            margin: 0;
            padding: 0;
        }
        .card {
            width: 100%;
            box-sizing: border-box;
        }
        .border {
            border: 6px double #000;
            padding: 0;
            min-height: 500px;
        }
        .kop-gambar {
            margin: 0;
            padding: 2px 0 0 0;
            text-align: center;
        }
        .kop-gambar img {
            width: 99%;
            height: auto;
            display: block;
            margin: 0 auto;
            padding: 0;
        }
        .horizontal-line {
            width: 100%;
            height: 4px;
            border-top: 6px double #000;
            margin: 0;
        }
        .content-wrapper {
            padding: 0.5cm;
        }
        .judul {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 18px;
            margin: 12px 0;
        }
        .isi {
            font-size: 14px;
            line-height: 1.8;
            text-align: justify;
        }
        .isi p {
            margin: 10px 0;
        }
        .data-table {
            margin-top: 10px;
            font-size: 14px;
            width: 100%;
            line-height: 1.7;
            border-collapse: collapse;
        }
        .data-table td {
            padding: 4px 4px;
            vertical-align: top;
        }
        .qr-kecil {
            margin: 5px 0;
            display: inline-block;
        }
        .ttd-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .ttd-table td {
            padding: 0;
        }
        .footer-note {
            margin-top: 0px;
            font-size: 8px;
            text-align: center;
            color: #000000;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="border">
            <div class="kop-gambar">
                <img src="{{ public_path('images/kop-surat.png') }}" alt="Logo PPA">
            </div>
            <div class="horizontal-line"></div>
            <div class="content-wrapper">
                <div class="judul">SURAT KETERANGAN SAKIT</div>
                <div class="isi">
                    <p>Yang bertanda tangan di bawah ini, menerangkan bahwa:</p>
                    <table class="data-table">
                        <tr>
                            <td style="width:100px;">Nama</td>
                            <td style="width:10px;">:</td>
                            <td>{{ $surat->nama }}</td>
                        </tr>
                        <tr>
                            <td>Umur</td>
                            <td>:</td>
                            <td>{{ $surat->umur }} Tahun</td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td>{{ $surat->jabatan }}</td>
                        </tr>
                        <tr>
                            <td>Departemen</td>
                            <td>:</td>
                            <td>{{ $surat->departemen }}</td>
                        </tr>
                        <tr>
                            <td>Keluhan</td>
                            <td>:</td>
                            <td>{{ $surat->keluhan }}</td>
                        </tr>
                    </table>
                    <p style="text-indent: 30px;">
                        Saat ini dalam keadaan sakit dan membutuhkan istirahat selama satu (1) hari,
                        terhitung sejak tanggal {{ $surat->tanggal_surat->translatedFormat('d F Y') }}.
                    </p>
                    <p>Dipulangkan Jam: {{ \Carbon\Carbon::parse($surat->jam_keluar_surat)->format('H:i') }} WITA</p>
                    <p>Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
                </div>
                <table class="ttd-table">
                    <tr>
                        <td style="width:50%; font-size:8px; text-align:left; vertical-align:bottom;">
                            PPA-HO-MAN-SHE-006
                        </td>
                        <td style="width:50%; text-align:center; font-size:14px;">
                            <p style="margin:0 0 5px 0;">Girimulya, {{ $surat->tanggal_surat->translatedFormat('d F Y') }}</p>
                            <div class="qr-kecil">
                                <img src="data:image/png;base64,{!! base64_encode(QrCode::format('png')->size(200)->generate(route('surat.verify', $surat->short_code))) !!}" alt="QR" style="width:80px; height:80px;">
                            </div>
                            <p style="margin:5px 0 0 0;"><b>( {{ $surat->petugas }} )</b></p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="footer-note">
            <p>Surat ini ditandatangani secara digital oleh petugas yang berwenang dan oleh karena itu tidak memerlukan tanda tangan basah.</p>
        </div>
    </div>
</body>
</html>
