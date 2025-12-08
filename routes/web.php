<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UploadFileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('log-eror', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'fisrt')->name('/');
    Route::get('login', 'index')->name('login');
    Route::get('registration', 'registration')->name('register');
    Route::get('confrim_user', 'confrim_user')->name('confrim_user');
    Route::get('register_status', 'register_status')->name('register_status');
    Route::get('forget_password', 'forget_password')->name('forget_password');
    Route::get('logout', 'logout')->name('logout');
    Route::post('post-registration', 'postRegistration')->name('register.post');
    Route::post('post-login', 'postLogin')->name('login.post');
    Route::post('verifikasi-Login', 'verifikasi_Login')->name('verifikasi_Login');
    // Route::get('dashboard', [AuthController::class, 'dashboard']);
});
Route::prefix('{akses}')->group(function () {
    Route::get('kualifikasi-supplier', [MenuController::class, 'kualifikasi_supplier'])->name('kualifikasi_supplier');
    Route::get('evaluasi-supplier/supplier-barang', [MenuController::class, 'evaluasi_supplier_barang'])->name('evaluasi_supplier_barang');
    Route::get('evaluasi-supplier/supplier-jasa', [MenuController::class, 'evaluasi_supplier_jasa'])->name('evaluasi_supplier_jasa');
    Route::get('evaluasi-supplier/supplier-rujukan', [MenuController::class, 'evaluasi_supplier_rujukan'])->name('evaluasi_supplier_rujukan');
    Route::get('evaluasi-kapus/data-penawaran', [MenuController::class, 'evaluasi_kapus_data_penawaran'])->name('evaluasi_kapus_data_penawaran');
    Route::get('evaluasi-kapus/penilaian-supplier-kapus', [MenuController::class, 'evaluasi_kapus_penilaian_supplier'])->name('evaluasi_kapus_penilaian_supplier');
    Route::get('evaluasi-kapus/data-supplier-kapus', [MenuController::class, 'evaluasi_kapus_data_supplier_kapus'])->name('evaluasi_kapus_data_supplier_kapus');
    Route::get('evaluasi-kapus/penetapan-supplier-kapus', [MenuController::class, 'evaluasi_kapus_penetapan_supplier_kapus'])->name('evaluasi_kapus_penetapan_supplier_kapus');
    Route::get('periode-penilaian', [MenuController::class, 'periode_penilaian'])->name('periode_penilaian');
    Route::get('laporan-keputusan', [MenuController::class, 'laporan_keputusan'])->name('laporan_keputusan');

    // MASTER DATA
    Route::get('app/master-data/master-supplier', [MasterDataController::class, 'app_master_data_supplier'])->name('app_master_data_supplier');
    Route::get('app/master-data/master-barang', [MasterDataController::class, 'app_master_data_barang'])->name('app_master_data_barang');
    Route::get('app/master-data/master-jasa', [MasterDataController::class, 'app_master_data_jasa'])->name('app_master_data_jasa');
    Route::get('app/master-data/master-rujukan', [MasterDataController::class, 'app_master_data_rujukan'])->name('app_master_data_rujukan');
    Route::get('app/master-data/master-pemeriksaan', [MasterDataController::class, 'app_master_data_pemeriksaan'])->name('app_master_data_pemeriksaan');
});
Route::prefix('app')->group(function () {
    // KUALIFIKASI SUPPLIER
    Route::post('kualifikasi-supplier/add-supplier', [MenuController::class, 'kualifikasi_supplier_add_supplier'])->name('kualifikasi_supplier_add_supplier');
    Route::post('kualifikasi-supplier/detail-supplier', [MenuController::class, 'kualifikasi_supplier_detail_supplier'])->name('kualifikasi_supplier_detail_supplier');
    Route::post('kualifikasi-supplier/detail-supplier/save', [MenuController::class, 'kualifikasi_supplier_detail_supplier_save'])->name('kualifikasi_supplier_detail_supplier_save');
    Route::post('kualifikasi-supplier/add-supplier/save', [MenuController::class, 'kualifikasi_supplier_add_supplier_save'])->name('kualifikasi_supplier_add_supplier_save');
    Route::post('kualifikasi-supplier/upload-document', [MenuController::class, 'kualifikasi_supplier_upload_document'])->name('kualifikasi_supplier_upload_document');
    Route::post('kualifikasi-supplier/upload-document/upload', [UploadFileController::class, 'kualifikasi_supplier_upload_document_upload'])->name('kualifikasi_supplier_upload_document_upload');
    Route::post('kualifikasi-supplier/penetapan-document', [MenuController::class, 'kualifikasi_supplier_penetapan_document'])->name('kualifikasi_supplier_penetapan_document');
    Route::post('kualifikasi-supplier/penetapan-document/save', [MenuController::class, 'kualifikasi_supplier_penetapan_document_save'])->name('kualifikasi_supplier_penetapan_document_save');
    Route::post('kualifikasi-supplier/penetapan-document/report', [MenuController::class, 'kualifikasi_supplier_penetapan_document_report'])->name('kualifikasi_supplier_penetapan_document_report');
    Route::post('kualifikasi-supplier/penetapan-document/report-view', [MenuController::class, 'kualifikasi_supplier_penetapan_document_report_view'])->name('kualifikasi_supplier_penetapan_document_report_view');
    // EVALUASI SUPPLIER
    Route::post('evaluasi-supplier/supplier-barang/cari-supplier', [MenuController::class, 'evaluasi_supplier_barang_cari_supplier'])->name('evaluasi_supplier_barang_cari_supplier');
    Route::post('evaluasi-supplier/supplier-barang/cari-barang', [MenuController::class, 'evaluasi_supplier_barang_cari_barang'])->name('evaluasi_supplier_barang_cari_barang');
    Route::post('evaluasi-supplier/supplier-barang/pilih-supplier', [MenuController::class, 'evaluasi_supplier_barang_pilih_supplier'])->name('evaluasi_supplier_barang_pilih_supplier');
    Route::post('evaluasi-supplier/supplier-barang/pilih-barang', [MenuController::class, 'evaluasi_supplier_barang_pilih_barang'])->name('evaluasi_supplier_barang_pilih_barang');
    Route::post('evaluasi-supplier/supplier-barang/pilih-periode', [MenuController::class, 'evaluasi_supplier_barang_pilih_periode'])->name('evaluasi_supplier_barang_pilih_periode');
    Route::post('evaluasi-supplier/supplier-barang/pilih-periode-barang', [MenuController::class, 'evaluasi_supplier_barang_pilih_periode_barang'])->name('evaluasi_supplier_barang_pilih_periode_barang');
    Route::post('evaluasi-supplier/supplier-barang/pilih-periode-barang/tambah-supplier', [MenuController::class, 'evaluasi_supplier_barang_pilih_periode_barang_add_supplier'])->name('evaluasi_supplier_barang_pilih_periode_barang_add_supplier');
    Route::post('evaluasi-supplier/supplier-barang/pilih-periode-supplier/tambah-barang', [MenuController::class, 'evaluasi_supplier_barang_pilih_periode_supplier_add_barang'])->name('evaluasi_supplier_barang_pilih_periode_supplier_add_barang');
    Route::post('evaluasi-supplier/supplier-barang/tambah-periode-supplier', [MenuController::class, 'evaluasi_supplier_barang_tambah_periode_supplier'])->name('evaluasi_supplier_barang_tambah_periode_supplier');
    Route::post('evaluasi-supplier/supplier-barang/tambah-periode-supplier/save', [MenuController::class, 'evaluasi_supplier_barang_tambah_periode_supplier_save'])->name('evaluasi_supplier_barang_tambah_periode_supplier_save');
    Route::post('evaluasi-supplier/supplier-barang/proses-penilaian-supplier-barang', [MenuController::class, 'evaluasi_supplier_barang_proses_penilaian_barang'])->name('evaluasi_supplier_barang_proses_penilaian_barang');
    Route::post('evaluasi-supplier/supplier-barang/proses-penilaian-supplier-barang/next', [MenuController::class, 'evaluasi_supplier_barang_proses_penilaian_barang_next'])->name('evaluasi_supplier_barang_proses_penilaian_barang_next');
    Route::post('evaluasi-supplier/supplier-barang/proses-penilaian-supplier', [MenuController::class, 'evaluasi_supplier_barang_proses_penilaian_supplier'])->name('evaluasi_supplier_barang_proses_penilaian_supplier');
    Route::post('evaluasi-supplier/supplier-barang/proses-penilaian-supplier/save', [MenuController::class, 'evaluasi_supplier_barang_proses_penilaian_supplier_save'])->name('evaluasi_supplier_barang_proses_penilaian_supplier_save');
    Route::post('evaluasi-supplier/supplier-barang/proses-penilaian-supplier/save-fix-proses', [MenuController::class, 'evaluasi_supplier_barang_proses_penilaian_supplier_save_fix'])->name('evaluasi_supplier_barang_proses_penilaian_supplier_save_fix');
    // JASA
    Route::post('evaluasi-supplier/supplier-jasa/cari-jasa', [MenuController::class, 'evaluasi_supplier_jasa_cari_jasa'])->name('evaluasi_supplier_jasa_cari_jasa');
    Route::post('evaluasi-supplier/supplier-jasa/pilih-jasa', [MenuController::class, 'evaluasi_supplier_jasa_pilih_jasa'])->name('evaluasi_supplier_jasa_pilih_jasa');
    Route::post('evaluasi-supplier/supplier-jasa/pilih-jasa/cari-supplier', [MenuController::class, 'evaluasi_supplier_jasa_pilih_jasa_supplier'])->name('evaluasi_supplier_jasa_pilih_jasa_supplier');
    Route::post('evaluasi-supplier/supplier-jasa/pilih-jasa/pilih-supplier', [MenuController::class, 'evaluasi_supplier_jasa_pilih_jasa_pilih_supplier'])->name('evaluasi_supplier_jasa_pilih_jasa_pilih_supplier');
    Route::post('evaluasi-supplier/supplier-jasa/pilih-jasa/pilih-supplier/update', [MenuController::class, 'evaluasi_supplier_jasa_pilih_jasa_pilih_supplier_update'])->name('evaluasi_supplier_jasa_pilih_jasa_pilih_supplier_update');
    Route::post('evaluasi-supplier/supplier-jasa/pilih-jasa/pilih-supplier/next', [MenuController::class, 'evaluasi_supplier_jasa_pilih_jasa_pilih_supplier_next'])->name('evaluasi_supplier_jasa_pilih_jasa_pilih_supplier_next');
    Route::post('evaluasi-supplier/supplier-jasa/pilih-jasa/proses-penilaian-supplier', [MenuController::class, 'evaluasi_supplier_jasa_pilih_jasa_proses_penilaian_supplier'])->name('evaluasi_supplier_jasa_pilih_jasa_proses_penilaian_supplier');
    Route::post('evaluasi-supplier/supplier-jasa/pilih-jasa/proses-penilaian-supplier/save', [MenuController::class, 'evaluasi_supplier_jasa_pilih_jasa_proses_penilaian_supplier_save'])->name('evaluasi_supplier_jasa_pilih_jasa_proses_penilaian_supplier_save');
    Route::post('evaluasi-supplier/supplier-jasa/pilih-jasa/proses-penilaian-supplier/save-fix-proses', [MenuController::class, 'evaluasi_supplier_jasa_pilih_jasa_proses_penilaian_supplier_save_fix'])->name('evaluasi_supplier_jasa_pilih_jasa_proses_penilaian_supplier_save_fix');
    // RUJUKAN
    Route::post('evaluasi-supplier/supplier-rujukan/cari-pemeriksaan', [MenuController::class, 'evaluasi_supplier_rujukan_cari_pemeriksaan'])->name('evaluasi_supplier_rujukan_cari_pemeriksaan');
    Route::post('evaluasi-supplier/supplier-rujukan/pilih-pemeriksaan', [MenuController::class, 'evaluasi_supplier_rujukan_pilih_pemeriksaan'])->name('evaluasi_supplier_rujukan_pilih_pemeriksaan');
    Route::post('evaluasi-supplier/supplier-rujukan/pilih-pemeriksaan/cari-rujukan', [MenuController::class, 'evaluasi_supplier_rujukan_pilih_pemeriksaan_rujukan'])->name('evaluasi_supplier_rujukan_pilih_pemeriksaan_rujukan');
    Route::post('evaluasi-supplier/supplier-rujukan/pilih-pemeriksaan/pilih-rujukan', [MenuController::class, 'evaluasi_supplier_rujukan_pilih_pemeriksaan_pilih_rujukan'])->name('evaluasi_supplier_rujukan_pilih_pemeriksaan_pilih_rujukan');
    Route::post('evaluasi-supplier/supplier-rujukan/pilih-pemeriksaan/pilih-rujukan/proses', [MenuController::class, 'evaluasi_supplier_rujukan_pilih_pemeriksaan_pilih_rujukan_proses'])->name('evaluasi_supplier_rujukan_pilih_pemeriksaan_pilih_rujukan_proses');
    Route::post('evaluasi-supplier/supplier-rujukan/pilih-pemeriksaan/pilih-rujukan/update', [MenuController::class, 'evaluasi_supplier_rujukan_pilih_pemeriksaan_pilih_rujukan_update'])->name('evaluasi_supplier_rujukan_pilih_pemeriksaan_pilih_rujukan_update');
    Route::post('evaluasi-supplier/supplier-rujukan/pilih-pemeriksaan/pilih-rujukan/next', [MenuController::class, 'evaluasi_supplier_rujukan_pilih_pemeriksaan_pilih_rujukan_next'])->name('evaluasi_supplier_rujukan_pilih_pemeriksaan_pilih_rujukan_next');
    Route::post('evaluasi-supplier/supplier-rujukan/pilih-pemeriksaan/pilih-rujukan/save-fix', [MenuController::class, 'evaluasi_supplier_rujukan_pilih_pemeriksaan_pilih_rujukan_save_fix'])->name('evaluasi_supplier_rujukan_pilih_pemeriksaan_pilih_rujukan_save_fix');

    Route::post('evaluasi-supplier/supplier-rujukan/cari-rujukan', [MenuController::class, 'evaluasi_supplier_rujukan_cari_rujukan'])->name('evaluasi_supplier_rujukan_cari_rujukan');
    Route::post('evaluasi-supplier/supplier-rujukan/pilih-rujukan', [MenuController::class, 'evaluasi_supplier_rujukan_pilih_rujukan'])->name('evaluasi_supplier_rujukan_pilih_rujukan');
    Route::post('evaluasi-supplier/supplier-rujukan/pilih-rujukan/cari-pemeriksaan', [MenuController::class, 'evaluasi_supplier_rujukan_cari_pemeriksaan_rujukan'])->name('evaluasi_supplier_rujukan_cari_pemeriksaan_rujukan');
    Route::post('evaluasi-supplier/supplier-rujukan/pilih-rujukan/pilih-pemeriksaan', [MenuController::class, 'evaluasi_supplier_rujukan_pilih_pemeriksaan_penilaian_rujukan'])->name('evaluasi_supplier_rujukan_pilih_pemeriksaan_penilaian_rujukan');
    Route::post('evaluasi-supplier/supplier-rujukan/pilih-rujukan/pilih-pemeriksaan/update', [MenuController::class, 'evaluasi_supplier_rujukan_pilih_rujukan_pilih_pemeriksaan_update'])->name('evaluasi_supplier_rujukan_pilih_rujukan_pilih_pemeriksaan_update');
    Route::post('evaluasi-supplier/supplier-rujukan/pilih-rujukan/pilih-pemeriksaan/next', [MenuController::class, 'evaluasi_supplier_rujukan_pilih_rujukan_pilih_pemeriksaan_next'])->name('evaluasi_supplier_rujukan_pilih_rujukan_pilih_pemeriksaan_next');

    Route::post('periode-penilaian/add', [MenuController::class, 'periode_penilaian_add'])->name('periode_penilaian_add');
    Route::post('periode-penilaian/save', [MenuController::class, 'periode_penilaian_save'])->name('periode_penilaian_save');
    Route::post('periode-penilaian/update', [MenuController::class, 'periode_penilaian_update'])->name('periode_penilaian_update');
    Route::post('periode-penilaian/update-save', [MenuController::class, 'periode_penilaian_update_save'])->name('periode_penilaian_update_save');

    // DATA PENAWARAN KAPUS
    Route::post('evaluasi-kapus/data-penawaran/add', [MenuController::class, 'evaluasi_kapus_data_penawaran_add'])->name('evaluasi_kapus_data_penawaran_add');
    Route::post('evaluasi-kapus/data-penawaran/save', [MenuController::class, 'evaluasi_kapus_data_penawaran_save'])->name('evaluasi_kapus_data_penawaran_save');
    // DATA PENILAIAN KAPUS
    Route::post('evaluasi-kapus/penilaian-supplier-kapus/add-periode', [MenuController::class, 'evaluasi_kapus_penilaian_supplier_add_periode'])->name('evaluasi_kapus_penilaian_supplier_add_periode');
    Route::post('evaluasi-kapus/penilaian-supplier-kapus/save-periode', [MenuController::class, 'evaluasi_kapus_penilaian_supplier_save_periode'])->name('evaluasi_kapus_penilaian_supplier_save_periode');
    Route::post('evaluasi-kapus/penilaian-supplier-kapus/detail-periode', [MenuController::class, 'evaluasi_kapus_penilaian_supplier_detail_periode'])->name('evaluasi_kapus_penilaian_supplier_detail_periode');
    Route::post('evaluasi-kapus/penilaian-supplier-kapus/detail-periode/penilaian-supplier', [MenuController::class, 'evaluasi_kapus_penilaian_supplier_detail_periode_supplier'])->name('evaluasi_kapus_penilaian_supplier_detail_periode_supplier');
    Route::post('evaluasi-kapus/penilaian-supplier-kapus/detail-periode/penilaian-supplier/add', [MenuController::class, 'evaluasi_kapus_penilaian_supplier_detail_periode_supplier_add'])->name('evaluasi_kapus_penilaian_supplier_detail_periode_supplier_add');
    Route::post('evaluasi-kapus/penilaian-supplier-kapus/fix-detail-periode', [MenuController::class, 'evaluasi_kapus_penilaian_supplier_fix_detail_periode'])->name('evaluasi_kapus_penilaian_supplier_fix_detail_periode');

    // PENETAPAN SUPPLIER KAPUS
    Route::post('evaluasi-kapus/penetapan-supplier-kapus/preview', [MenuController::class, 'evaluasi_kapus_penetapan_supplier_kapus_preview'])->name('evaluasi_kapus_penetapan_supplier_kapus_preview');
    Route::post('evaluasi-kapus/penetapan-supplier-kapus/preview-report', [MenuController::class, 'evaluasi_kapus_penetapan_supplier_kapus_preview_report'])->name('evaluasi_kapus_penetapan_supplier_kapus_preview_report');
    Route::post('evaluasi-kapus/penetapan-supplier-kapus/preview-report-terpilih', [MenuController::class, 'evaluasi_kapus_penetapan_supplier_kapus_preview_report_terpilih'])->name('evaluasi_kapus_penetapan_supplier_kapus_preview_report_terpilih');

    Route::get('laporan-keputusan/print', [MenuController::class, 'laporan_keputusan_print'])->name('laporan_keputusan_print');
    Route::post('laporan-keputusan/periode', [MenuController::class, 'laporan_keputusan_periode'])->name('laporan_keputusan_periode');
    Route::post('laporan-keputusan/surat-keputusan-evaluasi-barang', [MenuController::class, 'laporan_keputusan_surat_keputusan_barang'])->name('laporan_keputusan_surat_keputusan_barang');
    Route::post('laporan-keputusan/surat-keputusan-evaluasi-barang/report', [MenuController::class, 'laporan_keputusan_surat_keputusan_barang_report'])->name('laporan_keputusan_surat_keputusan_barang_report');
    Route::post('laporan-keputusan/surat-keputusan-evaluasi-barang-terpilih', [MenuController::class, 'laporan_keputusan_surat_keputusan_barang_terpilih'])->name('laporan_keputusan_surat_keputusan_barang_terpilih');
    Route::post('laporan-keputusan/surat-keputusan-evaluasi-barang-terpilih/report', [MenuController::class, 'laporan_keputusan_surat_keputusan_barang_terpilih_report'])->name('laporan_keputusan_surat_keputusan_barang_terpilih_report');
    Route::post('laporan-keputusan/surat-keputusan-evaluasi-jasa-terpilih', [MenuController::class, 'laporan_keputusan_surat_keputusan_jasa_terpilih'])->name('laporan_keputusan_surat_keputusan_jasa_terpilih');
    Route::post('laporan-keputusan/surat-keputusan-evaluasi-jasa-terpilih/report', [MenuController::class, 'laporan_keputusan_surat_keputusan_jasa_terpilih_report'])->name('laporan_keputusan_surat_keputusan_jasa_terpilih_report');
    Route::post('laporan-keputusan/surat-keputusan-evaluasi-rujukan-terpilih', [MenuController::class, 'laporan_keputusan_surat_keputusan_rujukan_terpilih'])->name('laporan_keputusan_surat_keputusan_rujukan_terpilih');
    Route::post('laporan-keputusan/surat-keputusan-evaluasi-rujukan-terpilih/report', [MenuController::class, 'laporan_keputusan_surat_keputusan_rujukan_terpilih_report'])->name('laporan_keputusan_surat_keputusan_rujukan_terpilih_report');
});
Route::prefix('dashboard')->group(function () {
    Route::get('home', [dashboardController::class, 'index'])->name('dashboard.home');
    Route::get('console', [dashboardController::class, 'console'])->name('dashboard.console');
});
Route::prefix('master-data')->group(function () {
    Route::get('user', [MasterController::class, 'master_user'])->name('master_user');
    Route::get('suplier', [MasterController::class, 'master_suplier'])->name('master_suplier');
    Route::get('barang', [MasterController::class, 'master_barang'])->name('master_barang');
    Route::get('jasa', [MasterController::class, 'master_jasa'])->name('master_jasa');
    Route::get('rujukan', [MasterController::class, 'master_rujukan'])->name('master_rujukan');
    Route::get('pemeriksaan', [MasterController::class, 'master_pemeriksaan'])->name('master_pemeriksaan');
    Route::get('penilaian', [MasterController::class, 'master_penilaian'])->name('master_penilaian');
    Route::get('penilaian-kapus', [MasterController::class, 'master_penilaian_kapus'])->name('master_penilaian_kapus');

    Route::get('document', [MasterController::class, 'master_document'])->name('master_document');
    Route::post('document/add', [MasterController::class, 'master_document_add'])->name('master_document_add');
    Route::post('document/save', [MasterController::class, 'master_document_save'])->name('master_document_save');
    Route::post('document/update', [MasterController::class, 'master_document_update'])->name('master_document_update');
    Route::post('document/update-save', [MasterController::class, 'master_document_update_save'])->name('master_document_update_save');
    Route::get('menu', [MasterController::class, 'master_menu'])->name('master_menu');
    Route::post('menu/add', [MasterController::class, 'master_menu_add'])->name('master_menu_add');
    Route::post('menu/save', [MasterController::class, 'master_menu_save'])->name('master_menu_save');
    Route::post('menu/update', [MasterController::class, 'master_menu_update'])->name('master_menu_update');
    Route::post('menu/update-save', [MasterController::class, 'master_menu_update_save'])->name('master_menu_update_save');
    Route::post('menu/sub-menu-save', [MasterController::class, 'master_sub_menu_save'])->name('master_sub_menu_save');
    Route::get('menu-access', [MasterController::class, 'master_menu_akses'])->name('master_menu_akses');
    Route::post('menu-access/update', [MasterController::class, 'master_menu_akses_update'])->name('master_menu_akses_update');
    Route::post('menu-access/update_save', [MasterController::class, 'master_menu_akses_update_save'])->name('master_menu_akses_update_save');
    Route::post('menu-access/update_sub_save', [MasterController::class, 'master_menu_akses_update_sub_save'])->name('master_menu_akses_update_sub_save');
});
Route::prefix('master-data')->group(function () {
    Route::post('suplier/add', [MasterController::class, 'master_suplier_add'])->name('master_suplier_add');
    Route::post('suplier/save', [MasterController::class, 'master_suplier_save'])->name('master_suplier_save');
    Route::post('suplier/import', [MasterController::class, 'master_suplier_import'])->name('master_suplier_import');
    Route::post('suplier/import/save', [MasterController::class, 'master_suplier_import_save'])->name('master_suplier_import_save');

    Route::post('barang/add', [MasterController::class, 'master_barang_add'])->name('master_barang_add');
    Route::post('barang/save', [MasterController::class, 'master_barang_save'])->name('master_barang_save');
    Route::post('barang/import', [MasterController::class, 'master_barang_import'])->name('master_barang_import');
    Route::post('barang/import/save', [MasterController::class, 'master_barang_import_save'])->name('master_barang_import_save');
    Route::post('jasa/add', [MasterController::class, 'master_jasa_add'])->name('master_jasa_add');
    Route::post('jasa/save', [MasterController::class, 'master_jasa_save'])->name('master_jasa_save');
    Route::post('rujukan/add', [MasterController::class, 'master_rujukan_add'])->name('master_rujukan_add');
    Route::post('rujukan/save', [MasterController::class, 'master_rujukan_save'])->name('master_rujukan_save');
    Route::post('pemeriksaan/add', [MasterController::class, 'master_pemeriksaan_add'])->name('master_pemeriksaan_add');
    Route::post('pemeriksaan/save', [MasterController::class, 'master_pemeriksaan_save'])->name('master_pemeriksaan_save');
});
Route::prefix('master-data')->group(function () {
    Route::post('penilaian/add', [MasterController::class, 'master_penilaian_add'])->name('master_penilaian_add');
    Route::post('penilaian/save', [MasterController::class, 'master_penilaian_save'])->name('master_penilaian_save');
    Route::post('penilaian/add-detail', [MasterController::class, 'master_penilaian_add_detail'])->name('master_penilaian_add_detail');
    Route::post('penilaian/save-detail', [MasterController::class, 'master_penilaian_save_detail'])->name('master_penilaian_save_detail');
    Route::post('penilaian/add-point', [MasterController::class, 'master_penilaian_add_point'])->name('master_penilaian_add_point');
    Route::post('penilaian/save-point', [MasterController::class, 'master_penilaian_save_point'])->name('master_penilaian_save_point');

    Route::post('penilaian-kapus/add', [MasterController::class, 'master_penilaian_kapus_add'])->name('master_penilaian_kapus_add');
    Route::post('penilaian-kapus/save', [MasterController::class, 'master_penilaian_kapus_save'])->name('master_penilaian_kapus_save');
    Route::post('penilaian-kapus/add-detail', [MasterController::class, 'master_penilaian_kapus_add_detail'])->name('master_penilaian_kapus_add_detail');
    Route::post('penilaian-kapus/save-detail', [MasterController::class, 'master_penilaian_kapus_save_detail'])->name('master_penilaian_kapus_save_detail');
    Route::post('penilaian-kapus/add-point-detail', [MasterController::class, 'master_penilaian_kapus_add_point_detail'])->name('master_penilaian_kapus_add_point_detail');
    Route::post('penilaian-kapus/save-point-detail', [MasterController::class, 'master_penilaian_kapus_save_point_detail'])->name('master_penilaian_kapus_save_point_detail');
});
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/testprint', [App\Http\Controllers\HomeController::class, 'testprint'])->name('testprint');
Route::get('/testprintcoba', [App\Http\Controllers\HomeController::class, 'testprintcoba'])->name('testprintcoba');
