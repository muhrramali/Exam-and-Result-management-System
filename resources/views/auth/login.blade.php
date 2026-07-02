<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in — School ERP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100">
    <div class="flex min-h-screen">
        {{-- Brand panel --}}
        <div class="hidden w-1/2 flex-col justify-between bg-gradient-to-br from-indigo-700 via-indigo-600 to-indigo-800 p-10 text-white lg:flex">
            <div>
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/20 text-sm font-bold">ERP</div>
                <h1 class="mt-8 text-2xl font-semibold leading-tight">Exam & Result<br>Management System</h1>
                <p class="mt-3 max-w-sm text-sm text-indigo-100">Schedule exams, enter marks, publish results, and manage re-check requests with full audit trail.</p>
            </div>
            <p class="text-xs text-indigo-200">© {{ date('Y') }} Exam & Result Management</p>
        </div>

        {{-- Form panel --}}
        <div class="flex w-full flex-col justify-center px-6 py-10 lg:w-1/2 lg:px-16">
            <div class="mx-auto w-full max-w-sm">
                <div class="mb-6 lg:hidden">
                    <div class="mb-3 flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-600 text-xs font-bold text-white">ERP</div>
                    <h2 class="text-lg font-semibold text-slate-900">Sign in to your account</h2>
                </div>
                <div class="mb-6 hidden lg:block">
                    <h2 class="text-lg font-semibold text-slate-900">Welcome back</h2>
                    <p class="text-sm text-slate-500">Enter your credentials to continue</p>
                </div>

                @if ($errors->has('login'))
                    <div class="alert-error mb-4">{{ $errors->first('login') }}</div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" class="card card-body space-y-4">
                    @csrf
                    <div>
                        <label class="label" for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="input" required autofocus>
                    </div>
                    <div>
                        <label class="label" for="password">Password</label>
                        <input id="password" type="password" name="password" class="input" required>
                    </div>
                    <button type="submit" class="btn-primary w-full">Sign in</button>
                </form>

                <!-- <div class="mt-5 rounded-lg border border-slate-200 bg-white p-3 text-xs text-slate-600">
                    <p class="mb-1.5 font-semibold text-slate-800">Demo accounts</p>
                    <p><span class="text-slate-500">Admin:</span> admin@school.com / password</p>
                    <p><span class="text-slate-500">Student:</span> student@school.com / password</p>
                </div> -->
            </div>
        </div>
    </div>
</body>
</html>
