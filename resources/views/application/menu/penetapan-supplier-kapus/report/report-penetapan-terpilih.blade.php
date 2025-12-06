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
        <h2 style="text-align: center;">Penetapan Supplier Terpilih</h2>
        <p style="text-align: justify;">Setelah menimbang dan memperhatikan hasil evaluasi dan kualifikasi berikut rekomendasi dari Tim Kualifikasi pengadaan :</p>
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
    <p>Maka bersama ini ditetapkan bahwa :</p>

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
    <p>Sebagai SUPPLIER TERPILIH untuk pengadaan barang sebagaimana diatas dengan kondisi sebagai berikut</p>
    <table>
        <tr>
            <td>Nama Barang</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Merk</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Type</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Jumlah </td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Harga </td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>System Pembayaran </td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Franco </td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Lama Pengiriman </td>
            <td>:</td>
            <td></td>
        </tr>
    </table>
    <p>Dari hasil evaluasi & kualifikasi tersebut direkomendasikan bahwa ………………………….., sebagai Supplier Terpilih untuk pengadaan barang/jasa tersebut diatas.</p>
    <br>
    <table style="width: 100%;">
        <tr>

            <td style="width: 60%;"></td>
            <td>
                Ditetapkan di Kantor Pusat. <br>
                {{ date('d-m-Y H:i:s')}}<br>
                Kepala Cabang / Direktur SDM & Umum <br>
                <br><br><br>
                (………………………)
            </td>
        </tr>
    </table>
</body>

</html>
