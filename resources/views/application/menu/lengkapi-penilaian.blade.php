@extends('layouts.template')
@section('base.css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap5.css">
<link href="{{ asset('vendors/choices/choices.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
<div class="row mb-3">
    <div class="col">
        <div class="card bg-100 border">
            <div class="row gx-0 flex-between-center">
                <div class="col-sm-auto d-flex align-items-center border-bottom">
                    <img class="ms-3 mx-3 m-2" src="{{ asset('img/app.png') }}" alt="" width="50" />
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
                    <h4 class="text-primary fw-bold mb-0">Lengkapi Penilaian <span class="text-info fw-medium">Data</span></h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-3">
    <div class="card-body d-flex justify-content-between">
        <div class="d-flex">
            <div class="row">
                <div class="col-md-6">
                    <select name="agreement" class="form-control choices-single-tahun" id="periode-penilaian" required>
                        <option value="">Pilih Periode Tahun</option>
                        @foreach ($periode as $periodes)
                        @if ($periodes->log_master_status_date == "")
                        <option value="{{ $periodes->log_master_code  }}">{{ $periodes->log_master_periode  }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <select name="" class="form-control choices-single-tipe" id="type-penilaian" required>
                        <option value="">Pilih Periode Tahun</option>
                        <option value="barang">Penilaian Barang</option>
                        <option value="jasa">Penilaian Jasa</option>
                        <option value="rujukan">Penilaian Rujukan</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="d-none d-md-block">
                <a class="btn btn-falcon-primary" href="#!" id="button-cari-data">
                    <span class="fab fa-searchengin me-1"></span>Cari Data</a>
            </div>
        </div>
    </div>
</div>
<span id="menu-lengkapi-data">

</span>
@endsection
@section('base.js')
<div class="modal fade" id="modal-supplier" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0">
            <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="menu-supplier"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-supplier-full" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 95%;">
        <div class="modal-content border-0">
            <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="menu-supplier-full"></div>
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
    new window.Choices(document.querySelector(".choices-single-tipe"));
</script>
<script>
    $(document).on("click", "#button-cari-data", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        var tahun = document.getElementById("periode-penilaian").value;
        var type = document.getElementById("type-penilaian").value;
        if (tahun == "" || type == "") {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                footer: '<a href="#">Why do I have this issue?</a>'
            });
        } else {
            $('#menu-lengkapi-data').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: "{{ route('lengkapi_penilaian_supplier_barang_find') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "tahun": tahun,
                    "type": type,

                },
                dataType: 'html',
            }).done(function(data) {
                $('#menu-lengkapi-data').html(data);
            }).fail(function() {
                $('#menu-lengkapi-data').html('eror');
            });
        }
    });
    $(document).on("click", "#button-cari-barang", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        var tahun = document.getElementById("periode-penilaian").value;
        if (tahun == "") {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                footer: '<a href="#">Why do I have this issue?</a>'
            });
        } else {
            $('#modal-supplier').modal('show');
            $('#menu-supplier').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: "{{ route('evaluasi_supplier_barang_cari_barang') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": code
                },
                dataType: 'html',
            }).done(function(data) {
                $('#menu-supplier').html(data);
            }).fail(function() {
                $('#menu-supplier').html('eror');
            });
        }
    });
    $(document).on("click", "#button-next-periode-penilaian", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        var supplier = $(this).data("supplier");
        $('#menu-supplier').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('lengkapi_penilaian_supplier_barang_simpan') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code,
                "supplier": supplier,
            },
            dataType: 'html',
        }).done(function(data) {
            $("#menu-table-penilaian").html(data);
        }).fail(function() {
            console.log('eror');
        });
    });

    $(document).on("click", "#button-proses-nilai-supplier", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        var supplier = $(this).data("supplier");
        var periode = $(this).data("periode");
        console.log(periode);

        $('#menu-supplier-full').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('lengkapi_penilaian_supplier_barang_proses') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code,
                "supplier": supplier,
                "periode": periode,
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-supplier-full').html(data);
        }).fail(function() {
            $('#menu-supplier-full').html('eror');
        });
    });
    $(document).on("click", "#button-pilih-data-supplier", function(e) {
        e.preventDefault();
        var code = document.getElementById("data_supplier").value;
        var tahun = document.getElementById("periode-penilaian").value;
        if (code == "") {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                footer: '<a href="#">Why do I have this issue?</a>'
            });
        } else {
            $('#menu-data-supplier').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: "{{ route('evaluasi_supplier_barang_pilih_supplier') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": code,
                    "tahun": tahun,
                },
                dataType: 'html',
            }).done(function(data) {
                $('#modal-supplier').modal('hide');
                $('#menu-data-supplier').html(data);
            }).fail(function() {
                $('#menu-data-supplier').html('eror');
            });
        }
    });
    $(document).on("click", "#button-pilih-data-barang", function(e) {
        e.preventDefault();
        var code = document.getElementById("data_barang").value;
        var tahun = document.getElementById("periode-penilaian").value;
        if (code == "" || tahun == "") {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                footer: '<a href="#">Why do I have this issue?</a>'
            });
        } else {
            $('#menu-data-supplier').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: "{{ route('evaluasi_supplier_barang_pilih_barang') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": code,
                    "tahun": tahun,
                },
                dataType: 'html',
            }).done(function(data) {
                $('#modal-supplier').modal('hide');
                $('#menu-data-supplier').html(data);
            }).fail(function() {
                $('#menu-data-supplier').html('eror');
            });
        }
    });
    $(document).on("click", "#button-tambah-data-barang", function(e) {
        e.preventDefault();
        var code = document.getElementById("data_supplier").value;
        var tahun = document.getElementById("periode-penilaian").value;
        if (code == "" || tahun == "") {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                footer: '<a href="#">Why do I have this issue?</a>'
            });
        } else {
            $('#menu-supplier').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: "{{ route('evaluasi_supplier_barang_pilih_periode_supplier_add_barang') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": code,
                    "tahun": tahun,
                },
                dataType: 'html',
            }).done(function(data) {
                $('#menu-supplier').html(data);
            }).fail(function() {
                $('#menu-supplier').html('eror');
            });
        }
    });
    $(document).on("click", "#button-tambah-data-supplier", function(e) {
        e.preventDefault();
        var code = document.getElementById("data_barang").value;
        var tahun = document.getElementById("periode-penilaian").value;
        if (code == "" || tahun == "") {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                footer: '<a href="#">Why do I have this issue?</a>'
            });
        } else {
            $('#menu-supplier').html(
                '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: "{{ route('evaluasi_supplier_barang_pilih_periode_barang_add_supplier') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": code,
                    "tahun": tahun,
                },
                dataType: 'html',
            }).done(function(data) {
                $('#menu-supplier').html(data);
            }).fail(function() {
                $('#menu-supplier').html('eror');
            });
        }
    });
    $(document).on("click", "#button-simpan-data-barang", function(e) {
        e.preventDefault();
        var supplier = document.getElementById("code_supplier").value;
        var barang = document.getElementById("data_barang").value;
        var periode = document.getElementById("periode-penilaian").value;
        if (supplier == "") {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                footer: '<a href="#">Why do I have this issue?</a>'
            });
        } else {

            $.ajax({
                url: "{{ route('evaluasi_supplier_barang_proses_penilaian_barang') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "supplier": supplier,
                    "barang": barang,
                    "periode": periode,

                },
                dataType: 'html',
            }).done(function(data) {
                if (data == 0) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Supplier Sudah Pernah Disimpan",
                        footer: '<a href="#">Sudah Cek di Table Bawah?</a>'
                    });
                } else {
                    $('#modal-supplier').modal('hide');
                    $('#modal-supplier-full').modal('show');
                    $('#menu-supplier-full').html(
                        '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
                    );
                    $('#menu-supplier-full').html(data);
                }
            }).fail(function() {
                $('#menu-supplier-full').html('eror');
            });
        }
    });
    $(document).on("click", "#button-simpan-data-supplier", function(e) {
        e.preventDefault();
        var supplier = document.getElementById("data_supplier").value;
        var barang = document.getElementById("code_barang").value;
        var periode = document.getElementById("periode-penilaian").value;
        if (supplier == "") {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                footer: '<a href="#">Why do I have this issue?</a>'
            });
        } else {

            $.ajax({
                url: "{{ route('evaluasi_supplier_barang_proses_penilaian_barang') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "supplier": supplier,
                    "barang": barang,
                    "periode": periode,

                },
                dataType: 'html',
            }).done(function(data) {
                if (data == 0) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Supplier Sudah Pernah Disimpan",
                        footer: '<a href="#">Sudah Cek di Table Bawah?</a>'
                    });
                } else {
                    $('#modal-supplier').modal('hide');
                    $('#modal-supplier-full').modal('show');
                    $('#menu-supplier-full').html(
                        '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
                    );
                    $('#menu-supplier-full').html(data);
                }
            }).fail(function() {
                $('#menu-supplier-full').html('eror');
            });
        }
    });
    $(document).on("click", "#button-next-periode-penilaian-barang", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        var supplier = $(this).data("supplier");
        var barang = $(this).data("barang");
        var tahun = document.getElementById("periode-penilaian").value;
        $.ajax({
            url: "{{ route('evaluasi_supplier_barang_proses_penilaian_barang_next') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code,
                "supplier": supplier,
                "barang": barang,
                "tahun": tahun,
            },
            dataType: 'html',
        }).done(function(data) {
            $("#menu-table-penilaian").html(data);
        }).fail(function() {
            console.log('eror');
        });
    });
