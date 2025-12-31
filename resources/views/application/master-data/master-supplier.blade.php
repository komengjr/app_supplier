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
                    <img class="ms-3 mx-3 m-2" src="{{ asset('img/supplier.png') }}" alt="" width="70" />
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
                    <h4 class="text-primary fw-bold mb-0">Master <span class="text-info fw-medium">Suplier</span></h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header bg-danger">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="m-0"><span class="badge bg-danger m-0 p-0">Master Suplier All Cabang</span></h3>
            </div>
            <div class="col-auto">

                <!-- <div class="btn-group" role="group">
                    <button class="btn btn-sm btn-falcon-primary dropdown-toggle" id="btnGroupVerticalDrop2" type="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                            class="fas fa-align-left me-1" data-fa-transform="shrink-3"></span>Option</button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-suplier"
                            id="button-tambah-data-suplier" data-code="123"><span class="fab fa-superpowers"></span> Tambah Suplier</button>
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-suplier"
                            id="button-upload-data-supplier" data-code="123"><span
                                class="fas fa-cloud-upload-alt"></span> Upload Supplier</button>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <div class="card-body border-top p-3">
        <table id="example" class="table table-striped" style="width:100%">
            <thead class="bg-200 text-700">
                <tr class="fs--2">
                    <th>No</th>
                    <th>Nama Suplier</th>
                    <th>Kota Suplier</th>
                    <th>Contact Person</th>
                    <th>Email</th>
                    <th>Kategori</th>
                    <th>Alamat Cabang</th>
                    <th>Cabang Pembuat</th>
                    <td>Pengadaan</td>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($data as $datas)
                <tr class="fs--2">
                    <td>{{ $no++ }}</td>
                    <td>{{ $datas->m_supplier_name }}</td>
                    <td>{{ $datas->m_supplier_city }}</td>
                    <td>
                        @php
                        $contact = DB::table('m_supplier_contact')->where('m_supplier_code',$datas->m_supplier_code)->get();
                        @endphp
                        @foreach ($contact as $con)
                        <small>
                            <li>{{ $con->m_supplier_contact_name }} - {{ $con->m_supplier_contact_number }}</li>
                        </small>
                        @endforeach
                    </td>
                    <td>{{ $datas->m_supplier_email }}</td>
                    <td>{{ $datas->m_supplier_cat }}</td>
                    <td>
                        @php
                        $addres = DB::table('m_supplier_address')->where('m_supplier_code',$datas->m_supplier_code)->get();
                        @endphp
                        @foreach ($addres as $add)
                        <li>{{ $add->m_supplier_address_name }}</li>
                        @endforeach
                    </td>
                    <td>
                        @php
                        $cabang = DB::table('master_cabang')
                        ->select('master_cabang_name')
                        ->where('master_cabang_code',$datas->m_supplier_cabang)->first();
                        @endphp
                        @if ($cabang)
                        {{ $cabang->master_cabang_name }}
                        @else
                        Nasional
                        @endif
                    </td>
                    <td>
                        @php
                            $pengadaan = DB::table('m_supplier_type')
                            ->join('type_pengadaan','type_pengadaan.type_pengadaan_code','=','m_supplier_type.type_pengadaan_code')
                            ->where('m_supplier_type.m_supplier_code',$datas->m_supplier_code)->get();
                        @endphp
                        @foreach ($pengadaan as $peng)
                            <li>{{ $peng->type_pengadaan_name }}</li>
                        @endforeach
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-falcon-primary dropdown-toggle" id="btnGroupVerticalDrop2" type="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                    class="fas fa-align-left me-1" data-fa-transform="shrink-3"></span>Option</button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-suplier"
                                    id="button-add-data-contact-supplier" data-code="{{$datas->m_supplier_code}}"><span class="fas fa-phone-square-alt"></span> Tambah Contact</button>
                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-suplier"
                                    id="button-add-data-alamat-supplier" data-code="{{$datas->m_supplier_code}}">
                                    <span class="fas fa-address-card"></span> Tambah Alamat</button>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#modal-suplier-full"
                                    id="button-dcoument-legal-supplier" data-code="{{$datas->m_supplier_code}}">
                                    <span class="fas fa-file-pdf"></span> Document Legalitas</button>
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
<div class="modal fade" id="modal-suplier-full" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 95%;">
        <div class="modal-content border-0">
            <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="menu-suplier-full"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-suplier" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0">
            <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="menu-suplier"></div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.4/js/responsive.bootstrap5.js"></script>
<script src="{{ asset('vendors/choices/choices.min.js') }}"></script>
<script>
    new DataTable('#example', {
        responsive: true
    });
</script>
<script>
    $(document).on("click", "#button-tambah-data-suplier", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-suplier').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('master_suplier_add') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-suplier').html(data);
        }).fail(function() {
            $('#menu-suplier').html('eror');
        });
    });
    $(document).on("click", "#button-add-data-contact-supplier", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-suplier').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('master_suplier_add_contact') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-suplier').html(data);
        }).fail(function() {
            $('#menu-suplier').html('eror');
        });
    });
    $(document).on("click", "#button-add-data-alamat-supplier", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-suplier').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('master_suplier_add_alamat') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-suplier').html(data);
        }).fail(function() {
            $('#menu-suplier').html('eror');
        });
    });
    $(document).on("click", "#button-dcoument-legal-supplier", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-suplier-full').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('master_suplier_detail_document') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-suplier-full').html(data);
        }).fail(function() {
            $('#menu-suplier-full').html('eror');
        });
    });
    $(document).on("click", "#button-preview-file", function(e) {
        e.preventDefault();
        var file = $(this).data("file");
        $('#show-file-doc').html(
            '<iframe src="../../../' + file + '" style="width:100%; height:533px;" frameborder="0"></iframe>'
        );
    });
</script>
@endsection
