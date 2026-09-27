<?php

namespace App\Http\Controllers\Personal_Skill;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use App\Models\Personal_Skill;
use Carbon\Carbon;

class Personal_Skill_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view_personal_skill()
     {
         //
         $dashboard_controller = new DashboardController();
         $global_user_menus = $dashboard_controller->user_session_menus(); // Call the user_session_menus function
         $user_id = $dashboard_controller->user_identity(); // Call the user_identity function
 
         // Access the user and menus data from the result
         $users = $global_user_menus['user'];
         $menus = $global_user_menus['menus'];   
 
         //Select all working experience data based on  (user_id) and bind to view
         $personal_skills = Personal_Skill::join('users', 'personal__skills.user_id', '=', 'users.id')
         ->where('users.id', $user_id)
         ->select('personal__skills.*')
         ->whereNull('personal__skills.deleted_at')
         ->get();
     
         //Select all deleted working experience data based on  (user_id) and bind to view
         $deleted_personal_skills = Personal_Skill::join('users', 'personal__skills.user_id', '=', 'users.id')
         ->where('users.id', $user_id)
         ->select('personal__skills.*')
         ->onlyTrashed()
         ->get();
      
         return view('Personal_Skill.Personal_Skill',compact('users','menus','personal_skills','deleted_personal_skills'));
     }

    public function store_personal_skill(Request $request)
    {
        // Validate the form data
        $request->validate([
            'Personal_Skill' => 'required|string|max:255',
        ]);

        $dashboard_controller = new DashboardController();
        $user_id = $dashboard_controller->user_identity(); // Call the user_identity function

        // Use updateOrInsert to update or insert the working experience record
        Personal_Skill::updateOrInsert(
            [
                'user_id' => $user_id,
                'skill' => $request->input('Personal_Skill'),
            ],
            [
                'skill' => $request->input('Personal_Skill'),
                'created_at' => Carbon::now(), // Set created_at to the current timestamp
            ]
        );
        // You can redirect to a success page or return a response as needed
        return redirect()->route('View-Personal-Skill');
    }

    public function update_personal_skill(Request $request){
        // Validate the form data
        $request->validate([
            'Personal_Skill' => 'required|string|max:255',
        ]);

        $id = $request->input('user_id');
        $personalskill = Personal_Skill::find($id);

        // Update the personal skill record with the new data
        $personalskill->skill = $request->input('Personal_Skill');
        // Add more fields as needed
        $personalskill->save();
        // You can redirect to a success page or return a response as needed
        return redirect()->route('View-Personal-Skill');
    }

    public function destroy_personal_skill($trashid) 
    {
        $record = Personal_Skill::find($trashid);
        $record->delete(); 
    }

    public function restore_personal_skill($restoreid) 
    {
        $restore_record = Personal_Skill::withTrashed()->find($restoreid);
        $restore_record->restore(); 
    }

    public function delete_personal_skill($deleteid) 
    {
        $delete_record = Personal_Skill::withTrashed()->find($deleteid);
        $delete_record->forceDelete();
    }
    
}
