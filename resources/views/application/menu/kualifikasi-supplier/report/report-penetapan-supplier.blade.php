<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Document Rekap</title>
    <link rel="stylesheet" href="style.css" media="all" />
</head>
<style>
    @font-face {
        font-family: SourceSansPro;
        src: url(SourceSansPro-Regular.ttf);
    }

    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }

    a {
        color: #0087C3;
        text-decoration: none;
    }

    body {
        position: relative;
        width: 100%;
        height: 100%;
        margin: 0 auto;
        color: #000000ff;
        background: #FFFFFF;
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-family: SourceSansPro;
    }

    header {
        padding: 10px 0;
        margin-bottom: 20px;
        /* border-bottom: 1px solid #0b0909; */
    }

    #logo {
        float: left;
        margin-top: 8px;
    }

    #logo img {
        height: 70px;
    }

    #company {
        float: right;
        text-align: right;
        color: black;
    }


    #details {
        padding: 10px;
        border: 2px solid #0b0909;
        border-style: solid solid dashed double;
        margin-bottom: 10px;
    }

    #client {
        padding-left: 6px;
        border-left: 6px solid #db3311;
        float: left;
    }

    #client .to {
        color: #777777;
    }

    h2.name {
        font-size: 1.4em;
        font-weight: normal;
        margin: 0;
    }

    #invoice {
        padding-top: 0;
        float: right;
        text-align: right;
    }

    #invoice span {
        font-size: 1.2rem;
    }

    #invoice h1 {
        color: #db3311;
        font-size: 2.4em;
        /* line-height: 1em; */
        font-weight: normal;
        margin: 0 0 10px 0;
    }

    #invoice .date {
        font-size: 1.1em;
        color: #777777;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        /* margin-bottom: 20px; */
    }

    table th,
    table td {
        padding: 5px;
        /* background: #EEEEEE; */
        text-align: center;
        /* border-bottom: 1px solid #000000; */
    }

    table th {
        white-space: nowrap;
        font-weight: normal;
        background: #b90303;
        color: white;
    }

    table td {
        text-align: left;
    }

    table td h3 {
        color: #000000ff;
        font-size: 1.2em;
        font-weight: normal;
        margin: 0 0 0.2em 0;
    }

    table .no {
        color: #FFFFFF;
        font-size: 1.6em;
        text-align: center;
        background: #db3311;
    }

    table .desc {
        text-align: left;
    }

    table .unit {
        background: #DDDDDD;
    }

    table .qty {
        text-align: center;
    }

    table .total {
        background: #eaebe3;
        color: #ff0404;
    }

    table td.unit,
    table td.qty,
    table td.total {
        font-size: 1.2em;
    }

    /* table tbody tr:last-child td {
        border: none;
    } */

    table tfoot td {
        padding: 10px 20px;
        background: #FFFFFF;
        /* border-bottom: none; */
        font-size: 1.2em;
        white-space: nowrap;
        /* border-top: 1px solid #AAAAAA; */
    }

    /* table tfoot tr:first-child td {
        border-top: none;
    } */

    table tfoot tr:last-child td {
        color: #db3311;
        font-size: 1.4em;
        border-top: 1px solid #db3311;

    }

    /* table tfoot tr td:first-child {
        border: none;
    } */

    #thanks {
        font-size: 2em;
        margin-bottom: 50px;
    }

    #notices {
        position: absolute;
        bottom: 0;
        padding-left: 6px;
        border-left: 6px solid #db3311;
    }

    #no_surat {
        margin-top: -20px;
    }

    #notices .notice {
        font-size: 1.0em;
    }

    footer {
        color: #777777;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #AAAAAA;
        padding: 8px 0;
        text-align: center;
    }
</style>

