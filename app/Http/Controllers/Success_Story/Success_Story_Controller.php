<?php

namespace App\Http\Controllers\Success_Story;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Success_Story;
use Carbon\Carbon;

class Success_Story_Controller extends Controller
{
    public function view_success_story()
    {
         //
         $dashboard_controller = new DashboardController();
         $global_user_menus = $dashboard_controller->user_session_menus(); // Call the user_session_menus function
         $user_id = $dashboard_controller->user_identity(); // Call the user_identity function
 
         // Access the user and menus data from the result
         $users = $global_user_menus['user'];
         $menus = $global_user_menus['menus'];   
 
         //Select all working experience data based on  (user_id) and bind to view
         $success_storys = Success_Story::join('users', 'success__stories.user_id', '=', 'users.id')
         ->where('users.id', $user_id)
         ->select('success__stories.*')
         ->whereNull('success__stories.deleted_at')
         ->get();
     
         //Select all deleted working experience data based on  (user_id) and bind to view
         $deleted_success_storys = Success_Story::join('users', 'success__stories.user_id', '=', 'users.id')
         ->where('users.id', $user_id)
         ->select('success__stories.*')
         ->onlyTrashed()
         ->get();
      
         return view('Success_Story.Success_Story',compact('users','menus','success_storys','deleted_success_storys'));
    }

    public function store_success_story(Request $request)
    {
        // Validate the form data
        $request->validate([
            'Title' => 'required|string',
            'Content' => 'required|string',
            'Image_Post' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $dashboard_controller = new DashboardController();
        $user_id = $dashboard_controller->user_identity(); // Call the user_identity function

        // Handle image upload if provided
        $imagePath = null;
        if ($request->hasFile('Image_Post')) {
            $image = $request->file('Image_Post');
            $image_name = $image->getClientOriginalName();
            $imagePath = 'success_story/' . now()->format('Y/m');
            $absolute_imagePath = 'success_story/' . now()->format('Y/m') . '/' . $image->getClientOriginalName();
            $image->move($imagePath, $image_name);
        }else{
            $imagePath = 'success_story/default';
            $absolute_imagePath = 'success_story/default/cover.jpg';
        }
        
        // Use updateOrInsert to update or insert the working experience record
        Success_Story::updateOrInsert(
            [
                'user_id' => $user_id,
                'title' => $request->input('Title'),
                'content' => $request->input('Content'),
                'image' => $absolute_imagePath,
            ],
            [
                'title' => $request->input('Title'),
                'content' => $request->input('Content'),
                'image' => $absolute_imagePath,
                'created_at' => Carbon::now(), // Set created_at to the current timestamp
            ]
        );

        // You can redirect to a success page or return a response as needed
        return redirect()->route('View-Success-Story');
    }

    public function update_post_image(Request $request){
        // Validate the form data
        $request->validate([
            'Image_Post' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $id = $request->input('user_id');
        $success_story = Success_Story::find($id);

        // Handle image upload if provided
        $imagePath = null;
        if ($request->hasFile('Image_Post')) {
            $image = $request->file('Image_Post');
            $image_name = $image->getClientOriginalName();
            $imagePath = 'success_story/' . now()->format('Y/m');
            $absolute_imagePath = 'success_story/' . now()->format('Y/m') . '/' . $image->getClientOriginalName();
            $image->move($imagePath, $image_name);
        }
    
        $success_story->image = $absolute_imagePath;
        // Add more fields as needed
        $success_story->save();
        // You can redirect to a success page or return a response as needed
        return redirect()->route('View-Success-Story');
    }

    public function update_success_story(Request $request){
        // Validate the form data
        $request->validate([
            'Title_Edit' => 'required|string',
            'Content_Edit' => 'required|string',
        ]);

        $id = $request->input('user_id');
        $editedsuccessstory = Success_Story::find($id);

        // Update the working experience record with the new data
        $editedsuccessstory->title = $request->input('Title_Edit');
        $editedsuccessstory->content = $request->input('Content_Edit');
        // Add more fields as needed
        $editedsuccessstory->save();
        // You can redirect to a success page or return a response as needed
        return redirect()->route('View-Success-Story');
    }

    public function destroy_success_story($trashid) 
    {
        $record = Success_Story::find($trashid);
        $record->delete(); 
    }

    public function restore_success_story($restoreid) 
    {
        $restore_record = Success_Story::withTrashed()->find($restoreid);
        $restore_record->restore(); 
    }

    public function delete_success_story($deleteid) 
    {
        $delete_record = Success_Story::withTrashed()->find($deleteid);
        $delete_record->forceDelete();
    }

}
