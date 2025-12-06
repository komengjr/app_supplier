<div class="modal-body p-0">
    <div class="bg-300 rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" id="staticBackdropLabel">Preview Penetapan Penawaran Supplier</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Pramita</a></p>
    </div>
    <div class="row g-3 p-4">
        <div class="col-md-6">
            <p>Berita Acara</p>
            <div id="report-penetapan"></div>
        </div>
        <div class="col-md-6">
            <p>Penetapan Supplier Terpilih</p>
            <div id="report-penetapan-terpilih"></div>
        </div>
    </div>
</div>
<script>
    $('#report-penetapan').html(
        '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
    );
    $.ajax({
        url: "{{ route('evaluasi_kapus_penetapan_supplier_kapus_preview_report') }}",
        type: "POST",
        cache: false,
        data: {
            "_token": "{{ csrf_token() }}",
            "code": '{{ $code }}'
        },
        dataType: 'html',
    }).done(function(data) {
        $('#report-penetapan').html(
            '<iframe src="data:application/pdf;base64, ' +
            data +
            '" style="width:100%; height:533px;" frameborder="0"></iframe>');
    }).fail(function() {
        $('#report-penetapan').html('eror');
    });
</script>
<script>
    $('#report-penetapan-terpilih').html(
        '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
    );
    $.ajax({
        url: "{{ route('evaluasi_kapus_penetapan_supplier_kapus_preview_report_terpilih') }}",
        type: "POST",
        cache: false,
        data: {
            "_token": "{{ csrf_token() }}",
            "code": '{{ $code }}'
        },
        dataType: 'html',
    }).done(function(data) {
        $('#report-penetapan-terpilih').html(
            '<iframe src="data:application/pdf;base64, ' +
            data +
            '" style="width:100%; height:533px;" frameborder="0"></iframe>');
    }).fail(function() {
        $('#report-penetapan-terpilih').html('eror');
    });
</script>
