<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

use File;
use Illuminate\Support\Facades\Auth;

class UploadFileController extends Controller
{
    public function kualifikasi_supplier_upload_document_upload(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = $request->document . '.' . $extension; //file name without extenstion // a unique file name

            $disk = Storage::disk(config('filesystems.default'));
            $path = $disk->putFileAs('public/data/document/' . $request->code . '/', $file, $fileName);
            // $path1 = $disk('videos', $file, $fileName);
            $lokasi = 'storage/data/document/' . $request->code . '/' . $fileName;
            // delete chunked file
            unlink($file->getPathname());
            $cek = DB::table('m_supplier_doc')->where('m_supplier_code', $request->code)->where('m_document_code', $request->document)->first();
            if ($cek) {
                DB::table('m_supplier_doc')->where('m_supplier_doc_code',$cek->m_supplier_doc_code)->update([
                    'm_supplier_doc_file' => $lokasi,
                ]);
            } else {
                DB::table('m_supplier_doc')->insert([
                    'm_supplier_doc_code' => Str::uuid(),
                    'm_supplier_code' => $request->code,
                    'm_document_code' => $request->document,
                    'm_supplier_doc_file' => $lokasi,
                    'm_supplier_doc_start' => now(),
                    'm_supplier_doc_end' => now(),
                    'created_at' => now(),
                ]);

            }
            return [
                'path' => storage_path('app/public/data/document/' . $request->code . '/' . $fileName),
                'filename' => $fileName,
                'button'=>'<button class="btn btn-primary" id="button-preview-file" data-file="'.$lokasi.'">Preview</button>'
            ];
        }

        // otherwise return percentage informatoin
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }
}
