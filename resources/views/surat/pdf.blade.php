<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Sakit - {{ $surat->nama }}</title>
    <style>
        @page {
            margin: 0.5cm;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 0;
            padding: 0;
        }
        .border {
            border: 4px double #000;
            padding: 0;
            min-height: 95%;
        }
        .kop-gambar {
            text-align: center;
            padding: 5px 0;
        }
        .kop-gambar img {
            width: 98%;
            height: auto;
        }
        .horizontal-line {
            border-top: 4px double #000;
            margin: 0;
        }
        .content-wrapper {
            padding: 10px 15px;
        }
        .judul {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 14px;
            margin: 10px 0;
        }
        .isi {
            font-size: 12px;
            line-height: 1.6;
            text-align: justify;
        }
        .isi p {
            margin: 8px 0;
        }
        .data-table {
            width: 100%;
            margin-top: 8px;
            font-size: 12px;
        }
        .data-table td {
            padding: 3px 0;
            vertical-align: top;
        }
        .ttd-table {
            width: 100%;
            margin-top: 20px;
        }
        .qr-code {
            text-align: center;
        }
        .qr-code img {
            width: 70px;
            height: 70px;
        }
        .footer-note {
            margin-top: 10px;
            font-size: 7px;
            text-align: center;
        }
        .doc-number {
            font-size: 7px;
        }
    </style>
</head>
<body>
    <div class="border">
        <div class="kop-gambar">
            <img src="{{ public_path('images/kop-surat.png') }}" alt="Logo">
        </div>
        <div class="horizontal-line"></div>
        <div class="content-wrapper">
            <div class="judul">SURAT KETERANGAN SAKIT</div>
            <div class="isi">
                <p>Yang bertanda tangan di bawah ini, menerangkan bahwa:</p>
                <table class="data-table">
                    <tr>
                        <td style="width:90px;">Nama</td>
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
                <p style="text-indent: 25px;">
                    Saat ini dalam keadaan sakit dan membutuhkan istirahat selama satu (1) hari,
                    terhitung sejak tanggal {{ $surat->tanggal_surat->translatedFormat('d F Y') }}.
                </p>
                <p>Dipulangkan Jam: {{ $surat->jam_keluar_surat }} WITA</p>
                <p>Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
            </div>
            <table class="ttd-table">
                <tr>
                    <td style="width:50%; font-size:7px; vertical-align:bottom;">
                        PPA-HO-MAN-SHE-006
                    </td>
                    <td style="width:50%; text-align:center;">
                        <p style="margin:0 0 5px 0;">Girimulya, {{ $surat->tanggal_surat->translatedFormat('d F Y') }}</p>
                        <div class="qr-code">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=70x70&data={{ urlencode(route('surat.verify', $surat->short_code)) }}" alt="QR">
                        </div>
                        <p style="margin:5px 0 0 0;"><b>( {{ $surat->petugas }} )</b></p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer-note">
        Surat ini ditandatangani secara digital oleh petugas yang berwenang dan oleh karena itu tidak memerlukan tanda tangan basah.
    </div>
</body>
</html>
