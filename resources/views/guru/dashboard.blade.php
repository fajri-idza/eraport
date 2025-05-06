@extends('guru.layout.app')
@section('content')
<div class="row">
    <h3>Selamat Datang {{ Auth::guard('guru')->user()->nama }} di Aplikasi E-Raport </h3>

</div>
@endsection
