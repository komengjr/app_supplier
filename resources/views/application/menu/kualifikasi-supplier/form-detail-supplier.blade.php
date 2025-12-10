<div class="modal-body p-0">
    <div class="bg-danger rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Detail Suplier Cabang</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <div class="card m-4 border border-danger">
        <form class="row g-3 p-4" action="{{ route('kualifikasi_supplier_detail_supplier_save') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="col-6">
                <label class="form-label" for="inputAddress">Nama Suplier</label>
                <input class="form-control form-control-lg" id="inputAddress" type="text" name="name" value="{{ $data->m_supplier_name }}"
                    required />
                <input type="text" name="data_supplier" id="" value="{{ $data->m_supplier_code }}" hidden>
            </div>
            <div class="col-3">
                <label class="form-label" for="inputAddress">Kota Suplier</label>
                <input class="form-control form-control-lg" id="inputAddress" type="text" name="city" value="{{ $data->m_supplier_city }}"
                    required />
            </div>
            <div class="col-3">
                <label class="form-label" for="inputAddress">Kategori Suplier</label>
                <select name="kategori" class="form-control" id="">
                    <option value="{{ $data->m_supplier_cat }}">{{ $data->m_supplier_cat }}</option>
                    <option value="UMKM">UMKM</option>
                    <option value="NONUMKM">NON UMKM</option>
                </select>
            </div>
            <div class="col-6">
                <label class="form-label" for="inputAddress">Telepon</label>
                <input class="form-control form-control-lg" id="inputAddress" type="text" name="phone" value="{{ $data->m_supplier_phone }}" />
            </div>
            <div class="col-6">
                <label class="form-label" for="inputAddress">Email</label>
                <input class="form-control form-control-lg" id="inputAddress" type="text" name="email" value="{{ $data->m_supplier_email }}" />
            </div>
            <div class="col-12">
                <label class="form-label" for="inputAddress">Alamat</label>
                <input class="form-control form-control-lg  " id="inputAddress" type="text" name="alamat" value="{{ $data->m_supplier_alamat }}" />
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" id="gridCheck" type="checkbox" required />
                    <label class="form-check-label" for="gridCheck">Check me</label>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary float-end" type="submit"><span class="fas fa-save"></span> Update</button>
            </div>
        </form>
    </div>
    <div class="card m-4 border border-danger">
        <form class="row g-3 p-4" action="{{ route('kualifikasi_supplier_detail_supplier_save_contact') }}" method="post">
            @csrf
            <h4>Contact Person</h4>
            <div class="col-md-6">
                <label class="form-label" for="inputAddress">Contact Name</label>
                <input class="form-control form-control-lg" id="inputAddress" type="text" name="contact_name" placeholder="Ibu Example" />
                <input type="text" name="data_supplier" id="" value="{{ $data->m_supplier_code }}" hidden>
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
</div>
