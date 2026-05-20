<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Portfolio') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-zinc-950 text-zinc-100">
    <header class="border-b border-white/10 bg-zinc-950/80 backdrop-blur">
        <div class="mx-auto max-w-6xl px-4 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="font-semibold tracking-tight">
                {{ config('app.name', 'Portfolio') }}
            </a>
            <nav class="flex items-center gap-4 text-sm text-zinc-300">
                <a class="hover:text-white" href="#portfolio">Portfolio</a>
                <a class="hover:text-white" href="#experience">Experience</a>
                <a class="hover:text-white" href="#certifications">Certifications</a>
                <a class="hover:text-white" href="#contact">Contact</a>
                @if (config('app.social.github'))
                    <a class="hover:text-white" href="{{ config('app.social.github') }}" target="_blank" rel="noreferrer">GitHub</a>
                @else
                    <span class="text-zinc-500" title="Set SOCIAL_GITHUB_URL in .env">GitHub</span>
                @endif
                @if (config('app.social.linkedin'))
                    <a class="hover:text-white" href="{{ config('app.social.linkedin') }}" target="_blank" rel="noreferrer">LinkedIn</a>
                @else
                    <span class="text-zinc-500" title="Set SOCIAL_LINKEDIN_URL in .env">LinkedIn</span>
                @endif
                <a class="rounded-md bg-white/10 px-3 py-1.5 hover:bg-white/15" href="{{ url('/admin') }}">Admin</a>
            </nav>
        </div>
    </header>

    <main>
        @if (session('status'))
            <div class="mx-auto max-w-6xl px-4 pt-6">
                <div class="rounded-lg border border-emerald-400/20 bg-emerald-500/10 px-4 py-3 text-emerald-200">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mx-auto max-w-6xl px-4 pt-6">
                <div class="rounded-lg border border-rose-400/20 bg-rose-500/10 px-4 py-3 text-rose-200">
                    <div class="font-semibold">Please fix the errors below.</div>
                </div>
            </div>
        @endif

        {{ $slot }}
    </main>

    <footer class="mt-16 border-t border-white/10">
        <div class="mx-auto max-w-6xl px-4 py-10 text-sm text-zinc-400">
            <div>© {{ now()->year }} {{ config('app.name', 'Portfolio') }}.</div>
        </div>
    </footer>
</body>
</html>
