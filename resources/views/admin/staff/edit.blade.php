@extends('layouts.admin')

@section('title', 'Edit Staff')
@section('page_title', 'Edit Staff')
@section('page_description', 'Update staff profile and account')

@section('content')
    <div class="max-w-3xl">
        <form method="POST" action="{{ route('admin.staff.update', $staff) }}"
            class="rounded-3xl bg-white border border-slate-200 p-8 shadow-sm space-y-6">
            @csrf
            @method('PUT')

            @include('admin.staff.partials.form', [
                'staff' => $staff,
            ])
        </form>
    </div>
@endsection
