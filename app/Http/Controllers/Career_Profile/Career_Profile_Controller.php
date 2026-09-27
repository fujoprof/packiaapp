<?php

namespace App\Http\Controllers\Career_Profile;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use App\Models\Education_Background;
use App\Models\Working_Experience;
use App\Models\Interested_Area;
use App\Models\Personal_Skill;
use App\Models\Success_Story;
use App\Models\Profile_Detail;
use Carbon\Carbon;

class Career_Profile_Controller extends Controller
{
    public function view_career_profile()
    {
         //
         $dashboard_controller = new DashboardController();
         $global_user_menus = $dashboard_controller->user_session_menus(); // Call the user_session_menus function
         $user_id = $dashboard_controller->user_identity(); // Call the user_identity function
 
         // Access the user and menus data from the result
         $users = $global_user_menus['user'];
         $menus = $global_user_menus['menus'];   

        //Select all education background data based on  (user_id) and bind to view
        //$education_backgrounds = Education_Background::where('user_id',$user_id)->get();

        $education_backgrounds = Education_Background::join('users', 'education__backgrounds.user_id', '=', 'users.id')
        ->where('users.id', $user_id)
        ->select('education__backgrounds.*')
        ->whereNull('education__backgrounds.deleted_at')
        ->get();

        //Select all working experience data based on  (user_id) and bind to view
        $working_experiences = Working_Experience::join('users', 'working__experiences.user_id', '=', 'users.id')
        ->where('users.id', $user_id)
        ->select('working__experiences.*')
        ->whereNull('working__experiences.deleted_at')
        ->get();

        //Select all Personal Skills data based on  (user_id) and bind to view
        $personal_skills = Personal_Skill::join('users', 'personal__skills.user_id', '=', 'users.id')
        ->where('users.id', $user_id)
        ->select('personal__skills.*')
        ->whereNull('personal__skills.deleted_at')
        ->get();

        //Select all interested area data based on  (user_id) and bind to view
        $interested_areas = Interested_Area::join('users', 'interested__areas.user_id', '=', 'users.id')
        ->where('users.id', $user_id)
        ->select('interested__areas.*')
        ->whereNull('interested__areas.deleted_at')
        ->get();

        //Select all working experience data based on  (user_id) and bind to view
        $profile_details = Profile_Detail::join('users', 'profile__details.user_id', '=', 'users.id')
        ->where('users.id', $user_id)
        ->select('profile__details.*')
        ->whereNull('profile__details.deleted_at')
        ->get();
      
        return view('Career_Profile.Career_Profile',compact('users','menus','education_backgrounds','working_experiences','personal_skills','interested_areas','profile_details'));
    }
}
