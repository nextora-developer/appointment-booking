<div>
    <label class="block text-sm font-bold text-slate-700">Name</label>
    <input type="text" name="name" value="{{ old('name', $staff->user->name ?? '') }}"
           class="mt-2 w-full rounded-2xl border-slate-300 focus:border-sky-500 focus:ring-sky-500">
    @error('name')
        <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-bold text-slate-700">Email</label>
    <input type="email" name="email" value="{{ old('email', $staff->user->email ?? '') }}"
           class="mt-2 w-full rounded-2xl border-slate-300 focus:border-sky-500 focus:ring-sky-500">
    @error('email')
        <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-bold text-slate-700">
        Password {{ $staff ? '(Leave blank to keep current password)' : '' }}
    </label>
    <input type="password" name="password"
           class="mt-2 w-full rounded-2xl border-slate-300 focus:border-sky-500 focus:ring-sky-500">
    @error('password')
        <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-bold text-slate-700">Phone</label>
    <input type="text" name="phone" value="{{ old('phone', $staff->phone ?? '') }}"
           class="mt-2 w-full rounded-2xl border-slate-300 focus:border-sky-500 focus:ring-sky-500">
    @error('phone')
        <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-bold text-slate-700">Bio</label>
    <textarea name="bio" rows="4"
              class="mt-2 w-full rounded-2xl border-slate-300 focus:border-sky-500 focus:ring-sky-500">{{ old('bio', $staff->bio ?? '') }}</textarea>
    @error('bio')
        <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-bold text-slate-700">Status</label>
    <select name="is_active"
            class="mt-2 w-full rounded-2xl border-slate-300 focus:border-sky-500 focus:ring-sky-500">
        <option value="1" @selected(old('is_active', $staff->is_active ?? 1) == 1)>Active</option>
        <option value="0" @selected(old('is_active', $staff->is_active ?? 1) == 0)>Inactive</option>
    </select>
    @error('is_active')
        <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center gap-3 pt-2">
    <button type="submit"
            class="inline-flex items-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-bold text-white hover:bg-slate-800">
        Save Staff
    </button>

    <a href="{{ route('admin.staff.index') }}"
       class="inline-flex items-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50">
        Cancel
    </a>
</div>