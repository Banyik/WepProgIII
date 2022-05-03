@extends('layout.master')
@section('title', $id->name)
@section('content')
    @php
        use App\Models\Post;
        use App\Models\User;
        $records = $id->post()->get();

    @endphp

<div class="flex flex-1">
    <div class="flex flex-col w-full">
        <div class="backdrop-blur-md shadow-lg rounded p-2 m-1 bg-white/70 flex flex-col ">
            <p class="text-2xl">{{$id->name}}</p>
            <p>Joined in: {{$id->created_at->format('Y')}}</p>
        </div>

    <div class="w-full flex flex-col h-[80vh] flex-auto overflow-auto overflow-y-scroll">

        @foreach($records as $item)

            <div class="inline float-right backdrop-blur-md shadow-lg rounded p-2 m-1 bg-white/50">

                <p class="text-xl">
                    <a
                        class="hover:text-cyan-900 hover:underline" href="{{route('post', $item)}}">
                        {{$item->post_title}}
                    </a>
                </p>

                <p class="text-sm mr-1">
                    <a
                        class="-mt-1 hover:text-cyan-900 hover:underline" href="{{route('user_site', $item->user_id)}}">
                        {{$item->user->name}}</a> {{$item->created_at->format('Y-m-d')}}
                    @if(Auth::check())
                        @if($item->user->id == Auth::id() || User::find(Auth::id())->auth->authentication == 9)
                            <form class="inline"  method="GET" href="{{route('home', $item->id)}}">
                                @csrf
                                <button type="submit" class="mr-1 text-sm hover:text-cyan-900 hover:underline" >
                                    Edit
                                </button>
                            </form>
                            <form class="inline"  method="POST" action="{{route('delete_post', $item->id)}}">
                                @csrf
                                <button type="submit" class="mr-1 text-sm hover:text-cyan-900 hover:underline" >
                                    Delete
                                </button>
                            </form>
                            @endif
                            @endif
                        </p>
            </div>
        @endforeach

    </div>
</div>
    <div class="float-right">
        <div class="bg-white/50 backdrop-blur-sm max-h-full flex grow-0 flex-col shadow-lg rounded p-1 m-1">
            @if(Auth::check())
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
            @endif
            @if(!Auth::check())
                <a href="{{route('login')}}">
                    <div class="text-center rounded p-2 m-1 hover:backdrop-blur-sm  hover:text-white/70 hover:bg-cyan-700/70">
                        <p class="text-xl">Login</p>
                    </div>
                </a>
                <a href="{{route('home')}}">
                    <div class="text-center rounded p-2 m-1 hover:backdrop-blur-sm  hover:text-white/70 hover:bg-cyan-700/70">
                        <p class="text-xl">Sign Up</p>
                    </div>
                </a>
            @endif
        </div>
    </div>
@endsection
