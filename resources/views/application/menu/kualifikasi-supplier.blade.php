@extends('layouts.template')
@section('base.css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap5.css">
    <link href="{{ asset('vendors/choices/choices.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="row mb-3">
        <div class="col">
            <div class="card bg-100 shadow-none border">
                <div class="row gx-0 flex-between-center">
                    <div class="col-sm-auto d-flex align-items-center border-bottom">
                        <img class="ms-3 mx-3" src="{{ asset('img/app.png') }}" alt="" width="50" />
                        <div>
                            <h6 class="text-primary fs--1 mb-0 pt-2">Welcome to </h6>
                            <h4 class="text-primary fw-bold mb-1">Suplier <span class="text-info fw-medium">Management
                                    System</span></h4>
                        </div>
                        <img class="ms-n4 d-none d-lg-block "
                            src="{{ asset('asset/img/illustrations/crm-line-chart.png') }}" alt="" width="150" />
                    </div>
                    <div class="col-xl-auto px-3 py-2">
                        <h6 class="text-primary fs--1 mb-0">Menu : </h6>
                        <h4 class="text-primary fw-bold mb-0">Kualifikasi <span class="text-info fw-medium">Suplier</span>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header bg-primary">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="m-0"><span class="badge bg-primary m-0 p-0">Kualifikasi Suplier</span></h3>
                </div>
                <div class="col-auto">

                    <div class="btn-group" role="group">
                        <button class="btn btn-sm btn-falcon-primary dropdown-toggle" id="btnGroupVerticalDrop2"
                            type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                class="fas fa-align-left me-1" data-fa-transform="shrink-3"></span>Option</button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-suplier"
                                id="button-tambah-data-suplier" data-code="123"><span class="fab fa-superpowers"></span>
                                Tambah Suplier</button>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-suplier"
                                id="button-upload-data-supplier" data-code="123"><span
                                    class="fas fa-cloud-upload-alt"></span> Upload Supplier</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body border-top p-3">
            <table id="example" class="table table-striped nowrap" style="width:100%">
                <thead class="bg-200 text-700">
                    <tr>
                        <th>No</th>
                        <th>Nama Perusahaan</th>
                        <th class="text-center">Document</th>
                        <th>Action</th>
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
                            <td>
                                @php
                                    $doc = DB::table('m_document')->get();
                                @endphp
                                @foreach ($doc as $docs)
                                    <li>{{ $docs->m_document_name }}
                                        @php
                                            $status = DB::table('m_supplier_doc')
                                                ->where('m_supplier_code', $datas->m_supplier_code)
                                                ->where('m_document_code', $docs->m_document_code)->first();
                                        @endphp
                                        @if ($status)
                                            <span class="far fa-check-circle text-success"></span>
                                        @else
                                            <span class="far fa-times-circle text-danger"></span>
                                        @endif
                                    </li>
                                @endforeach
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-falcon-primary dropdown-toggle" id="btnGroupVerticalDrop2"
                                        type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                            class="fas fa-align-left me-1" data-fa-transform="shrink-3"></span>Option</button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-suplier"
                                            id="button-upload-doc-data-supplier" data-code="{{$datas->m_supplier_code }}"><span
                                                class="fas fa-cloud-upload-alt"></span> Upload Document Supplier</button>
                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-suplier-lg"
                                            id="button-terbit-surat-penetapan-suplier"
                                            data-code="{{$datas->m_supplier_code }}"><span class="fab fa-superpowers"></span>
                                            Terbit Surat Penetapan Suplier </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('base.js')
    <div class="modal fade" id="modal-suplier" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 95%;">
            <div class="modal-content border-0">
                <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close" onclick="location.reload();"></button>
                </div>
                <div id="menu-suplier"></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-suplier-lg" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content border-0">
                <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="menu-suplier-lg"></div>
            </div>
        </div>
    </div>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.4/js/responsive.bootstrap5.js"></script>
    <script src="{{ asset('vendors/choices/choices.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        new DataTable('#example', {
            responsive: true
        });
    </script>
    <script>
        $(document).on("click", "#button-upload-doc-data-supplier", function (e) {
            e.preventDefault();
            var code = $(this).data("code");
            $('#menu-suplier').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: "{{ route('kualifikasi_supplier_upload_document') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": code
                },
                dataType: 'html',
            }).done(function (data) {
                $('#menu-suplier').html(data);
            }).fail(function () {
                $('#menu-suplier').html('eror');
            });
        });
        $(document).on("click", "#button-upload-data-supplier", function (e) {
            e.preventDefault();
            var code = $(this).data("code");
            $('#menu-suplier').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: "{{ route('master_suplier_import') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": code
                },
                dataType: 'html',
            }).done(function (data) {
                $('#menu-suplier').html(data);
            }).fail(function () {
                $('#menu-suplier').html('eror');
            });
        });
        $(document).on("click", "#button-terbit-surat-penetapan-suplier", function (e) {
            e.preventDefault();
            var code = $(this).data("code");
            $('#menu-suplier-lg').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: "{{ route('kualifikasi_supplier_penetapan_document') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": code
                },
                dataType: 'html',
            }).done(function (data) {
                $('#menu-suplier-lg').html(data);
            }).fail(function () {
                $('#menu-suplier-lg').html('eror');
            });
        });
        $(document).on("click", "#button-save-penetapan-supplier", function (e) {
            e.preventDefault();
            var data = $("#form-data-penetapan").serialize();
            $('#menu-proses-penetapan-supplier').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            console.log(data);

            $.ajax({
                url: "{{ route('kualifikasi_supplier_penetapan_document_save') }}",
                type: "POST",
                cache: false,
                data: data,
                dataType: 'html',
            }).done(function (field) {
                var data = JSON.parse(field);
                console.log(data.panda);
                $('#menu-proses-penetapan-supplier').html(field);
            }).fail(function () {
                $('#menu-proses-penetapan-supplier').html('eror');
            });
        });
    </script>
    <script>
        $(document).on("click", "#button-preview-file", function (e) {
            e.preventDefault();
            var file = $(this).data("file");
            $('#show-file-doc').html(
                '<iframe src="../' + file + '" style="width:100%; height:533px;" frameborder="0"></iframe>'
            );
        });
    </script>
@endsection
