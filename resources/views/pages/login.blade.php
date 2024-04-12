@extends('layout.login')

@section('title', "Login")

@section('content')
        @include("component.erorr")
        <div class="modal" style="visibility: inherit; opacity: 1; transform: matrix(1, 0, 0, 1, -150, -160);">
    
            <div class="circle" style="https: //s3-us-west-2.amazonaws.com/s.cdpn.io/9589/0+%281%29.jfif"></div>
            <div class="login">
            <h1>Login</h1>
            <form method="POST" action="{{ route('auth.login') }}" >
                @csrf
                <input type="text" name="email" placeholder="Username" >
                <input type="password" name="password" placeholder="Password" >
                <button class="btn btn-primary btn-block btn-large" type="submit">Let me in.</button>
            </form>
            </div>
        </div>
@endsection