<body>
    <header class="clearfix" style="padding-bottom: 0px;">
        <div id="company">
            <h5 class="name"><strong>SDM.XX-FRM-PP-08/05</strong></h5>
        </div>
    </header>
    <main style="padding-top: 0px;">
        <table style="width: 100%;" border="0">
            <tr>
                <td style="text-align: center;" colspan="3">
                    <h2 style="margin: 0px;"><strong>SURAT PENETAPAN SUPPLIER</strong></h2>
                    <p style="margin: 0px;">NO : XXX/CAB.XX/SK/I/123</p>

                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <h3>
                        Berdasarkan hasil evaluasi kualifikasi yang telah dilakukan oleh Tim Kualifikasi, dengan ini
                        menetapkan :
                    </h3>
                </td>
            </tr>
            <tr style>
                <td style="vertical-align:top; width: 35%;">
                    <h4 style="margin: 0px;">Nama Perusahaan Supplier </h4>
                </td>
                <td style="width: 10px;">:</td>
                <td style="text-align: justify;">
                    {{ $data->m_supplier_name }}
                </td>
            </tr>
            <tr style>
                <td style="vertical-align:top; width: 35%;">
                    <h4 style="margin: 0px;">Alamat</h4>
                </td>
                <td style="width: 10px;">:</td>
                <td style="text-align: justify;">
                    {{ $data->m_supplier_alamat }}
                </td>
            </tr>
            <tr style>
                <td style="vertical-align:top; width: 35%;">
                    <h4 style="margin: 0px;">Nomor NPWP/Legalitas </h4>
                </td>
                <td style="width: 10px;">:</td>
                <td style="text-align: justify;">
                    {{ $data->m_supplier_data_npwp }}
                </td>
            </tr>
            <tr style>
                <td style="vertical-align:top; width: 35%;">
                    <h4 style="margin: 0px;">Kontak Person </h4>
                </td>
                <td style="width: 10px;">:</td>
                <td style="text-align: justify;">
                    {{ $data->m_supplier_data_contact }}
                </td>
            </tr>
            <tr style>
                <td style="vertical-align:top; width: 35%;">
                    <h4 style="margin: 0px;">Nomor Contact</h4>
                </td>
                <td style="width: 10px;">:</td>
                <td style="text-align: justify;">
                    {{ $data->m_supplier_phone }}
                </td>
            </tr>
            <tr style>
                <td style="vertical-align:top; width: 35%;">
                    <h4 style="margin: 0px;">Alamat email</h4>
                </td>
                <td style="width: 10px;">:</td>
                <td style="text-align: justify;">
                    {{ $data->m_supplier_email }}
                </td>
            </tr>
        </table>
        <br><br>
        <table style="width: 100%;" border="0">
            <tr>
                <td style="text-align: center;" colspan="3">
                    <h3 style="margin: 0px;"><strong>DITETAPKAN SEBAGAI SUPPLIER DI PRAMITA</strong></h3>
                </td>
            </tr>
            <tr>
                <td colspan="3">

                </td>
            </tr>
            <tr style>
                <td style="vertical-align:top; width: 35%;">
                    <h3>Untuk Pengadaan Berupa</h3>
                </td>
                <td style="vertical-align:top;width: 10px;"></td>
                <td style="text-align: justify;">
                    @foreach ($type as $types)
                        <li>{{ $types->type_pengadaan_name }}</li>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    Keputusan ini berlaku sejak tanggal ditetapkan sampai dengan adanya penetapan baru.
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    Bandung , {{date('d-m-Y')}}
                </td>
            </tr>
            <tr>
                <td colspan="3">

                </td>
            </tr>
            <tr>
                <td colspan="3">

                </td>
            </tr>
            <tr>
                <td style="text-align: center;" colspan="3">
                    Team Kualifikasi
                </td>
            </tr>
        </table>
        <table style="width: 100%; padding-top: 50px;" border="0">
            <tr>

                <td style="width: 30%;">
                    <p style="margin: 0px;"></p>
                    <p style="margin: 0px;">Bag Pengadaan</p>
                    <br><br><br><br>
                    <p> {{ $data->m_supplier_data_pgd }}</p>
                </td>
                <td style="width: 30%;">
                    <p style="margin: 0px;"></p>
                    <p style="margin: 0px;">Manager SDM & Umum</p>
                    <br><br><br><br>
                    <p>{{ $data->m_supplier_data_mgr }}</p>
                </td>
                <td style="width: 30%;">
                    <p style="margin: 0px;"></p>
                    <p style="margin: 0px;">Kepala Cabang</p>
                    <br><br><br><br>
                    <p>{{ $data->m_supplier_data_kacab }}</p>
                </td>
            </tr>
        </table>

        {{-- <div id="thanks">Thank you!</div> --}}
        <div id="notices">

            <!-- <img style="padding-top: 1px; left: 10px;"
                src="data:image/png;base64, {!! base64_encode(QrCode::style('round')->format('svg')->size(70)->errorCorrection('H')->generate(123)) !!}"> -->


            <div class="notice">Dokumen Tidak Bisa di Ubah</div>
        </div>
    </main>
</body>

</html>
