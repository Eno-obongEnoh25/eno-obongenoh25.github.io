<x-layouts.admin>
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Message</h1>
            <p class="mt-2 text-zinc-300">From {{ $message->email }} · {{ $message->created_at->toDayDateTimeString() }}</p>
        </div>
        <div class="flex items-center gap-2">
            @if ($message->read_at)
                <form method="POST" action="{{ route('admin.messages.unread', $message) }}">
                    @csrf
                    <button class="rounded-md bg-white/10 px-3 py-2 text-sm hover:bg-white/15" type="submit">
                        Mark unread
                    </button>
                </form>
            @else
                <form method="POST" action="{{ route('admin.messages.read', $message) }}">
                    @csrf
                    <button class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-zinc-950 hover:bg-zinc-200" type="submit">
                        Mark read
                    </button>
                </form>
            @endif

            <a class="rounded-md bg-white/10 px-3 py-2 text-sm hover:bg-white/15" href="{{ route('admin.messages.index') }}">
                Back
            </a>
        </div>
    </div>

    <div class="mt-8 rounded-2xl border border-white/10 bg-white/5 p-6">
        <div class="whitespace-pre-wrap text-zinc-100 leading-relaxed">{{ $message->message }}</div>
    </div>
</x-layouts.admin>
