<div class="modal-body p-0">
    <div class="bg-danger rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Proses Penilaian Supplier</h4>
        <p class="fs--2 mb-0" style="color: white;">Support by <a class="link-100 fw-semi-bold" href="#!">Pramita</a></p>
    </div>
    <div class="card-body border-top p-3">
        <div class="card mb-3 border border-danger">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-sm-auto mb-2 mb-sm-0">
                        <h6 class="mb-0">Jumlah Barang <strong>{{ $barang->count() }}</strong></h6>
                    </div>
                    <div class="col-sm-auto">
                        <div class="row gx-2 align-items-center">
                            <div class="col-auto">
                                <form class="row gx-2">
                                    <div class="col-auto"><small>Pilih Barang :</small></div>
                                    <div class="col-auto">
                                        <select name="data_barang" class="form-control choices-single-barang" id="data_barang" required>
                                            <option value="">Pilih Barang Supplier</option>
                                            @foreach ($barang as $brg)
                                            <option value="{{$brg->m_barang_code}}">{{$brg->m_barang_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="col-auto pe-0">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table id="data-supplier" class="table table-striped" style="width:100%">
            <thead class="bg-200 text-700">
                <tr>
                    <th>No</th>
                    <th>Nama Suplier</th>
                    <th>Kota Suplier</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Cabang</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($data as $datas)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $datas->m_supplier_name }}</td>
                    <td>{{ $datas->m_supplier_city }}</td>
                    <td>{{ $datas->m_supplier_phone }}</td>
                    <td>{{ $datas->m_supplier_email }}</td>
                    <td>{{ $datas->m_supplier_cabang }}</td>
                    <td class="text-center"><button class="btn btn-danger btn-sm" id="button-penilaian-supplier" data-code="{{ $datas->m_supplier_code }}">Nilai Supplier</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    new DataTable('#data-supplier', {
        responsive: true
    });
</script>
<script>
    new window.Choices(document.querySelector(".choices-single-barang"));
</script>
