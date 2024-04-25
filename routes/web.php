<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UpkController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\GenerateController;
use App\Http\Controllers\Kabupaten\AuthController as KabupatenAuthController;
use App\Http\Controllers\Kabupaten\KabupatenController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\PinjamanAnggotaController;
use App\Http\Controllers\PinjamanIndividuController;
use App\Http\Controllers\PinjamanKelompokController;
use App\Http\Controllers\SopController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Kecamatan;
use App\Models\PinjamanKelompok;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/kab', [KabupatenAuthController::class, 'index'])->middleware('guest');
Route::post('/kab/login', [KabupatenAuthController::class, 'login'])->middleware('guest');

Route::group(['prefix' => 'kab', 'as' => 'kab.', 'middleware' => 'kab'], function () {
    Route::get('/dashboard', [KabupatenController::class, 'index']);
    Route::get('/simpan_saldo', [DashboardController::class, 'simpanSaldo']);
    Route::get('/kecamatan/{kd_kec}', [KabupatenController::class, 'kecamatan']);

    Route::post('/logout', [KabupatenAuthController::class, 'logout']);
});

Route::get('/', [AuthController::class, 'index'])->middleware('guest')->name('/');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

// Route::get('/force/{uname}', [AuthController::class, 'force'])->middleware('guest');

Route::get('/pelaporan', [PelaporanController::class, 'index'])->middleware('basic');
Route::get('/pelaporan/sub_laporan/{file}', [PelaporanController::class, 'subLaporan'])->middleware('basic');
Route::post('/pelaporan/preview', [PelaporanController::class, 'preview'])->middleware('basic');
Route::post('/pelaporan/preview/{lokasi?}', [PelaporanController::class, 'preview'])->middleware('basic');

Route::get('/pelaporan/mou', [PelaporanController::class, 'mou'])->middleware('auth');
Route::get('/pelaporan/ts', [PelaporanController::class, 'ts'])->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/piutang_jasa', [DashboardController::class, 'piutang'])->middleware('auth');
Route::get('/pelaporan/invoice/{invoice}', [PelaporanController::class, 'invoice']);
Route::get('/simpan_saldo', [DashboardController::class, 'simpanSaldo'])->middleware('auth');

Route::post('/dashboard/jatuh_tempo', [DashboardController::class, 'jatuhTempo'])->middleware('auth');
Route::post('/dashboard/nunggak', [DashboardController::class, 'nunggak'])->middleware('auth');
Route::post('/dashboard/tagihan', [DashboardController::class, 'tagihan'])->middleware('auth');
Route::get('/dashboard/pinjaman', [DashboardController::class, 'pinjaman'])->middleware('auth');
Route::get('/dashboard/pemanfaat', [DashboardController::class, 'pemanfaat'])->middleware('auth');

Route::get('/pengaturan/sop', [SopController::class, 'index'])->middleware('auth');
Route::get('/pengaturan/coa', [SopController::class, 'coa'])->middleware('auth');
Route::get('/pengaturan/ttd_pelaporan', [SopController::class, 'ttdPelaporan'])->middleware('auth');
Route::get('/pengaturan/ttd_spk', [SopController::class, 'ttdSpk'])->middleware('auth');
Route::put('/pengaturan/pesan_whatsapp/{kec}', [SopController::class, 'pesanWhatsapp'])->middleware('auth');

Route::put('/pengaturan/lembaga/{kec}', [SopController::class, 'lembaga'])->middleware('auth');
Route::put('/pengaturan/pengelola/{kec}', [SopController::class, 'pengelola'])->middleware('auth');
Route::put('/pengaturan/pinjaman/{kec}', [SopController::class, 'pinjaman'])->middleware('auth');
Route::put('/pengaturan/asuransi/{kec}', [SopController::class, 'asuransi'])->middleware('auth');
Route::put('/pengaturan/spk/{kec}', [SopController::class, 'spk'])->middleware('auth');
Route::put('/pengaturan/logo/{kec}', [SopController::class, 'logo'])->middleware('auth');
Route::put('/pengaturan/calk/{kec}', [SopController::class, 'calk'])->middleware('auth');

Route::post('/pengaturan/whatsapp/{token}', [SopController::class, 'whatsapp'])->middleware('auth');

