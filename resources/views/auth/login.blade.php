<x-layouts.guest title="Admin Login | {{ config('tenwek.name') }}">
    <div class="relative w-full max-w-md">
        <div aria-hidden="true" class="pointer-events-none absolute -inset-6 opacity-60 blur-2xl">
            <div class="absolute inset-0 bg-[radial-gradient(closest-side,rgba(13,148,136,0.22),transparent_70%)]"></div>
            <div class="absolute -top-10 -right-10 h-48 w-48 rounded-full bg-[radial-gradient(circle,rgba(231,40,44,0.28),transparent_70%)]"></div>
            <div class="absolute -bottom-12 -left-12 h-56 w-56 rounded-full bg-[radial-gradient(circle,rgba(26,26,104,0.22),transparent_70%)]"></div>
        </div>

        <div class="relative overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-lg">
            <div aria-hidden="true" class="h-1.5 bg-gradient-to-r from-[#1a1a68] via-[#0d9488] to-[#e7282c]"></div>

            <div class="p-8">
                <div class="mb-7 flex items-start justify-between gap-6">
                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Admin access</p>
                        <h1 class="mt-2 text-2xl font-extrabold leading-tight text-[#1a1a68]">
                            {{ config('tenwek.name') }}
                        </h1>
                        <p class="mt-1 text-sm text-slate-500">Sign in to manage content and settings.</p>
                    </div>
                    <div class="shrink-0">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl border border-gray-200 bg-white/60 shadow-sm">
                            <svg class="h-5 w-5 text-[#1a1a68]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 20a8 8 0 0116 0" />
                            </svg>
                        </div>
                    </div>
                </div>

                @if (session('status'))
                    <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800" role="status">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="post" action="{{ route('login') }}" class="space-y-5" x-data="{ showPw: false }">
                    @csrf

                    <div>
                        <label for="email" class="mb-1 block text-sm font-semibold text-[#1a1a68]">Email</label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                class="w-full rounded-xl border border-gray-300 py-3 pl-10 pr-4 text-sm text-[#1a1a68] focus:border-[#0d9488] focus:outline-none focus:ring-2 focus:ring-[#0d9488]"
                            >
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="mb-1 block text-sm font-semibold text-[#1a1a68]">Password</label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m6-7V8a6 6 0 10-12 0v2m12 0H6m12 0a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6a2 2 0 012-2" />
                                </svg>
                            </span>
                            <input
                                :type="showPw ? 'text' : 'password'"
                                name="password"
                                id="password"
                                required
                                autocomplete="current-password"
                                class="w-full rounded-xl border border-gray-300 py-3 pl-10 pr-12 text-sm text-[#1a1a68] focus:border-[#0d9488] focus:outline-none focus:ring-2 focus:ring-[#0d9488]"
                            >
                            <button
                                type="button"
                                class="absolute inset-y-0 right-0 flex items-center px-3 text-xs font-semibold text-gray-500 transition-colors hover:text-[#0d9488]"
                                @click="showPw = !showPw"
                                :aria-pressed="showPw ? 'true' : 'false'"
                                :aria-label="showPw ? 'Hide password' : 'Show password'"
                            >
                                <span x-text="showPw ? 'Hide' : 'Show'" x-cloak>Show</span>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between gap-4">
                        <label class="inline-flex select-none items-center gap-2 text-sm text-gray-600">
                            <input
                                type="checkbox"
                                name="remember"
                                id="remember"
                                class="rounded border-gray-300 text-[#0d9488] focus:ring-[#0d9488]"
                            >
                            Remember me
                        </label>
                        <a href="{{ route('home') }}" class="text-sm font-semibold text-[#0d9488] hover:underline">Back to site</a>
                    </div>

                    <button
                        type="submit"
                        class="w-full rounded-xl bg-[#0d9488] py-3 font-semibold text-white shadow-sm shadow-[#0d9488]/20 transition-colors hover:bg-[#0f766e]"
                    >
                        Log in
                    </button>

                    <p class="text-xs leading-relaxed text-gray-500">
                        If you don’t have access, contact an administrator.
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-layouts.guest>
