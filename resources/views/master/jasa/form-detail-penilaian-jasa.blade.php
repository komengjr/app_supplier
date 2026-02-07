<div class="modal-body p-0">
    <div class="bg-300 rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" id="staticBackdropLabel">Detail Penilaian Jasa</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Pramita</a></p>
    </div>
    <div class="p-2" id="menu-table-data-penilaian-supplier">
        <table id="data_penilaian" class="table table-striped" style="width:100%">
            <thead class="bg-200 text-700">
                <tr>
                    <th>No</th>
                    <th>Cabang Penilai</th>
                    <th>Peridoe Penilaian</th>
                    <th>Supplier</th>
                    <th>Barang</th>
                    <th>value</th>
                    <th>Score</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp

            </tbody>
        </table>
    </div>
</div>
<script>
    new DataTable('#data_penilaian', {
        responsive: true
    });
</script>
