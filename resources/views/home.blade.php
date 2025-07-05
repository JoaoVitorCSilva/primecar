@extends('adminlte::page')

@section('title', 'PrimeCAR')

@section('content_header')
    <h1>Bem vindo!</h1>
@stop

@section('content')
    <p>Você está no PrimeCAR.</p>


@stop

@push('css')
    <link rel="stylesheet" href="{{ asset('css/home.blade.css') }}">
@endpush

