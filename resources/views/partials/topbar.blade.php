<header class="app-topbar">
    <div class="flex min-w-0 items-center gap-2">
        <button type="button" class="btn-ghost btn-sm lg:hidden" onclick="toggleSidebar()" aria-label="Menu">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <div class="min-w-0">
            <h1 class="page-title truncate">@yield('page-title', 'Dashboard')</h1>
            @hasSection('page-subtitle')
                <p class="page-subtitle truncate">@yield('page-subtitle')</p>
            @endif
        </div>
    </div>

    <div class="flex shrink-0 items-center gap-2">
        <span class="badge-indigo hidden capitalize sm:inline-flex">{{ auth()->user()->role }}</span>
        <div class="hidden text-right sm:block">
            <p class="text-xs font-medium text-slate-900">{{ auth()->user()->name }}</p>
            <p class="max-w-[140px] truncate text-[10px] text-slate-500">{{ auth()->user()->email }}</p>
        </div>
        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 text-xs font-semibold text-white">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
    </div>
</header>
