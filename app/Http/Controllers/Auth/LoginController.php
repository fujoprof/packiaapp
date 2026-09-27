<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Permission;
use App\Models\User_Permission;
use DB;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //return "is working";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       return view('auth/login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //return $request;
        //$users = User::where('email','=',$request->email)->get();
        //return $users;

        $user = User::select('users.*', 'permissions.permission_name','permissions.id AS permissionId')
            ->join('user__permissions', 'users.id', '=', 'user__permissions.user_id')
            ->join('permissions', 'user__permissions.permission_id', '=', 'permissions.id')
            ->where('email', $request->email)->first();

        $coordinator = false;
        $administrator = false;
        $alumni = false;

        if ($user && Hash::check($request->password, $user->password)) {
            session(['username' => $request->email]);
            session(['permissionId' => $user->permissionId]);

            if ($user->permission_name == 'Co-ordinator') {
                $coordinator = true;
            } elseif ($user->permission_name == 'Administrator') {
                $administrator = true;
            } elseif ($user->permission_name == 'Alumni') {
                $alumni = true;
            }
        }
        

        if ($coordinator) {
            return redirect()->route('User-Management')->with('message', 'Login Successful');
            //return redirect()->route('coordinator.dashboard'); // Replace with your coordinator dashboard route.
        } elseif ($administrator) {
            return redirect()->route('dashboard.index')->with('message', 'Login Successful');
            //return redirect()->route('admin.dashboard'); // Replace with your administrator dashboard route.
        } elseif ($alumni) {
            return redirect()->route('View-Profile-Details')->with('message', 'Login Successful');
        } else {
            return redirect()->route('login.create')->with('message', 'Login Unsuccessful');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
