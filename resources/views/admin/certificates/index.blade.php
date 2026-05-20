<x-layouts.admin>
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Certificates</h1>
            <p class="mt-2 text-zinc-300">Add certificates shown on the landing page.</p>
        </div>
    </div>

    <div class="mt-6 rounded-2xl border border-white/10 bg-white/5 p-6">
        <h2 class="font-semibold">Add new</h2>
        <form method="POST" action="{{ route('admin.certificates.store') }}" enctype="multipart/form-data" class="mt-4 grid gap-4 sm:grid-cols-2">
            @csrf
            <div class="sm:col-span-2">
                <label class="text-sm text-zinc-300" for="title">Title</label>
                <input id="title" name="title" type="text" value="{{ old('title') }}"
                       class="mt-2 w-full rounded-lg border border-white/10 bg-zinc-950/40 px-3 py-2 text-white focus:border-white/20 focus:outline-none"
                       required>
                @error('title')
                    <div class="mt-2 text-sm text-rose-300">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="text-sm text-zinc-300" for="issuer">Issuer</label>
                <input id="issuer" name="issuer" type="text" value="{{ old('issuer') }}"
                       class="mt-2 w-full rounded-lg border border-white/10 bg-zinc-950/40 px-3 py-2 text-white focus:border-white/20 focus:outline-none">
                @error('issuer')
                    <div class="mt-2 text-sm text-rose-300">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="text-sm text-zinc-300" for="credential_id">Credential ID</label>
                <input id="credential_id" name="credential_id" type="text" value="{{ old('credential_id') }}"
                       class="mt-2 w-full rounded-lg border border-white/10 bg-zinc-950/40 px-3 py-2 text-white focus:border-white/20 focus:outline-none">
                @error('credential_id')
                    <div class="mt-2 text-sm text-rose-300">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="text-sm text-zinc-300" for="issued_at">Issued at</label>
                <input id="issued_at" name="issued_at" type="date" value="{{ old('issued_at') }}"
                       class="mt-2 w-full rounded-lg border border-white/10 bg-zinc-950/40 px-3 py-2 text-white focus:border-white/20 focus:outline-none">
                @error('issued_at')
                    <div class="mt-2 text-sm text-rose-300">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="text-sm text-zinc-300" for="expires_at">Expires at</label>
                <input id="expires_at" name="expires_at" type="date" value="{{ old('expires_at') }}"
                       class="mt-2 w-full rounded-lg border border-white/10 bg-zinc-950/40 px-3 py-2 text-white focus:border-white/20 focus:outline-none">
                @error('expires_at')
                    <div class="mt-2 text-sm text-rose-300">{{ $message }}</div>
                @enderror
            </div>

            <div class="sm:col-span-2">
                <label class="text-sm text-zinc-300" for="verify_url">Issuer verify URL</label>
                <input id="verify_url" name="verify_url" type="url" value="{{ old('verify_url') }}"
                       class="mt-2 w-full rounded-lg border border-white/10 bg-zinc-950/40 px-3 py-2 text-white focus:border-white/20 focus:outline-none"
                       placeholder="https://...">
                @error('verify_url')
                    <div class="mt-2 text-sm text-rose-300">{{ $message }}</div>
                @enderror
            </div>

            <div class="sm:col-span-2">
                <label class="text-sm text-zinc-300" for="certificate_file">Upload certificate (PDF or image)</label>
                <input id="certificate_file" name="certificate_file" type="file" accept="application/pdf,image/*"
                       class="mt-2 block w-full text-sm text-zinc-300 file:mr-4 file:rounded-md file:border-0 file:bg-white/10 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-white/15">
                @error('certificate_file')
                    <div class="mt-2 text-sm text-rose-300">{{ $message }}</div>
                @enderror
                <div class="mt-1 text-xs text-zinc-400">Max 10MB.</div>
            </div>

            <div class="sm:col-span-2 flex items-center justify-end gap-3">
                <button type="submit" class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-zinc-950 hover:bg-zinc-200">
                    Add certificate
                </button>
            </div>
        </form>
    </div>

    <div class="mt-8 overflow-hidden rounded-xl border border-white/10">
        <table class="min-w-full divide-y divide-white/10 bg-white/5 text-sm">
            <thead class="bg-white/5 text-zinc-300">
                <tr>
                    <th class="px-4 py-3 text-left font-medium">Title</th>
                    <th class="px-4 py-3 text-left font-medium">Issuer</th>
                    <th class="px-4 py-3 text-left font-medium">Issued</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
                @forelse ($certificates as $certificate)
                    <tr>
                        <td class="px-4 py-3 font-medium text-white">{{ $certificate->title }}</td>
                        <td class="px-4 py-3 text-zinc-300">{{ $certificate->issuer ?? '—' }}</td>
                        <td class="px-4 py-3 text-zinc-300">{{ optional($certificate->issued_at)->format('M Y') ?? '—' }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <a class="rounded-md bg-white/10 px-3 py-1.5 text-xs hover:bg-white/15"
                                   href="{{ route('certificates.verify', $certificate) }}" target="_blank" rel="noreferrer">
                                    Verify page
                                </a>
                                <a class="rounded-md bg-white/10 px-3 py-1.5 text-xs hover:bg-white/15"
                                   href="{{ route('admin.certificates.edit', $certificate) }}">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.certificates.destroy', $certificate) }}"
                                      onsubmit="return confirm('Delete this certificate?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-md bg-rose-500/20 px-3 py-1.5 text-xs text-rose-200 hover:bg-rose-500/30" type="submit">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-4 py-8 text-center text-zinc-300" colspan="4">No certificates yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.admin>
