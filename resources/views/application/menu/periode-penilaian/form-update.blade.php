<div class="modal-body p-0">
    <div class="bg-300 rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" id="staticBackdropLabel">Update Periode Penilaian</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <form class="row g-3 p-4" action="{{ route('periode_penilaian_update_save') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <label class="form-label" for="inputAddress">Periode Tahun</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="periode"
                value="{{ $data->log_master_periode }}" required />
            <input type="text" name="code" value="{{ $data->log_master_code }}" hidden>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="inputAddress">Kepala Cabang</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="kacab"
                value="{{ $data->log_master_kacab }}" required />
        </div>
        <div class="col-md-6">
            <label class="form-label" for="inputAddress">Manager SDM</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="mgr"
                value="{{ $data->log_master_mgr }}" required />
        </div>
        <div class="col-md-6">
            <label class="form-label" for="inputAddress">Bagian Pengadaan</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="bag"
                value="{{ $data->log_master_bag }}" required />
        </div>
        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" id="gridCheck" type="checkbox" required />
                <label class="form-check-label" for="gridCheck">Check me</label>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit"><span class="fas fa-save"></span> Save</button>
        </div>
    </form>
</div>
