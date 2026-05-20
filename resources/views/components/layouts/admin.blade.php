<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin · {{ config('app.name', 'Portfolio') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-zinc-950 text-zinc-100">
    <div class="min-h-screen">
        <header class="border-b border-white/10 bg-zinc-950/80 backdrop-blur">
            <div class="mx-auto max-w-6xl px-4 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.dashboard') }}" class="font-semibold tracking-tight">Admin</a>
                    <a href="{{ route('home') }}" class="text-sm text-zinc-300 hover:text-white">View site</a>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="rounded-md bg-white/10 px-3 py-2 text-sm hover:bg-white/15" type="submit">Logout</button>
                </form>
            </div>
        </header>

        <main class="mx-auto max-w-6xl px-4 py-10">
            @if (session('status'))
                <div class="mb-6 rounded-lg border border-emerald-400/20 bg-emerald-500/10 px-4 py-3 text-emerald-200">
                    {{ session('status') }}
                </div>
            @endif

            <div class="grid gap-6 md:grid-cols-4">
                <aside class="md:col-span-1">
                    <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                        <div class="text-xs uppercase tracking-wide text-zinc-400">Navigation</div>
                        <nav class="mt-3 space-y-1 text-sm">
                            <a class="block rounded-md px-3 py-2 hover:bg-white/10" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            <a class="block rounded-md px-3 py-2 hover:bg-white/10" href="{{ route('admin.certificates.index') }}">Certificates</a>
                            <a class="block rounded-md px-3 py-2 hover:bg-white/10" href="{{ route('admin.messages.index') }}">Messages</a>
                        </nav>
                    </div>
                </aside>

                <section class="md:col-span-3">
                    {{ $slot }}
                </section>
            </div>
        </main>
    </div>
</body>
</html>

