@props(['active' => null])

<aside class="w-64 bg-gradient-to-b from-slate-800 via-slate-900 to-slate-950 text-slate-100 flex flex-col shadow-xl">
    {{-- Logo Section --}}
    <div class="px-5 py-5 border-b border-slate-700/50">
        <div class="flex items-center gap-3">
            <div
                class="h-10 w-10 rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                <span class="text-white font-bold text-lg">A8</span>
            </div>
            <div>
                <p class="text-sm font-semibold text-white">Apotek Kelompok 8</p>
                <p class="text-[10px] text-slate-400">Sistem Manajemen Apotek</p>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto py-4 space-y-1">
        {{-- Main Menu --}}
        <p class="px-5 mb-2 text-[10px] font-semibold tracking-widest uppercase text-slate-500">
            Menu Utama
        </p>

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}" class="group flex items-center gap-3 mx-3 px-3 py-2.5 rounded-xl text-sm transition-all duration-200
                  {{ request()->routeIs('dashboard')
    ? 'bg-gradient-to-r from-emerald-500/20 to-teal-500/20 text-emerald-400 shadow-lg shadow-emerald-500/10 border border-emerald-500/20'
    : 'text-slate-300 hover:bg-slate-800/50 hover:text-white' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-emerald-400' : 'text-slate-500 group-hover:text-emerald-400' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>

        {{-- Transaksi Penjualan --}}
        <a href="{{ route('penjualans.index') }}" class="group flex items-center gap-3 mx-3 px-3 py-2.5 rounded-xl text-sm transition-all duration-200
                  {{ request()->routeIs('penjualans.*')
    ? 'bg-gradient-to-r from-emerald-500/20 to-teal-500/20 text-emerald-400 shadow-lg shadow-emerald-500/10 border border-emerald-500/20'
    : 'text-slate-300 hover:bg-slate-800/50 hover:text-white' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('penjualans.*') ? 'text-emerald-400' : 'text-slate-500 group-hover:text-emerald-400' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
            </svg>
            <span class="font-medium">Penjualan</span>
        </a>

        @auth
            @if(auth()->user()->is_admin)
                {{-- Admin Section --}}
                <p class="px-5 mt-6 mb-2 text-[10px] font-semibold tracking-widest uppercase text-slate-500">
                    Admin
                </p>

                {{-- Data Obat --}}
                <a href="{{ route('obats.index') }}" class="group flex items-center gap-3 mx-3 px-3 py-2.5 rounded-xl text-sm transition-all duration-200
                                  {{ request()->routeIs('obats.index') || request()->routeIs('obats.create') || request()->routeIs('obats.edit')
                    ? 'bg-gradient-to-r from-emerald-500/20 to-teal-500/20 text-emerald-400 shadow-lg shadow-emerald-500/10 border border-emerald-500/20'
                    : 'text-slate-300 hover:bg-slate-800/50 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('obats.index') ? 'text-emerald-400' : 'text-slate-500 group-hover:text-emerald-400' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                    <span class="font-medium">Data Obat</span>
                </a>

                {{-- Manajemen Stok --}}
                <a href="{{ route('obats.stock') }}" class="group flex items-center gap-3 mx-3 px-3 py-2.5 rounded-xl text-sm transition-all duration-200
                                  {{ request()->routeIs('obats.stock')
                    ? 'bg-gradient-to-r from-emerald-500/20 to-teal-500/20 text-emerald-400 shadow-lg shadow-emerald-500/10 border border-emerald-500/20'
                    : 'text-slate-300 hover:bg-slate-800/50 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('obats.stock') ? 'text-emerald-400' : 'text-slate-500 group-hover:text-emerald-400' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span class="font-medium">Manajemen Stok</span>
                </a>

                {{-- Kelola User --}}
                <a href="{{ route('users.index') }}" class="group flex items-center gap-3 mx-3 px-3 py-2.5 rounded-xl text-sm transition-all duration-200
                                  {{ request()->routeIs('users.*')
                    ? 'bg-gradient-to-r from-emerald-500/20 to-teal-500/20 text-emerald-400 shadow-lg shadow-emerald-500/10 border border-emerald-500/20'
                    : 'text-slate-300 hover:bg-slate-800/50 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('users.*') ? 'text-emerald-400' : 'text-slate-500 group-hover:text-emerald-400' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="font-medium">Kelola User</span>
                </a>
            @endif
        @endauth
    </nav>

    {{-- User Profile Section --}}
    <div class="px-4 py-4 border-t border-slate-700/50 bg-slate-900/50">
        <div class="flex items-center gap-3">
            <div
                class="h-9 w-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-semibold text-sm shadow-lg">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name ?? 'User' }}</p>
                <p class="text-[10px] text-slate-400">{{ auth()->user()->is_admin ? 'Administrator' : 'Staff' }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="p-2 rounded-lg text-slate-400 hover:text-rose-400 hover:bg-slate-800 transition-colors"
                    title="Logout">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>