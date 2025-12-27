<div class="modal-body p-0">
    <div class="bg-300 rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" id="staticBackdropLabel">Detail Document</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <div class="row g-3 p-4">
        <div class="col-md-7">
            <table class="table table-bordered border">
                <thead class="bg-300">
                    <tr>
                        <th>Nama Document</th>
                        <th>Doc</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doc as $docs)
                    <tr>
                        <td>{{ $docs->m_document_name }}<br><small class="text-warning">{{ $docs->m_document_desc }}</small></td>
                        <td>
                            @php
                            $file = DB::table('m_supplier_doc')->where('m_supplier_code', $code)->where('m_document_code', $docs->m_document_code)->first();
                            @endphp
                            @if ($file)
                            <button class="btn btn-primary" id="button-preview-file"
                                data-file="{{ $file->m_supplier_doc_file }}">Preview</button>
                            @else
                            <span id="button-waiting-list-<?php echo $docs->id_m_document ?>"></span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
            <span id="show-file-doc"></span>
        </div>
    </div>
</div>
