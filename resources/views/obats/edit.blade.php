<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Obat') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 text-sm text-gray-900">

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 text-red-800 px-4 py-2 rounded">
                        <ul class="list-disc list-inside text-xs">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('obats.update', $obat) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    {{-- Kode & Barcode --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold mb-1">Kode Obat</label>
                            <input type="text" name="kode" value="{{ old('kode', $obat->kode) }}"
                                   class="w-full border rounded px-3 py-2 text-sm"
                                   required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1">Barcode / Kode Scan</label>
                            <input type="text" name="barcode" value="{{ old('barcode', $obat->barcode) }}"
                                   class="w-full border rounded px-3 py-2 text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold mb-1">Nama Obat</label>
                        <input type="text" name="nama_obat" value="{{ old('nama_obat', $obat->nama_obat) }}"
                               class="w-full border rounded px-3 py-2 text-sm"
                               required>
                    </div>

                    {{-- Kandungan, Kategori, Produsen, Status --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-1">
                            <label class="block text-xs font-semibold mb-1">Kategori</label>
                            <input type="text" name="kategori" value="{{ old('kategori', $obat->kategori) }}"
                                   class="w-full border rounded px-3 py-2 text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold mb-1">Kandungan / Komposisi</label>
                            <input type="text" name="kandungan" value="{{ old('kandungan', $obat->kandungan) }}"
                                   class="w-full border rounded px-3 py-2 text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold mb-1">Produsen</label>
                            <input type="text" name="produsen" value="{{ old('produsen', $obat->produsen) }}"
                                   class="w-full border rounded px-3 py-2 text-sm">
                        </div>
                        <div class="flex items-center gap-2 pt-5 md:pt-7">
                            <input type="checkbox" name="is_aktif" value="1"
                                   {{ old('is_aktif', $obat->is_aktif) ? 'checked' : '' }}>
                            <span class="text-xs">Obat aktif (dapat dijual)</span>
                        </div>
                    </div>

                    {{-- Bentuk, Satuan, Tanggal Kadaluarsa --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold mb-1">Bentuk</label>
                            <input type="text" name="bentuk" value="{{ old('bentuk', $obat->bentuk) }}"
                                   class="w-full border rounded px-3 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1">Satuan</label>
                            <input type="text" name="satuan" value="{{ old('satuan', $obat->satuan) }}"
                                   class="w-full border rounded px-3 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1">Tanggal Kadaluarsa</label>
                            <input type="date" name="tanggal_kadaluarsa"
                                   value="{{ old('tanggal_kadaluarsa', optional($obat->tanggal_kadaluarsa)->format('Y-m-d')) }}"
                                   class="w-full border rounded px-3 py-2 text-sm">
                        </div>
                    </div>

                    {{-- Stok, Stok Minimum, Lokasi Rak --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold mb-1">Stok</label>
                            <input type="number" name="stok" value="{{ old('stok', $obat->stok) }}"
                                   class="w-full border rounded px-3 py-2 text-sm"
                                   min="0" required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1">Stok Minimum</label>
                            <input type="number" name="stok_minimum" value="{{ old('stok_minimum', $obat->stok_minimum) }}"
                                   class="w-full border rounded px-3 py-2 text-sm"
                                   min="0" required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1">Lokasi Rak / Lemari</label>
                            <input type="text" name="lokasi_rak" value="{{ old('lokasi_rak', $obat->lokasi_rak) }}"
                                   class="w-full border rounded px-3 py-2 text-sm">
                        </div>
                    </div>

                    {{-- Harga beli & jual --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold mb-1">Harga Beli</label>
                            <input type="number" step="0.01" name="harga_beli"
                                   value="{{ old('harga_beli', $obat->harga_beli) }}"
                                   class="w-full border rounded px-3 py-2 text-sm"
                                   min="0" required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold mb-1">Harga Jual</label>
                            <input type="number" step="0.01" name="harga_jual"
                                   value="{{ old('harga_jual', $obat->harga_jual) }}"
                                   class="w-full border rounded px-3 py-2 text-sm"
                                   min="0" required>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('obats.index') }}"
                           class="px-4 py-2 border rounded text-xs">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded text-xs hover:bg-blue-700">
                            Update
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
