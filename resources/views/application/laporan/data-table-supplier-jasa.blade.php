<div class="card-header bg-300 d-flex justify-content-between">
    <div>
        <button class="btn btn-falcon-default btn-sm ms-1 ms-sm-2 d-none d-sm-inline-block" type="button"
            data-bs-toggle="modal" data-bs-target="#modal-laporan" id="button-jasa-lampiran-terpilih"
            data-code="{{ $code }}">Cetak Lampiran Terpilih</button>
        <button class="btn btn-falcon-default btn-sm ms-1 ms-sm-2 d-none d-sm-inline-block" type="button"
            data-bs-toggle="modal" data-bs-target="#modal-laporan" id="button-barang-surat-keputusan"
            data-code="{{ $code }}" data-bs-original-title="Print" aria-label="Print">Cetak Surat Keputusan</button>
        <button class="btn btn-falcon-default btn-sm ms-1 ms-sm-2 d-none d-sm-inline-block" type="button"
            data-bs-toggle="modal" data-bs-target="#modal-laporan" id="button-detail-jasa-lampiran-terpilih"
            data-code="{{ $code }}">Detail Penilaian Jasa</button>
    </div>
    <div class="d-flex">

    </div>
</div>
<div class="card-body">
    <table id="example" class="table table-striped border" style="width:100%">
        <thead class="bg-200 text-700">
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2" class="text-center">Nama Jasa</th>
                <th colspan="4" class="text-center">Alternatif Suplier</th>

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
            @foreach ($jasa as $jasas)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $jasas->m_jasa_name }}</td>
                @php
                $suplier = DB::table('data_supp_jasa_cab')
                ->join('m_supplier', 'm_supplier.m_supplier_code', '=', 'data_supp_jasa_cab.m_supplier_code')
                ->where('data_supp_jasa_cab.m_jasa_code', $jasas->m_jasa_code)
                ->where('data_supp_jasa_cab.log_master_code', $code)
                ->where('data_supp_jasa_cab.master_cabang_code', Auth::user()->access_cabang)
                ->orderBy('data_supp_jasa_cab.data_supp_jasa_cab_score', 'DESC')->get();
                @endphp
                @foreach ($suplier as $sup)
                <td>{{ $sup->m_supplier_name }} ( <strong
                        class="text-primary">{{ $sup->data_supp_jasa_cab_score }}</strong> )</td>
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
</div>
<script>
    new DataTable('#example', {
        responsive: true,
        layout: {
            topStart: {
                buttons: [{
                    extend: 'excel',
                    exportOptions: {
                        orthogonal: 'export'
                    },
                    text: 'Export Excel',
                    title: 'Data Rekap Evaluasi Suplier Barang {{ date(' ymdhis ') }}'
                }],
            }
        }
    });
</script>
