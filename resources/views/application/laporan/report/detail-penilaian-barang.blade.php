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
        <h3 style="text-align: center; margin: 5px;">LAMPIRAN DETAIL PENILAIAN SUPPLIER</h3>
        <h3 style="text-align: center; margin: 5px;">DAFTAR SUPPLIER TERPILIH PER JENIS BARANG TAHUN {{$periode->log_master_periode}}</h3>
        <table id="example" class="table table-striped border" style="width:100%; font-size: 10px;" border="1">
            <thead class="">
                <tr>
                    <th rowspan="2">NO</th>
                    <th rowspan="2" class="text-center">NAMA BARANG</th>
                    <th colspan="4" class="text-center">ALTERNATIF SUPPLIER</th>

                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($brg as $brgs)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $brgs->m_barang_name }}</td>
                    @php
                    $suplier = DB::table('data_supp_brg_cab')
                    ->join('m_supplier', 'm_supplier.m_supplier_code', '=', 'data_supp_brg_cab.m_supplier_code')
                    ->where('data_supp_brg_cab.m_barang_code', $brgs->m_barang_code)
                    ->where('data_supp_brg_cab.log_master_code', $periode->log_master_code)
                    ->where('data_supp_brg_cab.master_cabang_code', Auth::user()->access_cabang)
                    ->orderBy('data_supp_brg_cab.data_supp_brg_cab_score', 'DESC')->get();
                    @endphp
                    @foreach ($suplier as $sup)
                    <td><b style="color: red;">{{ $sup->m_supplier_name }}</b> ( <strong class="text-primary">{{ $sup->data_supp_brg_cab_score }}</strong> )
                        <table>
                            <tr>
                                @foreach ($cat as $cats)
                                <th><small>{{$cats->t_penilaian_cat_name}} {{ $cats->t_penilaian_cat_score }}</small></th>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($cat as $cats)
                                @php
                                $point = DB::table('log_penilaian_cab')
                                ->join('t_penilaian_detail','t_penilaian_detail.t_penilaian_detail_code','=','log_penilaian_cab.t_penilaian_detail_code')
                                ->join('t_penilaian_cat','t_penilaian_cat.t_penilaian_cat_code','=','t_penilaian_detail.t_penilaian_cat_code')
                                ->where('log_penilaian_cab.m_barang_code',$brgs->m_barang_code)
                                ->where('log_penilaian_cab.log_master_code',$periode->log_master_code)
                                ->where('log_penilaian_cab.m_supplier_code',$sup->m_supplier_code)
                                ->where('t_penilaian_cat.t_penilaian_cat_code',$cats->t_penilaian_cat_code)
                                ->where('log_penilaian_cab.master_cabang_code',Auth::user()->access_cabang)
                                ->where('t_penilaian_detail.t_penilaian_detail_type','option')
                                ->sum('log_penilaian_cab.log_penilaian_cab_score');
                                @endphp

                                <td>{{ $point }}</td>

                                @endforeach
                            </tr>
                        </table>
                        Note :
                        @php
                        $note = DB::table('log_penilaian_cab_desc')
                        // ->where('m_barang_code',$brgs->m_barang_code)
                        ->where('log_master_code',$periode->log_master_code)
                        ->where('m_supplier_code',$sup->m_supplier_code)
                        ->get();
                        @endphp
                        @foreach ($note as $notes)
                        @if ($notes->log_penilaian_cab_desc_text != "")
                        <li style="margin-left: 10px;">{{ $notes->log_penilaian_cab_desc_text }}</li>
                        @endif
                        @endforeach
                    </td>
                    @endforeach
                    @if ($suplier->count() == 1)
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    @elseif ($suplier->count() == 2)
                    <td>-</td>
                    <td>-</td>
                    @elseif ($suplier->count() == 3)
                    <td>-</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <table style="width: 100%; padding-top: 50px;" border="0">
            @php
            $cabang = DB::table('master_cabang')->where('master_cabang_code',Auth::user()->access_cabang)->first();
            @endphp
            @if ($cabang)
            {{ $nama = $cabang->master_cabang_name }}
            @else
            {{ $nama = 'Cabang Tidak ditemukan' }}
            @endif
            <tr>
                <td style="width: 40%;">
                    <p style="margin: 0px;"> {{$nama}} <br>MANAGER SDM & UMUM</p>
                    <br><br><br>
                    <p>{{$periode->log_master_mgr}}</p>
                </td>
                <td>

                </td>
                <td style="width: 30%;">
                    <p style="margin: 0px;">{{$periode->log_master_jab}}</p>
                    <br><br><br>
                    <p>{{$periode->log_master_bag}}</p>
                </td>
                <td style="width: 30%;">
                    <p style="margin: 0px;">{{$periode->log_master_jab1}}</p>
                    <br><br><br>
                    <p>{{$periode->log_master_bag1}}</p>
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
