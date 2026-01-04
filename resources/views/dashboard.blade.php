<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="min-h-screen flex bg-slate-100">
        {{-- Sidebar --}}
        <x-sidebar />

        {{-- Main Content --}}
        <main class="flex-1 p-6 overflow-auto space-y-6">
            {{-- Header --}}
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Dashboard</h1>
                    <p class="text-sm text-slate-500 mt-1">{{ now()->format('l, d F Y') }}</p>
                </div>
            </div>

            {{-- Welcome Banner --}}
            <section
                class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 text-white p-6 shadow-xl shadow-emerald-500/20">
                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/2 blur-2xl">
                </div>

                <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-white/80">
                            Selamat datang kembali,
                        </p>
                        <h2 class="mt-1 text-xl md:text-2xl font-bold">
                            {{ auth()->user()->name }}! 👋
                        </h2>
                        <p class="mt-2 text-sm text-white/80 max-w-md">
                            Pantau aktivitas apotek, stok obat, dan transaksi harian untuk pelayanan pasien yang
                            optimal.
                        </p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('penjualans.create') }}"
                            class="inline-flex items-center gap-2 px-4 py-2.5 bg-white text-emerald-600 text-sm font-semibold rounded-xl hover:bg-white/90 transition-colors shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Transaksi Baru
                        </a>
                    </div>
                </div>
            </section>

            {{-- Stats Cards --}}
            <section class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div
                    class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200/50 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4">
                        <div
                            class="h-12 w-12 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-medium">Penjualan Hari Ini</p>
                            <p class="text-2xl font-bold text-slate-800 mt-1">
                                Rp {{ number_format($totalHariIni, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200/50 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4">
                        <div
                            class="h-12 w-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center shadow-lg shadow-indigo-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-medium">Penjualan Bulan Ini</p>
                            <p class="text-2xl font-bold text-slate-800 mt-1">
                                Rp {{ number_format($totalBulanIni, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200/50 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4">
                        <div
                            class="h-12 w-12 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center shadow-lg shadow-amber-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-medium">Total Transaksi</p>
                            <p class="text-2xl font-bold text-slate-800 mt-1">
                                {{ $jumlahTransaksi }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Two Column Section --}}
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                {{-- Top Selling --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/50 overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <div class="h-8 w-8 rounded-lg bg-emerald-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-slate-800">Obat Terlaris</h3>
                        </div>
                    </div>
                    <div class="p-5">
                        @forelse ($obatTerlaris as $index => $row)
                            <div
                                class="flex items-center gap-3 {{ $index > 0 ? 'mt-3 pt-3 border-t border-slate-100' : '' }}">
                                <span
                                    class="h-7 w-7 rounded-full bg-slate-100 text-slate-600 text-xs font-semibold flex items-center justify-center">
                                    {{ $index + 1 }}
                                </span>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-slate-800 truncate">{{ $row->nama_obat }}</p>
                                </div>
                                <span
                                    class="px-2.5 py-1 bg-emerald-100 text-emerald-700 text-xs font-semibold rounded-full">
                                    {{ $row->total_jumlah }} terjual
                                </span>
                            </div>
                        @empty
                            <p class="text-sm text-slate-400 text-center py-4">Belum ada data penjualan</p>
                        @endforelse
                    </div>
                </div>

                {{-- Low Stock --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200/50 overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="h-8 w-8 rounded-lg bg-rose-100 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-slate-800">Obat Hampir Habis</h3>
                            </div>
                            @isset($totalStokRendah)
                                <span class="px-2.5 py-1 bg-rose-100 text-rose-700 text-xs font-semibold rounded-full">
                                    {{ $totalStokRendah }} item
                                </span>
                            @endisset
                        </div>
                    </div>
                    <div class="p-5 space-y-3">
                        @forelse($obatHampirHabis as $obat)
                            <div
                                class="flex items-center justify-between p-3 rounded-xl bg-rose-50/50 border border-rose-100">
                                <div>
                                    <p class="text-sm font-medium text-slate-800">{{ $obat->nama_obat }}</p>
                                    <p class="text-xs text-slate-500">Min: {{ $obat->stok_minimum }}</p>
                                </div>
                                <span class="px-3 py-1.5 bg-rose-500 text-white text-xs font-bold rounded-lg shadow-sm">
                                    {{ $obat->stok }} stok
                                </span>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <div
                                    class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 mb-2">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <p class="text-sm text-slate-500">Semua stok obat aman!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>
        </main>
    </div>
</x-app-layout>