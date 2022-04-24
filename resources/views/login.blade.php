@extends('layout.master')
@section('title', 'Login')
@section('content')
    <div class="grid place-items-center  h-[80vh] ">
        <div class="items-center justify-center backdrop-blur-sm shadow-lg rounded p-8 m-1 bg-white/50 ">
            <form id="loginForm" name="loginForm" action="{{route('verification')}}" method="POST">
                @csrf
                <p class="text-center text-3xl">Login</p>
                <input id="name" class="w-full text-base backdrop-blur-sm shadow-lg p-1 my-1 rounded bg-white/5 focus:outline-none focus:outline-white border-transparent border-2 focus:ring" name="name" placeholder="Username" required><br>
                <input id="password" class="w-full text-base backdrop-blur-sm shadow-lg p-1 my-1 rounded bg-white/5 focus:outline-none focus:outline-white border-transparent border-2 focus:ring" name="password" placeholder="Password" type="password" required><br>
                <input class="float-left text-center rounded p-2 my-1 hover:backdrop-blur-sm hover:text-white/70 hover:bg-cyan-700/70 bg-white/50" onclick="preventMultipleSubmit()" name="submit" type="submit" value="Login">
            </form>

            <form action="{{route('register')}}" method="GET">

                <input class="float-right text-center rounded p-2 -my-3 hover:backdrop-blur-sm hover:text-white/70 hover:bg-cyan-700/70 bg-white/50" onclick="this.hidden=true" value="Register" type="submit">
            </form>
            <p class="text-center -my-3 py-2">Or</p>
        </div>

    </div>

@endsection
<script>
    function preventMultipleSubmit(){
        var username = document.forms['loginForm']['name'].value;
        var password = document.forms['loginForm']['password'].value;
        var button = document.forms['loginForm']['submit'];
        if(username !== "" && password !== ""){
            button.hidden = true;
        }
    }
</script>
