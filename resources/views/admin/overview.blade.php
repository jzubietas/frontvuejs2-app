@extends('layouts.dashboard')

@section('content')


<admin-overview :data ='{{ json_encode($data) }}'></admin-overview>
{{-- <h1>Bienvenido: {{ auth()->user()->name }}</h1> --}}

@endsection
