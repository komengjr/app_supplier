<?php

namespace App\Http\Controllers;

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
use Rawilk\Printing\Facades\Printing;
use Session;

class MasterDataController extends Controller
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
    // SUPPLIER
    public function app_master_data_supplier($akses)
    {
        if ($this->url_akses($akses) == true) {
            $data = DB::table('m_supplier')->get();
            return view('application.master-data.master-supplier', ['data' => $data]);
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    // BARANG
    public function app_master_data_barang($akses)
    {
        if ($this->url_akses($akses) == true) {
            $data = DB::table('m_barang')->get();
            return view('application.master-data.master-barang', ['data' => $data]);
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    // JASA
    public function app_master_data_jasa($akses)
    {
        if ($this->url_akses($akses) == true) {
            $data = DB::table('m_jasa')->get();
            return view('application.master-data.master-jasa', ['data' => $data]);
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    // RUJUKAN
    public function app_master_data_rujukan($akses)
    {
        if ($this->url_akses($akses) == true) {
            $data = DB::table('m_rujukan')->get();
            return view('application.master-data.master-rujukan', ['data' => $data]);
        } else {
            return Redirect::to('dashboard/home');
        }
    }
    // RUJUKAN
    public function app_master_data_pemeriksaan($akses)
    {
        if ($this->url_akses($akses) == true) {
            $data = DB::table('m_pemeriksaan')->get();
            return view('application.master-data.master-pemeriksaan', ['data' => $data]);
        } else {
            return Redirect::to('dashboard/home');
        }
    }
}
