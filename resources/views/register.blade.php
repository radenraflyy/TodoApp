@extends('layout')
@section('content')
@endsection
<style>
    .master {
        height: 100vh;
    }

    .register-box {
        box-sizing: border-box;
        border-radius: 10px;
    }
</style>

<div class="master d-flex flex-column justify-content-center align-items-center">
    <div class="register-box p-5 shadow w-50">
        <h1 class="text-center">REGISTER</h1>
        <form action="{{route('register.input')}}" method="POST">
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div>
                <label for="nama lengkap">Nama Lengkap</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <div>
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username">
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div>
                <button class="form-control btn btn-success mt-3" type="submit" name="loginbtn">Register</button>
                <a href="/">Sudah Punya Akun?</a>
            </div>
        </form>
    </div>
    <div style="width: 500px; text-align: center;">