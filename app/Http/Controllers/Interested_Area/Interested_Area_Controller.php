<?php

namespace App\Http\Controllers\Interested_Area;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use App\Models\Interested_Area;
use Carbon\Carbon;

class Interested_Area_Controller extends Controller
{
    public function view_interested_area()
    {
        //
        $dashboard_controller = new DashboardController();
        $global_user_menus = $dashboard_controller->user_session_menus(); // Call the user_session_menus function
        $user_id = $dashboard_controller->user_identity(); // Call the user_identity function

        // Access the user and menus data from the result
        $users = $global_user_menus['user'];
        $menus = $global_user_menus['menus'];   

        //Select all working experience data based on  (user_id) and bind to view
        $interested_areas = Interested_Area::join('users', 'interested__areas.user_id', '=', 'users.id')
        ->where('users.id', $user_id)
        ->select('interested__areas.*')
        ->whereNull('interested__areas.deleted_at')
        ->get();
    
        //Select all deleted working experience data based on  (user_id) and bind to view
        $deleted_interested_areas = Interested_Area::join('users', 'interested__areas.user_id', '=', 'users.id')
        ->where('users.id', $user_id)
        ->select('interested__areas.*')
        ->onlyTrashed()
        ->get();
     
        return view('Interested_Area.Interested_Area',compact('users','menus','interested_areas','deleted_interested_areas'));
    }

    public function store_interested_area(Request $request)
    {
        // Validate the form data
        $request->validate([
            'Interested_Area' => 'required|string|max:255',
        ]);

        $dashboard_controller = new DashboardController();
        $user_id = $dashboard_controller->user_identity(); // Call the user_identity function

        // Use updateOrInsert to update or insert the working experience record
        Interested_Area::updateOrInsert(
            [
                'user_id' => $user_id,
                'expertise' => $request->input('Interested_Area'),
            ],
            [
                'expertise' => $request->input('Interested_Area'),
                'created_at' => Carbon::now(), // Set created_at to the current timestamp
            ]
        );
        // You can redirect to a success page or return a response as needed
        return redirect()->route('View-Interested_Area');
    }

    public function update_interested_area(Request $request){
        // Validate the form data
        $request->validate([
            'Interested_Area' => 'required|string|max:255',
        ]);

        $id = $request->input('user_id');
        $interestedarea = Interested_Area::find($id);

        // Update the personal skill record with the new data
        $interestedarea->expertise = $request->input('Interested_Area');
        // Add more fields as needed
        $interestedarea->save();
        // You can redirect to a success page or return a response as needed
        return redirect()->route('View-Interested_Area');
    }

    public function destroy_interested_area($trashid) 
    {
        $record = Interested_Area::find($trashid);
        $record->delete(); 
    }

    public function restore_interested_area($restoreid) 
    {
        $restore_record = Interested_Area::withTrashed()->find($restoreid);
        $restore_record->restore(); 
    }

    public function delete_interested_area($deleteid) 
    {
        $delete_record = Interested_Area::withTrashed()->find($deleteid);
        $delete_record->forceDelete();
    }
}
