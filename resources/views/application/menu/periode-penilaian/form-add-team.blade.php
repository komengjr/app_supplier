<div class="modal-body p-0">
    <div class="bg-300 rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" id="staticBackdropLabel">Add Team Penilaian</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <form class="row g-3 p-4" action="{{ route('periode_penilaian_add_team_penilaian_save') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-12">
            <label class="form-label" for="inputAddress">Nama</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="nama" placeholder="Jhone Doe Iskandar"
                required />
            <input type="text" name="code" value="{{ $code }}" hidden>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="inputAddress">NIP</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="nip" placeholder="0011000110"
                required />
        </div>
        <div class="col-md-6">
            <label class="form-label" for="inputAddress">Jabatan</label>
            <input class="form-control form-control-lg" id="inputAddress" type="text" name="jabatan" placeholder="Laboratorium"
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
