<div class="modal-body p-0">
    <div class="bg-300 rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" id="staticBackdropLabel">Proses Penilaian Supplier <strong
                class="text-warning">{{ $supplier->m_supplier_name }}</strong> Untuk <strong
                class="text-warning">Penawaran {{$penawaran->data_penawaran_name}}</strong></h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <div class="row g-3 p-4">
        <h5>Barang Yang di Nilai : {{ $barang->m_barang_name }}</h5>
        <div class="accordion" id="accordionExample">
            @foreach ($kategori as $cat)
            <div class="accordion-item">
                <h2 class="accordion-header " id="heading1">
                    <button class="accordion-button bg-300" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse{{$cat->id_s_penilaian_cat }}" aria-expanded="true"
                        aria-controls="collapse{{$cat->id_s_penilaian_cat }}">
                        {{$cat->s_penilaian_cat_name}}
                    </button>
                </h2>
                <div class="accordion-collapse collapse show" id="collapse{{$cat->id_s_penilaian_cat }}"
                    aria-labelledby="heading1" data-bs-parent="#accordionExample">
                    <form id="form{{$cat->s_penilaian_cat_code }}">
                        @csrf
                        <div class="accordion-body">

                            <input type="text" name="supplier" value="{{ $supplier->m_supplier_code }}" id="" hidden>
                            <input type="text" name="barang" value="123" id="" hidden>
                            <input type="text" name="periode" value="20" id="" hidden>
                            <input type="text" name="cat_penilaian" value="{{$cat->s_penilaian_cat_code }}" id=""
                                hidden>
                            @php
                            $detail = DB::table('s_penilaian_detail')->where('s_penilaian_cat_code', $cat->s_penilaian_cat_code)->get();
                            @endphp
                            <table id="example-data{{$cat->id_s_penilaian_cat }}" class="table border"
                                style="width:100%">
                                <thead class="bg-300 text-700">
                                    <tr>
                                        <th>#</th>
                                        @foreach ($detail as $det)
                                        <th>{{$det->s_penilaian_detail_name}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        @foreach ($detail as $det)
                                        @php
                                        $option = DB::table('s_penilaian_point')->where('s_penilaian_detail_code', $det->s_penilaian_detail_code)->get();
                                        @endphp
                                        <td>
                                            <input type="text" name="{{ $det->s_penilaian_detail_code  }}" id=""
                                                value="{{ $det->s_penilaian_detail_code  }}" hidden>
                                            @php
                                            $log = DB::table('log_penilaian_cab')
                                            ->where('log_master_code', 200)
                                            ->where('m_supplier_code', $supplier->m_supplier_code)
                                            ->where('m_barang_code', 20)
                                            ->where('t_penilaian_detail_code', $det->s_penilaian_detail_code)->first();
                                            @endphp
                                            @if ($det->s_penilaian_detail_type == 'option')
                                            @if ($log)
                                            <select name="data{{ $det->s_penilaian_detail_code  }}" class="form-control"
                                                id="">
                                                <option value="{{$log->log_penilaian_cab_val}}">
                                                    {{$log->log_penilaian_cab_val}}
                                                </option>
                                                @foreach ($option as $opt)
                                                <option value="{{ $opt->s_penilaian_point_value}}">
                                                    {{ $opt->s_penilaian_point_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @else
                                            <select name="data{{ $det->s_penilaian_detail_code  }}" class="form-control"
                                                id="">
                                                <option value="0">Pilih Terlebih Dahulu</option>
                                                @foreach ($option as $opt)
                                                <option value="{{ $opt->s_penilaian_point_value}}">
                                                    {{ $opt->s_penilaian_point_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @endif
                                            @else
                                            @if ($log)
                                            <input type="text" class="form-control"
                                                name="data{{ $det->s_penilaian_detail_code  }}"
                                                value="{{ $log->log_penilaian_cab_val }}">
                                            @else
                                            <input type="text" class="form-control"
                                                name="data{{ $det->s_penilaian_detail_code  }}" value="0">
                                            @endif
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-end">
                                <button class="btn btn-falcon-success btn-sm"
                                    id="button-simpan-prosess-penilaian{{$cat->s_penilaian_cat_code }}"
                                    data-code="{{$cat->s_penilaian_cat_code }}" data-supplier=""
                                    data-brg="123"><span class="fas fa-save"></span>
                                    Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                new DataTable('#example-data{{$cat->id_s_penilaian_cat }}', {
                    responsive: true,
                    layout: {
                        topStart: '',
                        topEnd: '',
                        bottomStart: '',
                        bottomEnd: ''
                    }
                });
            </script>
            @endforeach
        </div>
        <div class="">
            <button class="btn btn-falcon-primary float-end" id="button-next-periode-penilaian-barang"
                data-bs-dismiss="modal">Selanjutnya</button>
        </div>
    </div>
</div>
