<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="min-h-screen flex bg-slate-100">
        {{-- Sidebar --}}
        <x-sidebar />

        {{-- Main Content --}}
        <main class="flex-1 p-6 overflow-auto">
            {{-- Header --}}
            <div class="mb-6">
                <a href="{{ route('obats.index') }}" class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-slate-700 mb-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Data Obat
                </a>
                <h1 class="text-2xl font-bold text-slate-800">Tambah Obat Baru</h1>
                <p class="text-sm text-slate-500 mt-1">Lengkapi informasi obat untuk ditambahkan ke inventaris</p>
            </div>

            {{-- Form Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/50 p-6 max-w-4xl">
                @if ($errors->any())
                    <div class="mb-6 px-4 py-3 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('obats.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Kode & Nama --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Kode Obat *</label>
                            <input type="text" name="kode" value="{{ old('kode') }}"
                                   class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all"
                                   placeholder="OBT-001" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Nama Obat *</label>
                            <input type="text" name="nama_obat" value="{{ old('nama_obat') }}"
                                   class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all"
                                   placeholder="Paracetamol 500mg" required>
                        </div>
                    </div>

                    {{-- Kategori & Kandungan --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Kategori</label>
                            <input type="text" name="kategori" value="{{ old('kategori') }}"
                                   class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all"
                                   placeholder="Analgesik">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Kandungan / Komposisi</label>
                            <input type="text" name="kandungan" value="{{ old('kandungan') }}"
                                   class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all"
                                   placeholder="Paracetamol 500 mg">
                        </div>
                    </div>

                    {{-- Status aktif --}}
                    <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-xl">
                        <input type="checkbox" name="is_aktif" value="1"
                               class="w-5 h-5 rounded border-slate-300 text-emerald-500 focus:ring-emerald-500"
                               {{ old('is_aktif', 1) ? 'checked' : '' }}>
                        <div>
                            <span class="text-sm font-medium text-slate-700">Obat Aktif</span>
                            <p class="text-xs text-slate-500">Obat dapat dijual ke pelanggan</p>
                        </div>
                    </div>

                    {{-- Bentuk, Satuan, Kadaluarsa --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Bentuk</label>
                            <input type="text" name="bentuk" value="{{ old('bentuk') }}"
                                   class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all"
                                   placeholder="Tablet, Kapsul, Sirup">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Satuan</label>
                            <input type="text" name="satuan" value="{{ old('satuan') }}"
                                   class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all"
                                   placeholder="Strip, Botol, Box">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Tanggal Kadaluarsa</label>
                            <input type="date" name="tanggal_kadaluarsa" value="{{ old('tanggal_kadaluarsa') }}"
                                   class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all">
                        </div>
                    </div>

                    {{-- Stok --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Stok *</label>
                            <input type="number" name="stok" value="{{ old('stok') }}"
                                   class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all"
                                   min="0" placeholder="100" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Stok Minimum *</label>
                            <input type="number" name="stok_minimum" value="{{ old('stok_minimum') }}"
                                   class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all"
                                   min="0" placeholder="10" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Lokasi Rak</label>
                            <input type="text" name="lokasi_rak" value="{{ old('lokasi_rak') }}"
                                   class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all"
                                   placeholder="Rak A1">
                        </div>
                    </div>

                    {{-- Harga --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Harga Beli *</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">Rp</span>
                                <input type="number" name="harga_beli" value="{{ old('harga_beli') }}"
                                       class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all"
                                       min="0" step="100" placeholder="5000" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Harga Jual *</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-400">Rp</span>
                                <input type="number" name="harga_jual" value="{{ old('harga_jual') }}"
                                       class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all"
                                       min="0" step="100" placeholder="7500" required>
                            </div>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <a href="{{ route('obats.index') }}"
                           class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-sm font-semibold rounded-xl shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 transition-all">
                            Simpan Obat
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</x-app-layout>
