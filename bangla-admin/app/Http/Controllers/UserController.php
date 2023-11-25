<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getRoles($role)
    {
        $roles = [];
        if ($role == 'admin') {
            $roles = ['admin', 'publisher', 'editor', 'developer', 'desk_reporter', 'proofreader', 'representative'];
        } else if ($role == 'publisher') {
            $roles = ['editor', 'developer', 'desk_reporter', 'proofreader', 'representative'];
        } else if ($role == 'editor') {
            $roles = ['developer', 'desk_reporter', 'proofreader', 'representative'];
        } else if ($role == 'desk_reporter') {
            $roles = ['proofreader', 'representative'];
        }
        
        return $roles;
    }
    public function index()
    {
        $userList = User::where('id', '!=', Auth::user()->id)->orderBy('id', 'DESC')->get();
        $role = Auth::user()->role;
        $roles = $this->getRoles($role);

        return view('admin.user.index', compact('userList', 'roles'));
    }

    public function create()
    {
        $role = Auth::user()->role;
        $roles = $this->getRoles($role);

        return view('admin.user.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $role = Auth::user()->role;
        $roles = $this->getRoles($role);

        if (in_array($request->role, $roles)) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect('/admin/user/index');
    }

    public function delete($id)
    {
        $currentUser = Auth::user();
        $user = User::where('id', $id)->first();
        if ($id != 1 && $currentUser->id == 1) {
            $user->delete();
        }
        return redirect('/admin/user/index');
    }

    public function edit($id)
    {
        $role = Auth::user()->role;
        $roles = $this->getRoles($role);
        $user = User::select('id', 'role', 'name', 'email')->where('id', $id)->first();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string']
        ]);

        $role = Auth::user()->role;
        $roles = $this->getRoles($role);

        if (in_array($request->role, $roles)) {
            $user = User::where('id', $request->id)->first();
            $user->name = $request->name;
            $user->role = $request->role;
            $user->save();
        }

        return redirect('/admin/user/index');
    }

    public function profile()
    {
        $user = User::find(Auth::user()->id);
        return view('admin.profile.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        if ($request->password) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255']
            ]);
        }


        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return back();
    }
}
