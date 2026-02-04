<div class="modal-body p-0">
    <div class="bg-danger rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Add Supplier Email</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <form class="row g-3 p-4" action="{{ route('master_suplier_add_email_save') }}" method="post">
        @csrf
        <h4>Email Perusahaan</h4>
        <div class="col-md-6">
            <label class="form-label" for="inputAddress">Contact Name</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="contact_name" placeholder="Ibu Example" />
            <input type="text" name="data_supplier" id="" value="{{ $code }}" hidden>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="inputAddress">Email</label>
            <input class="form-control form-control-lg  " id="inputAddress" type="text" name="contact_email" placeholder="Ex@gmail.com" />
        </div>
        <div class="col-12">
            <button class="btn btn-primary float-end" type="submit"><span class="fas fa-save"></span> Tambah</button>
        </div>
    </form>
</div>
