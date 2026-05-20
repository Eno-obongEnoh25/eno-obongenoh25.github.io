<x-layouts.admin>
    <div class="flex flex-wrap items-start justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Edit certificate</h1>
            <p class="mt-2 text-zinc-300">{{ $certificate->title }}</p>
        </div>
        <a class="rounded-md bg-white/10 px-3 py-2 text-sm hover:bg-white/15" href="{{ route('admin.certificates.index') }}">
            Back
        </a>
    </div>

    <div class="mt-8 rounded-2xl border border-white/10 bg-white/5 p-6">
        <form method="POST" action="{{ route('admin.certificates.update', $certificate) }}" enctype="multipart/form-data" class="grid gap-4 sm:grid-cols-2">
            @csrf
            @method('PUT')

            <div class="sm:col-span-2">
                <label class="text-sm text-zinc-300" for="title">Title</label>
                <input id="title" name="title" type="text" value="{{ old('title', $certificate->title) }}"
                       class="mt-2 w-full rounded-lg border border-white/10 bg-zinc-950/40 px-3 py-2 text-white focus:border-white/20 focus:outline-none"
                       required>
                @error('title')
                    <div class="mt-2 text-sm text-rose-300">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="text-sm text-zinc-300" for="issuer">Issuer</label>
                <input id="issuer" name="issuer" type="text" value="{{ old('issuer', $certificate->issuer) }}"
                       class="mt-2 w-full rounded-lg border border-white/10 bg-zinc-950/40 px-3 py-2 text-white focus:border-white/20 focus:outline-none">
                @error('issuer')
                    <div class="mt-2 text-sm text-rose-300">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="text-sm text-zinc-300" for="credential_id">Credential ID</label>
                <input id="credential_id" name="credential_id" type="text" value="{{ old('credential_id', $certificate->credential_id) }}"
                       class="mt-2 w-full rounded-lg border border-white/10 bg-zinc-950/40 px-3 py-2 text-white focus:border-white/20 focus:outline-none">
                @error('credential_id')
                    <div class="mt-2 text-sm text-rose-300">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="text-sm text-zinc-300" for="issued_at">Issued at</label>
                <input id="issued_at" name="issued_at" type="date" value="{{ old('issued_at', optional($certificate->issued_at)->format('Y-m-d')) }}"
                       class="mt-2 w-full rounded-lg border border-white/10 bg-zinc-950/40 px-3 py-2 text-white focus:border-white/20 focus:outline-none">
                @error('issued_at')
                    <div class="mt-2 text-sm text-rose-300">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="text-sm text-zinc-300" for="expires_at">Expires at</label>
                <input id="expires_at" name="expires_at" type="date" value="{{ old('expires_at', optional($certificate->expires_at)->format('Y-m-d')) }}"
                       class="mt-2 w-full rounded-lg border border-white/10 bg-zinc-950/40 px-3 py-2 text-white focus:border-white/20 focus:outline-none">
                @error('expires_at')
                    <div class="mt-2 text-sm text-rose-300">{{ $message }}</div>
                @enderror
            </div>

            <div class="sm:col-span-2">
                <label class="text-sm text-zinc-300" for="verify_url">Issuer verify URL</label>
                <input id="verify_url" name="verify_url" type="url" value="{{ old('verify_url', $certificate->verify_url) }}"
                       class="mt-2 w-full rounded-lg border border-white/10 bg-zinc-950/40 px-3 py-2 text-white focus:border-white/20 focus:outline-none"
                       placeholder="https://...">
                @error('verify_url')
                    <div class="mt-2 text-sm text-rose-300">{{ $message }}</div>
                @enderror
            </div>

            <div class="sm:col-span-2">
                <div class="flex items-center justify-between gap-3">
                    <label class="text-sm text-zinc-300" for="certificate_file">Replace/upload certificate file</label>
                    @if ($certificate->file_path)
                        <a class="text-xs text-zinc-300 hover:text-white"
                           href="{{ \Illuminate\Support\Facades\Storage::url($certificate->file_path) }}" target="_blank" rel="noreferrer">
                            View current ({{ $certificate->file_original_name ?? 'file' }})
                        </a>
                    @endif
                </div>
                <input id="certificate_file" name="certificate_file" type="file" accept="application/pdf,image/*"
                       class="mt-2 block w-full text-sm text-zinc-300 file:mr-4 file:rounded-md file:border-0 file:bg-white/10 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-white/15">
                @error('certificate_file')
                    <div class="mt-2 text-sm text-rose-300">{{ $message }}</div>
                @enderror

                @if ($certificate->file_path)
                    <label class="mt-3 flex items-center gap-2 text-sm text-zinc-300">
                        <input type="checkbox" name="remove_file" value="1" class="rounded border-white/10 bg-zinc-950/40">
                        Remove current file
                    </label>
                @endif
            </div>

            <div class="sm:col-span-2 flex items-center justify-end gap-3">
                <button type="submit" class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-zinc-950 hover:bg-zinc-200">
                    Save changes
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>

