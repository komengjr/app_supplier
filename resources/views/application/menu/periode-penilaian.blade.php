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
                    <h4 class="text-primary fw-bold mb-0">Periode <span class="text-info fw-medium">Penilaian</span>
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
                <h3 class="m-0"><span class="badge bg-primary m-0 p-0">Data Periode Penilaian</span></h3>
            </div>
            <div class="col-auto">

                <div class="btn-group" role="group">
                    <button class="btn btn-sm btn-falcon-primary dropdown-toggle" id="btnGroupVerticalDrop2"
                        type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                            class="fas fa-align-left me-1" data-fa-transform="shrink-3"></span>Option</button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-periode"
                            id="button-tambah-data-periode" data-code="123"><span class="fab fa-superpowers"></span>
                            Tambah Periode</button>
                        <!-- <div class="dropdown-divider"></div>
                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-barang"
                                    id="button-upload-data-barang" data-code="123"><span
                                        class="fas fa-cloud-upload-alt"></span> Upload Barang</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body border-top p-3">
        <table id="example" class="table table-striped" style="width:100%">
            <thead class="bg-200 text-700">
                <tr>
                    <th>No</th>
                    <th>Periode</th>
                    <th>Kepala Cabang</th>
                    <th>Manager SDM</th>
                    <th>No Surat</th>
                    <th>Team Evaluasi</th>
                    <th>Status Evaluasi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($periode as $per)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $per->log_master_periode }}</td>
                    <td>{{ $per->log_master_kacab }}</td>
                    <td>{{ $per->log_master_mgr }}</td>
                    <td>
                        <li>No Surat Keputusan : {{ $per->log_master_no_surat }}</li>
                        <!-- <li>No Surat Lampiran Barang : {{ $per->log_master_no_surat_brg }}</li>
                        <li>No Surat Lampiran Jasa : {{ $per->log_master_no_surat_jasa }}</li>
                        <li>No Surat Lampiran Rujukan : {{ $per->log_master_no_surat_rujukan }}</li> -->
                    </td>

                    <td>
                        @php
                        $team = DB::table('log_master_team')->where('log_master_code',$per->log_master_code)->get();
                        @endphp
                        @foreach ($team as $teams)
                        <li>
                            {{ $teams->log_master_team_name }} <a href="#" data-bs-toggle="modal" data-bs-target="#modal-periode" id="button-edit-team-penilai" data-code="{{ $teams->log_master_team_code }}"><span class="fas fa-edit text-warning"></span></a><br>
                            <small>{{ $teams->log_master_team_nip }} <br>{{ $teams->log_master_team_jabatan }}</small>
                        </li>
                        @endforeach
                    </td>
                    <td>
                        @if ($per->log_master_status_date == "")
                        <span class="badge bg-danger">Belum</span>
                        @else
                        <span class="badge bg-primary">Selesai</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-falcon-primary dropdown-toggle" id="btnGroupVerticalDrop2"
                                type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                    class="fas fa-align-left me-1" data-fa-transform="shrink-3"></span>Option</button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                                @if ($per->log_master_status_date == "")
                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-periode" id="button-update-periode-cabang" data-code="{{ $per->log_master_code  }}"><span class="far fa-edit"></span>
                                    Update</button>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-periode"
                                    id="button-tambah-team-penilaian" data-code="{{ $per->log_master_code  }}"><span
                                        class="fas fa-user-check"></span> Tambah Team Penilaian</button>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#modal-periode-full"
                                    id="button-penyelesaian-penilaian" data-code="{{ $per->log_master_code  }}"><span
                                        class="far fa-check-square"></span> Penyelesaian Evaluasi</button>
                                @else
                                <button class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#modal-periode-full"
                                    id="button-print-evaluasi" data-code="{{ $per->log_master_code  }}"><span
                                        class="fas fa-print"></span> Print Hasil Evaluasi</button>
                                @endif

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
<div class="modal fade" id="modal-periode" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0">
            <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="menu-periode"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-periode-full" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 95%;">
        <div class="modal-content border-0">
            <div class="position-absolute top-0 end-0 mt-3 me-3 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="menu-periode-full"></div>
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
    $(document).on("click", "#button-tambah-data-periode", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-periode').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('periode_penilaian_add') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-periode').html(data);
        }).fail(function() {
            $('#menu-periode').html('eror');
        });
    });
    $(document).on("click", "#button-update-periode-cabang", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-periode').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('periode_penilaian_update') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-periode').html(data);
        }).fail(function() {
            $('#menu-periode').html('eror');
        });
    });
    $(document).on("click", "#button-tambah-team-penilaian", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-periode').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('periode_penilaian_add_team_penilaian') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-periode').html(data);
        }).fail(function() {
            $('#menu-periode').html('eror');
        });
    });
    $(document).on("click", "#button-edit-team-penilai", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-periode').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('periode_penilaian_update_team_penilaian') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-periode').html(data);
        }).fail(function() {
            $('#menu-periode').html('eror');
        });
    });
    $(document).on("click", "#button-penyelesaian-penilaian", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        $('#menu-periode-full').html(
            '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $.ajax({
            url: "{{ route('periode_penilaian_penyelesaian_penilaian') }}",
            type: "POST",
            cache: false,
            data: {
                "_token": "{{ csrf_token() }}",
                "code": code
            },
            dataType: 'html',
        }).done(function(data) {
            $('#menu-periode-full').html(data);
        }).fail(function() {
            $('#menu-periode-full').html('eror');
        });
    });
    $(document).on("click", "#button-fix-save-penyelesaian-penilaian-evaluasi", function(e) {
        e.preventDefault();
        var code = $(this).data("code");
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: true
        });
        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Agree!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire({
                    title: "Success!",
                    text: "Your data has been Saved.",
                    icon: "success"
                });
                $('#footer-penyelesaian-evaluasi').html(
                    '<div class="spinner-border my-3" style="display: block; margin-left: auto; margin-right: auto;" role="status"><span class="visually-hidden">Loading...</span></div>'
                );
                $.ajax({
                    url: "{{ route('periode_penilaian_penyelesaian_penilaian_save') }}",
                    type: "POST",
                    cache: false,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "code": code
                    },
                    dataType: 'html',
                }).done(function(data) {
                    location.reload();
                }).fail(function() {
                    $('#footer-penyelesaian-evaluasi').html('eror');
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Your data is not save :)",
                    icon: "error"
                });
            }
        });

    });
</script>
@endsection
