<div class="card mb-3">
    <div class="card-header bg-danger d-flex justify-content-between">
        <h4 class="mb-0" style="color: white;">Data Supplier</h4>
        <!-- <button class="btn btn-falcon-primary btn-sm" id="button-simpan-fix-proses-penilaian">Simpan Evaluasi</button> -->
        <div class="btn-group" role="group">
            <button class="btn btn-sm btn-falcon-primary dropdown-toggle" id="btnGroupVerticalDrop2" type="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                    class="fas fa-align-left me-1" data-fa-transform="shrink-3"></span>Option</button>
            <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-suplier-lg"
                    id="button-tambah-data-penilaian-supplier" data-code="{{$code}}"><span class="fas fa-file-signature"></span> Penilaian Berdasarkan Supplier</button>
                <div class="dropdown-divider"></div>
                <button class="dropdown-item" id="button-simpan-fix-proses-penilaian" data-code="123"><span
                        class="fas fa-cloud-upload-alt"></span> Simpan Evaluasi</button>
            </div>
        </div>
    </div>
    <div class="card-body p-3" id="menu-table-penilaian">
        <table id="example" class="table table-striped" style="width:100%">
            <thead class="bg-200 text-700 border border-primary">
                <tr>
                    <th class="text-center" rowspan="2">No</th>
                    <th class="text-center" rowspan="2">Nama Supplier</th>
                    <th class="text-center" colspan="{{$cat->count()}}">Score</th>
                    <th rowspan="2" class="text-center">Action</th>
                </tr>
                <tr>
                    @foreach ($cat as $cats)
                    <th>{{ $cats->s_penilaian_cat_name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                <!-- @foreach ($data as $datas)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $datas->m_supplier_name }}</td>
                        <td>{{ 0 }}</td>
                        <td></td>
                    </tr>
                @endforeach -->
            </tbody>
        </table>
    </div>
</div>
<script>
    new DataTable('#example', {
        responsive: true
    });
</script>
