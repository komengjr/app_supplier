<div class="modal-body p-0">
    <div class="bg-300 rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" id="staticBackdropLabel">Upload Document</h4>
        <p class="fs--2 mb-0">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a></p>
    </div>
    <div class="row g-3 p-4">
        <div class="col-md-7">
            <table class="table table-bordered border">
                <thead class="bg-300">
                    <tr>
                        <th>Nama Document</th>
                        <th>Doc</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doc as $docs)
                    <tr>
                        <td>{{ $docs->m_document_name }}<br><small class="text-warning">{{ $docs->m_document_desc }}</small></td>
                        <td>
                            @php
                            $file = DB::table('m_supplier_doc')
                            ->where('m_supplier_doc_cab', Auth::user()->access_cabang)
                            ->where('m_supplier_code', $code)
                            ->where('m_document_code', $docs->m_document_code)->first();
                            @endphp
                            @if ($file)
                            <button class="btn btn-primary" id="button-preview-file"
                                data-file="{{ $file->m_supplier_doc_file }}">Previews</button>
                            @else
                            <span id="button-waiting-list-<?php echo $docs->id_m_document ?>"></span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span id="upload-param-<?php echo $docs->id_m_document ?>">
                                <span id="videoPreview<?php echo $docs->id_m_document ?>"></span>
                                <div class="progress<?php echo $docs->id_m_document ?>"
                                    style="height: 10px; margin-top: 10px; display: none;">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated loading<?php echo $docs->id_m_document ?>"
                                        role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 0%; height: 100%">0%
                                    </div>
                                    <br>
                                </div>
                                <input id="link<?php echo $docs->id_m_document ?>" type="text"
                                    name="link<?php echo $docs->id_m_document ?>" class="form-control" hidden>
                                <input class="frm-control" id="profile-image-{{ $docs->id_m_document  }}" type="file">

                            </span>
                        </td>
                    </tr>
                    <script type="text/javascript">
                        var browseFile<?php echo $docs->id_m_document ?> = $('#profile-image-{{ $docs->id_m_document }}');
                        var resumable<?php echo $docs->id_m_document ?> = new Resumable({
                            target: "{{ route('kualifikasi_supplier_upload_document_upload') }}",
                            query: {
                                _token: '{{ csrf_token() }}',
                                code: "{{ $code }}",
                                document: "{{ $docs->m_document_code }}",
                            }, // CSRF token
                            fileType: ['pdf'],
                            headers: {
                                'Accept': 'application/json'
                            },
                            testChunks: false,
                            throttleProgressCallbacks: 1,
                        });
                        resumable<?php echo $docs->id_m_document ?>.assignBrowse(browseFile<?php echo $docs->id_m_document ?>);
                        resumable<?php echo $docs->id_m_document ?>.on('fileAdded', function(file) { // trigger wn file picked
                            showProgress<?php echo $docs->id_m_document ?>();
                            resumable<?php echo $docs->id_m_document ?>.upload() // to actually start uploading.
                        });
                        resumable<?php echo $docs->id_m_document ?>.on('fileProgress', function(file) { // trigger when file progress update
                            updateProgress<?php echo $docs->id_m_document ?>(Math.floor(file.progress() * 100));
                        });
                        resumable<?php echo $docs->id_m_document ?>.on('fileSuccess', function(file, response) { // trigger when file upload complete
                            response = JSON.parse(response)
                            $('#videoPreview<?php echo $docs->id_m_document ?>').show();
                            $('#videoPreview<?php echo $docs->id_m_document ?>').attr('src', response.path);
                            $('#link<?php echo $docs->id_m_document ?>').attr('value', response.filename);
                            // $('.card-footer').show();
                            $('#browseFile<?php echo $docs->id_m_document ?>').hide();
                            $('#upload-param-<?php echo $docs->id_m_document ?>').html(
                                'Sukses Upload'
                            );
                            $('#button-waiting-list-<?php echo $docs->id_m_document ?>').html(response.button);
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "success",
                                title: "Berhasil Upload Document"
                            });
                        });
                        resumable<?php echo $docs->id_m_document ?>.on('fileError', function(file, response) { // trigger when there is any error
                            alert('file uploading error.')
                        });
                        var progress<?php echo $docs->id_m_document ?> = $('.progress<?php echo $docs->id_m_document ?>');

                        function showProgress<?php echo $docs->id_m_document ?>() {
                            progress<?php echo $docs->id_m_document ?>.find('.loading<?php echo $docs->id_m_document ?>').css('width', '0%');
                            progress<?php echo $docs->id_m_document ?>.find('.loading<?php echo $docs->id_m_document ?>').html('0%');
                            progress<?php echo $docs->id_m_document ?>.find('.loading<?php echo $docs->id_m_document ?>').removeClass('bg-info');
                            progress<?php echo $docs->id_m_document ?>.show();
                        }

                        function updateProgress<?php echo $docs->id_m_document ?>(value) {
                            progress<?php echo $docs->id_m_document ?>.find('.loading<?php echo $docs->id_m_document ?>').css('width', ` ${value}%`)
                            progress<?php echo $docs->id_m_document ?>.find('.loading<?php echo $docs->id_m_document ?>').html(`${value}%`)
                        }

                        function hideProgress<?php echo $docs->id_m_document ?>() {
                            progress<?php echo $docs->id_m_document ?>.hide();
                        }
                    </script>

                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
            <span id="show-file-doc"></span>
        </div>
        <!-- <iframe
            src="{{ asset('storage/data/document/06c22d3a-3043-41f0-b3b0-d17a5c5e8735/e2180a59-c878-462f-9968-f5da382996e6.pdf') }}"
            frameborder="0"></iframe> -->
    </div>
</div>
