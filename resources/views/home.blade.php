<x-layouts.app>
    <section class="mx-auto max-w-6xl px-4 py-14">
        <div class="grid gap-10 md:grid-cols-2 md:items-center">
            <div>
                <div class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-zinc-300">
                    Laravel • Backend • APIs • Cloud
                </div>
                <h1 class="mt-4 text-4xl font-semibold tracking-tight md:text-5xl">
                    Hi, I’m <span class="text-white">Enoh</span> — Senior Backend Engineer and Cloud Specialist.
                </h1>
                <p class="mt-4 text-zinc-300 leading-relaxed">
                    Portfolio, experience, and certifications — plus a direct way to contact me.
                </p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="#portfolio" class="rounded-md bg-white px-4 py-2 text-sm font-medium text-zinc-950 hover:bg-zinc-200">
                        View Portfolio
                    </a>
                    <a href="#contact" class="rounded-md bg-white/10 px-4 py-2 text-sm font-medium text-white hover:bg-white/15">
                        Send a Message
                    </a>
                </div>

                <div class="mt-5 flex flex-wrap gap-3">
                    @php
                        $github = config('app.social.github');
                        $linkedin = config('app.social.linkedin');
                    @endphp

                    @if ($github)
                        <a href="{{ $github }}" target="_blank" rel="noreferrer"
                           class="inline-flex items-center gap-2 rounded-md border border-white/10 bg-white/5 px-4 py-2 text-sm font-medium text-white hover:bg-white/10">
                            GitHub
                            <span class="text-zinc-400" aria-hidden="true">↗</span>
                        </a>
                    @else
                        <span title="Set SOCIAL_GITHUB_URL in .env"
                              class="inline-flex cursor-not-allowed items-center gap-2 rounded-md border border-white/10 bg-white/5 px-4 py-2 text-sm font-medium text-white/40">
                            GitHub
                        </span>
                    @endif

                    @if ($linkedin)
                        <a href="{{ $linkedin }}" target="_blank" rel="noreferrer"
                           class="inline-flex items-center gap-2 rounded-md border border-white/10 bg-white/5 px-4 py-2 text-sm font-medium text-white hover:bg-white/10">
                            LinkedIn
                            <span class="text-zinc-400" aria-hidden="true">↗</span>
                        </a>
                    @else
                        <span title="Set SOCIAL_LINKEDIN_URL in .env"
                              class="inline-flex cursor-not-allowed items-center gap-2 rounded-md border border-white/10 bg-white/5 px-4 py-2 text-sm font-medium text-white/40">
                            LinkedIn
                        </span>
                    @endif
                </div>
            </div>

            <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
                <div class="text-sm text-zinc-300">Quick highlights</div>
                <ul class="mt-4 space-y-3 text-zinc-200">
                    <li class="flex gap-2"><span class="text-zinc-400">•</span> Backend Engineer (Laravel/PHP, REST)</li>
                    <li class="flex gap-2"><span class="text-zinc-400">•</span> DevOps/Site Reliability Specialist</li>
                    <li class="flex gap-2"><span class="text-zinc-400">•</span> Kubernetes Cloud Native Associate</li>
                    <li class="flex gap-2"><span class="text-zinc-400">•</span> AWS AI and ML Specialist</li>
                </ul>
            </div>
        </div>
    </section>

    <section id="portfolio" class="mx-auto max-w-6xl px-4 py-10">
        <h2 class="text-2xl font-semibold tracking-tight">Portfolio</h2>
        <p class="mt-2 text-zinc-300">A few things I’ve built.</p>
        <div class="mt-6 grid gap-4 md:grid-cols-3">
            @foreach ([
                ['title' => 'vankwallet.com', 'desc' => 'A Platform that sells tokenised real estate.'],
                ['title' => 'golviasports.com', 'desc' => 'A social media platform for creative professionals.'],
                ['title' => 'blomgram.com', 'desc' => 'An online currency exchange platform.'],
                ['title' => 'boifiok.com', 'desc' => 'An e-commerce platform for local food vendors.'],
            ] as $project)
                <div class="rounded-xl border border-white/10 bg-white/5 p-5">
                    <div class="font-semibold">{{ $project['title'] }}</div>
                    <div class="mt-2 text-sm text-zinc-300">{{ $project['desc'] }}</div>
                </div>
            @endforeach
        </div>
    </section>

    <section id="experience" class="mx-auto max-w-6xl px-4 py-10">
        <h2 class="text-2xl font-semibold tracking-tight">Experience</h2>
        <p class="mt-2 text-zinc-300">A simple timeline.</p>
        <div class="mt-6 space-y-4">
            @foreach ([
                ['role' => 'Backend Engineer', 'company' => 'Vank Digital Services', 'period' => '2021 — 2025', 'summary' => 'Team Lead, backend developer, DevOps.'],
                ['role' => 'DevOps Specialist', 'company' => 'Drumbell Technologies', 'period' => '2024 — 2026', 'summary' => 'Managed infrastructure and deployment pipelines on AWS.'],
                ['role' => 'Site Reliability Engineer', 'company' => 'Golviasports', 'period' => '2025 — Present', 'summary' => 'Site Reliability Engineer(AWS).'],
                ['role' => 'DevOps Specialist', 'company' => 'Boifiok', 'period' => '2024 — Present', 'summary' => 'DevOps Specialist(AWS).'],
            ] as $job)
                <div class="rounded-xl border border-white/10 bg-white/5 p-5">
                    <div class="flex flex-wrap items-baseline justify-between gap-2">
                        <div class="font-semibold">{{ $job['role'] }} · <span class="text-zinc-300">{{ $job['company'] }}</span></div>
                        <div class="text-sm text-zinc-400">{{ $job['period'] }}</div>
                    </div>
                    <div class="mt-2 text-sm text-zinc-300">{{ $job['summary'] }}</div>
                </div>
            @endforeach
        </div>
    </section>

    <section id="certifications" class="mx-auto max-w-6xl px-4 py-10">
        <div class="flex items-end justify-between gap-4">
            <div>
                <h2 class="text-2xl font-semibold tracking-tight">Certifications</h2>
                <p class="mt-2 text-zinc-300">Click “Verify” to confirm a certificate.</p>
            </div>
        </div>

        <div class="mt-6 overflow-hidden rounded-xl border border-white/10">
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
                                    <a href="{{ route('certificates.verify', $certificate) }}"
                                       class="inline-flex items-center rounded-md bg-white px-3 py-1.5 text-xs font-semibold text-zinc-950 hover:bg-zinc-200">
                                        Verify
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-4 py-8 text-center text-zinc-300" colspan="4">
                                No certificates yet. Admin can add them in the dashboard.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section id="contact" class="mx-auto max-w-6xl px-4 py-10">
        <h2 class="text-2xl font-semibold tracking-tight">Contact</h2>
        <p class="mt-2 text-zinc-300">Send a message — it appears in the admin dashboard.</p>

        <form method="POST" action="{{ route('contact.store') }}" class="mt-6 max-w-2xl rounded-2xl border border-white/10 bg-white/5 p-6">
            @csrf
            <div class="grid gap-4">
                <div>
                    <label class="text-sm text-zinc-300" for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                           class="mt-2 w-full rounded-lg border border-white/10 bg-zinc-950/40 px-3 py-2 text-white placeholder:text-zinc-500 focus:border-white/20 focus:outline-none"
                           placeholder="you@example.com" required>
                    @error('email')
                        <div class="mt-2 text-sm text-rose-300">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="text-sm text-zinc-300" for="message">Message</label>
                    <textarea id="message" name="message" rows="5"
                              class="mt-2 w-full rounded-lg border border-white/10 bg-zinc-950/40 px-3 py-2 text-white placeholder:text-zinc-500 focus:border-white/20 focus:outline-none"
                              placeholder="How can I help?" required>{{ old('message') }}</textarea>
                    @error('message')
                        <div class="mt-2 text-sm text-rose-300">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex items-center justify-between gap-3">
                    <div class="text-xs text-zinc-400">No spam — just one message.</div>
                    <button type="submit" class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-zinc-950 hover:bg-zinc-200">
                        Send
                    </button>
                </div>
            </div>
        </form>
    </section>
</x-layouts.app>
