@extends('layouts.admin')

@section('title', 'Add Staff')
@section('page_title', 'Add Staff')
@section('page_description', 'Create a new staff account')

@section('content')
    <div class="max-w-3xl">
        <form method="POST" action="{{ route('admin.staff.store') }}"
            class="rounded-3xl bg-white border border-slate-200 p-8 shadow-sm space-y-6">
            @csrf

            @include('admin.staff.partials.form', [
                'staff' => null,
            ])
        </form>
    </div>
@endsection
