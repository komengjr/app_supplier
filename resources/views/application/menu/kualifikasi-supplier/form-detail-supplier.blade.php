<div class="modal-body p-0">
    <div class="bg-danger rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Detail Suplier Cabang</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <form class="row g-3 p-4" action="{{ route('kualifikasi_supplier_add_supplier_save') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="col-6">
            <label class="form-label" for="inputAddress">Nama Suplier</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="name" placeholder="PT Jhon"
                required />
        </div>
        <div class="col-6">
            <label class="form-label" for="inputAddress">Kota Suplier</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="city" placeholder="Papua"
                required />
        </div>
        <div class="col-6">
            <label class="form-label" for="inputAddress">Telepon</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="phone"
                placeholder="0000000" />
        </div>
        <div class="col-6">
            <label class="form-label" for="inputAddress">Email</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="email"
                placeholder="0000000" />
        </div>
        <div class="col-12">
            <label class="form-label" for="inputAddress">Alamat</label>
            <input class="form-control form-control-lg  " id="inputAddress" type="text" name="alamat"
                placeholder="Jl Example" required />
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
