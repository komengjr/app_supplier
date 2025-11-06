<?php

namespace App\Http\Controllers;

use App\Imports\BarangImport;
use App\Imports\SupplierImport;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class MasterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function master_user()
    {
        if (Auth::user()->access_code == 'master') {
            return view('master.master-user');
        } else {
            return view('application.error.404');
        }
    }
    // SUPLIER
    public function master_suplier()
    {
        if (Auth::user()->access_code == 'master') {
            $data = DB::table('m_supplier')->get();
            return view('master.master-suplier', ['data' => $data]);
        } else {
            return view('application.error.404');
        }
    }
    public function master_suplier_add(Request $request)
    {
        return view('master.suplier.form-add');
    }
    public function master_suplier_save(Request $request)
    {
        DB::table('m_supplier')->insert([
            'm_supplier_code' => str::uuid(),
            'm_supplier_name' => $request->name,
            'm_supplier_city' => $request->city,
            'm_supplier_alamat' => $request->alamat,
            'm_supplier_phone' => $request->phone,
            'm_supplier_status' => 1,
            'created_at' => now()
        ]);
        return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data Suplier');
    }
    public function master_suplier_import(Request $request)
    {
        return view('master.suplier.form-import-supplier');
    }
    public function master_suplier_import_save(Request $request)
    {
        Excel::import(new SupplierImport(), request()->file('file'));
        return redirect()->back()->withSuccess('Great! Upload Data Supplier');
    }
    // BARANG
    public function master_barang()
    {
        if (Auth::user()->access_code == 'master') {
            $data = DB::table('m_barang')->get();
            return view('master.master-barang', ['data' => $data]);
        } else {
            return view('application.error.404');
        }
    }
    public function master_barang_add(Request $request)
    {
        return view('master.barang.form-add');
    }
    public function master_barang_save(Request $request)
    {
        DB::table('m_barang')->insert([
            'm_barang_code' => str::uuid(),
            'm_barang_name' => $request->name,
            'm_barang_cat' => 'PEM',
            'm_barang_status' => 1,
            'created_at' => now()
        ]);
        return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data Barang');
    }
    public function master_barang_import(Request $request)
    {
        return view('master.barang.form-import-barang');
    }
    public function master_barang_import_save(Request $request)
    {
        Excel::import(new BarangImport(), request()->file('file'));
        return redirect()->back()->withSuccess('Great! Upload Data Pemeriksaan');
    }
    // MASTER JASA
    public function master_jasa()
    {
        if (Auth::user()->access_code == 'master') {
            $data = DB::table('m_jasa')->get();
            return view('master.master-jasa', ['data' => $data]);
        } else {
            return view('application.error.404');
        }
    }
    public function master_jasa_add(Request $request)
    {
        return view('master.jasa.form-add');
    }
    public function master_jasa_save(Request $request)
    {
        DB::table('m_jasa')->insert([
            'm_jasa_code' => str::uuid(),
            'm_jasa_name' => $request->name,
            'm_jasa_cat' => 'JAS',
            'm_jasa_status' => 1,
            'created_at' => now()
        ]);
        return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data Jasa');
    }
    // MASTER RUJUKAN
    public function master_rujukan()
    {
        if (Auth::user()->access_code == 'master') {
            $data = DB::table('m_rujukan')->get();
            return view('master.master-rujukan', ['data' => $data]);
        } else {
            return view('application.error.404');
        }
    }
    public function master_rujukan_add(Request $request)
    {
        return view('master.rujukan.form-add');
    }
    public function master_rujukan_save(Request $request)
    {
        DB::table('m_rujukan')->insert([
            'm_rujukan_code' => str::uuid(),
            'm_rujukan_name' => $request->name,
            'm_rujukan_status' => 1,
            'created_at' => now()
        ]);
        return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data Jasa');
    }
    // MASTER RUJUKAN
    public function master_pemeriksaan()
    {
        if (Auth::user()->access_code == 'master') {
            $data = DB::table('m_pemeriksaan')->get();
            return view('master.master-pemeriksaan', ['data' => $data]);
        } else {
            return view('application.error.404');
        }
    }
    public function master_pemeriksaan_add()
    {
        return view('master.pemeriksaan.form-add');
    }
    public function master_pemeriksaan_save(Request $request)
    {
        DB::table('m_pemeriksaan')->insert([
            'm_pemeriksaan_code' => str::uuid(),
            'm_pemeriksaan_name' => $request->name,
            'm_pemeriksaan_status' => 1,
            'created_at' => now()
        ]);
        return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data Jasa');
    }
    // MASTER MENU PENILAIAN
    public function master_penilaian()
    {
        if (Auth::user()->access_code == 'master') {
            $data = DB::table('t_penilaian_cat')->get();
            return view('master.master-penilaian', ['data' => $data]);
        } else {
            return view('application.error.404');
        }
    }
    public function master_penilaian_add(Request $request)
    {
        return view('master.penilaian.form-add');
    }
    public function master_penilaian_save(Request $request)
    {
        DB::table('t_penilaian_cat')->insert([
            't_penilaian_cat_code' => str::uuid(),
            't_penilaian_cat_name' => $request->name,
            't_penilaian_cat_status' => 1,
            'created_at' => now()
        ]);
        return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data Kategori');
    }
    public function master_penilaian_add_detail(Request $request)
    {
        return view('master.penilaian.form-add-detail', ['code' => $request->code]);
    }
    public function master_penilaian_save_detail(Request $request)
    {
        DB::table('t_penilaian_detail')->insert([
            't_penilaian_detail_code' => str::uuid(),
            't_penilaian_cat_code' => $request->code,
            't_penilaian_detail_name' => $request->name,
            't_penilaian_detail_point' => $request->point,
            't_penilaian_detail_status' => 1,
            't_penilaian_detail_type' => $request->type,
            'created_at' => now()
        ]);
        return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data Penilaian');
    }
    public function master_penilaian_add_point(Request $request)
    {
        return view('master.penilaian.form-add-point', ['code' => $request->code]);
    }
    public function master_penilaian_save_point(Request $request)
    {
        DB::table('t_penilaian_point')->insert([
            't_penilaian_point_code' => str::uuid(),
            't_penilaian_detail_code' => $request->code,
            't_penilaian_point_name' => $request->name,
            't_penilaian_point_value' => $request->point,
            't_penilaian_point_status' => 1,
            'created_at' => now()
        ]);
        return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data Point');
    }
    // MASTER PENILAIAN KAPUS
    public function master_penilaian_kapus()
    {
        if (Auth::user()->access_code == 'master') {
            $data = DB::table('s_penilaian_cat')
                ->join('s_penilaian_type', 's_penilaian_type.s_penilaian_type_code', '=', 's_penilaian_cat.s_penilaian_type_code')
                ->get();
            return view('master.master-penilaian-kapus', ['data' => $data]);
        } else {
            return view('application.error.404');
        }
    }
    public function master_penilaian_kapus_add()
    {
        if (Auth::user()->access_code == 'master') {
            $data = DB::table('s_penilaian_type')->get();
            return view('master.penilaian-kapus.form-add', ['data' => $data]);
        } else {
            return view('application.error.404');
        }
    }
    public function master_penilaian_kapus_save(Request $request)
    {
        if (Auth::user()->access_code == 'master') {
            DB::table('s_penilaian_cat')->insert([
                's_penilaian_cat_code' => Str::uuid(),
                's_penilaian_cat_name' => $request->name,
                's_penilaian_type_code' => $request->type,
                's_penilaian_cat_score' => $request->score,
                's_penilaian_cat_status' => 1,
                'created_at' => now()
            ]);
            return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data Penilaian');
        } else {
            return view('application.error.404');
        }
    }
    public function master_penilaian_kapus_add_detail(Request $request)
    {
        if (Auth::user()->access_code == 'master') {
            // $data = DB::table('s_penilaian_type')->get();
            return view('master.penilaian-kapus.form-add-detail', ['code' => $request->code]);
        } else {
            return view('application.error.404');
        }
    }
    public function master_penilaian_kapus_save_detail(Request $request)
    {
        if (Auth::user()->access_code == 'master') {
            DB::table('s_penilaian_detail')->insert([
                's_penilaian_detail_code' => Str::uuid(),
                's_penilaian_cat_code' => $request->code,
                's_penilaian_detail_name' => $request->name,
                's_penilaian_detail_type' => $request->type,
                's_penilaian_detail_point' => $request->score,
                's_penilaian_detail_status' => 1,
                'created_at' => now()
            ]);
            return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data Penilaian');
        } else {
            return view('application.error.404');
        }
    }
    public function master_penilaian_kapus_add_point_detail(Request $request)
    {
        if (Auth::user()->access_code == 'master') {
            return view('master.penilaian-kapus.form-add-point', ['code' => $request->code]);
        } else {
            return view('application.error.404');
        }
    }
    public function master_penilaian_kapus_save_point_detail(Request $request)
    {
        if (Auth::user()->access_code == 'master') {
             DB::table('s_penilaian_point')->insert([
                's_penilaian_point_code' => Str::uuid(),
                's_penilaian_detail_code' => $request->code,
                's_penilaian_point_name' => $request->name,
                's_penilaian_point_value' => $request->point,
                's_penilaian_point_status' => 1,
                'created_at' => now()
            ]);
            return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data Penilaian');
        } else {
            return view('application.error.404');
        }
    }
    // MASTER MENU
    public function master_document()
    {
        if (Auth::user()->access_code == 'master') {
            $data = DB::table('m_document')
                ->join('m_document_type', 'm_document_type.m_document_type_code', '=', 'm_document.m_document_type_code')
                ->get();
            return view('master.master-document', ['data' => $data]);
        } else {
            return view('application.error.404');
        }
    }
    public function master_document_add()
    {
        if (Auth::user()->access_code == 'master') {
            $data = DB::table('m_document')->get();
            $tipe = DB::table('m_document_type')->get();
            return view('master.document.form-add', ['data' => $data, 'tipe' => $tipe]);
        } else {
            return view('application.error.404');
        }
    }

    public function master_document_save(Request $request)
    {
        if (Auth::user()->access_code == 'master') {
            DB::table('m_document')->insert([
                'm_document_code' => str::uuid(),
                'm_document_type_code' => $request->type,
                'm_document_name' => $request->name,
                'm_document_desc' => $request->desc,
                'm_document_status' => 1,
                'created_at' => now()
            ]);
            return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data Document');
        } else {
            return view('application.error.404');
        }
    }
    public function master_document_update(Request $request)
    {
        if (Auth::user()->access_code == 'master') {
            $data = DB::table('m_document')
                ->join('m_document_type', 'm_document_type.m_document_type_code', '=', 'm_document.m_document_type_code')
                ->where('m_document_code', $request->code)->first();
            $tipe = DB::table('m_document_type')->get();
            return view('master.document.form-update', ['data' => $data, 'tipe' => $tipe]);
        } else {
            return view('application.error.404');
        }
    }
    public function master_document_update_save(Request $request)
    {
        if (Auth::user()->access_code == 'master') {
            DB::table('m_document')->where('m_document_code', $request->code)->update([
                'm_document_type_code' => $request->type,
                'm_document_name' => $request->name,
                'm_document_desc' => $request->desc,
                'm_document_status' => 1,
                'created_at' => now()
            ]);
            return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data Document');
        } else {
            return view('application.error.404');
        }
    }

    // MASTER MENU
    public function master_menu()
    {
        if (Auth::user()->access_code == 'master') {
            $data = DB::table('z_menu_sub')->get();
            return view('master.master-menu', ['data' => $data]);
        } else {
            return view('application.error.404');
        }
    }
    public function master_menu_add()
    {
        if (Auth::user()->access_code == 'master') {
            $menu = DB::table('z_menu')->get();
            return view('master.menu.form-add', ['menu' => $menu]);
        } else {
            return view('application.error.404');
        }
    }
    public function master_menu_save(Request $request)
    {
        if (Auth::user()->access_code == 'master') {
            $code = Str::uuid();
            DB::table('z_menu_sub')->insert([
                'menu_sub_code' => $code,
                'menu_code' => $request->code,
                'menu_sub_name' => $request->name,
                'menu_sub_link' => $request->link,
                'menu_sub_option' => $request->option,
                'menu_sub_icon' => $request->icon,
                'menu_sub_status' => 1,
            ]);
            DB::table('z_menu_user')->insert([
                'menu_sub_code' => $code,
                'access_code' => 'master',
                'created_at' => now()
            ]);
            return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data');
        } else {
            return view('application.error.404');
        }
    }
    public function master_menu_update(Request $request)
    {
        if (Auth::user()->access_code == 'master') {
            $menu = DB::table('z_menu_sub')->where('menu_sub_code', $request->code)->first();
            return view('master.menu.form-update', ['menu' => $menu]);
        } else {
            return view('application.error.404');
        }
    }
    public function master_menu_update_save(Request $request)
    {
        if (Auth::user()->access_code == 'master') {
            return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data');
        } else {
            return view('application.error.404');
        }
    }
    public function master_sub_menu_save(Request $request)
    {
        if (Auth::user()->access_code == 'master') {
            DB::table('z_menu_sub_main')->insert([
                'menu_main_sub_code' => str::uuid(),
                'menu_sub_code' => $request->code,
                'menu_main_sub_name' => $request->name,
                'menu_main_sub_link' => $request->link,
                'menu_main_sub_icon' => $request->icon,
                'menu_main_sub_status' => 1,
                'created_at' => now(),
            ]);
            return redirect()->back()->withSuccess('Great! Berhasil Menambahkan Data');
        } else {
            return view('application.error.404');
        }
    }
    // MASTER MENU
    public function master_menu_akses()
    {
        if (Auth::user()->access_code == 'master') {
            $data = DB::table('master_access')->get();
            return view('master.master-menu-access', ['data' => $data]);
        } else {
            return view('application.error.404');
        }
    }
    public function master_menu_akses_update(Request $request)
    {
        if (Auth::user()->access_code == 'master') {
            $data = DB::table('z_menu')->get();
            return view('master.menu-access.form-update-menu', ['data' => $data, 'code' => $request->code]);
        } else {
            return view('application.error.404');
        }
    }
    public function master_menu_akses_update_save(Request $request)
    {
        if (Auth::user()->access_code == 'master') {
            if ($request->status == 0) {
                DB::table('z_menu_user')->insert([
                    'menu_sub_code' => $request->id,
                    'access_code' => $request->code,
                    'created_at' => now()
                ]);
            } else {
                DB::table('z_menu_user')->where('id_menu_user', $request->number)->delete();
            }
        } else {
            return view('application.error.404');
        }
    }
    public function master_menu_akses_update_sub_save(Request $request)
    {
        if (Auth::user()->access_code == 'master') {
            if ($request->status == 0) {
                DB::table('z_menu_user_sub')->insert([
                    'menu_main_sub_code' => $request->id,
                    'access_code' => $request->code,
                    'created_at' => now()
                ]);
            } else {
                DB::table('z_menu_user_sub')->where('id_menu_user_sub', $request->number)->delete();
            }
        } else {
            return view('application.error.404');
        }
    }
}
