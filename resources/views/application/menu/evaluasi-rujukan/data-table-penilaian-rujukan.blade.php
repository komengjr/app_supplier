<table id="example" class="table table-striped" style="width:100%">
    <thead class="bg-200 text-700 border border-primary">
        <tr>
            <th class="text-center" rowspan="2">No</th>
            <th class="text-center" rowspan="2">Nama Rujukan</th>
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
        @foreach ($rujukan as $ruj)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $ruj->m_rujukan_name }}</td>
                @foreach ($cat as $cats)
                    @php
                        $value = DB::table('log_penilaian_rujukan_cab')
                            ->join('t_penilaian_detail', 't_penilaian_detail.t_penilaian_detail_code', 'log_penilaian_rujukan_cab.t_penilaian_detail_code')
                            ->join('t_penilaian_cat', 't_penilaian_cat.t_penilaian_cat_code', 't_penilaian_detail.t_penilaian_cat_code')
                            ->where('t_penilaian_detail.t_penilaian_detail_type', 'option')
                            ->where('log_penilaian_rujukan_cab.log_master_code', $periode)
                            ->where('log_penilaian_rujukan_cab.m_rujukan_code', $ruj->m_rujukan_code)
                            ->where('log_penilaian_rujukan_cab.m_pemeriksaan_code', $code)
                            ->where('t_penilaian_detail.t_penilaian_cat_code', $cats->t_penilaian_cat_code)->sum('log_penilaian_rujukan_cab.penilaian_rujukan_cab_score');
                    @endphp
                    <td> {{ $value }}</td>
                @endforeach
                <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-rujukan-full"
                        id="button-proses-nilai-rujukan" data-rujukan="{{$ruj->m_rujukan_code}}" data-code="{{ $code  }}"
                        data-periode="{{ $periode }}">Proses</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    new DataTable('#example', {
        responsive: true
    });
</script>
