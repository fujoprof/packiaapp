<?php

namespace App\Http\Controllers\Working_Experience;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use App\Models\Working_Experience;
use Carbon\Carbon;

class Working_Experience_Controller extends Controller
{
    public function view_working_experience()
    {
         //
         $dashboard_controller = new DashboardController();
         $global_user_menus = $dashboard_controller->user_session_menus(); // Call the user_session_menus function
         $user_id = $dashboard_controller->user_identity(); // Call the user_identity function
 
         // Access the user and menus data from the result
         $users = $global_user_menus['user'];
         $menus = $global_user_menus['menus'];   
 
         //Select all working experience data based on  (user_id) and bind to view
         $working_experiences = Working_Experience::join('users', 'working__experiences.user_id', '=', 'users.id')
         ->where('users.id', $user_id)
         ->select('working__experiences.*')
         ->whereNull('working__experiences.deleted_at')
         ->get();
     
         //Select all deleted working experience data based on  (user_id) and bind to view
         $deleted_working_experiences = Working_Experience::join('users', 'working__experiences.user_id', '=', 'users.id')
         ->where('users.id', $user_id)
         ->select('working__experiences.*')
         ->onlyTrashed()
         ->get();
      
         return view('Working_Experience.Working_Experience',compact('users','menus','working_experiences','deleted_working_experiences'));
    }

    public function store_working_experience(Request $request)
    {
        // Validate the form data
        $request->validate([
            'Start_Year' => 'required|integer',
            'End_Year' => 'required|integer',
            'Working_Experience' => 'required|string|max:255',
        ]);

        $dashboard_controller = new DashboardController();
        $user_id = $dashboard_controller->user_identity(); // Call the user_identity function

        // Use updateOrInsert to update or insert the working experience record
        Working_Experience::updateOrInsert(
            [
                'user_id' => $user_id,
                'start_year' => $request->input('Start_Year'),
                'end_year' => $request->input('End_Year'),
                'organization' => $request->input('Working_Experience'),
            ],
            [
                'start_year' => $request->input('Start_Year'),
                'end_year' => $request->input('End_Year'),
                'organization' => $request->input('Working_Experience'),
                'created_at' => Carbon::now(), // Set created_at to the current timestamp
            ]
        );

        // You can redirect to a success page or return a response as needed
        return redirect()->route('View-Working-Experience');
    }

    public function update_working_experience(Request $request){
        // Validate the form data
        $request->validate([
            'Start_Year' => 'required|integer',
            'End_Year' => 'required|integer',
            'Working_Experience' => 'required|string|max:255',
        ]);

        $id = $request->input('user_id');
        $workingexperience = Working_Experience::find($id);

        // Update the working experience record with the new data
        $workingexperience->start_year = $request->input('Start_Year');
        $workingexperience->end_year = $request->input('End_Year');
        $workingexperience->organization = $request->input('Working_Experience');
        // Add more fields as needed
        $workingexperience->save();
        // You can redirect to a success page or return a response as needed
        return redirect()->route('View-Working-Experience');
    }
    
    public function destroy_working_experience($trashid) 
    {
        $record = Working_Experience::find($trashid);
        $record->delete(); 
    }

    public function restore_working_experience($restoreid) 
    {
        $restore_record = Working_Experience::withTrashed()->find($restoreid);
        $restore_record->restore(); 
    }

    public function delete_working_experience($deleteid) 
    {
        $delete_record = Working_Experience::withTrashed()->find($deleteid);
        $delete_record->forceDelete();
    }
}
