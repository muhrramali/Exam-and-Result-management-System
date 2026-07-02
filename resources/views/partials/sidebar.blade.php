@php
    $role = auth()->user()->role;
    $nav = match ($role) {
        'admin' => [
            ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'home'],
            ['label' => 'Exams', 'route' => 'admin.exams.index', 'icon' => 'calendar'],
            ['label' => 'Results', 'route' => 'admin.results.index', 'icon' => 'clipboard'],
            ['label' => 'Re-check', 'route' => 'admin.recheck.index', 'icon' => 'link'],
            ['label' => 'Grading scales', 'route' => 'admin.grading-scales.index', 'icon' => 'academic'],
            ['label' => 'Students', 'route' => 'admin.students.index', 'icon' => 'users'],
            ['label' => 'Classes', 'route' => 'admin.classes.index', 'icon' => 'building'],
            ['label' => 'Sections', 'route' => 'admin.sections.index', 'icon' => 'grid'],
            ['label' => 'Subjects', 'route' => 'admin.subjects.index', 'icon' => 'academic'],
            ['label' => 'Class subjects', 'route' => 'admin.class-subjects.index', 'icon' => 'link'],
            ['label' => 'Assign sections', 'route' => 'admin.assignments.students', 'icon' => 'clipboard'],
            ['label' => 'Class report', 'route' => 'admin.reports.class-summary', 'icon' => 'grid'],
            ['label' => 'Audit trail', 'route' => 'admin.audit.index', 'icon' => 'calendar'],
        ],
        'student' => [
            ['label' => 'Dashboard', 'route' => 'student.dashboard', 'icon' => 'home'],
            ['label' => 'My results', 'route' => 'student.results.index', 'icon' => 'clipboard'],
            ['label' => 'Re-check', 'route' => 'student.recheck.index', 'icon' => 'link'],
        ],
        default => [],
    };
@endphp

<aside id="sidebar" class="app-sidebar -translate-x-full lg:translate-x-0">
    <div class="app-sidebar-brand">
        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-500 text-xs font-bold">ER</div>
        <div class="min-w-0">
            <p class="truncate text-sm font-semibold leading-tight">Exam & Results</p>
            <p class="text-[10px] capitalize text-slate-400">{{ $role }}</p>
        </div>
    </div>

    <nav class="app-sidebar-nav">
        @foreach ($nav as $item)
            @php
                $active = request()->routeIs($item['route'])
                    || request()->routeIs(preg_replace('/\.index$/', '.*', $item['route']));
            @endphp
            <a href="{{ route($item['route']) }}"
               class="app-nav-link {{ $active ? 'app-nav-link-active' : '' }}">
                @include('partials.icons.' . $item['icon'])
                <span class="truncate">{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <div class="border-t border-white/10 p-2">
        <button type="button" onclick="document.getElementById('logout-form').submit()"
                class="app-nav-link w-full text-red-300 hover:bg-red-500/20 hover:text-red-200">
            @include('partials.icons.logout')
            Logout
        </button>
    </div>
</aside>
