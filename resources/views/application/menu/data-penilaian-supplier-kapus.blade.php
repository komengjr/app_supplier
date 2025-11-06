@extends('layouts.template')
@section('base.css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap5.css">
    <link href="{{ asset('vendors/choices/choices.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="row mb-3">
        <div class="col">
            <div class="card bg-100 border border-danger">
                <div class="row gx-0 flex-between-center">
                    <div class="col-sm-auto d-flex align-items-center border-bottom">
                        <img class="ms-3 mx-3 m-2" src="{{ asset('img/app.png') }}" alt="" width="50" />
                        <div>
                            <h6 class="text-danger fs--1 mb-0 pt-2">Welcome to </h6>
                            <h4 class="text-danger fw-bold mb-1">Suplier <span class="text-danger fw-medium">Management
                                    System</span></h4>
                        </div>
                        <img class="ms-n4 d-none d-lg-block "
                            src="{{ asset('asset/img/illustrations/crm-line-chart.png') }}" alt="" width="150" />
                    </div>
                    <div class="col-xl-auto px-3 py-2">
                        <h6 class="text-danger fs--1 mb-0">Menu : </h6>
                        <h4 class="text-danger fw-bold mb-0">Penilaian <span class="text-danger fw-medium">Supplier
                                Kapus</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3 border border-danger">
        <div class="card-body d-flex justify-content-between">
            <div>
                <select name="agreement" class="form-control choices-single-tahun" id="periode-penilaian" required>
                    <option value="">Pilih Periode Tahun</option>
                    @foreach ($periode as $periodes)
                        <option value="{{ $periodes->n_periode_code  }}">{{ $periodes->n_periode_name  }}</option>
                    @endforeach
                </select>

            </div>
            <div class="d-flex">
                <div class="d-none d-md-block">
                    <button class="btn btn-falcon-danger" id="button-add-periode-penilaian-kapus">+ Tambah Periode
                        Penilaian</button>
                    <!-- <a class="btn btn-falcon-primary" href="#!" id="button-cari-supplier"><span
                                    class="fab fa-searchengin me-1"></span>Pilih Supplier</a>
                            <a class="btn btn-falcon-warning" href="#!" id="button-cari-barang"><span
                                    class="fas fa-shapes me-1"></span>Pilih Barang</a> -->
                </div>
                <div class="dropdown font-sans-serif d-sm-block d-md-none">
                    <button class="btn btn-falcon-default text-600 btn-sm dropdown-toggle dropdown-caret-none ms-2"
                        type="button" id="email-settings" data-bs-toggle="dropdown" data-boundary="viewport"
                        aria-haspopup="true" aria-expanded="false"><svg class="svg-inline--fa fa-cog fa-w-16"
                            aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cog" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M487.4 315.7l-42.6-24.6c4.3-23.2 4.3-47 0-70.2l42.6-24.6c4.9-2.8 7.1-8.6 5.5-14-11.1-35.6-30-67.8-54.7-94.6-3.8-4.1-10-5.1-14.8-2.3L380.8 110c-17.9-15.4-38.5-27.3-60.8-35.1V25.8c0-5.6-3.9-10.5-9.4-11.7-36.7-8.2-74.3-7.8-109.2 0-5.5 1.2-9.4 6.1-9.4 11.7V75c-22.2 7.9-42.8 19.8-60.8 35.1L88.7 85.5c-4.9-2.8-11-1.9-14.8 2.3-24.7 26.7-43.6 58.9-54.7 94.6-1.7 5.4.6 11.2 5.5 14L67.3 221c-4.3 23.2-4.3 47 0 70.2l-42.6 24.6c-4.9 2.8-7.1 8.6-5.5 14 11.1 35.6 30 67.8 54.7 94.6 3.8 4.1 10 5.1 14.8 2.3l42.6-24.6c17.9 15.4 38.5 27.3 60.8 35.1v49.2c0 5.6 3.9 10.5 9.4 11.7 36.7 8.2 74.3 7.8 109.2 0 5.5-1.2 9.4-6.1 9.4-11.7v-49.2c22.2-7.9 42.8-19.8 60.8-35.1l42.6 24.6c4.9 2.8 11 1.9 14.8-2.3 24.7-26.7 43.6-58.9 54.7-94.6 1.5-5.5-.7-11.3-5.6-14.1zM256 336c-44.1 0-80-35.9-80-80s35.9-80 80-80 80 35.9 80 80-35.9 80-80 80z">
                            </path>
                        </svg><!-- <span class="fas fa-cog"></span> Font Awesome fontawesome.com --></button>
                    <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="email-settings">
                        <a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#modal-supplier"
                            id="button-tambah-periode-supplier">Tambah Periode</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#modal-supplier"
                            id="button-cari-supplier">Pilih Suplier</a>
                        <a class="dropdown-item" href="#!" id="button-cari-barang">Pilih Barang</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#!">Send feedback</a>
                        <a class="dropdown-item" href="#!">Help</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <span id="menu-data-supplier">

    </span>
@endsection
@section('base.js')
    <div class="modal fade" id="modal-kapus" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content border-0">
                <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="menu-kapus"></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-kapus-full" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 95%;">
            <div class="modal-content border-0">
                <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="menu-kapus-full"></div>
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
        new window.Choices(document.querySelector(".choices-single-tahun"));
    </script>
    <script>
        $(document).on("click", "#button-add-periode-penilaian-kapus", function (e) {
            e.preventDefault();
            var code = $(this).data("code");
            $('#modal-kapus').modal('show');
            $('#menu-kapus').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: "{{ route('evaluasi_kapus_penilaian_supplier_add_periode') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": 123,

                },
                dataType: 'html',
            }).done(function (data) {
                $('#menu-kapus').html(data);
            }).fail(function () {
                $('#menu-kapus').html('eror');
            });

        });

    </script>
    <script>
        $('#periode-penilaian').on("change", function () {
            $('#menu-data-supplier').html('<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>');
            $.ajax({
                url: "{{ route('evaluasi_kapus_penilaian_supplier_detail_periode') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": 123,

                },
                dataType: 'html',
            }).done(function (data) {
                $('#menu-data-supplier').html(data);
            }).fail(function () {
                $('#menu-data-supplier').html('eror');
            });
        });
        $(document).on("click", "#button-tambah-data-penilaian-supplier", function (e) {
            e.preventDefault();
            var code = $(this).data("code");
            $('#modal-kapus-full').modal('show');
            $('#menu-kapus-full').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: "{{ route('evaluasi_kapus_penilaian_supplier_detail_periode_supplier') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": code,

                },
                dataType: 'html',
            }).done(function (data) {
                $('#menu-kapus-full').html(data);
            }).fail(function () {
                $('#menu-kapus-full').html('eror');
            });

        });
        $(document).on("click", "#button-penilaian-supplier", function (e) {
            e.preventDefault();
            var code = $(this).data("code");
            $('#modal-kapus-full').modal('show');
            $('#menu-kapus-full').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: "{{ route('evaluasi_kapus_penilaian_supplier_detail_periode_supplier_add') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": code,

                },
                dataType: 'html',
            }).done(function (data) {
                $('#menu-kapus-full').html(data);
            }).fail(function () {
                $('#menu-kapus-full').html('eror');
            });

        });
        $(document).on("click", "#button-simpan-fix-proses-penilaian", function (e) {
            e.preventDefault();
            var dataid = document.getElementById("periode-penilaian").value;
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-falcon-success",
                    cancelButton: "btn btn-falcon-danger"
                },
                buttonsStyling: true
            });
            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You want Proses This!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Proses it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('evaluasi_kapus_penilaian_supplier_fix_detail_periode') }}",
                        type: "POST",
                        cache: false,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "code": dataid
                        },
                        dataType: 'html',
                    }).done(function (data) {
                        swalWithBootstrapButtons.fire({
                            title: "Success!",
                            text: "Your data has been Saved.",
                            icon: "success"
                        });
                        console.log(data);
                    }).fail(function () {
                        swalWithBootstrapButtons.fire({
                            title: "Failed",
                            text: "Your data is Failed :)",
                            icon: "error"
                        });
                    });

                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your data is Failed :)",
                        icon: "error"
                    });
                }
            });
        });
    </script>

@endsection
