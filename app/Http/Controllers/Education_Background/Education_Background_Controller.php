<?php

namespace App\Http\Controllers\Education_Background;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use App\Models\Education_Background;
use Carbon\Carbon;

class Education_Background_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view_education_background()
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

        //Select all deleted education background data based on  (user_id) and bind to view
        //$deleted_education_backgrounds = Education_Background::where('user_id',$user_id)->onlyTrashed()->get();

        //Select all working experience data based on  (user_id) and bind to view
        $education_backgrounds = Education_Background::join('users', 'education__backgrounds.user_id', '=', 'users.id')
        ->where('users.id', $user_id)
        ->select('education__backgrounds.*')
        ->whereNull('education__backgrounds.deleted_at')
        ->get();
    
        //Select all deleted working experience data based on  (user_id) and bind to view
        $deleted_education_backgrounds = Education_Background::join('users', 'education__backgrounds.user_id', '=', 'users.id')
        ->where('users.id', $user_id)
        ->select('education__backgrounds.*')
        ->onlyTrashed()
        ->get();

        return view('Education_Background.Education_Background',compact('users','menus','education_backgrounds','deleted_education_backgrounds'));
    }
    public function store_education_background(Request $request)
    {
        // Validate the form data
        $request->validate([
            'Start_Year' => 'required|integer',
            'End_Year' => 'required|integer',
            'Education_Qualification' => 'required|string|max:255',
        ]);

        $dashboard_controller = new DashboardController();
        $user_id = $dashboard_controller->user_identity(); // Call the user_identity function

        // Use updateOrInsert to update or insert the education background record
        Education_Background::updateOrInsert(
            [
                'user_id' => $user_id,
                'start_year' => $request->input('Start_Year'),
                'end_year' => $request->input('End_Year'),
                'qualification' => $request->input('Education_Qualification'),
            ],
            [
                'start_year' => $request->input('Start_Year'),
                'end_year' => $request->input('End_Year'),
                'qualification' => $request->input('Education_Qualification'),
                'created_at' => Carbon::now(), // Set created_at to the current timestamp
            ]
        );

        // You can redirect to a success page or return a response as needed
        return redirect()->route('Education-Background');
    }
    
    public function update_education_background(Request $request){
        // Validate the form data
        $request->validate([
            'Start_Year' => 'required|integer',
            'End_Year' => 'required|integer',
            'Education_Qualification' => 'required|string|max:255',
        ]);

        $id = $request->input('user_id');
        $educationBackground = Education_Background::find($id);

        // Update the education background record with the new data
        $educationBackground->start_year = $request->input('Start_Year');
        $educationBackground->end_year = $request->input('End_Year');
        $educationBackground->qualification = $request->input('Education_Qualification');
        // Add more fields as needed
        $educationBackground->save();
        // You can redirect to a success page or return a response as needed
        return redirect()->route('Education-Background');
    }

    public function destroy_education_background($trashid) {
        $record = Education_Background::find($trashid);
        $record->delete(); 
    }

    public function restore_education_background($restoreid) {
        $restore_record = Education_Background::withTrashed()->find($restoreid);
        $restore_record->restore(); 
    }

    public function delete_education_background($deleteid) {
        $delete_record = Education_Background::withTrashed()->find($deleteid);
        $delete_record->forceDelete();
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
