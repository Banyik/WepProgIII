@extends('layout.master')
@section('title','Post')
@section('content')
    <form action="{{route('post_validate')}}" method="POST">
        @csrf
        <input placeholder="Title of the post" name="post_title">
        <input placeholder="Content of the post" name="post_content">
        <input type="submit" value="Submit">
    </form>
@endsection