Route::get('/pengaturan/invoice', [SopController::class, 'invoice'])->middleware('auth');
Route::get('/pengaturan/{inv}/invoice', [SopController::class, 'detailInvoice'])->middleware('auth');

Route::post('/pengaturan/sop/simpanttdpelaporan', [SopController::class, 'simpanTtdPelaporan'])->middleware('auth');

Route::get('/database/kelompok/register_kelompok', [KelompokController::class, 'register'])->middleware('auth');
Route::get('/database/kelompok/generatekode', [KelompokController::class, 'generateKode'])->middleware('auth');

Route::get('/database/penduduk/register_penduduk', [AnggotaController::class, 'register'])->middleware('auth');
Route::get('/database/penduduk/cari_nik', [AnggotaController::class, 'cariNik'])->middleware('auth');

Route::post('/database/penduduk/{nik}/blokir', [AnggotaController::class, 'blokir'])->middleware('auth');

Route::get('/database/kelompok/detail_kelompok/{id}', [KelompokController::class, 'detailKelompok'])->middleware('auth');
Route::get('/database/anggota/detail_anggota/{id}', [AnggotaController::class, 'detailAnggota'])->middleware('auth');


Route::resource('/database/desa', DesaController::class)->middleware('auth');
Route::resource('/database/kelompok', KelompokController::class)->middleware('auth');
Route::resource('/database/penduduk', AnggotaController::class)->middleware('auth');

Route::get('/register_proposal', [PinjamanKelompokController::class, 'create'])->middleware('auth');
Route::get('/register_proposal/{id_kel}', [PinjamanKelompokController::class, 'register'])->middleware('auth');
Route::get('/daftar_kelompok', [PinjamanKelompokController::class, 'DaftarKelompok'])->middleware('auth');

Route::get('/detail/{perguliran}', [PinjamanKelompokController::class, 'detail'])->middleware('auth');
Route::get('/perguliran/proposal', [PinjamanKelompokController::class, 'proposal'])->middleware('auth');
Route::get('/perguliran/verified', [PinjamanKelompokController::class, 'verified'])->middleware('auth');
Route::get('/perguliran/waiting', [PinjamanKelompokController::class, 'waiting'])->middleware('auth');
Route::get('/perguliran/aktif', [PinjamanKelompokController::class, 'aktif'])->middleware('auth');
Route::get('/perguliran/lunas', [PinjamanKelompokController::class, 'lunas'])->middleware('auth');
Route::get('/perguliran/generate/{id_pinj}', [PinjamanKelompokController::class, 'generate'])->middleware('auth');
Route::get('/lunas/{perguliran}', [PinjamanKelompokController::class, 'pelunasan'])->middleware('auth');
Route::get('/cetak_keterangan_lunas/{perguliran}', [PinjamanKelompokController::class, 'keterangan'])->middleware('auth');

Route::get('/perguliran/cari_kelompok', [PinjamanKelompokController::class, 'cariKelompok'])->middleware('auth');
Route::get('/perguliran/cari_anggota', [PinjamanAnggotaController::class, 'cariAnggota'])->middleware('auth');

Route::post('/perguliran/simpan_data/{id}', [PinjamanKelompokController::class, 'simpan'])->middleware('auth');
Route::post('/perguliran/rescedule', [PinjamanKelompokController::class, 'rescedule'])->middleware('auth');
Route::post('/perguliran/hapus', [PinjamanKelompokController::class, 'hapus'])->middleware('auth');
Route::resource('/perguliran', PinjamanKelompokController::class)->middleware('auth');

Route::get('/perguliran/dokumen/kartu_angsuran/{id}', [PinjamanKelompokController::class, 'kartuAngsuran'])->middleware('auth');
Route::get('/perguliran/dokumen/kartu_angsuran_i/{id}', [PinjamanAnggotaController::class, 'kartuAngsuranIndividu'])->middleware('auth');


Route::get('/perguliran/dokumen/kartu_angsuran/{id}/{idtp}', [PinjamanKelompokController::class, 'cetakPadaKartu'])->middleware('auth');

Route::get('/perguliran/dokumen/kartu_angsuran_anggota/{id}/{nia?}', [PinjamanKelompokController::class, 'kartuAngsuranAnggota'])->middleware('auth');
Route::get('/perguliran/dokumen/kartu_angsuran_anggota_i/{id}/{nia?}', [PinjamanAnggotaController::class, 'kartuAngsuranAnggotaIndividu'])->middleware('auth');


