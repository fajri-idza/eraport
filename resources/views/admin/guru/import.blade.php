@extends('admin.layout.app')
@php
    $judul = 'Import Data Guru';
@endphp
@section('content')
<div class="container-fluid">

    @if (session('message'))
    <div>{{ session('message') }}</div>

    @if (session('failures'))
        <ul>
            @foreach (session('failures') as $failure)
                <li>
                    Baris {{ $failure->row() }}:
                    Kolom {{ implode(', ', $failure->attribute()) }} -
                    {{ implode(', ', $failure->errors()) }}
                </li>
            @endforeach
        </ul>
    @endif
@endif
<a href="{{ asset('template/template_import_guru.xlsx') }}" class="btn btn-success mb-3">Download Template Excel</a>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.guru.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" required>
                <button type="submit">Import Excel</button>
            </form>
        </div>
    </div>
</div>
@endsection
