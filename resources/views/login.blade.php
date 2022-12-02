@extends('layout')
@section('content')
<style>
        .main {
            height: 100vh;
        }
  
        .login-box {
            box-sizing: border-box;
            border-radius: 10px;
        }
    </style>
    <!-- introduction start -->
<div class="mybg align-items-center" style="display:grid;grid-template-columns: 50% 50%;">
    <div class="container ms-5"  >
        <div >
            <h1 class="title animate__animated animate__bounceInLeft">Organisir Harimu.</h1>
            <p class="description animate__animated animate__bounceInRight">To-do List adalah sebuah pengatur jadwal online yg gratis dan mudah digunakan yg bisa membantumu untuk mengatur waktumu. Buat hidup dan pekerjaanmu tetap terorganisir. Ayo coba sekarang.</p>
        </div>
    </div>
    
    <div class="main d-flex flex-column justify-content-center align-items-center">
    <div class="login-box p-5 shadow" style="width: 450px;">
        <h1 class="text-center">LOGIN</h1>
        <form action="{{route('login.auth')}}" method="POST">
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
            
            @if (session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            
            @if (session('notAllowed'))
            <script>
                    Swal.fire(
                'Anda belum Login',
                'because you havent logged in yet',
                'success'
                )
            </script>
            @endif
            @if (session('logout'))
            <script>
                    Swal.fire(
                'Anda Berhasil Logout',
                'why? :(',
                'warning'
                )
            </script>
            @endif
            <div>
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" autocomplete="off">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" autocomplete="off">
            </div>
            <div>
                <button class="form-control btn btn-success mt-3" type="submit" >Login</button>
                <a href="{{route('register')}}" class="form-control btn btn-success mt-3 text-decoration-underline" type="submit">Belum Punya Akun?</a>
            </div>
        </form>
    </div>
    <div style="width: 500px; text-align: center;">
</div>
<!-- introduction end -->

@endsection
