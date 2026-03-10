@extends('layouts.admin')

@section('title', 'Add Service')
@section('page_title', 'Add Service')
@section('page_description', 'Create a new service for customer booking')

@section('content')
    <div class="max-w-3xl">
        <form method="POST" action="{{ route('admin.services.store') }}"
              class="rounded-3xl bg-white border border-slate-200 p-8 shadow-sm space-y-6">
            @csrf

            @include('admin.services.partials.form', [
                'service' => null
            ])
        </form>
    </div>
@endsection