Route::get('/perguliran/dokumen/cetak_kartu_angsuran_anggota/{id}/{idtp}/{nia?}', [PinjamanKelompokController::class, 'cetakKartuAngsuranAnggota'])->middleware('auth');

Route::post('/perguliran/dokumen', [PinjamanKelompokController::class, 'dokumen'])->middleware('auth');

Route::post('/perguliran/kembali_proposal/{id}', [PinjamanKelompokController::class, 'kembaliProposal'])->middleware('auth');

Route::get('/register_proposal_i', [PinjamanIndividuController::class, 'create'])->middleware('auth');
Route::get('/register_proposal_i/{nia}', [PinjamanIndividuController::class, 'register'])->middleware('auth');
Route::get('/register_proposal_i/jaminan/{id}', [PinjamanIndividuController::class, 'Jaminan'])->middleware('auth');
Route::get('/daftar_individu', [PinjamanIndividuController::class, 'DaftarAnggota'])->middleware('auth');

Route::get('/detail_i/{perguliran_i}', [PinjamanIndividuController::class, 'detail'])->middleware('auth');
Route::get('/perguliran_i/proposal', [PinjamanIndividuController::class, 'proposal'])->middleware('auth');
Route::get('/perguliran_i/verified', [PinjamanIndividuController::class, 'verified'])->middleware('auth');
Route::get('/perguliran_i/waiting', [PinjamanIndividuController::class, 'waiting'])->middleware('auth');
Route::get('/perguliran_i/aktif', [PinjamanIndividuController::class, 'aktif'])->middleware('auth');
Route::get('/perguliran_i/lunas', [PinjamanIndividuController::class, 'lunas'])->middleware('auth');
Route::get('/perguliran_i/generate/{id_pinj}', [PinjamanIndividuController::class, 'generate'])->middleware('auth');
Route::get('/lunas_i/{perguliran_i}', [PinjamanIndividuController::class, 'pelunasan'])->middleware('auth');
Route::get('/cetak_keterangan_lunas_i/{perguliran_i}', [PinjamanIndividuController::class, 'keterangan'])->middleware('auth');

Route::get('/perguliran_i/cari_kelompok', [PinjamanIndividuController::class, 'cariKelompok'])->middleware('auth');
Route::post('/perguliran_i/simpan_data/{id}', [PinjamanIndividuController::class, 'simpan'])->middleware('auth');
Route::post('/perguliran_i/rescedule', [PinjamanIndividuController::class, 'rescedule'])->middleware('auth');
Route::post('/perguliran_i/hapus', [PinjamanIndividuController::class, 'hapus'])->middleware('auth');
Route::resource('/perguliran_i', PinjamanIndividuController::class)->middleware('auth');

Route::get('/perguliran_i/dokumen/kartu_angsuran/{id}', [PinjamanIndividuController::class, 'kartuAngsuran'])->middleware('auth');
Route::get('/perguliran_i/dokumen/kartu_angsuran/{id}/{idtp}', [PinjamanIndividuController::class, 'cetakPadaKartu'])->middleware('auth');

Route::get('/perguliran_i/dokumen/kartu_angsuran_anggota/{id}/{nia?}', [PinjamanIndividuController::class, 'kartuAngsuranAnggota'])->middleware('auth');

Route::get('/perguliran_i/dokumen/cetak_kartu_angsuran_anggota/{id}/{idtp}/{nia?}', [PinjamanIndividuController::class, 'cetakKartuAngsuranAnggota'])->middleware('auth');

Route::post('/perguliran_i/dokumen', [PinjamanIndividuController::class, 'dokumen'])->middleware('auth');

Route::post('/perguliran_i/kembali_proposal/{id}', [PinjamanIndividuController::class, 'kembaliProposal'])->middleware('auth');

Route::get('/pinjaman_anggota/register/{id_pinkel}', [PinjamanAnggotaController::class, 'create'])->middleware('auth');
Route::get('/pinjaman_anggota/cari_pemanfaat', [PinjamanAnggotaController::class, 'cariPemanfaat'])->middleware('auth');
Route::get('/hapus_pemanfaat/{id}', [PinjamanAnggotaController::class, 'hapus'])->middleware('auth');

