<div class="modal-body p-0">
    <div class="bg-300 rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" id="staticBackdropLabel">Form Penetapan Supplier {{ $supplier->m_supplier_name }}</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <div class="row g-3 p-3" id="menu-proses-penetapan-supplier">
        @if ($data)
            <div id="report-penetapan-supplier"></div>
            <script>
                $('#report-penetapan-supplier').html(
                    '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
                );
                $.ajax({
                    url: "{{ route('kualifikasi_supplier_penetapan_document_report_view') }}",
                    type: "POST",
                    cache: false,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "code": '{{ $supplier->m_supplier_code }}'
                    },
                    dataType: 'html',
                }).done(function (data) {
                    $('#report-penetapan-supplier').html(
                        '<iframe src="data:application/pdf;base64, ' +
                        data +
                        '" style="width:100%; height:533px;" frameborder="0"></iframe>');
                }).fail(function () {
                    $('#report-penetapan-supplier').html('eror');
                });
            </script>
        @else
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Gagal Terbit!</strong> Mohon dilengkapi legalitas Supplier terlebih dahulu
            </div>
        @endif
    </div>
</div>
