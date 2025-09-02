<div class="card mb-3">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0">Details Jasa</h5>
            </div>
            <div class="col-auto">

            </div>
        </div>
    </div>
    <div class="card-body bg-light border-top">
        <div class="row">
            <div class="col-lg col-xxl-5">
                <h6 class="fw-semi-bold ls mb-3 text-uppercase">Data Information</h6>
                <div class="row">
                    <div class="col-5 col-sm-4">
                        <p class="fw-semi-bold mb-1">Nama Jasa</p>
                    </div>
                    <div class="col">{{$data->m_jasa_name}}</div>
                </div>
                <div class="row">
                    <div class="col-5 col-sm-4">
                        <p class="fw-semi-bold mb-1">Created</p>
                    </div>
                    <div class="col">{{$data->created_at}}</div>
                </div>
                <div class="row">
                    <div class="col-5 col-sm-4">
                        <p class="fw-semi-bold mb-1">Email</p>
                    </div>
                    <div class="col"><a href="mailto:tony@gmail.com">-</a></div>
                </div>

            </div>
            <div class="col-lg col-xxl-5 mt-4 mt-lg-0 offset-xxl-1">
                <!-- <h6 class="fw-semi-bold ls mb-3 text-uppercase">Addons Information</h6>
                <div class="row">
                    <div class="col-5 col-sm-4">
                        <p class="fw-semi-bold mb-1">Send email to</p>
                    </div>
                    <div class="col"><a href="mailto:tony@gmail.com">-</a></div>
                </div>
                <div class="row">
                    <div class="col-5 col-sm-4">
                        <p class="fw-semi-bold mb-1">Address</p>
                    </div>
                    <div class="col">
                        <p class="mb-1">-</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5 col-sm-4">
                        <p class="fw-semi-bold mb-1">Phone number</p>
                    </div>
                    <div class="col"><a href="tel:+12025550110">-</a></div>
                </div> -->
            </div>
        </div>
    </div>
    <div class="card-footer border-top text-end">
        <div class="row align-items-center">
            <div class="col-auto">
                <input type="text" name="code_supplier" id="code_jasa" value="{{$code}}" hidden>
            </div>
            <div class="col float-end">
                <a class="btn btn-falcon-primary ms-2 " href="#!" data-bs-toggle="modal" data-bs-target="#modal-supplier" id="button-tambah-data-supplier">
                    <span class="far fa-file-archive me-1"></span>Tambah Penilaian Supplier
                </a>
            </div>
        </div>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header bg-300 d-flex justify-content-between">
        <h5 class="mb-0">Logs Penilaian</h5>
        <button class="btn btn-falcon-primary" id="button-simpan-fix-proses-penilaian-jasa" data-code="{{ $periode }}">Simpan Evaluasi</button>
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
                    @foreach ($cat as $cats)
                    @php
                    $value = DB::table('log_penilaian_jasa_cab')
                    ->join('t_penilaian_detail','t_penilaian_detail.t_penilaian_detail_code','log_penilaian_jasa_cab.t_penilaian_detail_code')
                    ->join('t_penilaian_cat','t_penilaian_cat.t_penilaian_cat_code','t_penilaian_detail.t_penilaian_cat_code')
                    ->where('t_penilaian_detail.t_penilaian_detail_type', 'option')
                    ->where('log_penilaian_jasa_cab.log_master_code', $periode)
                    ->where('log_penilaian_jasa_cab.m_supplier_code', $sup->m_supplier_code)
                    ->where('log_penilaian_jasa_cab.m_jasa_code', $code)
                    ->where('t_penilaian_detail.t_penilaian_cat_code',$cats->t_penilaian_cat_code)->sum('log_penilaian_jasa_cab.penilaian_jasa_cab_score');
                    @endphp
                    <td> {{ $value }}</td>
                    @endforeach
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-supplier-full" id="button-proses-nilai-supplier" data-supplier="{{$sup->m_supplier_code}}" data-code="{{ $code  }}" data-periode="{{ $periode }}">Proses</button>
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
<script>
    new window.Choices(document.querySelector(".choices-single-tahun"));
</script>
