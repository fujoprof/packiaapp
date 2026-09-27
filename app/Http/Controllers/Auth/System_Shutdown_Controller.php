<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class System_Shutdown_Controller extends Controller
{
    public function system_shutdown()
    {
        // Check if the 'username' session exists
        if (Session::has('username')) {
            // Remove the 'username' session
            Session::forget('username');
            Session::forget('permissionId');
            
            return redirect()->route('login.create')->with('message', 'Logged out successfully');    
        }else{
            return redirect()->back();    
        }

    }
}
