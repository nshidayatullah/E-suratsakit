<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verifikasi Surat Sakit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 30px;
            max-width: 500px;
            width: 100%;
            text-align: center;
        }
        .valid {
            border-top: 5px solid #4CAF50;
        }
        .invalid {
            border-top: 5px solid #f44336;
        }
        .icon {
            font-size: 60px;
            margin-bottom: 20px;
        }
        .icon.success {
            color: #4CAF50;
        }
        .icon.error {
            color: #f44336;
        }
        h1 {
            margin: 0 0 20px 0;
            font-size: 24px;
        }
        .info {
            text-align: left;
            margin-top: 20px;
        }
        .info table {
            width: 100%;
            border-collapse: collapse;
        }
        .info td {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .info td:first-child {
            font-weight: bold;
            width: 120px;
            color: #666;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    @if($valid)
    <div class="card valid">
        <div class="icon success">✓</div>
        <h1>Surat Sakit Valid</h1>
        <p>Surat keterangan sakit ini terdaftar dan sah.</p>
        
        <div class="info">
            <table>
                <tr>
                    <td>Kode</td>
                    <td>: {{ $surat->short_code }}</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>: {{ $surat->nama }}</td>
                </tr>
                <tr>
                    <td>Departemen</td>
                    <td>: {{ $surat->departemen }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>: {{ $surat->tanggal_surat->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td>Petugas</td>
                    <td>: {{ $surat->petugas }}</td>
                </tr>
            </table>
        </div>
        
        <a href="{{ route('surat.cetak', $surat->short_code) }}" class="btn">Lihat Surat</a>
    </div>
    @else
    <div class="card invalid">
        <div class="icon error">✗</div>
        <h1>Surat Tidak Valid</h1>
        <p>Kode surat tidak ditemukan dalam sistem.</p>
    </div>
    @endif
</body>
</html>
