<div class="card mb-3">
    <div class="card-header bg-300 d-flex justify-content-between">
        <h5 class="mb-0">Logs Penilaian</h5>
        <button class="btn btn-falcon-primary" id="button-simpan-fix-proses-penilaian" data-code="{{ $tahun }}">Simpan Evaluasi</button>
    </div>
    <div class="card-body p-3" id="menu-table-penilaian">
        <table id="example" class="table table-striped" style="width:100%">
            <thead class="bg-200 text-700 border border-primary">
                <tr>
                    <th class="text-center" rowspan="2">No</th>
                    <th class="text-center" rowspan="2">Nama Supplier</th>
                    <th class="text-center" rowspan="2">Nama Jasa</th>
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
                @foreach ($supplier as $sup)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $sup->m_supplier_name }}</td>
                    <td>{{ $sup->m_jasa_name }}</td>
                    @foreach ($cat as $cats)
                    @php
                    $value = DB::table('log_penilaian_jasa_cab')
                    ->join('t_penilaian_detail','t_penilaian_detail.t_penilaian_detail_code','log_penilaian_jasa_cab.t_penilaian_detail_code')
                    ->join('t_penilaian_cat','t_penilaian_cat.t_penilaian_cat_code','t_penilaian_detail.t_penilaian_cat_code')
                    ->where('t_penilaian_detail.t_penilaian_detail_type', 'option')
                    ->where('log_penilaian_jasa_cab.log_master_code', $tahun)
                    ->where('log_penilaian_jasa_cab.m_supplier_code', $sup->m_supplier_code)
                    ->where('log_penilaian_jasa_cab.m_jasa_code', $sup->m_jasa_code)
                    ->where('t_penilaian_detail.t_penilaian_cat_code',$cats->t_penilaian_cat_code)->sum('log_penilaian_jasa_cab.penilaian_jasa_cab_score');
                    @endphp
                    <td> {{ $value }}</td>
                    @endforeach
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-supplier-full" id="button-proses-nilai-jasa" data-supplier="{{$sup->m_supplier_code}}" data-code="{{$sup->m_jasa_code}}" data-periode="{{ $tahun }}">Proses</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    new DataTable('#example', {
        responsive: true
    });
</script>
