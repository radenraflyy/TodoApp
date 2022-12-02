@extends('layout')
@section('content')
    @if (session('notAllowed'))
    <script>
            Swal.fire(
        'Anda Sudah Login',
        'because you are already logged in',
        'success'
        )
    </script>
    @endif
    @if (session('congrats'))
    <script>
            Swal.fire(
        'Welcome To Website Todo',
        'Semoga Bisa Membantu Kegiatan anda',
        'success'
        )
    </script>
    @endif
    @if (session('successEdit'))
    <script>
            Swal.fire(
        'Anda Berhasil Update Todo',
        'because you changed the Todo',
        'success'
        )
    </script>
    @endif
    @if (session('successDelete'))
    <script>
            Swal.fire(
        'Anda Berhasil Delete Todo',
        'because you deleted Todo',
        'error'
        )
    </script>
    @endif
    @if(Session::get('successAdd'))
        <script>
            Swal.fire(
        'Anda Berhasil Menambahkan Todo',
        'because you add data',
        'success'
        )
        </script>
    @endif
    
    
<section class="" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <nav aria-label="breadcrumb container">
          <ol class="breadcrumb ms-5">
              <i class='bx bxs-home mt-1 ms-5'></i>
              <li class="breadcrumb-item active ms-1" aria-current="page">Home / MyTodos</li>
          </ol>
      </nav>
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-12 col-xl-10">

        <div class="card w-auto">
          <div class="card-header p-3">
            <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>{{$todos->count()}} Task List</h5>
          </div>
          <div class="card-body" data-mdb-perfect-scrollbar="true">

            <table class="table mb-0">
              <thead>
                <tr>
                  <th scope="col">Title</th>
                  <th scope="col">Description</th>
                  <th scope="col">Date</th>
                  <th>Status</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($todos as $todo)
                <tr class="fw-normal">
                  <td class="align-middle">
                    <span>{{$todo->title}}</span>
                  </td>
                  <td class="max align-middle">
                    <span>{{$todo->description}}</span>
                  </td>
                  <td class="align-middle">
                    <h6 class="mb-0"><span class="badge bg-danger">
                      @if($todo['status'] == 1)
                      Selesai Pada : {{\Carbon\Carbon::parse($todo->done_time)->format('j F, Y') }}
                      @else
                      Target Selesai : {{\Carbon\Carbon::parse($todo->date)->format('j F, Y') }}
                    </span></h6>
                      @endif  
                  </td>
                  <td class="align-middle">
                    <span>{{$todo->status == 1? 'completed' : 'Proses'}}</span>
                  </td>
                  <td class="align-middle">
                    <a href="/edit/{{$todo->id}}"  data-mdb-toggle="tooltip" title="Edit"><i style="margin-bottom: -15px;"
                        class="fas fa-edit me-3 btn btn-success"></i></a>
                    {{-- <a href="#!" data-mdb-toggle="tooltip" title="Remove"><i
                        class="fas fa-trash-alt text-danger"></i></a> --}}
                    <form class="delete ms-5" action="/delete/{{$todo->id}}" method="POST">
                        @method("DELETE")
                        @csrf
                        <button type="submit" style="margin-top: -35px;" class="btn btn-danger" title="Remove" data-mdb-toggle="tooltip"><i
                        class="fas fa-trash-alt"></i></button>
                    </form>
                    @if($todo ['status'] == 1)
                      <span class="fas fa-circle-check btn btn-primary"></span>
                    @else
                    <form action="todo/update/{{$todo->id}}" method="POST">
                      @method('PATCH')
                      @csrf
                      <button style="margin-right: -90px;" type="submit" class="bi bi-hourglass-split btn btn-primary"></button>
                    </form>
                    @endif
                  </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
          <div class="card-footer text-end p-3">
            <a href="{{ route('todo.listtodo') }}" class="text-success">Create</a>
            {{-- <button class="btn btn-primary">Add Task</button> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
