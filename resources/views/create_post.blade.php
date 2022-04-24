@extends('layout.master')
@section('title','Post')
@section('content')
    @php
        use App\Models\User;
    @endphp
    <div class="flex flex-1">

            <div class="float-left flex flex-col flex-auto">
                <div class="float-left backdrop-blur-sm shadow-lg rounded p-2 m-1 my-10 bg-white/50">
                    <form id="postForm" name="postForm" action="{{route('post_validate')}}" method="POST">
                        @csrf
                        <input required class="w-full text-base flex-col backdrop-blur-sm shadow-lg my-1 rounded bg-white/5 focus:outline-none focus:outline-white border-transparent border-2 focus:ring" placeholder="Title of the post" name="post_title">
                        <textarea required class="w-full h-96 text-base resize-y flex flex-col my-1 backdrop-blur-sm shadow-lg rounded bg-white/5 focus:outline-none focus:outline-white border-transparent border-2 focus:ring" placeholder="Content of the post" name="post_content"></textarea>
                        <input onclick="preventMultipleSubmit()" name="submit" class="text-center rounded p-2 m-1 hover:backdrop-blur-sm hover:text-white/70 hover:bg-cyan-700/70 bg-white/50" type="submit" value="Submit">
                    </form>
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

@endsection
<script>
    function preventMultipleSubmit(){
        var post_title = document.forms['postForm']['post_title'].value;
        var post_content = document.forms['postForm']['post_content'].value;
        var button = document.forms['postForm']['submit'];
        if(post_title !== "" && post_content !== ""){
            button.hidden = true;
        }
    }
</script>
