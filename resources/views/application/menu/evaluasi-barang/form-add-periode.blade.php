<div class="modal-body p-0">
    <div class="bg-300 rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" id="staticBackdropLabel">Tambah Periode</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <form class="row g-3 p-4" action="{{ route('evaluasi_supplier_barang_tambah_periode_supplier_save') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-12">
            <label class="form-label" for="inputAddress">Periode</label>
            <input type="text" class="form-control form-control-lg" name="periode" id="">

            <!-- <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" id="gridCheck" type="checkbox" required />
                <label class="form-check-label" for="gridCheck">Check me</label>
            </div>
        </div> -->
            <div class="col-12 pt-3">
                <button class="btn btn-primary float-end" type="submit"><span class="fas fa-save"></span> Simpan</button>
            </div>
        </div>
    </form>
</div>

