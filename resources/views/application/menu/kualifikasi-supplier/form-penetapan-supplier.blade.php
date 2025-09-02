<div class="modal-body p-0">
    <div class="bg-300 rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" id="staticBackdropLabel">Form Penetapan Supplier {{ $supplier->m_supplier_name }}</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <div class="row g-3 p-4">
        <div class="col-md-12">
            <table class="table table-bordered border">
                <thead class="bg-300">
                    <tr>
                        <th>Nama Document</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 0;
                    @endphp
                    @foreach ($doc as $docs)
                        <tr>
                            <td>{{ $docs->m_document_name }}</td>
                            <td class="text-center">
                                @php
                                    $file = DB::table('m_supplier_doc')->where('m_supplier_code', $code)->where('m_document_code', $docs->m_document_code)->first();
                                @endphp
                                @if ($file)
                                    <span class="far fa-check-circle text-success"></span>
                                    @php
                                        $no = $no + 1;
                                    @endphp
                                @else
                                    <span class="far fa-times-circle text-danger"></span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($doc->count() == $no)
                <form class="row g-3" action="{{ route('periode_penilaian_save') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-4">
                        <label class="form-label" for="inputAddress">Nomor Surat</label>
                        <input class="form-control form-control-lg" id="inputAddress" type="text" name="nomor"
                            placeholder="00000/0000/0000" required />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="inputAddress">Nomor NPWP/Legalitas</label>
                        <input class="form-control form-control-lg" id="inputAddress" type="text" name="npwp"
                            placeholder="0000000" required />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="inputAddress">Nomor Kontak</label>
                        <input class="form-control form-control-lg" id="inputAddress" type="text" name="kacab"
                            placeholder="Jhone Doe" required />
                    </div>
                    <div class="col-12">
                        <label for="organizerMultiple">Untuk Pengadaan Berupa:</label>
                        <select class="form-select js-choice-type" id="organizerMultiple" multiple="multiple" size="1"
                            name="organizerMultiple" data-options='{"removeItemButton":true,"placeholder":true}'>
                            <option value="">Select Tipe Pengadaan</option>
                            @foreach ($type as $types)
                                <option value="{{$types->type_pengadaan_code}}">{{$types->type_pengadaan_name}}</option>
                            @endforeach
                        </select>
                    </div>
                     <div class="col-md-4">
                        <label class="form-label" for="inputAddress">Kepala Cabang</label>
                        <input class="form-control form-control-lg" id="inputAddress" type="text" name="bag"
                            placeholder="Jhone Doe" required />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="inputAddress">Manager SDM</label>
                        <input class="form-control form-control-lg" id="inputAddress" type="text" name="mgr"
                            placeholder="Jhone Doe" required />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="inputAddress">Bagian Pengadaan</label>
                        <input class="form-control form-control-lg" id="inputAddress" type="text" name="mgr"
                            placeholder="Jhone Doe" required />
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" id="gridCheck" type="checkbox" required />
                            <label class="form-check-label" for="gridCheck">Check me</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit" id="button-save-penetapan-supplier"><span class="fas fa-save"></span> Save</button>
                    </div>
                </form>
            @endif
        </div>
        <!-- <iframe
            src="{{ asset('storage/data/document/06c22d3a-3043-41f0-b3b0-d17a5c5e8735/e2180a59-c878-462f-9968-f5da382996e6.pdf') }}"
            frameborder="0"></iframe> -->
    </div>
</div>
<script>
    new window.Choices(document.querySelector(".js-choice-type"));
</script>
