<?php

namespace App\Http\Controllers;

// use charlieuki\ReceiptPrinter\Facades\ReceiptPrinter;
use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Rawilk\Printing\Facades\Printing;
use Session;
use PDF;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function url_akses($akses)
    {
        $data = DB::table('z_menu_user')->where('menu_sub_code', $akses)->where('access_code', Auth::user()->access_code)->first();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }
    public function url_akses_sub($akses)
    {
        $data = DB::table('z_menu_user_sub')->where('menu_main_sub_code', $akses)->where('access_code', Auth::user()->access_code)->first();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }
    // SUPPLIER BARANG
    public function kualifikasi_supplier($akses)
    {
        if ($this->url_akses($akses) == true) {
            $data = DB::table('m_supplier')->where('m_supplier_cabang', Auth::user()->access_cabang)->get();
            return view('application.menu.kualifikasi-supplier', ['data' => $data]);
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function kualifikasi_supplier_add_supplier(Request $request)
    {
        // $doc = DB::table('m_document')->get();
        return view('application.menu.kualifikasi-supplier.form-add-supplier');
    }
    public function kualifikasi_supplier_detail_supplier(Request $request)
    {
        $data = DB::table('m_supplier')->where('m_supplier_code', $request->code)->first();
        return view('application.menu.kualifikasi-supplier.form-detail-supplier', compact('data'));
    }
    public function kualifikasi_supplier_detail_supplier_save(Request $request)
    {
        try {
            DB::table('m_supplier')->where('m_supplier_code', $request->data_supplier)->update([
                'm_supplier_name' => $request->name,
                'm_supplier_city' => $request->city,
                'm_supplier_alamat' => $request->alamat,
                'm_supplier_phone' => $request->phone,
                'm_supplier_email' => $request->email,
                'm_supplier_cat' => $request->kategori,
            ]);
            return redirect()->back()->withSuccess('Great! Berhasil Update Data Supplier Cabang');
        } catch (\Throwable $e) {
            return redirect()->back()->withError('Failed! Gagal Update Data Supplier Cabang');
        }
    }
    public function kualifikasi_supplier_detail_supplier_save_contact(Request $request)
    {
        try {
            DB::table('m_supplier_contact')->insert([
                'm_supplier_contact_code' => str::uuid(),
                'm_supplier_code' => $request->data_supplier,
                'm_supplier_contact_name' => $request->contact_name,
                'm_supplier_contact_number' => $request->contact_number,
                'm_supplier_contact_cabang' => Auth::user()->access_cabang,
                'm_supplier_contact_status' => 1,
                'created_at' => now(),
            ]);
            return redirect()->back()->withSuccess('Great! Berhasil Update Data Supplier Cabang');
        } catch (\Throwable $e) {
            return redirect()->back()->withError('Failed! Gagal Update Data Supplier Cabang');
        }
    }
    public function kualifikasi_supplier_add_supplier_save(Request $request)
    {
        $cek = DB::table('m_supplier')->where('m_supplier_name', '=', $request->name)->first();
        if ($cek) {
            return redirect()->back()->withError('Fail! Data Supplier Sudah Ada');
        } else {
            try {
                DB::table('m_supplier')->insert([
                    'm_supplier_code' => Str::uuid(),
                    'm_supplier_name' => $request->name,
                    'm_supplier_city' => $request->city,
                    'm_supplier_alamat' => $request->alamat,
                    'm_supplier_phone' => $request->phone,
                    'm_supplier_email' => $request->email,
                    'm_supplier_cat' => $request->kategori,
                    'm_supplier_cabang' => Auth::user()->access_cabang,
                    'm_supplier_status' => 0,
                ]);
                return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data Supplier Cabang');
            } catch (\Throwable $th) {
                return redirect()->back()->withError('Fail! Gagal Menambahkan Data Supplier Cabang');
            }
        }
    }
    public function kualifikasi_supplier_upload_document(Request $request)
    {
        $doc = DB::table('m_document')->get();
        return view('application.menu.kualifikasi-supplier.form-upload-document', ['doc' => $doc, 'code' => $request->code]);
    }
    public function kualifikasi_supplier_penetapan_document(Request $request)
    {
        $supplier = DB::table('m_supplier')->where('m_supplier_code', $request->code)->first();
        $doc = DB::table('m_document')->get();
        $type = DB::table('type_pengadaan')->get();
        return view('application.menu.kualifikasi-supplier.form-penetapan-supplier', ['supplier' => $supplier, 'doc' => $doc, 'code' => $request->code, 'type' => $type]);
    }
    public function kualifikasi_supplier_penetapan_document_save(Request $request)
    {
        $cek = DB::table('m_supplier_data')->where('m_supplier_code', $request->supplier_code)->first();
        if ($cek) {
            return [
                "status" => false,
                "data" => '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Erorr!</strong> Data Sudah ada
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>'
            ];
        } else {
            $data = $request->tipe;
            for ($i = 0; $i < count($data); $i++) {
                DB::table('m_supplier_type')->insert([
                    'm_supplier_type_code' => Str::uuid(),
                    'm_supplier_code' => $request->supplier_code,
                    'type_pengadaan_code' => $request->tipe[$i],
                    'm_supplier_type_status' => 1,
                    'created_at' => now(),
                ]);
            }
            DB::table('m_supplier_data')->insert([
                'm_supplier_data_code' => Str::uuid(),
                'm_supplier_code' => $request->supplier_code,
                'm_supplier_data_no' => $request->nomor,
                'm_supplier_data_npwp' => $request->npwp,
                'm_supplier_data_contact' => $request->kontak,
                'm_supplier_data_kacab' => $request->kacab,
                'm_supplier_data_mgr' => $request->mgr,
                'm_supplier_data_pgd' => $request->pgd,
                'm_supplier_data_cabang' => Auth::user()->access_cabang,
                'created_at' => now()
            ]);
            return [
                "status" => true,
                "data" => true
            ];
        }
    }
    public function kualifikasi_supplier_penetapan_document_report(Request $request)
    {
        $supplier = DB::table('m_supplier')->where('m_supplier_code', $request->code)->first();
        $data = DB::table('m_supplier_data')->where('m_supplier_code', $request->code)->first();
        return view('application.menu.kualifikasi-supplier.form-report-penetapan-supplier', ['supplier' => $supplier, 'data' => $data]);
    }
    public function kualifikasi_supplier_penetapan_document_report_view(Request $request)
    {
        $data = DB::table('m_supplier_data')
            ->join('m_supplier', 'm_supplier.m_supplier_code', '=', 'm_supplier_data.m_supplier_code')
            ->where('m_supplier_data.m_supplier_code', $request->code)->first();
        $type = DB::table('m_supplier_type')
            ->join('type_pengadaan', 'type_pengadaan.type_pengadaan_code', '=', 'm_supplier_type.type_pengadaan_code')
            ->where('m_supplier_code', $request->code)->get();
        $image = base64_encode(file_get_contents(public_path('img/logo.png')));
        $pdf = PDF::loadview('application.menu.kualifikasi-supplier.report.report-penetapan-supplier', ['data' => $data, 'type' => $type], compact('image'))->setPaper('A4', 'potrait')->setOptions(['defaultFont' => 'Helvetica']);
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $font = $dompdf->getFontMetrics()->get_font("helvetica", "bold");
        $font1 = $dompdf->getFontMetrics()->get_font("helvetica", "normal");
        $dompdf->get_canvas()->page_text(300, 820, "{PAGE_NUM} / {PAGE_COUNT}", $font, 10, array(0, 0, 0));
        $dompdf->get_canvas()->page_text(34, 820, "Print by. " . Auth::user()->fullname, $font1, 10, array(0, 0, 0));
        return base64_encode($pdf->stream());
    }
    // EVALUASI SUPPLIER BARANG
    public function evaluasi_supplier_barang($akses)
    {
        if ($this->url_akses_sub($akses) == true) {
            $cat = DB::table('t_penilaian_cat')->get();
            $periode = DB::table('log_master')->where('log_master_cabang', Auth::user()->access_cabang)->get();
            return view('application.menu.menu-evaluasi-barang', ['cat' => $cat, 'periode' => $periode]);
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function evaluasi_supplier_barang_cari_supplier(Request $request)
    {
        $data = DB::table('m_supplier')->get();
        return view('application.menu.evaluasi-barang.form-cari-supplier', ['data' => $data]);
    }
    public function evaluasi_supplier_barang_cari_barang(Request $request)
    {
        $data = DB::table('m_barang')->get();
        return view('application.menu.evaluasi-barang.form-cari-barang', ['data' => $data]);
    }
    public function evaluasi_supplier_barang_pilih_supplier(Request $request)
    {
        $cat = DB::table('t_penilaian_cat')->get();
        $brg = DB::table('log_penilaian_cab')
            ->select('m_barang.*')
            ->join('m_barang', 'm_barang.m_barang_code', '=', 'log_penilaian_cab.m_barang_code')
            ->where('m_supplier_code', $request->code)
            ->where('log_master_code', $request->tahun)
            ->where('master_cabang_code', Auth::user()->access_cabang)->distinct()->get(['m_supplier.m_supplier_code']);
        $periode = DB::table('log_master')->where('log_master_cabang', Auth::user()->access_cabang)->get();
        $data = DB::table('m_supplier')->where('m_supplier_code', $request->code)->first();
        return view('application.menu.evaluasi-barang.form-detail-supplier', [
            'cat' => $cat,
            'brg' => $brg,
            'data' => $data,
            'periode' => $periode,
            'tahun' => $request->tahun,
            'code' => $request->code,
        ]);
    }
    public function evaluasi_supplier_barang_pilih_barang(Request $request)
    {
        $cat = DB::table('t_penilaian_cat')->get();
        $data = DB::table('m_barang')->where('m_barang_code', $request->code)->first();
        $supplier = DB::table('log_penilaian_cab')
            ->select('m_supplier.*')
            ->join('m_supplier', 'm_supplier.m_supplier_code', '=', 'log_penilaian_cab.m_supplier_code')
            ->where('m_barang_code', $request->code)
            ->where('log_master_code', $request->tahun)
            ->where('master_cabang_code', Auth::user()->access_cabang)->distinct()->get(['m_supplier.m_supplier_code']);
        return view('application.menu.evaluasi-barang.form-detail-barang', [
            'cat' => $cat,
            'data' => $data,
            'periode' => $request->tahun,
            'supplier' => $supplier,
            'code' => $request->code,
        ]);
    }
    public function evaluasi_supplier_barang_pilih_periode_supplier_add_barang(Request $request)
    {
        $data = DB::table('m_barang')->get();
        return view('application.menu.evaluasi-barang.form-add-barang', ['data' => $data]);
    }
    public function evaluasi_supplier_barang_pilih_periode_barang_add_supplier(Request $request)
    {
        $data = DB::table('m_supplier')->get();
        return view('application.menu.evaluasi-barang.form-add-supplier', ['data' => $data]);
    }
    public function evaluasi_supplier_barang_pilih_periode(Request $request)
    {
        $cat = DB::table('t_penilaian_cat')->get();
        $detail = DB::table('t_penilaian_detail')->get();
        $brg = DB::table('log_penilaian_cab')
            ->select('m_barang.*')
            ->join('m_barang', 'm_barang.m_barang_code', '=', 'log_penilaian_cab.m_barang_code')
            ->where('m_supplier_code', $request->supplier)
            ->where('log_master_code', $request->code)
            ->where('master_cabang_code', Auth::user()->access_cabang)->distinct()->get(['m_supplier.m_supplier_code']);
        return view('application.menu.evaluasi-barang.data-table-penilaian', [
            'cat' => $cat,
            'brg' => $brg,
            'supplier' => $request->supplier,
            'periode' => $request->code,
        ]);
    }
    public function evaluasi_supplier_barang_pilih_periode_barang(Request $request)
    {
        $cat = DB::table('t_penilaian_cat')->get();
        $detail = DB::table('log_penilaian_cab')
            ->where('')
            ->where('m_barang_code', $request->barang)->get();
        $brg = DB::table('m_barang')->get();
        return view('application.menu.evaluasi-barang.data-table-penilaian-supplier', [
            'cat' => $cat,
            'brg' => $brg,
            'barang' => $request->barang,
            'periode' => $request->code,
        ]);
    }
    public function evaluasi_supplier_barang_tambah_periode_supplier(Request $request)
    {
        return view('application.menu.evaluasi-barang.form-add-periode');
    }
    public function evaluasi_supplier_barang_tambah_periode_supplier_save(Request $request)
    {
        DB::table('log_master')->insert([
            'log_master_code' => str::uuid(),
            'log_master_periode' => $request->periode,
            'log_master_cabang' => Auth::user()->access_cabang,
            'log_master_status' => 1,
            'log_master_date' => now(),
            'created_at' => now(),
        ]);
        return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data');
    }
    public function evaluasi_supplier_barang_proses_penilaian_barang(Request $request)
    {
        $cek = DB::table('log_penilaian_cab')
            ->where('m_barang_code', $request->barang)
            ->where('log_master_code', $request->periode)
            ->where('master_cabang_code', Auth::user()->access_cabang)
            ->where('m_supplier_code', $request->supplier)->first();
        if ($cek) {
            return 0;
        } else {
            $kategori = DB::table('t_penilaian_cat')->get();
            $barang = DB::table('m_barang')->where('m_barang_code', $request->barang)->first();
            $supplier = DB::table('m_supplier')->where('m_supplier_code', $request->supplier)->first();
            return view('application.menu.evaluasi-barang.form-proses-penilaian-barang', [
                'kategori' => $kategori,
                'code' => $request->code,
                'barang' => $barang,
                'supplier' => $supplier,
                'periode' => $request->periode,
            ]);
        }
    }
    public function evaluasi_supplier_barang_proses_penilaian_barang_next(Request $request)
    {
        $cat = DB::table('t_penilaian_cat')->get();
        $data = DB::table('m_barang')->where('m_barang_code', $request->barang)->first();
        $supplier = DB::table('log_penilaian_cab')->select('m_supplier.*')
            ->join('m_supplier', 'm_supplier.m_supplier_code', '=', 'log_penilaian_cab.m_supplier_code')
            ->where('m_barang_code', $request->barang)
            ->where('log_master_code', $request->code)
            ->where('master_cabang_code', Auth::user()->access_cabang)
            ->distinct()->get(['m_supplier.m_supplier_code']);
        return view('application.menu.evaluasi-barang.data-table-penilaian-barang', [
            'cat' => $cat,
            'data' => $data,
            'periode' => $request->tahun,
            'supplier' => $supplier,
            'code' => $request->barang,
        ]);
    }
    public function evaluasi_supplier_barang_proses_penilaian_supplier(Request $request)
    {
        // return $request->code.' data : '.$request->supplier;
        $kategori = DB::table('t_penilaian_cat')->get();
        $barang = DB::table('m_barang')->where('m_barang_code', $request->code)->first();
        $supplier = DB::table('m_supplier')->where('m_supplier_code', $request->supplier)->first();
        return view('application.menu.evaluasi-barang.form-proses-penilaian', [
            'kategori' => $kategori,
            'barang' => $barang,
            'supplier' => $supplier,
            'code' => $request->code,
            'periode' => $request->periode,
        ]);
    }
    public function evaluasi_supplier_barang_proses_penilaian_supplier_save(Request $request)
    {
        $data = DB::table('t_penilaian_detail')->where('t_penilaian_cat_code', $request->cat_penilaian)->get();

        foreach ($data as $value) {
            $cek = DB::table('log_penilaian_cab')
                ->where('log_master_code', $request->periode)
                ->where('m_supplier_code', $request->supplier)
                ->where('m_barang_code', $request->barang)
                ->where('t_penilaian_detail_code', $request[$value->t_penilaian_detail_code])->first();
            $cat = DB::table('t_penilaian_cat')
                ->join('t_penilaian_detail', 't_penilaian_detail.t_penilaian_cat_code', '=', 't_penilaian_cat.t_penilaian_cat_code')
                ->where('t_penilaian_detail.t_penilaian_detail_code', $request[$value->t_penilaian_detail_code])
                ->where('t_penilaian_cat.t_penilaian_cat_name', 'Distribusi')->first();
            $score = $request['data' . $value->t_penilaian_detail_code] * $value->t_penilaian_detail_point;
            if ($cek) {
                DB::table('log_penilaian_cab')
                    ->where('log_master_code', $request->periode)
                    ->where('m_supplier_code', $request->supplier)
                    ->where('m_barang_code', $request->barang)
                    ->where('t_penilaian_detail_code', $request[$value->t_penilaian_detail_code])
                    ->update([
                        'log_penilaian_cab_val' => $request['data' . $value->t_penilaian_detail_code],
                        'log_penilaian_cab_score' => $score,
                    ]);
                if ($cat) {
                    DB::table('log_penilaian_cab_desc')
                        ->where('log_master_code', $request->periode)
                        ->where('m_supplier_code', $request->supplier)
                        ->where('m_barang_code', $request->barang)
                        ->where('t_penilaian_detail_code', $request[$value->t_penilaian_detail_code])
                        ->update([
                            'log_penilaian_cab_desc_text' => $request['desc' . $value->t_penilaian_detail_code],
                            'log_penilaian_cab_desc_status' => 1,
                        ]);
                }
            } else {
                DB::table('log_penilaian_cab')->insert([
                    'log_penilaian_cab_code' => str::uuid(),
                    'log_master_code' => $request->periode,
                    'm_supplier_code' => $request->supplier,
                    'm_barang_code' => $request->barang,
                    'master_cabang_code' => Auth::user()->access_cabang,
                    't_penilaian_detail_code' => $request[$value->t_penilaian_detail_code],
                    'log_penilaian_cab_val' => $request['data' . $value->t_penilaian_detail_code],
                    'log_penilaian_cab_score' => $score,
                    'created_at' => now(),
                ]);
                if ($cat) {
                    DB::table('log_penilaian_cab_desc')->insert([
                        'log_penilaian_cab_code_desc' => str::uuid(),
                        'log_master_code' => $request->periode,
                        'm_supplier_code' => $request->supplier,
                        'm_barang_code' => $request->barang,
                        'master_cabang_code' => Auth::user()->access_cabang,
                        't_penilaian_detail_code' => $request[$value->t_penilaian_detail_code],
                        'log_penilaian_cab_desc_text' => $request['desc' . $value->t_penilaian_detail_code],
                        'log_penilaian_cab_desc_status' => 1,
                        'created_at' => now(),
                    ]);
                }
            }
        }
        return 123;
    }
    public function evaluasi_supplier_barang_proses_penilaian_supplier_save_fix(Request $request)
    {
        $data = DB::table('m_supplier')
            ->join('log_penilaian_cab', 'log_penilaian_cab.m_supplier_code', '=', 'm_supplier.m_supplier_code')
            ->where('log_penilaian_cab.log_master_code', $request->code)
            ->where('log_penilaian_cab.master_cabang_code', Auth::user()->access_cabang)->distinct()->get(['m_supplier.m_supplier_code']);

        $cat = DB::table('t_penilaian_cat')->get();

        foreach ($data as $value) {
            $brg = DB::table('m_barang')
                ->join('log_penilaian_cab', 'log_penilaian_cab.m_barang_code', '=', 'm_barang.m_barang_code')
                ->where('log_penilaian_cab.log_master_code', $request->code)
                ->where('log_penilaian_cab.m_supplier_code', $value->m_supplier_code)
                ->where('log_penilaian_cab.master_cabang_code', Auth::user()->access_cabang)->distinct()->get(['m_barang.m_barang_code']);
            foreach ($brg as $brgs) {
                $total = 0;
                $score = 0;
                foreach ($cat as $cats) {
                    $nilai = DB::table('log_penilaian_cab')
                        ->join('t_penilaian_detail', 't_penilaian_detail.t_penilaian_detail_code', '=', 'log_penilaian_cab.t_penilaian_detail_code')
                        ->join('t_penilaian_cat', 't_penilaian_cat.t_penilaian_cat_code', '=', 't_penilaian_detail.t_penilaian_cat_code')
                        ->where('log_penilaian_cab.m_supplier_code', $value->m_supplier_code)
                        ->where('log_penilaian_cab.m_barang_code', $brgs->m_barang_code)
                        ->where('log_penilaian_cab.log_master_code', $request->code)
                        ->where('log_penilaian_cab.master_cabang_code', Auth::user()->access_cabang)
                        ->where('t_penilaian_detail.t_penilaian_detail_type', 'option')
                        ->where('t_penilaian_cat.t_penilaian_cat_code', $cats->t_penilaian_cat_code)
                        ->sum('log_penilaian_cab.log_penilaian_cab_score');
                    // $total = $total + $nilai;
                    $score = $score + ($nilai * $cats->t_penilaian_cat_score);
                }
                $cek = DB::table('data_supp_brg_cab')
                    ->where('log_master_code', $request->code)
                    ->where('m_barang_code', $brgs->m_barang_code)
                    ->where('m_supplier_code', $value->m_supplier_code)
                    ->where('master_cabang_code', Auth::user()->access_cabang)->first();
                if ($cek) {
                    $cek = DB::table('data_supp_brg_cab')
                        ->where('log_master_code', $request->code)
                        ->where('m_barang_code', $brgs->m_barang_code)
                        ->where('m_supplier_code', $value->m_supplier_code)
                        ->where('master_cabang_code', Auth::user()->access_cabang)->update([
                            'data_supp_brg_cab_score' => $score,
                            'created_at' => now(),
                        ]);
                } else {
                    DB::table('data_supp_brg_cab')->insert([
                        'data_supp_brg_cab_code' => str::uuid(),
                        'log_master_code' => $request->code,
                        'm_barang_code' => $brgs->m_barang_code,
                        'm_supplier_code' => $value->m_supplier_code,
                        'master_cabang_code' => Auth::user()->access_cabang,
                        'data_supp_brg_cab_score' => $score,
                        'created_at' => now(),
                    ]);
                }
            }
        }
        return $data;
    }


    // SUPPLIER JASA
    public function evaluasi_supplier_jasa($akses)
    {
        if ($this->url_akses_sub($akses) == true) {
            $cat = DB::table('t_penilaian_cat')->get();
            $periode = DB::table('log_master')->where('log_master_cabang', Auth::user()->access_cabang)->get();
            return view('application.menu.menu-evaluasi-jasa', ['cat' => $cat, 'periode' => $periode]);
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function evaluasi_supplier_jasa_cari_jasa(Request $request)
    {
        $data = DB::table('m_jasa')->get();
        return view('application.menu.evaluasi-jasa.form-cari-jasa', ['data' => $data]);
    }
    public function evaluasi_supplier_jasa_pilih_jasa(Request $request)
    {
        $cat = DB::table('t_penilaian_cat')->get();
        $data = DB::table('m_jasa')->where('m_jasa_code', $request->code)->first();
        $supplier = DB::table('log_penilaian_jasa_cab')->select('m_supplier.*')
            ->join('m_supplier', 'm_supplier.m_supplier_code', '=', 'log_penilaian_jasa_cab.m_supplier_code')
            ->where('m_jasa_code', $request->code)
            ->where('log_master_code', $request->tahun)
            ->where('master_cabang_code', Auth::user()->access_cabang)->distinct()->get(['m_supplier.m_supplier_code']);
        return view('application.menu.evaluasi-jasa.form-detail-jasa', [
            'cat' => $cat,
            'data' => $data,
            'periode' => $request->tahun,
            'supplier' => $supplier,
            'code' => $request->code,
        ]);
    }
    public function evaluasi_supplier_jasa_pilih_jasa_supplier(Request $request)
    {
        $data = DB::table('m_supplier')->get();
        return view('application.menu.evaluasi-jasa.form-add-supplier', ['data' => $data]);
    }
    public function evaluasi_supplier_jasa_pilih_jasa_pilih_supplier(Request $request)
    {
        $cek = DB::table('log_penilaian_jasa_cab')
            ->where('m_jasa_code', $request->jasa)
            ->where('log_master_code', $request->periode)
            ->where('master_cabang_code', Auth::user()->access_cabang)
            ->where('m_supplier_code', $request->supplier)->first();
        if ($cek) {
            return 0;
        } else {
            $kategori = DB::table('t_penilaian_cat')->get();
            $jasa = DB::table('m_jasa')->where('m_jasa_code', $request->jasa)->first();
            $supplier = DB::table('m_supplier')->where('m_supplier_code', $request->supplier)->first();
            return view('application.menu.evaluasi-jasa.form-proses-penilaian-jasa', [
                'kategori' => $kategori,
                'code' => $request->code,
                'jasa' => $jasa,
                'supplier' => $supplier,
                'periode' => $request->periode,
            ]);
        }
    }
    public function evaluasi_supplier_jasa_pilih_jasa_pilih_supplier_update(Request $request)
    {
        $kategori = DB::table('t_penilaian_cat')->get();
        $jasa = DB::table('m_jasa')->where('m_jasa_code', $request->code)->first();
        $supplier = DB::table('m_supplier')->where('m_supplier_code', $request->supplier)->first();
        return view('application.menu.evaluasi-jasa.form-proses-penilaian-jasa', [
            'kategori' => $kategori,
            'code' => $request->code,
            'jasa' => $jasa,
            'supplier' => $supplier,
            'periode' => $request->periode,
        ]);
    }
    public function evaluasi_supplier_jasa_pilih_jasa_pilih_supplier_next(Request $request)
    {
        $cat = DB::table('t_penilaian_cat')->get();
        $data = DB::table('m_jasa')->where('m_jasa_code', $request->jasa)->first();
        $supplier = DB::table('log_penilaian_jasa_cab')->select('m_supplier.*')->join('m_supplier', 'm_supplier.m_supplier_code', '=', 'log_penilaian_jasa_cab.m_supplier_code')
            ->where('m_jasa_code', $request->jasa)
            ->where('log_master_code', $request->tahun)
            ->where('master_cabang_code', Auth::user()->access_cabang)
            ->distinct()->get(['m_supplier.m_supplier_code']);
        return view('application.menu.evaluasi-jasa.data-table-penilaian-jasa', [
            'cat' => $cat,
            'data' => $data,
            'periode' => $request->tahun,
            'supplier' => $supplier,
            'code' => $request->jasa,
        ]);
    }
    public function evaluasi_supplier_jasa_pilih_jasa_proses_penilaian_supplier(Request $request)
    {
        return 123;
    }
    public function evaluasi_supplier_jasa_pilih_jasa_proses_penilaian_supplier_save(Request $request)
    {
        $data = DB::table('t_penilaian_detail')->where('t_penilaian_cat_code', $request->cat_penilaian)->get();
        foreach ($data as $value) {
            $cek = DB::table('log_penilaian_jasa_cab')
                ->where('log_master_code', $request->periode)
                ->where('m_supplier_code', $request->supplier)
                ->where('m_jasa_code', $request->jasa)
                ->where('t_penilaian_detail_code', $request[$value->t_penilaian_detail_code])->first();
            $score = $request['data' . $value->t_penilaian_detail_code] * $value->t_penilaian_detail_point;
            if ($cek) {
                DB::table('log_penilaian_jasa_cab')
                    ->where('log_master_code', $request->periode)
                    ->where('m_supplier_code', $request->supplier)
                    ->where('m_jasa_code', $request->jasa)
                    ->where('t_penilaian_detail_code', $request[$value->t_penilaian_detail_code])->update([
                        'penilaian_jasa_cab_val' => $request['data' . $value->t_penilaian_detail_code],
                        'penilaian_jasa_cab_score' => $score,
                    ]);
            } else {
                DB::table('log_penilaian_jasa_cab')->insert([
                    'penilaian_jasa_cab_code' => str::uuid(),
                    'log_master_code' => $request->periode,
                    'm_supplier_code' => $request->supplier,
                    'm_jasa_code' => $request->jasa,
                    'master_cabang_code' => Auth::user()->access_cabang,
                    't_penilaian_detail_code' => $request[$value->t_penilaian_detail_code],
                    'penilaian_jasa_cab_val' => $request['data' . $value->t_penilaian_detail_code],
                    'penilaian_jasa_cab_score' => $score,
                    'created_at' => now(),
                ]);
            }
        }
        return 123;
    }
    public function evaluasi_supplier_jasa_pilih_jasa_proses_penilaian_supplier_save_fix(Request $request)
    {
        $data = DB::table('m_supplier')
            ->join('log_penilaian_jasa_cab', 'log_penilaian_jasa_cab.m_supplier_code', '=', 'm_supplier.m_supplier_code')
            ->where('log_penilaian_jasa_cab.log_master_code', $request->code)
            ->where('log_penilaian_jasa_cab.master_cabang_code', Auth::user()->access_cabang)->distinct()->get(['m_supplier.m_supplier_code']);

        $cat = DB::table('t_penilaian_cat')->get();

        foreach ($data as $value) {
            $jasa = DB::table('m_jasa')
                ->join('log_penilaian_jasa_cab', 'log_penilaian_jasa_cab.m_jasa_code', '=', 'm_jasa.m_jasa_code')
                ->where('log_penilaian_jasa_cab.log_master_code', $request->code)
                ->where('log_penilaian_jasa_cab.m_supplier_code', $value->m_supplier_code)
                ->where('log_penilaian_jasa_cab.master_cabang_code', Auth::user()->access_cabang)->distinct()->get(['m_jasa.m_jasa_code']);
            foreach ($jasa as $jasas) {
                $total = 0;
                $score = 0;
                foreach ($cat as $cats) {
                    $nilai = DB::table('log_penilaian_jasa_cab')
                        ->join('t_penilaian_detail', 't_penilaian_detail.t_penilaian_detail_code', '=', 'log_penilaian_jasa_cab.t_penilaian_detail_code')
                        ->join('t_penilaian_cat', 't_penilaian_cat.t_penilaian_cat_code', '=', 't_penilaian_detail.t_penilaian_cat_code')
                        ->where('log_penilaian_jasa_cab.m_supplier_code', $value->m_supplier_code)
                        ->where('log_penilaian_jasa_cab.m_jasa_code', $jasas->m_jasa_code)
                        ->where('log_penilaian_jasa_cab.log_master_code', $request->code)
                        ->where('log_penilaian_jasa_cab.master_cabang_code', Auth::user()->access_cabang)
                        ->where('t_penilaian_detail.t_penilaian_detail_type', 'option')
                        ->where('t_penilaian_cat.t_penilaian_cat_code', $cats->t_penilaian_cat_code)
                        ->sum('log_penilaian_jasa_cab.penilaian_jasa_cab_score');
                    // $total = $total + $nilai;
                    $score = $score + ($nilai * $cats->t_penilaian_cat_score);
                }
                $cek = DB::table('data_supp_jasa_cab')
                    ->where('log_master_code', $request->code)
                    ->where('m_jasa_code', $jasas->m_jasa_code)
                    ->where('m_supplier_code', $value->m_supplier_code)
                    ->where('master_cabang_code', Auth::user()->access_cabang)->first();
                if ($cek) {
                    $cek = DB::table('data_supp_jasa_cab')
                        ->where('log_master_code', $request->code)
                        ->where('m_jasa_code', $jasas->m_jasa_code)
                        ->where('m_supplier_code', $value->m_supplier_code)
                        ->where('master_cabang_code', Auth::user()->access_cabang)->update([
                            'data_supp_jasa_cab_score' => $score,
                            'created_at' => now(),
                        ]);
                } else {
                    DB::table('data_supp_jasa_cab')->insert([
                        'data_supp_jasa_cab_code' => str::uuid(),
                        'log_master_code' => $request->code,
                        'm_jasa_code' => $jasas->m_jasa_code,
                        'm_supplier_code' => $value->m_supplier_code,
                        'master_cabang_code' => Auth::user()->access_cabang,
                        'data_supp_jasa_cab_score' => $score,
                        'created_at' => now(),
                    ]);
                }
            }
        }
    }

    // SUPPLIER RUJUKAN
    public function evaluasi_supplier_rujukan($akses)
    {
        if ($this->url_akses_sub($akses) == true) {
            $cat = DB::table('t_penilaian_cat')->get();
            $periode = DB::table('log_master')->where('log_master_cabang', Auth::user()->access_cabang)->get();
            return view('application.menu.menu-evaluasi-rujukan', ['cat' => $cat, 'periode' => $periode]);
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function evaluasi_supplier_rujukan_cari_pemeriksaan(Request $request)
    {
        $data = DB::table('m_pemeriksaan')->get();
        return view('application.menu.evaluasi-rujukan.form-cari-pemeriksaan', ['data' => $data]);
    }
    public function evaluasi_supplier_rujukan_cari_rujukan(Request $request)
    {
        $data = DB::table('m_rujukan')->get();
        return view('application.menu.evaluasi-rujukan.form-cari-rujukan', ['data' => $data]);
    }
    public function evaluasi_supplier_rujukan_pilih_pemeriksaan(Request $request)
    {
        $cat = DB::table('t_penilaian_cat')->get();
        $data = DB::table('m_pemeriksaan')->where('m_pemeriksaan_code', $request->code)->first();
        $rujukan = DB::table('log_penilaian_rujukan_cab')->select('m_rujukan.*')
            ->join('m_rujukan', 'm_rujukan.m_rujukan_code', '=', 'log_penilaian_rujukan_cab.m_rujukan_code')
            ->where('m_pemeriksaan_code', $request->code)
            ->where('log_master_code', $request->tahun)
            ->where('master_cabang_code', Auth::user()->access_cabang)->distinct()->get(['m_rujukan.m_rujukan_code']);
        return view('application.menu.evaluasi-rujukan.form-detail-pemeriksaan', [
            'cat' => $cat,
            'data' => $data,
            'periode' => $request->tahun,
            'rujukan' => $rujukan,
            'code' => $request->code,
        ]);
    }
    public function evaluasi_supplier_rujukan_pilih_rujukan(Request $request)
    {
        $cat = DB::table('t_penilaian_cat')->get();
        $data = DB::table('m_rujukan')->where('m_rujukan_code', $request->code)->first();
        $pemeriksaan = DB::table('log_penilaian_rujukan_cab')->select('m_pemeriksaan.*')
            ->join('m_pemeriksaan', 'm_pemeriksaan.m_pemeriksaan_code', '=', 'log_penilaian_rujukan_cab.m_pemeriksaan_code')
            ->where('m_rujukan_code', $request->code)
            ->where('log_master_code', $request->tahun)
            ->where('master_cabang_code', Auth::user()->access_cabang)->distinct()->get(['m_pemeriksaan.m_pemeriksaan_code']);
        return view('application.menu.evaluasi-rujukan.form-detail-rujukan', [
            'cat' => $cat,
            'data' => $data,
            'periode' => $request->tahun,
            'pemeriksaan' => $pemeriksaan,
            'code' => $request->code,
        ]);
    }
    public function evaluasi_supplier_rujukan_pilih_pemeriksaan_rujukan(Request $request)
    {
        $data = DB::table('m_rujukan')->get();
        return view('application.menu.evaluasi-rujukan.form-add-rujukan', ['data' => $data]);
    }
    public function evaluasi_supplier_rujukan_cari_pemeriksaan_rujukan(Request $request)
    {
        $data = DB::table('m_pemeriksaan')->get();
        return view('application.menu.evaluasi-rujukan.form-add-pemeriksaan', ['data' => $data]);
    }
    public function evaluasi_supplier_rujukan_pilih_pemeriksaan_pilih_rujukan(Request $request)
    {
        $cek = DB::table('log_penilaian_rujukan_cab')
            ->where('m_pemeriksaan_code', $request->pemeriksaan)
            ->where('log_master_code', $request->periode)
            ->where('master_cabang_code', Auth::user()->access_cabang)
            ->where('m_rujukan_code', $request->rujukan)->first();
        if ($cek) {
            return 0;
        } else {
            $kategori = DB::table('t_penilaian_cat')->get();
            $rujukan = DB::table('m_rujukan')->where('m_rujukan_code', $request->rujukan)->first();
            $pemeriksaan = DB::table('m_pemeriksaan')->where('m_pemeriksaan_code', $request->pemeriksaan)->first();
            return view('application.menu.evaluasi-rujukan.form-proses-penilaian-rujukan', [
                'kategori' => $kategori,
                'code' => $request->code,
                'pemeriksaan' => $pemeriksaan,
                'rujukan' => $rujukan,
                'periode' => $request->periode,
            ]);
        }
    }
    public function evaluasi_supplier_rujukan_pilih_pemeriksaan_penilaian_rujukan(Request $request)
    {
        $cek = DB::table('log_penilaian_rujukan_cab')
            ->where('m_pemeriksaan_code', $request->pemeriksaan)
            ->where('log_master_code', $request->periode)
            ->where('master_cabang_code', Auth::user()->access_cabang)
            ->where('m_rujukan_code', $request->rujukan)->first();
        if ($cek) {
            return 0;
        } else {
            $kategori = DB::table('t_penilaian_cat')->get();
            $rujukan = DB::table('m_rujukan')->where('m_rujukan_code', $request->rujukan)->first();
            $pemeriksaan = DB::table('m_pemeriksaan')->where('m_pemeriksaan_code', $request->pemeriksaan)->first();
            return view('application.menu.evaluasi-rujukan.form-proses-penilaian-pemeriksaan', [
                'kategori' => $kategori,
                'code' => $request->code,
                'pemeriksaan' => $pemeriksaan,
                'rujukan' => $rujukan,
                'periode' => $request->periode,
            ]);
        }
    }
    public function evaluasi_supplier_rujukan_pilih_pemeriksaan_pilih_rujukan_update(Request $request)
    {
        $kategori = DB::table('t_penilaian_cat')->get();
        $pemeriksaan = DB::table('m_pemeriksaan')->where('m_pemeriksaan_code', $request->code)->first();
        $rujukan = DB::table('m_rujukan')->where('m_rujukan_code', $request->rujukan)->first();
        return view('application.menu.evaluasi-rujukan.form-proses-penilaian-rujukan', [
            'kategori' => $kategori,
            'code' => $request->code,
            'pemeriksaan' => $pemeriksaan,
            'rujukan' => $rujukan,
            'periode' => $request->periode,
        ]);
    }
    public function evaluasi_supplier_rujukan_pilih_rujukan_pilih_pemeriksaan_update(Request $request)
    {
        $kategori = DB::table('t_penilaian_cat')->get();
        $pemeriksaan = DB::table('m_pemeriksaan')->where('m_pemeriksaan_code', $request->pemeriksaan)->first();
        $rujukan = DB::table('m_rujukan')->where('m_rujukan_code', $request->code)->first();
        return view('application.menu.evaluasi-rujukan.form-proses-penilaian-pemeriksaan', [
            'kategori' => $kategori,
            'code' => $request->code,
            'pemeriksaan' => $pemeriksaan,
            'rujukan' => $rujukan,
            'periode' => $request->periode,
        ]);
    }
    public function evaluasi_supplier_rujukan_pilih_pemeriksaan_pilih_rujukan_next(Request $request)
    {
        $cat = DB::table('t_penilaian_cat')->get();
        $rujukan = DB::table('log_penilaian_rujukan_cab')->select('m_rujukan.*')->join('m_rujukan', 'm_rujukan.m_rujukan_code', '=', 'log_penilaian_rujukan_cab.m_rujukan_code')
            ->where('m_pemeriksaan_code', $request->pemeriksaan)
            ->where('log_master_code', $request->tahun)
            ->where('master_cabang_code', Auth::user()->access_cabang)
            ->distinct()->get(['m_rujukan.m_rujukan_code']);
        return view('application.menu.evaluasi-rujukan.data-table-penilaian-rujukan', [
            'cat' => $cat,
            'periode' => $request->tahun,
            'rujukan' => $rujukan,
            'code' => $request->pemeriksaan,
        ]);
    }
    public function evaluasi_supplier_rujukan_pilih_rujukan_pilih_pemeriksaan_next(Request $request)
    {
        $cat = DB::table('t_penilaian_cat')->get();
        $pemeriksaan = DB::table('log_penilaian_rujukan_cab')->select('m_pemeriksaan.*')
            ->join('m_pemeriksaan', 'm_pemeriksaan.m_pemeriksaan_code', '=', 'log_penilaian_rujukan_cab.m_pemeriksaan_code')
            ->where('m_rujukan_code', $request->rujukan)
            ->where('log_master_code', $request->tahun)
            ->where('master_cabang_code', Auth::user()->access_cabang)
            ->distinct()->get(['m_pemeriksaan.m_pemeriksaan_code']);
        return view('application.menu.evaluasi-rujukan.data-table-penilaian-pemeriksaan', [
            'cat' => $cat,
            'periode' => $request->tahun,
            'pemeriksaan' => $pemeriksaan,
            'code' => $request->rujukan,
        ]);
    }
    public function evaluasi_supplier_rujukan_pilih_pemeriksaan_pilih_rujukan_proses(Request $request)
    {
        $data = DB::table('t_penilaian_detail')->where('t_penilaian_cat_code', $request->cat_penilaian)->get();
        foreach ($data as $value) {
            $cek = DB::table('log_penilaian_rujukan_cab')
                ->where('log_master_code', $request->periode)
                ->where('m_rujukan_code', $request->rujukan)
                ->where('m_pemeriksaan_code', $request->pemeriksaan)
                ->where('t_penilaian_detail_code', $request[$value->t_penilaian_detail_code])->first();
            $score = $request['data' . $value->t_penilaian_detail_code] * $value->t_penilaian_detail_point;
            if ($cek) {
                DB::table('log_penilaian_rujukan_cab')
                    ->where('log_master_code', $request->periode)
                    ->where('m_rujukan_code', $request->rujukan)
                    ->where('m_pemeriksaan_code', $request->pemeriksaan)
                    ->where('t_penilaian_detail_code', $request[$value->t_penilaian_detail_code])->update([
                        'penilaian_rujukan_cab_val' => $request['data' . $value->t_penilaian_detail_code],
                        'penilaian_rujukan_cab_score' => $score,
                    ]);
            } else {
                DB::table('log_penilaian_rujukan_cab')->insert([
                    'penilaian_rujukan_cab_code' => str::uuid(),
                    'log_master_code' => $request->periode,
                    'm_rujukan_code' => $request->rujukan,
                    'm_pemeriksaan_code' => $request->pemeriksaan,
                    'master_cabang_code' => Auth::user()->access_cabang,
                    't_penilaian_detail_code' => $request[$value->t_penilaian_detail_code],
                    'penilaian_rujukan_cab_val' => $request['data' . $value->t_penilaian_detail_code],
                    'penilaian_rujukan_cab_score' => $score,
                    'created_at' => now(),
                ]);
            }
        }
        return 123;
    }
    public function evaluasi_supplier_rujukan_pilih_pemeriksaan_pilih_rujukan_save_fix(Request $request)
    {
        $data = DB::table('m_rujukan')
            ->join('log_penilaian_rujukan_cab', 'log_penilaian_rujukan_cab.m_rujukan_code', '=', 'm_rujukan.m_rujukan_code')
            ->where('log_penilaian_rujukan_cab.log_master_code', $request->code)
            ->where('log_penilaian_rujukan_cab.master_cabang_code', Auth::user()->access_cabang)->distinct()->get(['m_rujukan.m_rujukan_code']);

        $cat = DB::table('t_penilaian_cat')->get();

        foreach ($data as $value) {
            $pemeriksaan = DB::table('m_pemeriksaan')
                ->join('log_penilaian_rujukan_cab', 'log_penilaian_rujukan_cab.m_pemeriksaan_code', '=', 'm_pemeriksaan.m_pemeriksaan_code')
                ->where('log_penilaian_rujukan_cab.log_master_code', $request->code)
                ->where('log_penilaian_rujukan_cab.m_rujukan_code', $value->m_rujukan_code)
                ->where('log_penilaian_rujukan_cab.master_cabang_code', Auth::user()->access_cabang)->distinct()->get(['m_pemeriksaan.m_pemeriksaan_code']);
            foreach ($pemeriksaan as $pem) {
                $total = 0;
                $score = 0;
                foreach ($cat as $cats) {
                    $nilai = DB::table('log_penilaian_rujukan_cab')
                        ->join('t_penilaian_detail', 't_penilaian_detail.t_penilaian_detail_code', '=', 'log_penilaian_rujukan_cab.t_penilaian_detail_code')
                        ->join('t_penilaian_cat', 't_penilaian_cat.t_penilaian_cat_code', '=', 't_penilaian_detail.t_penilaian_cat_code')
                        ->where('log_penilaian_rujukan_cab.m_rujukan_code', $value->m_rujukan_code)
                        ->where('log_penilaian_rujukan_cab.m_pemeriksaan_code', $pem->m_pemeriksaan_code)
                        ->where('log_penilaian_rujukan_cab.log_master_code', $request->code)
                        ->where('log_penilaian_rujukan_cab.master_cabang_code', Auth::user()->access_cabang)
                        ->where('t_penilaian_detail.t_penilaian_detail_type', 'option')
                        ->where('t_penilaian_cat.t_penilaian_cat_code', $cats->t_penilaian_cat_code)
                        ->sum('log_penilaian_rujukan_cab.penilaian_rujukan_cab_score');
                    // $total = $total + $nilai;
                    $score = $score + ($nilai * $cats->t_penilaian_cat_score);
                }
                $cek = DB::table('data_supp_rujukan_cab')
                    ->where('log_master_code', $request->code)
                    ->where('m_pemeriksaan_code', $pem->m_pemeriksaan_code)
                    ->where('m_rujukan_code', $value->m_rujukan_code)
                    ->where('master_cabang_code', Auth::user()->access_cabang)->first();
                if ($cek) {
                    $cek = DB::table('data_supp_rujukan_cab')
                        ->where('log_master_code', $request->code)
                        ->where('m_pemeriksaan_code', $pem->m_pemeriksaan_code)
                        ->where('m_rujukan_code', $value->m_rujukan_code)
                        ->where('master_cabang_code', Auth::user()->access_cabang)->update([
                            'data_supp_rujukan_cab_score' => $score,
                            'created_at' => now(),
                        ]);
                } else {
                    DB::table('data_supp_rujukan_cab')->insert([
                        'data_supp_rujukan_cab_code' => str::uuid(),
                        'log_master_code' => $request->code,
                        'm_pemeriksaan_code' => $pem->m_pemeriksaan_code,
                        'm_rujukan_code' => $value->m_rujukan_code,
                        'master_cabang_code' => Auth::user()->access_cabang,
                        'data_supp_rujukan_cab_score' => $score,
                        'created_at' => now(),
                    ]);
                }
            }
        }
    }

    // PERIODE PENJUALAN
    public function periode_penilaian($akses)
    {
        if ($this->url_akses($akses) == true) {
            $cat = DB::table('t_penilaian_cat')->get();
            $periode = DB::table('log_master')->where('log_master_cabang', Auth::user()->access_cabang)->get();
            return view('application.menu.periode-penilaian', ['cat' => $cat, 'periode' => $periode]);
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function periode_penilaian_add(Request $request)
    {
        return view('application.menu.periode-penilaian.form-add');
    }
    public function periode_penilaian_save(Request $request)
    {
        DB::table('log_master')->insert([
            'log_master_code' => str::uuid(),
            'log_master_periode' => $request->periode,
            'log_master_kacab' => $request->kacab,
            'log_master_mgr' => $request->mgr,
            'log_master_bag' => $request->bag,
            'log_master_jab' => $request->jab,
            'log_master_bag1' => $request->bag1,
            'log_master_jab1' => $request->jab1,
            'log_master_cabang' => Auth::user()->access_cabang,
            'log_master_status' => 1,
            'log_master_date' => now(),
            'created_at' => now()
        ]);
        return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data Jasa');
    }
    public function periode_penilaian_update(Request $request)
    {
        $data = DB::table('log_master')->where('log_master_code', $request->code)->first();
        return view('application.menu.periode-penilaian.form-update', ['data' => $data]);
    }
    public function periode_penilaian_update_save(Request $request)
    {
        DB::table('log_master')->where('log_master_code', $request->code)->update([
            'log_master_periode' => $request->periode,
            'log_master_kacab' => $request->kacab,
            'log_master_mgr' => $request->mgr,
            'log_master_bag' => $request->bag,
            'log_master_jab' => $request->jab,
            'log_master_bag1' => $request->bag1,
            'log_master_jab1' => $request->jab1,
            'updated_at' => now()
        ]);
        return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data Penilaian');
    }
    public function periode_penilaian_add_team_penilaian(Request $request)
    {
        return view('application.menu.periode-penilaian.form-add-team', ['code' => $request->code]);
    }
    public function periode_penilaian_add_team_penilaian_save(Request $request)
    {
        DB::table('log_master_team')->insert([
            'log_master_team_code' => str::uuid(),
            'log_master_code' => $request->code,
            'log_master_team_jabatan' => $request->jabatan,
            'log_master_team_nip' => $request->nip,
            'log_master_team_name' => $request->nama,
            'created_at' => now()
        ]);
        return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Team Penilaian');
    }
    // SUPPLIER KAPUS
    public function evaluasi_kapus_data_penawaran($akses)
    {
        if ($this->url_akses_sub($akses) == true) {
            $data = DB::table('data_penawaran')->get();
            return view('application.menu.data-penawaran-kapus', ['data' => $data]);
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function evaluasi_kapus_data_penawaran_add(Request $request)
    {

        return view('application.menu.data-penawaran-kapus.form-add');
    }
    public function evaluasi_kapus_data_penawaran_save(Request $request)
    {
        DB::table('data_penawaran')->insert([
            'data_penawaran_code' => Str::uuid(),
            'data_penawaran_name' => $request->name,
            'data_penawaran_cabang' => $request->cabang,
            'data_penawaran_tujuan' => $request->tujuan,
            'data_penawaran_anggaran' => $request->anggaran,
            'data_penawaran_status' => 0,
            'created_at' => now()
        ]);
        return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data Penawaran KAPUS');
    }
    // PENILAIAN SUPPLIER KAPUS
    public function evaluasi_kapus_penilaian_supplier($akses)
    {
        if ($this->url_akses_sub($akses) == true) {
            $penawaran = DB::table('data_penawaran')->get();
            return view('application.menu.data-penilaian-supplier-kapus', ['penawaran' => $penawaran]);
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function evaluasi_kapus_penilaian_supplier_add_periode(Request $request)
    {
        return view('application.menu.data-penilaian-kapus.form-add-periode');
    }
    public function evaluasi_kapus_penilaian_supplier_save_periode(Request $request)
    {
        DB::table('n_periode')->insert([
            'n_periode_code' => Str::uuid(),
            'n_periode_name' => $request->periode,
            'n_periode_cabang' => Auth::user()->access_cabang,
            'n_periode_date' => now(),
            'n_periode_status' => 0,
            'created_at' => now()
        ]);
        return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data Penawaran KAPUS');
    }
    public function evaluasi_kapus_penilaian_supplier_detail_periode(Request $request)
    {
        $data = DB::table('m_supplier')->get();
        $cat = DB::table('s_penilaian_cat')->get();
        return view('application.menu.data-penilaian-kapus.data-supplier-kapus', ['data' => $data, 'cat' => $cat, 'code' => $request->code]);
    }
    public function evaluasi_kapus_penilaian_supplier_detail_periode_supplier(Request $request)
    {
        $data = DB::table('m_supplier')->get();
        $barang = DB::table('m_barang')->get();
        return view('application.menu.data-penilaian-kapus.data-pemilihan-penilaian-supplier', ['data' => $data], compact('barang'));
    }
    public function evaluasi_kapus_penilaian_supplier_detail_periode_supplier_add(Request $request)
    {
        $supplier = DB::table('m_supplier')->where('m_supplier_code', $request->code)->first();
        $kategori = DB::table('s_penilaian_cat')->where('s_penilaian_type_code', 'pen_kapus')->get();
        $penawaran = DB::table('data_penawaran')->where('data_penawaran_code', $request->id)->first();
        $barang = DB::table('m_barang')->where('m_barang_code', $request->data_barang)->first();
        return view('application.menu.data-penilaian-kapus.form-proses-penilaian-supplier', [
            'supplier' => $supplier,
            'kategori' => $kategori,
            'penawaran' => $penawaran,
            'barang' => $barang,
        ]);
    }
    public function evaluasi_kapus_penilaian_supplier_fix_detail_periode(Request $request)
    {
        return 123;
    }
    // DATA SUPPLIER KAPUS
    public function evaluasi_kapus_data_supplier_kapus($akses)
    {
        if ($this->url_akses_sub($akses) == true) {
            $data = DB::table('m_supplier')->get();
            return view('application.menu.data-supplier-kapus', ['data' => $data]);
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    // PENETAPAN SUPPLIER KAPUS
    public function evaluasi_kapus_penetapan_supplier_kapus($akses)
    {
        if ($this->url_akses_sub($akses) == true) {
            $data = DB::table('data_penawaran')->get();
            return view('application.menu.penetapan-supplier-kapus', ['data' => $data]);
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function evaluasi_kapus_penetapan_supplier_kapus_preview(Request $request)
    {
        return view('application.menu.penetapan-supplier-kapus.preview-penetapan', ['code' => $request->code]);
    }
    public function evaluasi_kapus_penetapan_supplier_kapus_preview_report(Request $request)
    {
        $project = DB::table('data_penawaran')->where('data_penawaran_code', $request->code)->first();
        $image = base64_encode(file_get_contents(public_path('img/logo.png')));
        $pdf = PDF::loadview('application.menu.penetapan-supplier-kapus.report.report-penetapan', compact('image', 'project'))->setPaper('A4', 'potrait')->setOptions(['defaultFont' => 'Calibri']);
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $font = $dompdf->getFontMetrics()->get_font("helvetica", "bold");
        $font1 = $dompdf->getFontMetrics()->get_font("helvetica", "normal");
        $dompdf->get_canvas()->page_text(300, 820, "{PAGE_NUM} / {PAGE_COUNT}", $font, 10, array(0, 0, 0));
        $dompdf->get_canvas()->page_text(34, 800, "Confidential", $font1, 9, array(0, 0, 0));
        $dompdf->get_canvas()->page_text(34, 810, "Form SDM.02-FRM-PP-06.2/2", $font1, 9, array(0, 0, 0));
        $dompdf->get_canvas()->page_text(34, 820, "Print by. " . Auth::user()->fullname . " " . date('d-m-Y H:i:s'), $font1, 9, array(0, 0, 0));
        return base64_encode($pdf->stream());
    }
    public function evaluasi_kapus_penetapan_supplier_kapus_preview_report_terpilih(Request $request)
    {
        $project = DB::table('data_penawaran')->where('data_penawaran_code', $request->code)->first();
        $image = base64_encode(file_get_contents(public_path('img/logo.png')));
        $pdf = PDF::loadview('application.menu.penetapan-supplier-kapus.report.report-penetapan-terpilih', compact('image', 'project'))->setPaper('A4', 'potrait')->setOptions(['defaultFont' => 'Calibri']);
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $font = $dompdf->getFontMetrics()->get_font("helvetica", "bold");
        $font1 = $dompdf->getFontMetrics()->get_font("helvetica", "normal");
        $dompdf->get_canvas()->page_text(300, 820, "{PAGE_NUM} / {PAGE_COUNT}", $font, 10, array(0, 0, 0));
        $dompdf->get_canvas()->page_text(34, 800, "Confidential", $font1, 9, array(0, 0, 0));
        $dompdf->get_canvas()->page_text(34, 810, "Form SDM.02-FRM-PP-06.2/2", $font1, 9, array(0, 0, 0));
        $dompdf->get_canvas()->page_text(34, 820, "Print by. " . Auth::user()->fullname . " " . date('d-m-Y H:i:s'), $font1, 9, array(0, 0, 0));
        return base64_encode($pdf->stream());
    }

    // LAPORAN
    public function laporan_keputusan($akses)
    {
        if ($this->url_akses($akses) == true) {
            $data = DB::table('log_master')->where('log_master_cabang', Auth::user()->access_cabang)->get();
            return view('application.laporan.laporan-keputusan', ['data' => $data]);
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    public function laporan_keputusan_periode(Request $request)
    {
        if ($request->kategori == 'barang') {
            $brg = DB::table('m_barang')
                ->select('m_barang.*')
                ->join('data_supp_brg_cab', 'data_supp_brg_cab.m_barang_code', '=', 'm_barang.m_barang_code')
                ->where('data_supp_brg_cab.log_master_code', $request->code)
                ->where('data_supp_brg_cab.master_cabang_code', Auth::user()->access_cabang)
                ->distinct()->get(['m_barang.m_barang_code']);
            return view('application.laporan.data-table-suplier-barang', ['brg' => $brg, 'code' => $request->code]);
        } elseif ($request->kategori == 'jasa') {
            $jasa = DB::table('m_jasa')
                ->select('m_jasa.*')
                ->join('data_supp_jasa_cab', 'data_supp_jasa_cab.m_jasa_code', '=', 'm_jasa.m_jasa_code')
                ->where('data_supp_jasa_cab.log_master_code', $request->code)
                ->where('data_supp_jasa_cab.master_cabang_code', Auth::user()->access_cabang)
                ->distinct()->get(['m_jasa.m_jasa_code']);
            return view('application.laporan.data-table-supplier-jasa', ['jasa' => $jasa, 'code' => $request->code]);
        } elseif ($request->kategori == 'rujukan') {
            $pemeriksaan = DB::table('m_pemeriksaan')
                ->select('m_pemeriksaan.*')
                ->join('data_supp_rujukan_cab', 'data_supp_rujukan_cab.m_pemeriksaan_code', '=', 'm_pemeriksaan.m_pemeriksaan_code')
                ->where('data_supp_rujukan_cab.log_master_code', $request->code)
                ->where('data_supp_rujukan_cab.master_cabang_code', Auth::user()->access_cabang)
                ->distinct()->get(['m_pemeriksaan.m_pemeriksaan_code']);
            return view('application.laporan.data-table-supplier-rujukan', ['pemeriksaan' => $pemeriksaan, 'code' => $request->code]);
        } else {
            return 'tidak ditemukan';
        }
    }
    public function laporan_keputusan_surat_keputusan_barang(Request $request)
    {
        return view('application.laporan.form-report-keputusan', ['code' => $request->code]);
    }
    public function laporan_keputusan_surat_keputusan_detail_penilaian(Request $request)
    {
        return view('application.laporan.form-report-detail-penilaian-barang', ['code' => $request->code]);
    }
    public function laporan_keputusan_surat_keputusan_detail_penilaian_report(Request $request)
    {
        $brg = DB::table('m_barang')
            ->select('m_barang.*')
            ->join('data_supp_brg_cab', 'data_supp_brg_cab.m_barang_code', '=', 'm_barang.m_barang_code')
            ->where('data_supp_brg_cab.log_master_code', $request->code)
            ->where('data_supp_brg_cab.master_cabang_code', Auth::user()->access_cabang)
            ->distinct()->get(['m_barang.m_barang_code']);
        $periode = DB::table('log_master')->where('log_master_code', $request->code)->first();
        $cat = DB::table('t_penilaian_cat')->get();
        $image = base64_encode(file_get_contents(public_path('img/logo.png')));
        $pdf = PDF::loadview('application.laporan.report.detail-penilaian-barang', ['brg' => $brg, 'periode' => $periode], compact('image', 'cat'))->setPaper('A4', 'landscape')->setOptions(['defaultFont' => 'Helvetica']);
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $font = $dompdf->getFontMetrics()->get_font("helvetica", "bold");
        $font1 = $dompdf->getFontMetrics()->get_font("helvetica", "normal");
        $dompdf->get_canvas()->page_text(300, 820, "{PAGE_NUM} / {PAGE_COUNT}", $font, 10, array(0, 0, 0));
        $dompdf->get_canvas()->page_text(34, 820, "Print by. " . Auth::user()->fullname, $font1, 10, array(0, 0, 0));
        return base64_encode($pdf->stream());
    }
    public function laporan_keputusan_surat_keputusan_barang_report(Request $request)
    {
        $tahun = DB::table('log_master')->where('log_master_code', $request->code)->first();
        $cabang = DB::table('master_cabang')->where('master_cabang_code', Auth::user()->access_cabang)->first();
        $image = base64_encode(file_get_contents(public_path('img/logo.png')));
        $pdf = PDF::loadview('application.laporan.report.surat-keputusan-barang', ['tahun' => $tahun, 'cabang' => $cabang], compact('image'))->setPaper('A4', 'potrait')->setOptions(['defaultFont' => 'Helvetica']);
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $font = $dompdf->getFontMetrics()->get_font("helvetica", "bold");
        $font1 = $dompdf->getFontMetrics()->get_font("helvetica", "normal");
        $dompdf->get_canvas()->page_text(300, 820, "{PAGE_NUM} / {PAGE_COUNT}", $font, 10, array(0, 0, 0));
        $dompdf->get_canvas()->page_text(34, 820, "Print by. " . Auth::user()->fullname, $font1, 10, array(0, 0, 0));
        return base64_encode($pdf->stream());
    }
    public function laporan_keputusan_surat_keputusan_barang_terpilih(Request $request)
    {
        return view('application.laporan.form-report-pemilihan-supplier-barang', ['code' => $request->code]);
    }
    public function laporan_keputusan_surat_keputusan_barang_terpilih_report(Request $request)
    {
        $brg = DB::table('m_barang')
            ->select('m_barang.*')
            ->join('data_supp_brg_cab', 'data_supp_brg_cab.m_barang_code', '=', 'm_barang.m_barang_code')
            ->where('data_supp_brg_cab.log_master_code', $request->code)
            ->where('data_supp_brg_cab.master_cabang_code', Auth::user()->access_cabang)
            ->distinct()->get(['m_barang.m_barang_code']);
        $periode = DB::table('log_master')->where('log_master_code', $request->code)->first();
        $image = base64_encode(file_get_contents(public_path('img/logo.png')));
        $team = DB::table('log_master_team')->where('log_master_code', $request->code)->get();
        $pdf = PDF::loadview('application.laporan.report.daftar-supplier-barang-terpilih', ['brg' => $brg, 'periode' => $periode], compact('image', 'team'))->setPaper('A4', 'potrait')->setOptions(['defaultFont' => 'Helvetica']);
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $font = $dompdf->getFontMetrics()->get_font("helvetica", "bold");
        $font1 = $dompdf->getFontMetrics()->get_font("helvetica", "normal");
        $dompdf->get_canvas()->page_text(300, 820, "{PAGE_NUM} / {PAGE_COUNT}", $font, 10, array(0, 0, 0));
        $dompdf->get_canvas()->page_text(34, 820, "Print by. " . Auth::user()->fullname, $font1, 10, array(0, 0, 0));
        return base64_encode($pdf->stream());
    }
    public function laporan_keputusan_surat_keputusan_jasa_terpilih(Request $request)
    {
        return view('application.laporan.form-report-pemilihan-supplier-jasa', ['code' => $request->code]);
    }
    public function laporan_keputusan_surat_keputusan_jasa_terpilih_report(Request $request)
    {
        $jasa = DB::table('m_jasa')
            ->select('m_jasa.*')
            ->join('data_supp_jasa_cab', 'data_supp_jasa_cab.m_jasa_code', '=', 'm_jasa.m_jasa_code')
            ->where('data_supp_jasa_cab.log_master_code', $request->code)
            ->where('data_supp_jasa_cab.master_cabang_code', Auth::user()->access_cabang)
            ->distinct()->get(['m_jasa.m_jasa_code']);
        $periode = DB::table('log_master')->where('log_master_code', $request->code)->first();
        $image = base64_encode(file_get_contents(public_path('img/logo.png')));
        $team = DB::table('log_master_team')->where('log_master_code', $request->code)->get();
        $pdf = PDF::loadview('application.laporan.report.daftar-supplier-jasa-terpilih', ['jasa' => $jasa, 'periode' => $periode], compact('image', 'team'))->setPaper('A4', 'potrait')->setOptions(['defaultFont' => 'Helvetica']);
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $font = $dompdf->getFontMetrics()->get_font("helvetica", "bold");
        $font1 = $dompdf->getFontMetrics()->get_font("helvetica", "normal");
        $dompdf->get_canvas()->page_text(300, 820, "{PAGE_NUM} / {PAGE_COUNT}", $font, 10, array(0, 0, 0));
        $dompdf->get_canvas()->page_text(34, 820, "Print by. " . Auth::user()->fullname, $font1, 10, array(0, 0, 0));
        return base64_encode($pdf->stream());
    }
    public function laporan_keputusan_surat_keputusan_rujukan_terpilih(Request $request)
    {
        return view('application.laporan.form-report-pemilihan-supplier-rujukan', ['code' => $request->code]);
    }
    public function laporan_keputusan_surat_keputusan_rujukan_terpilih_report(Request $request)
    {
        $pemeriksaan = DB::table('m_pemeriksaan')
            ->select('m_pemeriksaan.*')
            ->join('data_supp_rujukan_cab', 'data_supp_rujukan_cab.m_pemeriksaan_code', '=', 'm_pemeriksaan.m_pemeriksaan_code')
            ->where('data_supp_rujukan_cab.log_master_code', $request->code)
            ->where('data_supp_rujukan_cab.master_cabang_code', Auth::user()->access_cabang)
            ->distinct()->get(['m_pemeriksaan.m_pemeriksaan_code']);
        $periode = DB::table('log_master')->where('log_master_code', $request->code)->first();
        $image = base64_encode(file_get_contents(public_path('img/logo.png')));
        $pdf = \Barryvdh\DomPDF\Facade\pdf::loadview('application.laporan.report.daftar-supplier-rujukan-terpilih', ['pemeriksaan' => $pemeriksaan, 'periode' => $periode], compact('image'))->setPaper('A4', 'potrait')->setOptions(['defaultFont' => 'Helvetica']);
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $font = $dompdf->getFontMetrics()->get_font("helvetica", "bold");
        $font1 = $dompdf->getFontMetrics()->get_font("helvetica", "normal");
        $dompdf->get_canvas()->page_text(300, 820, "{PAGE_NUM} / {PAGE_COUNT}", $font, 10, array(0, 0, 0));
        $dompdf->get_canvas()->page_text(34, 820, "Print by. " . Auth::user()->fullname, $font1, 10, array(0, 0, 0));
        return base64_encode($pdf->stream());
    }

    public function laporan_keputusan_print()
    {
        // Set params
        $mid = '123123456';
        $store_name = 'YOURMART';
        $store_address = 'Mart Address';
        $store_phone = '1234567890';
        $store_email = 'yourmart@email.com';
        $store_website = 'yourmart.com';
        $tax_percentage = 10;
        $transaction_id = 'TX123ABC456';
        $currency = 'Rp';
        $image_path = 'logo.png';

        // Init printer
        $printer = new ReceiptPrinter;
        $printer->init(
            config('network'),
            config('smb://localhost/printer_coba')
        );

        $printer->setStore($mid, $store_name, $store_address, $store_phone, $store_email, $store_website);

        // Set currency
        $printer->setCurrency($currency);

        // Set request amount
        $printer->setRequestAmount(123);

        // Set transaction ID
        $printer->setTransactionID($transaction_id);

        // Set logo
        // Uncomment the line below if $image_path is defined
        // $printer->setLogo($image_path);

        // Set QR code
        $printer->setQRcode([
            'tid' => $transaction_id,
            'amount' => 123,
        ]);

        // Print payment request
        $printer->printReceipt();
        // $printer->printRequest();
    }
}
