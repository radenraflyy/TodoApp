@extends('layout')
@section('content')
    <div class="container content">  
    <nav aria-label="breadcrumb container" style="margin-top: 30px; margin-bottom:-50px; margin-left: -80px;">
        <ol class="breadcrumb">
            <i class='bx bxs-home mt-1'></i>
            <li class="breadcrumb-item active ms-1" aria-current="page">Home / EditTodos</li>
        </ol>
    </nav>

    <div class="mt-5" style="width: 150%; margin-left: -80px;">
        <form class="form-create mb-4" action="/todo/update/{{$todoe->id}}" method="POST">
        @csrf
            @method("PATCH")
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h1 class="text-center mb-4">Edit Todo</h1>
            <div class="form-group">
                <label for="">Title</label>
                <input value="{{$todoe->title}}" placeholder="title of todo" type="text" class="form-control" name="title">
            </div>
            <div class="form-group">
                <label for="">Targer Date</label>
                <input value="{{$todoe->date}}" type="date" class="form-control" name="date">
            </div>
            <div class="form-group">
                <label for="">Description</label><br>
            <textarea value="{{$todoe->description}}" style="width: 100%;" placeholder="Type your descriptions here..." tabindex="5" name="description"></textarea>
            </div>
            <button type="submit" id="btn-submit" class="btn btn-primary mt-3">Submit</button>
            <a href="/todo/" class="btn btn-danger mt-2" id="btn-submit">Cancel</a>
        </form>
    </div>
@endsection