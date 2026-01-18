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
@php
$no_cabang = DB::table('master_cabang_no')->where('master_cabang_no_code',Auth::user()->access_cabang)->first();
$no_document = DB::table('log_master')->where('log_master_cabang',Auth::user()->access_cabang)->get();
$nourut = 1;
@endphp
@if ($no_cabang)
@php
$nocabang = $no_cabang->master_cabang_nomor;
@endphp
@else
@php
$nocabang = 'XX';
@endphp
@endif
@foreach ($no_document as $no_documents)

@if ($no_documents->log_master_code == $code)
@php
$no_fix = $nourut++;
$no_fix = str_pad($no_fix, 3, '0', STR_PAD_LEFT)
@endphp
@else
@php
$nourut++;
@endphp
@endif

@endforeach

<body>
    <header class="clearfix" style="padding-bottom: 0px;">
        <div id="company">
            <h5 class="name"><strong>SDM.{{$nocabang}}-FRM-PP-08/05</strong></h5>
        </div>
    </header>
    <main style="padding-top: 0px;">
        <table style="width: 100%;" border="0">
            <tr>
                <td style="text-align: center;" colspan="2">
                    <h2 style="margin: 0px;"><strong>SURAT KEPUTUSAN</strong></h2>
                    <p style="margin: 0px;">NO : {{$no_fix}}/CAB.{{$nocabang}}/SK/I/{{$tahun->log_master_periode+1}}</p>

                </td>
            </tr>
            <tr>
                <td style="text-align: center;" colspan="2">
                    <h3>
                        DAFTAR SUPPLIER TERPILIH
                        LABORATORIUM MEDIS & KLINIK {{$cabang->master_cabang_name}}
                    </h3>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h4>Kepala Cabang Laboratorium Medis & Klinik {{$cabang->master_cabang_name}}, setelah :</h4>
                </td>
            </tr>
            <tr style>
                <td style="vertical-align:top; width: 25%;">
                    <h5 style="margin: 0px;">MENIMBANG :</h5>
                </td>
                <td style="text-align: justify;">
                    <p style="margin: 0px;">1. Bahwa untuk menjamin kelancaran operasional laboratorium dan klinik,
                        demi terwujudnya kualitas pelayanan dan hasil diagnosis yang bermutu
                        tinggi maka perlu dilakukannya penetapan terhadap Supplier Terpilih
                        yang memiliki kualitas barang dan pelayanan yang baik.
                    </p>
                    <p style="margin: 0px;"> 2. Perlu ditetapkan pemilihan supplier di antara supplier yang dievaluasi
                    </p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top;">
                    <h5 style="margin: 0px;">MEMPERHATIKAN : </h5>
                </td>
                <td>
                    <p style="margin: 0px;">1. Visi dan Misi Laboratorium Medis dan Klinik Pramita </p>
                    <p style="margin: 0px;">2. Kebijakan Mutu Laboratorium Medis dan Klinik Pramita </p>
                </td>
            </tr>
            <tr>
                <td style="text-align: center;" colspan="2">
                    <h2 tyle="margin: 0px;">MEMUTUSKAN</h2>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top;">
                    <h5 style="margin: 0px;">MENETAPKAN : </h5>
                </td>
                <td>
                    <p style="margin: 0px;">1. Daftar Supplier Terpilih tahun {{$tahun->log_master_periode+1}} dengan
                        daftar terlampir.</p>
                    <p style="margin: 0px;">2. Keputusan ini berlaku sejak tanggal ditetapkannya untuk jangka waktu 1 (
                        satu ) tahun.</p>
                    <p style="margin: 0px;">3. Bilamana di kemudian hari terdapat kekeliruan dalam surat keputusan ini,
                        maka akan dilakukan
                        peninjauan seperlunya.</p>
                </td>
            </tr>
        </table>
        <table style="width: 100%; padding-top: 50px;" border="0">
            <tr>
                <td></td>
                <td style="width: 40%;">
                    <p style="margin: 0px;">{{$cabang->master_cabang_name}}, {{date('d-m-Y')}}</p>
                    <p style="margin: 0px;">Kepala Cabang</p>
                    <br><br><br><br>
                    <p>{{$tahun->log_master_kacab}}</p>
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
