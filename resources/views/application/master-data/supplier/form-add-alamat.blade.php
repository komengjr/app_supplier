<div class="modal-body p-0">
    <div class="bg-danger rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Add Suplier Address</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <form class="row g-3 p-4" action="{{ route('master_suplier_add_alamat_save') }}" method="post">
        @csrf
        <div class="col-md-12">
            <label class="form-label" for="inputAddress">Alamat Cabang</label>
            <textarea name="alamat" class="form-control" id=""></textarea>
            <input type="text" name="data_supplier" id="" value="{{ $code }}" hidden>
        </div>

        <div class="col-12">
            <button class="btn btn-primary float-end" type="submit"><span class="fas fa-save"></span> Tambah</button>
        </div>
    </form>
</div>
