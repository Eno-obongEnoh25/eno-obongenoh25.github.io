<x-layouts.admin>
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Messages</h1>
            <p class="mt-2 text-zinc-300">Incoming messages from the landing page form.</p>
        </div>
    </div>

    <div class="mt-8 overflow-hidden rounded-xl border border-white/10">
        <table class="min-w-full divide-y divide-white/10 bg-white/5 text-sm">
            <thead class="bg-white/5 text-zinc-300">
                <tr>
                    <th class="px-4 py-3 text-left font-medium">Email</th>
                    <th class="px-4 py-3 text-left font-medium">Status</th>
                    <th class="px-4 py-3 text-left font-medium">Received</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
                @forelse ($messages as $message)
                    <tr>
                        <td class="px-4 py-3 text-zinc-100">{{ $message->email }}</td>
                        <td class="px-4 py-3">
                            @if ($message->read_at)
                                <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-2 py-0.5 text-xs text-zinc-300">Read</span>
                            @else
                                <span class="inline-flex items-center rounded-full border border-amber-400/20 bg-amber-500/10 px-2 py-0.5 text-xs text-amber-200">Unread</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-zinc-300">{{ $message->created_at->format('M j, Y g:i A') }}</td>
                        <td class="px-4 py-3 text-right">
                            <a class="rounded-md bg-white/10 px-3 py-1.5 text-xs hover:bg-white/15"
                               href="{{ route('admin.messages.show', $message) }}">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-4 py-8 text-center text-zinc-300" colspan="4">No messages yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $messages->links() }}
    </div>
</x-layouts.admin>
