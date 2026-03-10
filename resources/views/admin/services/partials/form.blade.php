<div>
    <label class="block text-sm font-bold text-slate-700">Service Name</label>
    <input type="text" name="name" value="{{ old('name', $service->name ?? '') }}"
           class="mt-2 w-full rounded-2xl border-slate-300 focus:border-sky-500 focus:ring-sky-500">
    @error('name')
        <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-bold text-slate-700">Description</label>
    <textarea name="description" rows="5"
              class="mt-2 w-full rounded-2xl border-slate-300 focus:border-sky-500 focus:ring-sky-500">{{ old('description', $service->description ?? '') }}</textarea>
    @error('description')
        <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
    @enderror
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-bold text-slate-700">Price</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $service->price ?? '') }}"
               class="mt-2 w-full rounded-2xl border-slate-300 focus:border-sky-500 focus:ring-sky-500">
        @error('price')
            <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-bold text-slate-700">Duration (minutes)</label>
        <input type="number" name="duration" value="{{ old('duration', $service->duration ?? 30) }}"
               class="mt-2 w-full rounded-2xl border-slate-300 focus:border-sky-500 focus:ring-sky-500">
        @error('duration')
            <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
        @enderror
    </div>
</div>

<div>
    <label class="block text-sm font-bold text-slate-700">Status</label>
    <select name="is_active"
            class="mt-2 w-full rounded-2xl border-slate-300 focus:border-sky-500 focus:ring-sky-500">
        <option value="1" @selected(old('is_active', $service->is_active ?? 1) == 1)>Active</option>
        <option value="0" @selected(old('is_active', $service->is_active ?? 1) == 0)>Inactive</option>
    </select>
    @error('is_active')
        <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center gap-3 pt-2">
    <button type="submit"
            class="inline-flex items-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-bold text-white hover:bg-slate-800">
        Save Service
    </button>

    <a href="{{ route('admin.services.index') }}"
       class="inline-flex items-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50">
        Cancel
    </a>
</div>