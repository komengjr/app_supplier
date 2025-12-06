<div class="modal-body p-0">
    <div class="bg-danger rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Tambah Penawaran </h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <form class="row g-3 p-4" action="{{ route('evaluasi_kapus_data_penawaran_save') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <label class="form-label" for="inputAddress">Nama Project</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="name" placeholder="Pembelian Alat Elektromedis"
                required />
        </div>
        <div class="col-md-6">
            <label class="form-label" for="inputAddress">Department / Cabang</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="cabang"
                placeholder="Example" required />
        </div>
        <div class="col-md-6">
            <label class="form-label" for="inputAddress">Tujuan</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="tujuan" placeholder=".............."
                required />
        </div>
        <div class="col-md-6">
            <label class="form-label" for="inputAddress">Anggaran</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="anggaran" placeholder="Rp. xxxxxxxxx"
                required />
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
