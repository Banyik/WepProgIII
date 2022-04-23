@extends('layout.master')
@section('title', $id->post_title)
@section('content')
    @php
        use App\Models\User;
        use App\Models\Post;
        $record = App\Models\Comment::orderBy('id','desc')->get();

    @endphp

    <form action="{{route('home')}}" method="GET">
        <input value="Back" type="submit">
    </form>
    <div class="flex flex-1">
        <div class="float-left flex flex-col flex-auto">
            <div class="float-left backdrop-blur-sm shadow-lg rounded p-2 m-1 bg-white/50">
                <p class="text-3xl">{{$id->post_title}}</p>
                <p class="text-sm">Author: <a class="hover:text-cyan-900 hover:underline"  href="{{route('user_site',$id->user_id)}}">{{$id->user->name}}</a> {{$id->created_at->format('Y-m-d')}}</p>
            </div>

            <div class="float-left backdrop-blur-sm shadow-lg rounded p-2 m-1 bg-white/50">
                <?php
                echo $text = $id->post;
                ?>
            </div>
        </div>

        <div class="float-right">
            <div class="bg-white/50 backdrop-blur-sm max-h-full flex grow-0 flex-col shadow-lg rounded p-1 m-1">
                <a href="{{route('user_site', Auth::id())}}">
                    <div class="text-center rounded p-2 m-1 hover:backdrop-blur-sm  hover:text-white/70 hover:bg-cyan-700/70">
                        <p class="text-xl">{{User::find(Auth::id())->name}}</p>
                    </div>
                </a>
                <a href="{{route('create_post')}}">
                    <div class="text-center rounded p-2 m-1 hover:backdrop-blur-sm  hover:text-white/70 hover:bg-cyan-700/70">
                        <p class="text-xl">Create a post</p>
                    </div>
                </a>
                <a href="{{route('logout')}}">
                    <div class="text-center rounded p-2 m-1 hover:backdrop-blur-sm  hover:text-white/70 hover:bg-red-500">
                        <p class="text-xl">Logout</p>
                    </div>
                </a>
            </div>
        </div>
    </div>


    Comments<br>
    <form action="{{route('post_comment', $id->id)}}" method="POST">
        @csrf
        <input name="comment" required>
        <input id="comment_" type="submit" value="Submit" onClick="this.hidden=true;">
    </form>
    @foreach($record as $item)
        @if($item->post_id == $id->id)
            <tr>
                <td>Author:{{$item->user->name}} {{$item->created_at->format('Y-m-d')}}</td><br>
                <td>{{$item->comment_post}}</a></td><br>
            </tr>
            @endif
    @endforeach
@endsection
