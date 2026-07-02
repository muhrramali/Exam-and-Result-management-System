<div {{ $attributes->merge(['class' => 'bg-white rounded-xl border border-slate-200 shadow-sm']) }}>
    @if (isset($title))
        <div class="px-6 py-4 border-b border-slate-100">
            <h2 class="text-lg font-semibold text-slate-900">{{ $title }}</h2>
            @if (isset($subtitle))
                <p class="text-sm text-slate-500 mt-0.5">{{ $subtitle }}</p>
            @endif
        </div>
    @endif
    <div class="p-6">{{ $slot }}</div>
</div>
