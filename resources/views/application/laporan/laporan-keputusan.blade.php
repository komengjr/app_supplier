@extends('layouts.template')
@section('base.css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap5.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.4/css/buttons.dataTables.css">
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
                    <h4 class="text-primary fw-bold mb-0">Laporan <span class="text-info fw-medium">Keputsan</span></h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-3">
    <div class="card-body d-flex justify-content-left">

        <div class="dropdown font-sans-serif me-3">
            <select name="kategori_penilaian" class="form-control choices-single-kategori" id="kategori-penilaian" required>
                <option value="">Pilih Kategori</option>
                <option value="barang">Barang</option>
                <option value="jasa">Jasa</option>
                <option value="rujukan">Rujukan</option>

            </select>
        </div>
        <div class="dropdown font-sans-serif">
            <select name="agreement" class="form-control choices-single-tahun" id="periode-penilaian" required>
                <option value="">Pilih Periode Tahun</option>
                @foreach ($data as $datas)
                <option value="{{ $datas->log_master_code }}">Periode {{ $datas->log_master_periode }}</option>
                @endforeach
            </select>
        </div>

        <div class="d-flex justify-content-between">

        </div>
    </div>
</div>
<div class="card mb-3">
    <div class="" id="menu-laporan-keputusan">

    </div>
</div>
@endsection
@section('base.js')
<div class="modal fade" id="modal-laporan" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content border-0">
            <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="menu-laporan"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-laporan-full" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 95%;">
        <div class="modal-content border-0">
            <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="menu-laporan-full"></div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.4/js/responsive.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.4/js/dataTables.buttons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.4/js/buttons.print.min.js"></script>
<script src="{{ asset('vendors/choices/choices.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    new window.Choices(document.querySelector(".choices-single-tahun"));
    new window.Choices(document.querySelector(".choices-single-kategori"));
    $('#periode-penilaian').on("change", function() {
        var dataid = document.getElementById("periode-penilaian").value;
        var kategori = document.getElementById("kategori-penilaian").value;
        if (dataid == "" || kategori == "") {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                footer: '<a href="#">Why do I have this issue?</a>'
            });
        } else {
            $("#menu-laporan-keputusan").html('<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>');
            $.ajax({
                url: "{{ route('laporan_keputusan_periode') }}",
                type: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "code": dataid,
                    "kategori": kategori,
                },
                dataType: 'html',
            }).done(function(data) {
                $("#menu-laporan-keputusan").html(data);
            }).fail(function() {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                    footer: '<a href="#">Why do I have this issue?</a>'
                });
            });
        }
    });
</script>
<script>
    $(document).on("click", "#button-barang-surat-keputusan", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-laporan').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('laporan_keputusan_surat_keputusan_barang') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-laporan').html(data);
        }).fail(function() {
            $('#menu-laporan').html('eror');
        });
    });
    $(document).on("click", "#button-barang-lampiran-terpilih", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-laporan').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('laporan_keputusan_surat_keputusan_barang_terpilih') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-laporan').html(data);
        }).fail(function() {
            $('#menu-laporan').html('eror');
        });
    });
    $(document).on("click", "#button-jasa-lampiran-terpilih", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-laporan').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('laporan_keputusan_surat_keputusan_jasa_terpilih') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-laporan').html(data);
        }).fail(function() {
            $('#menu-laporan').html('eror');
        });
    });
    $(document).on("click", "#button-rujukan-lampiran-terpilih", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-laporan').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('laporan_keputusan_surat_keputusan_rujukan_terpilih') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-laporan').html(data);
        }).fail(function() {
            $('#menu-laporan').html('eror');
        });
    });

</script>
@endsection
