<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            border-spacing: 0;
            /* margin-bottom: 20px; */
        }

        table th,
        table td {
            padding: 5px;
        }
    </style>
</head>

<body>
    <header>
        <h2 style="text-align: center;">Berita Acara Evaluasi & Kualifikasi Supplier <br>Pengadaan Barang Asset</h2>
        <p style="text-align: justify;">Pada hari ini Senin, tanggal {{ date('d-M-Y') }}. Telah dilakukan evaluasi dan kualifikasi suppler terhadap :</p>
        <hr>
        <table>
            <tr>
                <td><strong>Name Proyek</strong></td>
                <td>:</td>
                <td>{{ $project->data_penawaran_name }}</td>
            </tr>
            <tr>
                <td><strong>Department / Cabang</strong></td>
                <td>:</td>
                <td>{{ $project->data_penawaran_cabang }}</td>
            </tr>
            <tr>
                <td><strong>Tujuan</strong> </td>
                <td>:</td>
                <td>{{ $project->data_penawaran_tujuan }}</td>
            </tr>
            <tr>
                <td><strong>Anggaran</strong> </td>
                <td>:</td>
                <td>@currency($project->data_penawaran_anggaran)</td>
            </tr>
        </table>
        <hr>
    </header>
    <p>Terhadap penawaran yang masuk telah dilakukan evaluasi :</p>
    <table border="1" style="width: 100%;">
        <thead>
            <tr>
                <th>Supplier</th>
                <th>Kualitas</th>
                <th>Harga</th>
                <th>Distribusi</th>
                <th>Purna-jual</th>
                <th>Total Point</th>
            </tr>
        </thead>
    </table>
    <p>Dari hasil evaluasi tersebut maka supplier yang mempunyai performance kinerja tertinggi adalah :</p>
    <table>
        <tr>
            <td>Nama Supplier</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Kontak Person </td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Anggaran </td>
            <td>:</td>
            <td></td>
        </tr>
    </table>
    <p>Telah dilakukan negosiasi dan hasilnya adalah sebagai berikut :</p>
    <table border="1" style="width: 100%;">
        <thead>
            <tr>
                <th>Proses Negosiasi</th>
                <th>Penawaran Supplier</th>
                <th>Penawaran Pramita</th>
            </tr>
        </thead>
    </table>
    <p>Dari hasil evaluasi & kualifikasi tersebut direkomendasikan bahwa ………………………….., sebagai Supplier Terpilih untuk pengadaan barang/jasa tersebut diatas.</p>
    <p style="text-align: center;">Team Kualifikasi</p>
    <br>
    <br><br>
    <table style="width: 100%;">
        <tr>
            <td>(………………………)</td>
            <td>(………………………)</td>
            <td>(………………………)</td>
            <td>(………………………)</td>
        </tr>
    </table>
</body>

</html>
