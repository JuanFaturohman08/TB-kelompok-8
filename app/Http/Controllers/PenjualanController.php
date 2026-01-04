<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Penjualan;
use App\Models\PenjualanItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Penjualan::with(['user', 'items.obat'])->orderByDesc('tanggal');

        // Filter berdasarkan tanggal
        if ($request->filled('from')) {
            $query->whereDate('tanggal', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('tanggal', '<=', $request->to);
        }

        $penjualans = $query->get();

        return view('penjualans.index', compact('penjualans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penjualans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.obat_id' => 'nullable|exists:obats,id',
            'items.*.jumlah' => 'nullable|integer|min:1',
            'catatan' => 'nullable|string|max:255',
        ]);

        // Filter item yang valid (obat_id dan jumlah terisi)
        $validItems = collect($request->items)->filter(function ($item) {
            return !empty($item['obat_id']) && !empty($item['jumlah']);
        });

        if ($validItems->isEmpty()) {
            return back()->withErrors(['items' => 'Minimal pilih satu obat dengan jumlah valid.'])
                ->withInput();
        }

        DB::beginTransaction();
        try {
            $total = 0;
            $itemsData = [];

            foreach ($validItems as $item) {
                $obat = Obat::findOrFail($item['obat_id']);

                // Validasi kadaluarsa
                if ($obat->tanggal_kadaluarsa && $obat->tanggal_kadaluarsa <= now()) {
                    throw new \Exception("Obat {$obat->nama_obat} sudah kadaluarsa dan tidak dapat dijual.");
                }

                // Validasi stok
                if ($obat->stok < $item['jumlah']) {
                    throw new \Exception("Stok {$obat->nama_obat} tidak mencukupi. Tersisa: {$obat->stok}");
                }

                $hargaSatuan = $obat->harga_jual;
                $subtotal = $hargaSatuan * $item['jumlah'];
                $total += $subtotal;

                $itemsData[] = [
                    'obat_id' => $obat->id,
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $hargaSatuan,
                    'subtotal' => $subtotal,
                ];

                // Kurangi stok
                $obat->decrement('stok', $item['jumlah']);
            }

            // Buat penjualan
            $penjualan = Penjualan::create([
                'tanggal' => now(),
                'user_id' => auth()->id(),
                'total' => $total,
                'catatan' => $request->catatan,
            ]);

            // Simpan item penjualan
            foreach ($itemsData as $data) {
                $penjualan->items()->create($data);
            }

            DB::commit();

            return redirect()->route('penjualans.index')
                ->with('success', 'Transaksi penjualan berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['items' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        $penjualan->load(['items.obat', 'user']);
        return view('penjualans.show', compact('penjualan'));
    }

    /**
     * Show invoice for a penjualan.
     */
    public function invoice(Penjualan $penjualan)
    {
        $penjualan->load(['items.obat', 'user']);
        return view('penjualans.invoice', compact('penjualan'));
    }

    /**
     * Display sales report.
     */
    public function report(Request $request)
    {
        $from = $request->from ?? now()->startOfMonth()->format('Y-m-d');
        $to = $request->to ?? now()->format('Y-m-d');

        // Total penjualan
        $totalPenjualan = Penjualan::whereDate('tanggal', '>=', $from)
            ->whereDate('tanggal', '<=', $to)
            ->sum('total');

        // Jumlah transaksi
        $jumlahTransaksi = Penjualan::whereDate('tanggal', '>=', $from)
            ->whereDate('tanggal', '<=', $to)
            ->count();

        // Item terjual per obat
        $itemTerjual = DB::table('penjualan_items')
            ->join('penjualans', 'penjualan_items.penjualan_id', '=', 'penjualans.id')
            ->join('obats', 'penjualan_items.obat_id', '=', 'obats.id')
            ->whereDate('penjualans.tanggal', '>=', $from)
            ->whereDate('penjualans.tanggal', '<=', $to)
            ->select(
                'obats.kode',
                'obats.nama_obat',
                DB::raw('SUM(penjualan_items.jumlah) as total_jumlah'),
                DB::raw('SUM(penjualan_items.subtotal) as total_pendapatan')
            )
            ->groupBy('obats.id', 'obats.kode', 'obats.nama_obat')
            ->orderByDesc('total_jumlah')
            ->get();

        // Penjualan per hari
        $penjualanPerHari = Penjualan::whereDate('tanggal', '>=', $from)
            ->whereDate('tanggal', '<=', $to)
            ->selectRaw('DATE(tanggal) as tanggal, SUM(total) as total, COUNT(*) as jumlah_transaksi')
            ->groupByRaw('DATE(tanggal)')
            ->orderBy('tanggal')
            ->get();

        return view('penjualans.report', compact(
            'from',
            'to',
            'totalPenjualan',
            'jumlahTransaksi',
            'itemTerjual',
            'penjualanPerHari'
        ));
    }
}

