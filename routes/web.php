<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Penjualan;
use App\Models\Obat;
use Illuminate\Support\Facades\DB;

// ROUTE TES UNTUK CEK LARAVEL
Route::get('/cek', function () {
    return 'TES LARAVEL';
});

Route::get('/', function () {
    return view('welcome');
});

// DASHBOARD
Route::get('/dashboard', function () {
    $today = now()->toDateString();
    $month = now()->month;
    $year = now()->year;

    $totalHariIni = Penjualan::whereDate('tanggal', $today)->sum('total');

    $totalBulanIni = Penjualan::whereYear('tanggal', $year)
        ->whereMonth('tanggal', $month)
        ->sum('total');

    $jumlahTransaksi = Penjualan::count();

    $obatTerlaris = DB::table('penjualan_items')
        ->join('obats', 'penjualan_items.obat_id', '=', 'obats.id')
        ->select('obats.nama_obat', DB::raw('SUM(penjualan_items.jumlah) as total_jumlah'))
        ->groupBy('penjualan_items.obat_id', 'obats.nama_obat')
        ->orderByDesc('total_jumlah')
        ->limit(5)
        ->get();

    $obatHampirHabis = Obat::whereColumn('stok', '<', 'stok_minimum')
        ->orderBy('stok')
        ->limit(5)
        ->get();

    $totalStokRendah = $obatHampirHabis->count();

    return view('dashboard', compact(
        'totalHariIni',
        'totalBulanIni',
        'jumlahTransaksi',
        'obatTerlaris',
        'obatHampirHabis',
        'totalStokRendah'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

// ROUTE USER LOGIN (PROFILE)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ROUTE OBAT + PENJUALAN + USER (hanya butuh login)
Route::middleware(['auth'])->group(function () {

    // PENCARIAN OBAT CEPAT (AJAX SELECT2) - harus sebelum resource
    Route::get('/obats/search', function (Request $request) {
        $term = $request->get('q');

        $obats = Obat::query()
            ->select('id', 'nama_obat', 'stok', 'harga_jual')
            ->when($term, function ($q) use ($term) {
                $q->where('nama_obat', 'like', "%{$term}%")
                    ->orWhere('kode', 'like', "%{$term}%");
            })
            ->orderBy('nama_obat')
            ->limit(20)
            ->get();

        return response()->json($obats);
    })->name('obats.search');

    // Manajemen stok (ADMIN) - harus sebelum resource
    Route::middleware('admin')->group(function () {
        Route::get('/obats/stock', [ObatController::class, 'stock'])
            ->name('obats.stock');

        Route::resource('users', UserController::class)
            ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    });

    // OBAT resource - setelah routes spesifik
    Route::resource('obats', ObatController::class);

    // PENJUALAN
    Route::get('penjualans/report', [PenjualanController::class, 'report'])
        ->name('penjualans.report');

    Route::resource('penjualans', PenjualanController::class)
        ->only(['index', 'create', 'store']);

    Route::get('penjualans/{penjualan}/invoice', [PenjualanController::class, 'invoice'])
        ->name('penjualans.invoice');
});

require __DIR__ . '/auth.php';
