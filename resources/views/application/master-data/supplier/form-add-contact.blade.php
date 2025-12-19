<div class="modal-body p-0">
    <div class="bg-danger rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Add Suplier Contact</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <form class="row g-3 p-4" action="{{ route('kualifikasi_supplier_detail_supplier_save_contact') }}" method="post">
        @csrf
        <h4>Contact Person</h4>
        <div class="col-md-6">
            <label class="form-label" for="inputAddress">Contact Name</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="contact_name" placeholder="Ibu Example" />
            <input type="text" name="data_supplier" id="" value="{{ $code }}" hidden>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="inputAddress">Contact Number</label>
            <input class="form-control form-control-lg  " id="inputAddress" type="text" name="contact_number" placeholder="0823xxxxxx" />
        </div>
        <div class="col-12">
            <button class="btn btn-primary float-end" type="submit"><span class="fas fa-save"></span> Tambah</button>
        </div>
    </form>
</div>
