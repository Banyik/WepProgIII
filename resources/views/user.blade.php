@php
    use App\Models\User
@endphp
@extends('layout.master')
@section('title', $id->name)
@section('content')
{{$id}}
@endsection
