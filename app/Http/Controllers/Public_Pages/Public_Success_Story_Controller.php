<?php

namespace App\Http\Controllers\Public_Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class Public_Success_Story_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view_alumin_stories()
    {
        $dashboard_controller = new DashboardController();
        $global_user_menus = $dashboard_controller->user_session_menus(); // Call the user_session_menus function
        $user_id = $dashboard_controller->user_identity(); // Call the user_identity function

        // Access the user and menus data from the result
        $users = $global_user_menus['user'];
        $menus = $global_user_menus['menus'];   
     
        return view('Alumni_Story.view_alumni_story',compact('users','menus'));
   }
}
