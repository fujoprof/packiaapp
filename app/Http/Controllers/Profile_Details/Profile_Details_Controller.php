<?php

namespace App\Http\Controllers\Profile_Details;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use App\Models\Profile_Detail;
use App\Models\User;
use Carbon\Carbon;

class Profile_Details_Controller extends Controller
{
    public function view_profile_details()
    {
         //
         $dashboard_controller = new DashboardController();
         $global_user_menus = $dashboard_controller->user_session_menus(); // Call the user_session_menus function
         $user_id = $dashboard_controller->user_identity(); // Call the user_identity function
 
         // Access the user and menus data from the result
         $users = $global_user_menus['user'];
         $menus = $global_user_menus['menus'];   
 
         //Select all working experience data based on  (user_id) and bind to view
         $profile_details = Profile_Detail::join('users', 'profile__details.user_id', '=', 'users.id')
         ->where('users.id', $user_id)
         ->select('profile__details.*')
         ->whereNull('profile__details.deleted_at')
         ->get();
      
         return view('Profile_Detail.Profile_Detail',compact('users','user_id','menus','profile_details'));
    }

    public function edit_profile_image(Request $request){
        // Validate the form data
        $request->validate([
            'profile_image_data' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $id = $request->input('user_id');
        $user_data = User::find($id);

        // Handle image upload if provided
        $imagePath = null;
        if ($request->hasFile('profile_image_data')) {
            $image = $request->file('profile_image_data');
            $image_name = $image->getClientOriginalName();
            $imagePath = 'profile_details/' . now()->format('Y/m');
            $absolute_imagePath = 'profile_details/' . now()->format('Y/m') . '/' . $image->getClientOriginalName();
            $image->move($imagePath, $image_name);
        }
    
        $user_data->profile_image = $absolute_imagePath;
        // Add more fields as needed
        $user_data->save();
        // You can redirect to a success page or return a response as needed
        return redirect()->route('View-Profile-Details');
    }

    public function edit_profile_data(Request $request){
        // Validate the form data
        $request->validate([
            'Edit_Address' => 'required|string',
            'Phone_Number' => 'required|string',
        ]);

        $id = $request->input('user_id');
        $personal_details = User::find($id);

        // Update the working experience record with the new data
        $personal_details->address = $request->input('Edit_Address');
        $personal_details->phone_number = $request->input('Phone_Number');
        // Add more fields as needed
        $personal_details->save();
        // You can redirect to a success page or return a response as needed
        return redirect()->route('View-Profile-Details');
    }

    public function edit_biography_data(Request $request){
        // Validate the form data
        $request->validate([
            'Biography_Data' => 'required|string',
        ]);

        $id = $request->input('user_id');
        //$biography_data = Profile_Detail::find(1);
        $biography_data = Profile_Detail::where('user_id', $id)->first();

        // Update the working experience record with the new data
        $biography_data->biography = $request->input('Biography_Data');
        // Add more fields as needed
        $biography_data->save();
        // You can redirect to a success page or return a response as needed
        return redirect()->route('View-Profile-Details');
    }
}
