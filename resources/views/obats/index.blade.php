<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="min-h-screen flex bg-slate-100">
        {{-- Sidebar --}}
        <x-sidebar />

        {{-- Main Content --}}
        <main class="flex-1 p-6 overflow-auto">
            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Data Obat</h1>
                    <p class="text-sm text-slate-500 mt-1">Kelola stok dan informasi obat apotek</p>
                </div>
                <a href="{{ route('obats.create') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-sm font-semibold rounded-xl shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:scale-105 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Obat
                </a>
            </div>

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-4 px-4 py-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Search & Filter --}}
            <div class="mb-6 p-4 bg-white rounded-2xl shadow-sm border border-slate-200/50">
                <form method="GET" action="{{ route('obats.index') }}" class="flex flex-wrap items-center gap-3">
                    <div class="flex-1 min-w-[200px]">
                        <input type="text" name="q" value="{{ request('q') }}"
                               placeholder="Cari nama, kode, atau kategori..."
                               class="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all">
                    </div>
                    <label class="inline-flex items-center gap-2 text-sm text-slate-600 cursor-pointer">
                        <input type="checkbox" name="low_stock" value="1"
                               class="w-4 h-4 rounded border-slate-300 text-emerald-500 focus:ring-emerald-500"
                               {{ request('low_stock') ? 'checked' : '' }}>
                        <span>Stok rendah</span>
                    </label>
                    <button type="submit"
                            class="px-5 py-2.5 bg-slate-800 text-white text-sm font-medium rounded-xl hover:bg-slate-700 transition-colors">
                        Cari
                    </button>
                </form>
            </div>

            {{-- Data Table --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/50 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gradient-to-r from-slate-50 to-slate-100 border-b border-slate-200">
                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Kode</th>
                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Nama Obat</th>
                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Kategori</th>
                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Bentuk</th>
                                <th class="px-4 py-3 text-center font-semibold text-slate-600">Stok</th>
                                <th class="px-4 py-3 text-right font-semibold text-slate-600">Harga Beli</th>
                                <th class="px-4 py-3 text-right font-semibold text-slate-600">Harga Jual</th>
                                <th class="px-4 py-3 text-center font-semibold text-slate-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($obats as $obat)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-4 py-3">
                                        <span class="inline-flex px-2.5 py-1 bg-slate-100 text-slate-700 text-xs font-mono rounded-lg">
                                            {{ $obat->kode }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="font-medium text-slate-800">{{ $obat->nama_obat }}</div>
                                        @if($obat->kandungan)
                                            <div class="text-xs text-slate-400 mt-0.5">{{ Str::limit($obat->kandungan, 30) }}</div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-slate-600">{{ $obat->kategori ?? '-' }}</td>
                                    <td class="px-4 py-3 text-slate-600">{{ $obat->bentuk ?? '-' }}</td>
                                    <td class="px-4 py-3 text-center">
                                        @if($obat->stok < $obat->stok_minimum)
                                            <span class="inline-flex px-2.5 py-1 bg-rose-100 text-rose-700 text-xs font-semibold rounded-full">
                                                {{ $obat->stok }}
                                            </span>
                                        @else
                                            <span class="inline-flex px-2.5 py-1 bg-emerald-100 text-emerald-700 text-xs font-semibold rounded-full">
                                                {{ $obat->stok }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-right text-slate-600">
                                        Rp {{ number_format($obat->harga_beli, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3 text-right font-medium text-slate-800">
                                        Rp {{ number_format($obat->harga_jual, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('obats.edit', $obat) }}"
                                               class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors"
                                               title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('obats.destroy', $obat) }}" method="POST"
                                                  onsubmit="return confirm('Yakin hapus obat ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors"
                                                        title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-12 text-center">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                                </svg>
                                            </div>
                                            <p class="text-slate-500">Belum ada data obat</p>
                                            <a href="{{ route('obats.create') }}" class="text-emerald-600 hover:text-emerald-700 font-medium text-sm">
                                                + Tambah obat pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
