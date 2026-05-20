<x-layouts.admin>
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Dashboard</h1>
            <p class="mt-2 text-zinc-300">Manage certificates and review incoming messages.</p>
        </div>
    </div>

    <div class="mt-8 grid gap-4 sm:grid-cols-2">
        <div class="rounded-xl border border-white/10 bg-white/5 p-5">
            <div class="text-sm text-zinc-300">Certificates</div>
            <div class="mt-2 text-3xl font-semibold">{{ $certificateCount }}</div>
            <a class="mt-4 inline-flex rounded-md bg-white/10 px-3 py-2 text-sm hover:bg-white/15" href="{{ route('admin.certificates.index') }}">
                Manage certificates
            </a>
        </div>

        <div class="rounded-xl border border-white/10 bg-white/5 p-5">
            <div class="text-sm text-zinc-300">Messages</div>
            <div class="mt-2 text-3xl font-semibold">{{ $messageCount }}</div>
            <a class="mt-4 inline-flex rounded-md bg-white/10 px-3 py-2 text-sm hover:bg-white/15" href="{{ route('admin.messages.index') }}">
                View messages
            </a>
        </div>
    </div>
</x-layouts.admin>

