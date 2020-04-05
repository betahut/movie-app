@extends('layouts.main')

@section('styles')
<style> .screen-empty{ min-height: calc(100vh - 280px); } </style>
@endsection

@section('content')
<div class="mx-auto bg-gray-900">
    <div class="content screen-empty">
        <div class="hero-image absolute h-screen bg-cover bg-center container" style="background-image:linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(26, 32, 44) 85%);"></div>
        <div class="p-8 z-10 relative">
            <livewire:search-dropdown />
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endsection