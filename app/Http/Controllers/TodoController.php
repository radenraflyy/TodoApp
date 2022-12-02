<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('register');
    }
    public function index()
    {
        return view('login');
    }

    

    public function dashboard()
    {
        return view('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('logout', 'Anda Berhasil Logout');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('listtodo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerAccount(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required', //'|email:dns'
            'username' => 'required|min:4|max:15|unique:users',
            'password' => 'required|min:4',
            'name' => 'required|min:3',
        ]);

        // input data ke db
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // redirect kemana setelah berhasil
        return redirect('/')->with('success', 'Berhasil menambahkan akun! silahkan login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ], [
            'username.exists' => 'username ini belum tersedia',
            'username.required' => 'username ini harus di isi',
            'password.required' => 'password ini harus di isi',
        ]);
        $user = $request->only('username', 'password');
        if (Auth::attempt($user)) {
            return redirect()->route('todo.index')->with('congrats', 'Berhasil Login');;
        } else {
            return redirect()->back()->with('eror', 'gagal login, silahkan cek dan coba lagi');
        }
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:5',
        ]);

        Todo::create([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('todo.index')->with('successAdd', 'Berhasil Menambahkan Todo!');
    }

     public function home()
    {
        // $todos =  Todo::all(); 
        $todos = Todo::where('user_id', '=', Auth::user()->id)->get();
        return view('create', compact('todos')); // compact ini berfungsi untuk melempar variable products yang isinya itu adalah data data yang ada di database ke view product
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todoe = Todo::findOrFail($id); 
        return view('edit', compact('todoe'));
    }

    public function update(Request $request, $id)
    {
        Todo::findOrFail($id)->update($request->all());
        return redirect()->route('todo.index')->with('successEdit', 'Berhasil Mengupdate Todo!');
    }
    
    public function completed(){
        return view('completed');
    }

    public function updateCompleted($id){
        Todo::where('id', $id)->update([
            'status' => 1,
            'done_time' => \Carbon\Carbon::now(),
        ]);
        return redirect()->back()->with('done', 'Todo telah selesai dikerjakan');
    }

    public function destroy($id)
    {
        // Todo::where('id', '=', $id)->delete();
        Todo::destroy($id);
        return back()->with('successDelete', 'Anda berhasil menghapus Todo.');
    }
}
