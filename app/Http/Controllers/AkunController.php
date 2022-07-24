<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index()
    {
        $data = [
            'users' => User::all()
        ];
        return view('akun.index', $data);
    }

    public function create()
    {
        return view('akun.create');
    }

    public function edit($id)
    {
        $data = [
            'user' => User::findOrFail($id)
        ];

        return view('akun.edit', $data);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'email' => 'email|required|unique:users,email',
            'password' => 'required',
            'name' => 'required'
        ]);

        $validate['password'] = bcrypt($request->password);

        User::create($validate);

        return redirect('admin/akun')->with('message', '<div class="alert alert-success">Update berhasil, password anda : <strong>' . $request->password . '</strong>!</div>');
    }

    public function update($id, Request $request)
    {
        $validate = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
            'name' => 'required'
        ]);

        $user = User::findOrFail($id);

        if (password_verify($validate['password'], $user->password)) {
            User::where('id', $user->id)->update([
                'email' => $request->email,
                'name' => $request->name,
            ]);

            return redirect('admin/akun')->with('message', '<div class="alert alert-success">Update berhasil!</div>');
        } else {
            return back()->with('message', '<div class="alert alert-danger">Password salah!</div>');
        }
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect('admin/akun')->with('message', '<div class="alert alert-success">Delete berhasil!</div>');
    }
}
