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
                    <h1 class="text-2xl font-bold text-slate-800">Manajemen Stok</h1>
                    <p class="text-sm text-slate-500 mt-1">Pantau stok obat dan identifikasi yang hampir habis</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-slate-500">Total item</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $obats->count() }}</p>
                </div>
            </div>

            {{-- Summary Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                @php
                    $stokRendah = $obats->filter(fn($o) => $o->stok < $o->stok_minimum)->count();
                    $stokAman = $obats->filter(fn($o) => $o->stok >= $o->stok_minimum)->count();
                    $stokKosong = $obats->filter(fn($o) => $o->stok == 0)->count();
                @endphp

                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200/50">
                    <div class="flex items-center gap-4">
                        <div
                            class="h-12 w-12 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-medium">Stok Aman</p>
                            <p class="text-2xl font-bold text-emerald-600">{{ $stokAman }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200/50">
                    <div class="flex items-center gap-4">
                        <div
                            class="h-12 w-12 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center shadow-lg shadow-amber-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-medium">Stok Rendah</p>
                            <p class="text-2xl font-bold text-amber-600">{{ $stokRendah }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200/50">
                    <div class="flex items-center gap-4">
                        <div
                            class="h-12 w-12 rounded-xl bg-gradient-to-br from-rose-500 to-red-500 flex items-center justify-center shadow-lg shadow-rose-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-medium">Stok Habis</p>
                            <p class="text-2xl font-bold text-rose-600">{{ $stokKosong }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Data Table --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/50 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gradient-to-r from-slate-50 to-slate-100 border-b border-slate-200">
                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Kode</th>
                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Nama Obat</th>
                                <th class="px-4 py-3 text-center font-semibold text-slate-600">Stok</th>
                                <th class="px-4 py-3 text-center font-semibold text-slate-600">Minimum</th>
                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Lokasi Rak</th>
                                <th class="px-4 py-3 text-center font-semibold text-slate-600">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($obats as $obat)
                                <tr
                                    class="hover:bg-slate-50/50 transition-colors {{ $obat->stok < $obat->stok_minimum ? 'bg-rose-50/30' : '' }}">
                                    <td class="px-4 py-3">
                                        <span
                                            class="inline-flex px-2.5 py-1 bg-slate-100 text-slate-700 text-xs font-mono rounded-lg">
                                            {{ $obat->kode }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 font-medium text-slate-800">{{ $obat->nama_obat }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span
                                            class="text-lg font-bold {{ $obat->stok < $obat->stok_minimum ? 'text-rose-600' : 'text-slate-800' }}">
                                            {{ $obat->stok }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center text-slate-500">{{ $obat->stok_minimum }}</td>
                                    <td class="px-4 py-3 text-slate-600">{{ $obat->lokasi_rak ?? '-' }}</td>
                                    <td class="px-4 py-3 text-center">
                                        @if($obat->stok == 0)
                                            <span
                                                class="inline-flex items-center gap-1 px-2.5 py-1 bg-rose-100 text-rose-700 text-xs font-semibold rounded-full">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Habis
                                            </span>
                                        @elseif($obat->stok < $obat->stok_minimum)
                                            <span
                                                class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-100 text-amber-700 text-xs font-semibold rounded-full">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Rendah
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-100 text-emerald-700 text-xs font-semibold rounded-full">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Aman
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-12 text-center">
                                        <div class="flex flex-col items-center gap-3">
                                            <div
                                                class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                </svg>
                                            </div>
                                            <p class="text-slate-500">Belum ada data obat</p>
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