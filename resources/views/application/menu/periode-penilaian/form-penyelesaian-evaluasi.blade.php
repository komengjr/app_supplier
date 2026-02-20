<div class="modal-body p-0">
    <div class="bg-300 rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" id="staticBackdropLabel">Form Penyelesaian Evaluasi</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <div class="p-3">
        <div class="card mb-3 border">
            <div class="card-header">
                <h5>Penilaian Evaluasi Supplier Barang</h5>
            </div>
            <div class="card-body bg-light">
                <div class="table-responsive">
                    <table id="table-barang" class="table table-striped border" style="width:100%; font-size: 10px;" border="1">
                        <thead class="bg-200 text-900">
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
                                <td>{{ $sup->m_supplier_name }} ( <strong
                                        class="text-primary">{{ $sup->data_supp_brg_cab_score }}</strong>
                                    )</td>
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
            </div>
        </div>
        <div class="card mb-3 border">
            <div class="card-header">
                <h5>Penilaian Evaluasi Supplier Jasa</h5>
            </div>
            <div class="card-body bg-light">
                <div class="table-responsive">
                    <table id="table-jasa" class="table table-striped border" style="width:100%; font-size: 10px;" border="1">
                        <thead class="bg-200 text-700">
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2" class="text-center">NAMA JASA</th>
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
                            @foreach ($jasa as $jasas)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $jasas->m_jasa_name }}</td>
                                @php
                                $suplier = DB::table('data_supp_jasa_cab')
                                ->join('m_supplier', 'm_supplier.m_supplier_code', '=', 'data_supp_jasa_cab.m_supplier_code')
                                ->where('data_supp_jasa_cab.m_jasa_code', $jasas->m_jasa_code)
                                ->where('data_supp_jasa_cab.log_master_code', $periode->log_master_code)
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
            </div>
        </div>
        <div class="card mb-3 border">
            <div class="card-header">
                <h5>Penilaian Evaluasi Rujukan Pemeriksaan</h5>
            </div>
            <div class="card-body bg-light">
                <div class="table-responsive">
                    <table id="table-rujukan" class="table table-striped border" style="width:100%;font-size: 10px;" border="1">
                        <thead class="bg-200 text-700">
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2" class="text-center">NAMA PEMERIKSAAN</th>
                                <th colspan="4" class="text-center">ALTERNATIF RUJUKAN</th>

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
                            @foreach ($pemeriksaan as $pem)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $pem->m_pemeriksaan_name }}</td>
                                @php
                                $suplier = DB::table('data_supp_rujukan_cab')
                                ->join('m_rujukan', 'm_rujukan.m_rujukan_code', '=', 'data_supp_rujukan_cab.m_rujukan_code')
                                ->where('data_supp_rujukan_cab.m_pemeriksaan_code', $pem->m_pemeriksaan_code)
                                ->where('data_supp_rujukan_cab.log_master_code', $periode->log_master_code)
                                ->where('data_supp_rujukan_cab.master_cabang_code', Auth::user()->access_cabang)
                                ->orderBy('data_supp_rujukan_cab.data_supp_rujukan_cab_score', 'DESC')->get();
                                @endphp
                                @foreach ($suplier as $sup)
                                <td>{{ $sup->m_rujukan_name }} ( <strong
                                        class="text-primary">{{ $sup->data_supp_rujukan_cab_score }}</strong> )</td>
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
            </div>
        </div>
        <div class="card border">
            <!-- <div class="card-header">
                <h5 class="mb-0">Team Evaluasi</h5>
            </div> -->
            <div class="card-body bg-light pb-0">
                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="fs-0">Informasi Penting</h5>
                        <p class="fs--1 text-danger">Pastikan Semua data sudah terisi dengan benar , jika sudah melanjutkan proses ini tidak dapat di ulang kembali karena proses penilaian Evaluasi sudah selesai.</p>
                    </div>

                </div>
            </div>
            <div class="card-footer py-3">
                <div class="text-end" id="footer-penyelesaian-evaluasi">
                    <h6 class="fs-0 fw-normal"></h6><a class="btn btn-falcon-primary btn-sm" href="#" id="button-fix-save-penyelesaian-penilaian-evaluasi" data-code="{{ $code }}">Simpan & Selesai</a>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    new DataTable('#table-barang', {
        responsive: true
    });
    new DataTable('#table-jasa', {
        responsive: true
    });
    new DataTable('#table-rujukan', {
        responsive: true
    });

</script>
