<x-layouts.app>
    <section class="mx-auto max-w-3xl px-4 py-14">
        <div class="flex items-center justify-between gap-4">
            <div>
                <div class="text-sm text-zinc-400">Certificate verification</div>
                <h1 class="mt-2 text-3xl font-semibold tracking-tight">{{ $certificate->title }}</h1>
                <p class="mt-2 text-zinc-300">
                    This certificate exists in my portfolio database and is verified by this page.
                </p>
            </div>
            <a href="{{ route('home') }}#certifications" class="rounded-md bg-white/10 px-3 py-2 text-sm hover:bg-white/15">
                Back
            </a>
        </div>

        <div class="mt-8 rounded-2xl border border-white/10 bg-white/5 p-6">
            <dl class="grid gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-xs uppercase tracking-wide text-zinc-400">Issuer</dt>
                    <dd class="mt-1 text-zinc-100">{{ $certificate->issuer ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wide text-zinc-400">Credential ID</dt>
                    <dd class="mt-1 text-zinc-100">{{ $certificate->credential_id ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wide text-zinc-400">Issued</dt>
                    <dd class="mt-1 text-zinc-100">{{ optional($certificate->issued_at)->toFormattedDateString() ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wide text-zinc-400">Expires</dt>
                    <dd class="mt-1 text-zinc-100">{{ optional($certificate->expires_at)->toFormattedDateString() ?? '—' }}</dd>
                </div>
            </dl>

            <div class="mt-6 flex flex-wrap items-center gap-3">
                <span class="inline-flex items-center rounded-full border border-emerald-400/20 bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-200">
                    Verified
                </span>

                @if ($certificate->verify_url)
                    <a href="{{ $certificate->verify_url }}" target="_blank" rel="noreferrer"
                       class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-zinc-950 hover:bg-zinc-200">
                        Open Issuer Verification
                    </a>
                @endif
            </div>
        </div>

        @if ($certificate->file_path)
            @php
                $wm = trim((string) env('CERTIFICATE_WATERMARK', config('app.name', 'Portfolio')));
                if ($wm === '') {
                    $wm = 'VERIFIED';
                }
            @endphp

            <div class="mt-6 overflow-hidden rounded-2xl border border-white/10 bg-white/5">
                @php
                    $url = route('certificates.view', $certificate);
                    $mime = $certificate->file_mime_type;
                @endphp

                @if ($mime && str_starts_with($mime, 'image/'))
                    <div class="relative">
                        <img src="{{ $url }}" alt="Certificate image" class="w-full bg-zinc-950/40 object-contain select-none" draggable="false">
                        <div class="pointer-events-none absolute inset-0 opacity-40" aria-hidden="true"
                             style="background-image: repeating-linear-gradient(-35deg,
                                rgba(255,255,255,0.0) 0px,
                                rgba(255,255,255,0.0) 120px,
                                rgba(255,255,255,0.08) 120px,
                                rgba(255,255,255,0.08) 220px);">
                        </div>
                        <div class="pointer-events-none absolute inset-0 flex items-center justify-center" aria-hidden="true">
                            <div class="-rotate-12 select-none text-center text-3xl font-black tracking-widest text-white/20 sm:text-5xl">
                                {{ $wm }}
                            </div>
                        </div>
                    </div>
                @elseif ($mime === 'application/pdf')
                    <div class="relative">
                        <iframe src="{{ $url }}" class="h-[70vh] w-full bg-zinc-950/40" title="Certificate PDF"></iframe>
                        <div class="pointer-events-none absolute inset-0 opacity-40" aria-hidden="true"
                             style="background-image: repeating-linear-gradient(-35deg,
                                rgba(255,255,255,0.0) 0px,
                                rgba(255,255,255,0.0) 120px,
                                rgba(255,255,255,0.08) 120px,
                                rgba(255,255,255,0.08) 220px);">
                        </div>
                        <div class="pointer-events-none absolute inset-0 flex items-center justify-center" aria-hidden="true">
                            <div class="-rotate-12 select-none text-center text-3xl font-black tracking-widest text-white/20 sm:text-5xl">
                                {{ $wm }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="p-6 text-sm text-zinc-300">
                        File uploaded. Certificate preview is not available for this file type.
                    </div>
                @endif
            </div>
        @endif
    </section>
</x-layouts.app>
