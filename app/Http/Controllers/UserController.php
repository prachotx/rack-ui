<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index(Request $request){
        $search=$request->search;
        $users=User::where('name','like','%'.$search.'%')
        ->orWhere('email','like','%'.$search.'%')
        ->orderByDesc('id')->paginate(10)->withQueryString();
        return view("user",compact(['users','search']));
    }
    function add()
    {
        $branches = Branch::all()->pluck('name', 'id')->toArray();
        return view('/add_user',compact('branches'));
    }
    function create(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required|min:8|confirmed',
            'role' => 'required',
            'branch_id' => 'required'
        ]);
        $data = [
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request['password']),
            'role' => $request->role,
            'branch_id' => $request->branch_id
        ];
        $user = User::create($data);
        return redirect('/users');
    }
    function edit($id)
    {
        $user = User::find($id);
        $branches = Branch::all()->pluck('name', 'id')->toArray();
        return view('/edit_user', compact(['user','branches']));
    }
    
    function update($id, Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'role' => 'required',
            'branch_id' => 'required'
        ]);
        $data = [
            'email' => $request->email,
            'name' => $request->name,
            'role' => $request->role,
            'branch_id' => $request->branch_id
        ];
        $user = User::find($id)->update($data);
        return redirect('/users');
    }
    
    function change_password($id)
    {
        $user = User::find($id);
        return view('/change_password', compact('user'));
    }
    
    function update_password($id, Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);
        $data = [
            'password' => Hash::make($request['password'])
        ];
        $user = User::find($id)->update($data);
        return redirect('/users');
    }
}
