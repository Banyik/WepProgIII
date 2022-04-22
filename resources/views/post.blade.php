@extends('layout.master')
@section('title', $id->post_title)
@section('content')
    @php use App\Models\User; @endphp

    <form action="{{route('home')}}" method="GET">
        <input value="Back" type="submit">
    </form>

    {{$id->post_title}}<br>
    Author: {{User::find($id->user_id)->name}}<br>
    {{$id->post}}<br>

    Comments<br>
    <form action="{{route('post_comment', $id->id)}}" method="POST">
        @csrf
        <input name="comment">
        <input value="Submit" type="submit">
    </form>

    @php
        $record = App\Models\Comment::orderBy('id','desc')->get();
    @endphp
    @foreach($record as $item)
        @if($item->post_id == $id->id)
            <tr>
                <td>Author:{{User::find($item->user_id)->name}}</td><br>
                <td>{{$item->comment_post}}</a></td><br>
            </tr>
            @endif
    @endforeach
@endsection
