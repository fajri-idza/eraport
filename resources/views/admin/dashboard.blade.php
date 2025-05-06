@extends('admin.layout.app')
@section('content')
<div class="row">
    <h3>Selamat Datang {{ Auth::guard('admin')->user()->nama }} di Aplikasi E-Raport </h3>

</div>
@endsection
