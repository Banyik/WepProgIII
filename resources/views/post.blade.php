@extends('layout.master')
@section('title', $id->post_title)
@section('content')
    @php
        use App\Models\User;
        use App\Models\Post;
        $record = $id->comment()->get();
    @endphp

    <a class="w-max p-1 rounded hover:backdrop-blur-sm hover:text-white/70 hover:bg-cyan-700/70 bg-white/50 m-1"  href="{{route('home')}}">Back</a>
    <div class="flex flex-1">
        <div class="h-[90vh] float-left flex flex-auto overflow-auto overflow-y-scroll">
            <div class="float-left flex flex-col flex-auto">
                <div class="float-left backdrop-blur-sm shadow-lg rounded p-2 m-1 bg-white/50">
                    <p class="text-3xl">{{$id->post_title}}</p>
                    <p class="text-sm">Author: <a class="hover:text-cyan-900 hover:underline"  href="{{route('user_site',$id->user_id)}}">{{$id->user->name}}</a> {{$id->created_at->format('Y-m-d')}}</p>
                    @if(Auth::check())
                        @if($id->user_id == Auth::id() || User::find(Auth::id())->auth->authentication == 9)
                            <form class="inline"  method="GET" action="{{route('post_edit', $id->id)}}">
                                @csrf
                                <button type="submit" class="mr-1 text-sm hover:text-cyan-900 hover:underline" >
                                    Edit
                                </button>
                            </form>
                            <form class="inline"  method="POST" action="{{route('delete_post', $id->id)}}">
                                @csrf
                                <button type="submit" class="mr-1 text-sm hover:text-cyan-900 hover:underline" >
                                    Delete
                                </button>
                            </form>
                        @endif
                    @endif
                </div>

                <div class=" float-left backdrop-blur-sm shadow-lg rounded p-2 m-1 bg-white/50">
                    <?php
                    echo $text = $id->post;
                    $hasFile = false;
                    try {
                        $content = $id->postFile->file;
                        $hasFile = true;
                    }
                    catch (Exception $e){

                    }
                    ?>
                    @if ($hasFile)
                        <img src={{asset('uploads/'.$content )}}/>
                    @endif
                </div>
                <a class="w-max p-1 rounded hover:backdrop-blur-sm hover:text-white/70 hover:bg-cyan-700/70 bg-cyan-300/70 m-1"  href="{{route('post_raw',$id->id)}}">Open as PDF</a>


                <div class="float-left flex flex-col">
                    <div class="h-[80vh] flex-auto overflow-auto overflow-y-scroll backdrop-blur-sm shadow-lg rounded p-2 m-1 my-10 bg-white/50">
                        <p class="mx-1.5">Comments</p>
                        <form name="commentForm" action="{{route('post_comment', $id->id)}}" method="POST">
                            @csrf
                            <textarea required class="w-full h-max text-base resize-y flex flex-col m-1 backdrop-blur-sm shadow-lg rounded bg-white/5 focus:outline-none focus:outline-white border-transparent border-2 focus:ring" placeholder="Write your comment here!" name="comment"></textarea>
                            <input id="comment_" class="text-center rounded p-2 m-1 hover:backdrop-blur-sm hover:text-white/70 hover:bg-cyan-700/70 bg-white/50" name="comment_" type="submit" value="Submit" onclick="preventMultipleSubmit()">
                        </form>


                        <div class="float-left flex flex-col w-full">
                            @foreach($record as $item)
                                    <div class="inline float-right backdrop-blur-md shadow-lg rounded p-2 m-1 bg-white/50">

                                        <p class="text-xl">
                                                {{$item->comment_post}}
                                            </a>
                                        </p>

                                        <p class="text-sm mr-1">
                                            <a
                                                class="-mt-1 hover:text-cyan-900 hover:underline" href="{{route('user_site', $item->user_id)}}">
                                                {{$item->user->name}}</a> {{$item->created_at->format('Y-m-d')}}
                                        @if(Auth::check())
                                            @if($item->user->id == Auth::id() || User::find(Auth::id())->auth->authentication == 9)
                                                <form class="inline"  method="POST" action="{{route('delete_comment', $item->id)}}">
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
                </div>
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






    </div>


@endsection


<script>
    function preventMultipleSubmit(){
        var comment = document.forms['commentForm']['comment'].value;
        var button = document.forms['commentForm']['comment_'];
        if(comment !== ""){
            button.hidden = true;
        }
    }
</script>