</script>
<script>
    $('#periode-penilaian').on("change", function() {
        $('#menu-data-supplier').html("");
    });
    $(document).on("click", "#button-simpan-fix-proses-penilaian", function(e) {
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
                    url: "{{ route('evaluasi_supplier_barang_proses_penilaian_supplier_save_fix') }}",
                    type: "POST",
                    cache: false,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "code": dataid
                    },
                    dataType: 'html',
                }).done(function(data) {
                    swalWithBootstrapButtons.fire({
                        title: "Success!",
                        text: "Your data has been Saved.",
                        icon: "success"
                    });
                    console.log(data);

                }).fail(function() {
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
@foreach ($cat as $cats)
<script>
    $(document).on("click", "#button-simpan-prosess-penilaian{{$cats->t_penilaian_cat_code }}", function(e) {
        e.preventDefault();
        var data = $("#form{{$cats->t_penilaian_cat_code }}").serialize();
        $.ajax({
            url: "{{ route('evaluasi_supplier_barang_proses_penilaian_supplier_save') }}",
            type: "POST",
            cache: false,
            data: data,
            dataType: 'html',
        }).done(function(data) {
            Swal.fire({
                title: "Berhasil Simpan.",
                icon: "success",
                draggable: true
            });
            $('#button-simpan-prosess-penilaian{{$cats->t_penilaian_cat_code }}').hide();
        }).fail(function() {
            $('#menu-supplier-full').html('eror');
        });
    });
</script>
@endforeach
@endsection