Route::get('/pinjaman_anggota/form_hapus/{pinj}', [PinjamanAnggotaController::class, 'form_penghapusan'])->middleware('auth');

Route::resource('/pinjaman_anggota', PinjamanAnggotaController::class)->middleware('auth');

Route::post('/lunaskan_pemanfaat/{pinjaman}', [PinjamanAnggotaController::class, 'lunaskan'])->middleware('auth');
Route::post('/hapus_pemanfaat/{pinjaman}', [PinjamanAnggotaController::class, 'penghapusan'])->middleware('auth');

Route::get('/transaksi/jurnal_umum', [TransaksiController::class, 'jurnalUmum'])->middleware('auth');
Route::get('/transaksi/jurnal_angsuran', [TransaksiController::class, 'jurnalAngsuran'])->middleware('auth');
Route::get('/transaksi/jurnal_angsuran_individu', [TransaksiController::class, 'jurnalAngsuranIndividu'])->middleware('auth');
Route::get('/transaksi/tutup_buku', [TransaksiController::class, 'jurnalTutupBuku'])->middleware('auth');
Route::get('/trasaksi/saldo/{kode_akun}', [TransaksiController::class, 'saldo'])->middleware('auth');

Route::get('/transaksi/ambil_rekening/{id}', [TransaksiController::class, 'rekening'])->middleware('auth');
Route::get('/transaksi/form_nominal/', [TransaksiController::class, 'form'])->middleware('auth');
Route::get('/transaksi/form_angsuran/{id_pinkel}', [TransaksiController::class, 'formAngsuran'])->middleware('auth');
Route::get('/transaksi/form_angsuran_individu/{id_pinkel}', [TransaksiController::class, 'formAngsuranIndividu'])->middleware('auth');

Route::get('/transaksi/angsuran/target/{id_pinkel}', [TransaksiController::class, 'targetAngsuran'])->middleware('auth');
Route::get('/transaksi/angsuran_individu/target/{id_pinkel}', [TransaksiController::class, 'targetAngsuranIndividu'])->middleware('auth');
Route::post('/transaksi/angsuran_individu', [TransaksiController::class, 'angsuranIndividu']);

Route::get('/transaksi/data/{idt}', [TransaksiController::class, 'data'])->middleware('auth');
Route::get('/transaksi/tutup_buku/saldo_awal/{tahun}', [TransaksiController::class, 'saldoAwal'])->middleware('auth');
Route::post('/transaksi/tutup_buku/saldo', [TransaksiController::class, 'saldoTutupBuku'])->middleware('auth');
Route::post('/transaksi/tutup_buku', [TransaksiController::class, 'simpanTutupBuku'])->middleware('auth');
Route::post('/transaksi/simpan_laba', [TransaksiController::class, 'simpanAlokasiLaba'])->middleware('auth');
Route::post('/transaksi/reversal', [TransaksiController::class, 'reversal'])->middleware('auth');
Route::post('/transaksi/hapus', [TransaksiController::class, 'hapus'])->middleware('auth');

Route::get('/transaksi/angsuran/lpp/{id}', [TransaksiController::class, 'lpp'])->middleware('auth');
Route::get('/transaksi/angsuran_i/lpp/{id}', [TransaksiController::class, 'lppIndividu'])->middleware('auth');

Route::get('/transaksi/angsuran/detail_angsuran/{id}', [TransaksiController::class, 'detailAngsuran'])->middleware('auth');
Route::get('/transaksi/angsuran/detail_angsuran_i/{id}', [TransaksiController::class, 'detailAngsuranIndividu'])->middleware('auth');


Route::get('/transaksi/detail_transaksi/', [TransaksiController::class, 'detailTransaksi'])->middleware('auth');

Route::post('/transaksi/angsuran', [TransaksiController::class, 'angsuran'])->middleware('auth');
Route::post('/transaksi/angsuran/cetak_bkm', [TransaksiController::class, 'cetakBkm'])->middleware('auth');

Route::get('/transaksi/generate_real/{id_pinkel}', [TransaksiController::class, 'generateReal'])->middleware('auth');
Route::get('/transaksi/regenerate_real/{id_pinkel}', [TransaksiController::class, 'realisasi'])->middleware('auth');

