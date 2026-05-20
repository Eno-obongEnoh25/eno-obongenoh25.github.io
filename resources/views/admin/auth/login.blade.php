<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login · {{ config('app.name', 'Portfolio') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-zinc-950 text-zinc-100">
    <div class="mx-auto max-w-md px-4 py-16">
        <a class="text-sm text-zinc-300 hover:text-white" href="{{ route('home') }}">← Back to site</a>

        <h1 class="mt-6 text-3xl font-semibold tracking-tight">Admin Login</h1>
        <p class="mt-2 text-sm text-zinc-300">Sign in to manage certificates and view messages.</p>

        <form method="POST" action="{{ route('admin.login.store') }}" class="mt-8 rounded-2xl border border-white/10 bg-white/5 p-6">
            @csrf
            <div class="grid gap-4">
                <div>
                    <label class="text-sm text-zinc-300" for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                           class="mt-2 w-full rounded-lg border border-white/10 bg-zinc-950/40 px-3 py-2 text-white focus:border-white/20 focus:outline-none"
                           required autofocus>
                    @error('email')
                        <div class="mt-2 text-sm text-rose-300">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="text-sm text-zinc-300" for="password">Password</label>
                    <input id="password" name="password" type="password"
                           class="mt-2 w-full rounded-lg border border-white/10 bg-zinc-950/40 px-3 py-2 text-white focus:border-white/20 focus:outline-none"
                           required>
                    @error('password')
                        <div class="mt-2 text-sm text-rose-300">{{ $message }}</div>
                    @enderror
                </div>

                <label class="flex items-center gap-2 text-sm text-zinc-300">
                    <input type="checkbox" name="remember" class="rounded border-white/10 bg-zinc-950/40">
                    Remember me
                </label>

                <button type="submit" class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-zinc-950 hover:bg-zinc-200">
                    Sign in
                </button>
            </div>
        </form>

        <div class="mt-6 text-xs text-zinc-400">
            Admin user is created by `php artisan db:seed` using `.env` keys: `ADMIN_EMAIL`, `ADMIN_PASSWORD`, `ADMIN_NAME`.
        </div>
    </div>
</body>
</html>

