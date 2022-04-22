@extends('layout.master')
@section('title', 'Home')
@section('content')
    <form method="GET" action="{{route('create_post')}}">
        <input name="postbutton" type="submit", value="Post">
    </form>
    @php
        $record = App\Models\Post::orderBy('id','desc')->get();
        @endphp
    @foreach($record as $item)
        <tr>
            <td><a href="{{route('post', $item)}}">{{$item->post_title}}</a></td><br>
        </tr>
    @endforeach
    @if($user->auth->authentication == 9)
        AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
    @endif
@endsection
