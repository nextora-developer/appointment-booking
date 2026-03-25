<section class="space-y-10">

    {{-- PROFILE INFO --}}
    <div>
        <header>
            <h2 class="text-xl font-serif text-slate-900">
                Profile Information
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Update your account's profile information and email address.
            </p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')

            {{-- 2 COLUMN --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- NAME --}}
                <div>
                    <label class="text-sm font-semibold text-slate-700">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="mt-2 w-full border border-slate-200 px-4 py-3
                           focus:outline-none focus:ring-2 focus:ring-[#8bc34a]/40 focus:border-[#8bc34a]">

                    @error('name')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div>
                    <label class="text-sm font-semibold text-slate-700">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="mt-2 w-full border border-slate-200 px-4 py-3
                           focus:outline-none focus:ring-2 focus:ring-[#8bc34a]/40 focus:border-[#8bc34a]">

                    @error('email')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- VERIFY --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="border border-amber-200 bg-amber-50 px-4 py-4">
                    <p class="text-sm text-slate-700">
                        Your email address is unverified.

                        <button form="send-verification" class="ml-2 underline text-[#8bc34a] hover:text-[#7cb342]">
                            Resend verification email
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-emerald-600">
                            Verification link sent successfully.
                        </p>
                    @endif
                </div>
            @endif

            {{-- SAVE --}}
            <div class="flex items-center gap-4 pt-2">
                <button
                    class="inline-flex items-center bg-[#8bc34a] px-5 py-3 text-sm font-semibold text-white hover:bg-[#7cb342] transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>


    {{-- PASSWORD --}}
    <div class="border-t border-slate-200 pt-8">
        <header>
            <h2 class="text-xl font-serif text-slate-900">
                Update Password
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Ensure your account is using a strong password.
            </p>
        </header>

        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            {{-- 3 COLUMN --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                {{-- CURRENT --}}
                <div>
                    <label class="text-sm font-semibold text-slate-700">Current Password</label>
                    <input type="password" name="current_password" placeholder="Enter your current password"
                        class="mt-2 w-full border border-slate-200 px-4 py-3
                           focus:outline-none focus:ring-2 focus:ring-[#8bc34a]/40 focus:border-[#8bc34a]">

                    @error('current_password', 'updatePassword')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- NEW --}}
                <div>
                    <label class="text-sm font-semibold text-slate-700">New Password</label>
                    <input type="password" name="password" placeholder="At least 8 characters"
                        class="mt-2 w-full border border-slate-200 px-4 py-3
                           focus:outline-none focus:ring-2 focus:ring-[#8bc34a]/40 focus:border-[#8bc34a]">

                    @error('password', 'updatePassword')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- CONFIRM --}}
                <div>
                    <label class="text-sm font-semibold text-slate-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Re-enter new password"
                        class="mt-2 w-full border border-slate-200 px-4 py-3
                           focus:outline-none focus:ring-2 focus:ring-[#8bc34a]/40 focus:border-[#8bc34a]">

                    @error('password_confirmation', 'updatePassword')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- SAVE --}}
            <div class="flex items-center gap-4 pt-2">
                <button
                    class="inline-flex items-center bg-[#8bc34a] px-5 py-3 text-sm font-semibold text-white hover:bg-[#7cb342] transition">
                    Update Password
                </button>

                @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-slate-500">
                        Saved.
                    </p>
                @endif
            </div>
        </form>
    </div>
</section>
