<div class="modal-body p-0">
    <div class="bg-300 rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" id="staticBackdropLabel">Cari Rujukan</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <div class="row g-3 p-4">
        <div class="col-12">
            <label class="form-label" for="inputAddress">Nama Rujukan</label>
            <select name="data_rujukan" id="data_rujukan" class="form-control choices-single-jenis" required>
                <option value="">Pilih Rujukan</option>
                @foreach ($data as $datas)
                <option value="{{ $datas->m_rujukan_code   }}">{{ $datas->m_rujukan_name }}</option>
                @endforeach
            </select>
            <!-- <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" id="gridCheck" type="checkbox" required />
                <label class="form-check-label" for="gridCheck">Check me</label>
            </div>
        </div> -->
            <div class="col-12 pt-3">
                <button class="btn btn-primary float-end" type="button" id="button-simpan-data-rujukan"><span class="fas fa-save"></span> Pilih</button>
            </div>
        </div>
    </div>
</div>
<script>
    new window.Choices(document.querySelector(".choices-single-jenis"));
</script>
