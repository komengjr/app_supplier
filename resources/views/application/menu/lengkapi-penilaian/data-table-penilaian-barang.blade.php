<table id="example-sub" class="table table-striped" style="width:100%">
    <thead class="bg-200 text-700 border border-primary">
        <tr>
            <th class="text-center" rowspan="2">No</th>
            <th class="text-center" rowspan="2">Nama Supplier</th>
            <th class="text-center" rowspan="2">Nama Barang</th>
            <th class="text-center" colspan="{{$cat->count()}}">Score</th>
            <th rowspan="2" class="text-center">Action</th>
        </tr>
        <tr>
            @foreach ($cat as $cats)
            <th>{{ $cats->t_penilaian_cat_name }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach ($brg as $brgs)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $brgs->m_supplier_name }}</td>
            <td>{{ $brgs->m_barang_name }}</td>
            @foreach ($cat as $cats)
            @php
            $value = DB::table('log_penilaian_cab')
            ->join('t_penilaian_detail', 't_penilaian_detail.t_penilaian_detail_code', 'log_penilaian_cab.t_penilaian_detail_code')
            ->join('t_penilaian_cat', 't_penilaian_cat.t_penilaian_cat_code', 't_penilaian_detail.t_penilaian_cat_code')
            ->where('t_penilaian_detail.t_penilaian_detail_type', 'option')
            ->where('log_penilaian_cab.log_master_code', $tahun)
            ->where('log_penilaian_cab.m_barang_code', $brgs->m_barang_code)
            ->where('log_penilaian_cab.m_supplier_code', $brgs->m_supplier_code)
            ->where('t_penilaian_detail.t_penilaian_cat_code', $cats->t_penilaian_cat_code)->sum('log_penilaian_cab.log_penilaian_cab_score');
            @endphp
            <td> {{ $value }}</td>
            @endforeach
            <td>
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modal-supplier-full" id="button-proses-nilai-supplier"
                    data-supplier="{{$brgs->m_supplier_code}}" data-code="{{ $brgs->m_barang_code  }}"
                    data-periode="{{ $tahun }}">Proses</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    new DataTable('#example-sub', {
        responsive: true
    });
</script>
