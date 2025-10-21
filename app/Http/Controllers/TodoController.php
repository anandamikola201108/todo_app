<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::where('user_id', Auth::user()->id)->get();
        return view('dashboard.index', compact('todos'));
    }

    public function create()
    {
        return view('dashboard.create');
    }

    public function store(Request $request)
    {
        // Validasi form
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required|date',
            'description' => 'required|min:8'
        ]);

        // Simpan ke database
        Todo::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'status' => 0,
        ]);

        return redirect()->route('todo.index')->with('addTodo', 'Berhasil menambahkan data Todo!');
    }

    public function edit($id)
    {
        $todo = Todo::where('id', $id)->first();
        return view('dashboard.edit', compact('todo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required|date',
            'description' => 'required|min:8'
        ]);

        Todo::where('id', $id)->update([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'status' => 0,
        ]);

        return redirect()->route('todo.index')->with('successUpdate', 'Berhasil mengubah data!');
    }

    public function destroy($id)
    {
        Todo::where('id', $id)->delete();
        return redirect()->route('todo.index')->with('successDelete', 'Berhasil menghapus data Todo!');
    }

    public function login()
    {
        return view('dashboard.login');
    }

    public function register()
    {
        return view('dashboard.Register');
    }

    public function registerAccount(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'username' => 'required|min:4|max:8',
            'password' => 'required|min:4',
            'name' => 'required|min:3',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/')->with('success', 'Berhasil menambahkan akun! Silakan login.');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required'
        ], [
            'username.exists' => "Username tidak ditemukan."
        ]);

        $user = $request->only('username', 'password');
        if (Auth::attempt($user)) {
            return redirect()->route('todo.index');
        } else {
            return redirect('/')->with('fail', "Gagal login, periksa kembali username dan password.");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function updateToCompleted($id)
    {
        Todo::where('id', $id)->update([
            'status' => 1,
            'done_time' => \Carbon\Carbon::now(),
        ]);
    
        return redirect()->back()->with('done', 'Todo telah selesai dikerjakan!');
    }
    
}
