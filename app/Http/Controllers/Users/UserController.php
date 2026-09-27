<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_management_view()
    {
        $dashboard_controller = new DashboardController();
        $global_user_menus = $dashboard_controller->user_session_menus(); // Call the user_session_menus function
        $user_id = $dashboard_controller->user_identity(); // Call the user_identity function

        // Access the user and menus data from the result
        $users = $global_user_menus['user'];
        $menus = $global_user_menus['menus'];  

        //$users_list = User::all();

        // Get list of alumni with active account
        $alumnis = User::join('user__permissions', 'users.id', '=', 'user__permissions.user_id')
        ->join('permissions', 'permissions.id', '=', 'user__permissions.permission_id')
        ->where('permissions.id', '=', 2)
        ->select('users.*', 'users.id as userId')
        ->get();

        // Get list of alumni with suspended account
        $trashed_alumnis = User::join('user__permissions', 'users.id', '=', 'user__permissions.user_id')
        ->join('permissions', 'permissions.id', '=', 'user__permissions.permission_id')
        ->where('permissions.id', '=', 2)
        ->select('users.*', 'users.id as userId')
        ->onlyTrashed()
        ->get();
         
        //$users_trashed = User::onlyTrashed()->get();
        
        return view('users.user-administration',compact('users','menus','alumnis','trashed_alumnis'));
    }

    public function suspend_alumni_account($trashid) 
    {
        $record = User::find($trashid);
        $record->delete(); 
    }

    public function activate_alumni_account($restoreid) 
    {
        $restore_record = User::withTrashed()->find($restoreid);
        $restore_record->restore(); 
    }

    public function delete_alumni_account($deleteid) 
    {
       //$delete_record = User::withTrashed()->find($deleteid);
        //$delete_record->forceDelete();

        // Assuming you have the user ID you want to delete in the $deleteid variable
        $userIdToDelete = $deleteid;

        // Check if there are any references in the "user__permissions" table
        $referencesExist = DB::table('user__permissions')->where('user_id', $userIdToDelete)->exists();

        if ($referencesExist) {
            // If references exist, you should delete them first
            DB::table('user__permissions')->where('user_id', $userIdToDelete)->delete();
        }

        // Now, you can safely delete the user
        $delete_record = User::withTrashed()->find($userIdToDelete);
        $delete_record->forceDelete();
    }

    public function update_alumni_password(Request $request){
        // Validate the form data
        $request->validate([
            'New_Password' => 'required|string|max:255',
        ]);

        $id = $request->input('user_id');
        $newpassword = User::find($id);

        // Update the personal skill record with the new data
        $newpassword->password = $request->input('New_Password');
        // Add more fields as needed
        $newpassword->save();
        // You can redirect to a success page or return a response as needed
        return redirect()->route('User-Management');
    }

    public function uploadUsers(Request $request)
	{
		Excel::import(new UsersImport, $request->file);

		return redirect()->back()->with('bulk_success_message', 'All records are Imported Successfully');
	}
	
	public function exportUsers()
	{
		return Excel::download(new UsersExport, 'Alimni_List.csv');
	}
	
}
