@extends('layout.master')
@section('title', 'Login')
@section('content')
    <form action="{{route('verification')}}" method="POST">
        @csrf
        <input name="name" placeholder="Username" required><br>
        <input name="password" placeholder="Password" type="password" required><br>
        <input value="Login" type="submit">
    </form>
@endsection
