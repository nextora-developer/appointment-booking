<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-bold text-slate-700">Customer</label>
        <input type="text" value="{{ $appointment->customer->name ?? 'N/A' }}" disabled
            class="mt-2 w-full rounded-2xl border-slate-300 bg-slate-100 text-slate-500">
    </div>

    <div>
        <label class="block text-sm font-bold text-slate-700">Service</label>
        <input type="text" value="{{ $appointment->service->name ?? 'N/A' }}" disabled
            class="mt-2 w-full rounded-2xl border-slate-300 bg-slate-100 text-slate-500">
    </div>

    <div>
        <label class="block text-sm font-bold text-slate-700">Date</label>
        <input type="text" value="{{ $appointment->appointment_date }}" disabled
            class="mt-2 w-full rounded-2xl border-slate-300 bg-slate-100 text-slate-500">
    </div>

    <div>
        <label class="block text-sm font-bold text-slate-700">Time</label>
        <input type="text" value="{{ $appointment->appointment_time }}" disabled
            class="mt-2 w-full rounded-2xl border-slate-300 bg-slate-100 text-slate-500">
    </div>
</div>

<div>
    <label class="block text-sm font-bold text-slate-700">Assign Staff</label>
    <select name="staff_id" class="mt-2 w-full rounded-2xl border-slate-300 focus:border-sky-500 focus:ring-sky-500">
        <option value="">Not Assigned</option>
        @foreach ($staffMembers as $member)
            <option value="{{ $member->id }}" @selected(old('staff_id', $appointment->staff_id) == $member->id)>
                {{ $member->user->name }}
            </option>
        @endforeach
    </select>
    @error('staff_id')
        <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-bold text-slate-700">Status</label>
    <select name="status" class="mt-2 w-full rounded-2xl border-slate-300 focus:border-sky-500 focus:ring-sky-500">
        @foreach ($statuses as $status)
            <option value="{{ $status }}" @selected(old('status', $appointment->status) === $status)>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>
    @error('status')
        <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-bold text-slate-700">Notes</label>
    <textarea name="notes" rows="5"
        class="mt-2 w-full rounded-2xl border-slate-300 focus:border-sky-500 focus:ring-sky-500">{{ old('notes', $appointment->notes) }}</textarea>
    @error('notes')
        <p class="mt-2 text-sm text-rose-500">{{ $message }}</p>
    @enderror
</div>

<div class="flex flex-wrap items-center gap-3 pt-2">
    <button type="submit"
        class="inline-flex items-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-bold text-white hover:bg-slate-800">
        Save Changes
    </button>

    <a href="{{ route('admin.appointments.index') }}"
        class="inline-flex items-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50">
        Cancel
    </a>
</div>
