<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Globals\global_subroutine;
use App\Models\User;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Start of super global function for user session and menu
    public function user_session_menus()
    {
        $username = session()->get('username');
        $permissionId = session()->get('permissionId');

        // Fetch user data
        $user = DB::select("SELECT * FROM `users` 
            JOIN user__permissions
            ON users.id = user__permissions.user_id
            JOIN permissions
            ON permissions.id = user__permissions.permission_id 
            WHERE users.email = '$username'");

        // Fetch menu data
        $menus = DB::select("SELECT * FROM `menus` 
            JOIN menu__permissions
            ON menu__permissions.menu_id = menus.id
            JOIN permissions
            ON permissions.id = menu__permissions.permission_id
            WHERE permissions.id = '$permissionId' AND menus.menu_status = 1 ORDER BY menus.id ASC");
        // Create an object or an array to hold both user and menu data
        $result = [
            'user' => $user,
            'menus' => $menus,
        ];

        return $result;
    }

    public function user_identity(){
        $username = session()->get('username');
        // Query the 'users' table to get the user based on the username
        $user = User::where('email', $username)->select('id')->first();
        return $user->id;
    }
    //End of super global function for user session and menu

    public function index()
    {
        $data = $this->user_session_menus(); // Call the user_session_menus function

        // Access the user and menus data from the result
        $users = $data['user'];
        $menus = $data['menus'];     
        
        return view('dashboard',compact('users','menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
