@extends('layouts.admin')

@section('title', 'Edit Service')
@section('page_title', 'Edit Service')
@section('page_description', 'Update service information')

@section('content')
    <div class="max-w-3xl">
        <form method="POST" action="{{ route('admin.services.update', $service) }}"
            class="rounded-3xl bg-white border border-slate-200 p-8 shadow-sm space-y-6">
            @csrf
            @method('PUT')

            @include('admin.services.partials.form', [
                'service' => $service,
            ])
        </form>
    </div>
@endsection