Route::get('/transaksi/angsuran/form_anggota/{id_pinkel}', [TransaksiController::class, 'formAnggota'])->middleware('auth');
Route::get('/transaksi/angsuran/form_anggota_i/{id_pinkel}', [TransaksiController::class, 'formAnggotaIndividu'])->middleware('auth');

Route::get('/angsuran/notifikasi/{idtp}', [TransaksiController::class, 'notifikasi'])->middleware('auth');
Route::get('/angsuran/notifikasi_i/{idtp}', [TransaksiController::class, 'notifikasiIndividu'])->middleware('auth');

Route::get('/transaksi/dokumen/kuitansi/{id}', [TransaksiController::class, 'kuitansi'])->middleware('auth');
Route::get('/transaksi/dokumen/kuitansi_thermal/{id}', [TransaksiController::class, 'kuitansi_thermal'])->middleware('auth');
Route::get('/transaksi/dokumen/bkk/{id}', [TransaksiController::class, 'bkk'])->middleware('auth');
Route::get('/transaksi/dokumen/bkm/{id}', [TransaksiController::class, 'bkm'])->middleware('auth');
Route::get('/transaksi/dokumen/bm/{id}', [TransaksiController::class, 'bm'])->middleware('auth');

Route::get('/transaksi/dokumen/struk_individu/{id}', [TransaksiController::class, 'strukIndividu'])->middleware('auth');
Route::get('/transaksi/dokumen/struk_matrix_individu/{id}', [TransaksiController::class, 'strukMatrixIndividu'])->middleware('auth');
Route::get('/transaksi/dokumen/struk_thermal_individu/{id}', [TransaksiController::class, 'strukThermalIndividu'])->middleware('auth');
Route::post('/transaksi/dokumen/cetak', [TransaksiController::class, 'cetak'])->middleware('auth');

Route::get('/transaksi/dokumen/struk/{id}', [TransaksiController::class, 'struk'])->middleware('auth');
Route::get('/transaksi/dokumen/struk_matrix/{id}', [TransaksiController::class, 'strukMatrix'])->middleware('auth');
Route::get('/transaksi/dokumen/struk_thermal/{id}', [TransaksiController::class, 'strukThermal'])->middleware('auth');
Route::get('/transaksi/dokumen/bkm_angsuran/{id}', [TransaksiController::class, 'bkmAngsuran'])->middleware('auth');
Route::get('/transaksi/dokumen/bkk_angsuran/{id}', [TransaksiController::class, 'bkkAngsuran'])->middleware('auth');
Route::post('/transaksi/dokumen/cetak', [TransaksiController::class, 'cetak'])->middleware('auth');

Route::get('/transaksi/ebudgeting', [TransaksiController::class, 'ebudgeting'])->middleware('auth');
Route::post('/transaksi/anggaran', [TransaksiController::class, 'formAnggaran'])->middleware('auth');
Route::post('/transaksi/simpan_anggaran', [TransaksiController::class, 'simpanAnggaran'])->middleware('auth');

Route::resource('/transaksi', TransaksiController::class)->middleware('auth');

Route::resource('/profil', UserController::class);

Route::get('/sync/{lokasi}', [DashboardController::class, 'sync'])->middleware('auth');
Route::get('/link', function () {
    $target = '/home/dbm/public_html/apps/storage/app/public';
    $shortcut = '/home/dbm/public_html/apps/public/storage';
    symlink($target, $shortcut);
});

Route::get('/user', function () {
    $kec = Kecamatan::where('web_kec', request()->getHost())->orwhere('web_alternatif', request()->getHost())->with('kabupaten')->first();
    $users = User::where('lokasi', $kec->id)->with('l', 'j')->orderBy('level', 'ASC')->orderBy('jabatan', 'ASC')->get();

    return view('welcome', ['users' => $users, 'kec' => $kec]);
});

Route::get('/download/{file}', function ($file) {
    return response()->download(storage_path('app/public/docs/' . $file));
})->name('download');

Route::get('/unpaid', [DashboardController::class, 'unpaid'])->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/generate', [GenerateController::class, 'index']);
Route::get('/generate/individu', [GenerateController::class, 'individu']);
Route::get('/generate/kelompok', [GenerateController::class, 'kelompok']);
Route::post('/generate/save/{offset?}', [GenerateController::class, 'generate']);

Route::get('/{invoice}', [PelaporanController::class, 'invoice']);
