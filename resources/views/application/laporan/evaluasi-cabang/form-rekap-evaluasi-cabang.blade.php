<div class="modal-body p-0">
    <div class="bg-300 rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" id="staticBackdropLabel">Report Rekapitulasi Evaluasi</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <div class="row g-3 p-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="m-0"><span class="badge bg-primary m-0 p-0">Surat Keputusan</span></h3>
                        </div>
                        <div class="col-auto">

                        </div>
                    </div>
                </div>
                <div class="card-body border-top p-3">
                    <div id="report-keputusan"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="m-0"><span class="badge bg-primary m-0 p-0">Daftar Terpilih Supplier Barang</span></h3>
                        </div>
                        <div class="col-auto">

                        </div>
                    </div>
                </div>
                <div class="card-body border-top p-3">
                    <div id="report-suppplier-barang"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="m-0"><span class="badge bg-primary m-0 p-0">Daftar Terpilih Supplier Jasa</span></h3>
                        </div>
                        <div class="col-auto">

                        </div>
                    </div>
                </div>
                <div class="card-body border-top p-3">
                    <div id="report-suppplier-jasa"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="m-0"><span class="badge bg-primary m-0 p-0">Daftar Terpilih Rujukan Pemeriksaan</span></h3>
                        </div>
                        <div class="col-auto">

                        </div>
                    </div>
                </div>
                <div class="card-body border-top p-3">
                    <div id="report-rujukan-pemeriksaan"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#report-keputusan').html(
        '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
    );
    $.ajax({
        url: "{{ route('laporan_evaluasi_cabang_rekapitulasi_surat_keputusan') }}",
        type: "POST",
        cache: false,
        data: {
            "_token": "{{ csrf_token() }}",
            "code": '{{ $code }}'
        },
        dataType: 'html',
    }).done(function(data) {
        $('#report-keputusan').html(
            '<iframe src="data:application/pdf;base64, ' +
            data +
            '" style="width:100%; height:533px;" frameborder="0"></iframe>');
    }).fail(function() {
        $('#report-keputusan').html('eror');
    });
</script>
<script>
    $('#report-suppplier-barang').html(
        '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
    );
    $.ajax({
        url: "{{ route('laporan_evaluasi_cabang_rekapitulasi_surat_supplier_barang') }}",
        type: "POST",
        cache: false,
        data: {
            "_token": "{{ csrf_token() }}",
            "code": '{{ $code }}'
        },
        dataType: 'html',
    }).done(function(data) {
        $('#report-suppplier-barang').html(
            '<iframe src="data:application/pdf;base64, ' +
            data +
            '" style="width:100%; height:533px;" frameborder="0"></iframe>');
    }).fail(function() {
        $('#report-suppplier-barang').html('eror');
    });
</script>
<script>
    $('#report-suppplier-jasa').html(
        '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
    );
    $.ajax({
        url: "{{ route('laporan_evaluasi_cabang_rekapitulasi_surat_supplier_jasa') }}",
        type: "POST",
        cache: false,
        data: {
            "_token": "{{ csrf_token() }}",
            "code": '{{ $code }}'
        },
        dataType: 'html',
    }).done(function(data) {
        $('#report-suppplier-jasa').html(
            '<iframe src="data:application/pdf;base64, ' +
            data +
            '" style="width:100%; height:533px;" frameborder="0"></iframe>');
    }).fail(function() {
        $('#report-suppplier-jasa').html('eror');
    });
</script>
<script>
    $('#report-rujukan-pemeriksaan').html(
        '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
    );
    $.ajax({
        url: "{{ route('laporan_evaluasi_cabang_rekapitulasi_surat_rujukan_pemeriksaan') }}",
        type: "POST",
        cache: false,
        data: {
            "_token": "{{ csrf_token() }}",
            "code": '{{ $code }}'
        },
        dataType: 'html',
    }).done(function(data) {
        $('#report-rujukan-pemeriksaan').html(
            '<iframe src="data:application/pdf;base64, ' +
            data +
            '" style="width:100%; height:533px;" frameborder="0"></iframe>');
    }).fail(function() {
        $('#report-rujukan-pemeriksaan').html('eror');
    });
</script>
