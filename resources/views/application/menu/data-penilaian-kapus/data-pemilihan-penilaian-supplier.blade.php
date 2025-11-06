<div class="modal-body p-0">
    <div class="bg-danger rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Data Supplier</h4>
        <p class="fs--2 mb-0" style="color: white;">Support by <a class="link-100 fw-semi-bold" href="#!">Pramita</a></p>
    </div>
    <div class="card-body border-top p-3">
        <table id="data-supplier" class="table table-striped nowrap" style="width:100%">
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
