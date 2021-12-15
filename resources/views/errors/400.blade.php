@php $page_title = "Error 400";@endphp

@extends('layouts.page')

@section('stylesheet')
@endsection
@section('content') 
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
    </div>
    <div class="card-body">
        <h1 class="error-title">404</h1>
        <h5>Oops, an error has occurred with message {{ $errorMessage }}.</h5>
    </div>
</div>
@endsection

@section('javascript')
@endsection
