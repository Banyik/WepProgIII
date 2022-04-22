@extends('layout.master')
@section('title', 'Home')
@section('content')
    <form method="GET" action="{{route('post')}}">
        <input name="postbutton" type="submit", value="Post">
    </form>
    @php
        $record = App\Models\Post::orderBy('post_id','desc')->get();
        @endphp
    @foreach($record as $item)
        <tr>
            <td>{{$item->post_title}}</td><br>
        </tr>
    @endforeach
    @if($user->auth->authentication == 9)
        AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
    @endif
@endsection
