<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Education_Background\Education_Background_Controller;
use App\Http\Controllers\Working_Experience\Working_Experience_Controller;
use App\Http\Controllers\Personal_Skill\Personal_Skill_Controller;
use App\Http\Controllers\Interested_Area\Interested_Area_Controller;
use App\Http\Controllers\Success_Story\Success_Story_Controller;
use App\Http\Controllers\Career_Profile\Career_Profile_Controller;
use App\Http\Controllers\Profile_Details\Profile_Details_Controller;
use App\Http\Controllers\Auth\System_Shutdown_Controller;
use App\Http\Controllers\Public_Pages\Public_Success_Story_Controller;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('auth/login');
    return view('index/index');
});

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/register',RegisterController::class);
Route::post('/create',[RegisterController::class,'register_user']);
Route::post('/duplicate-user',[RegisterController::class,'duplicate_user']);

//get all registered users
Route::post('/view-registered-users',[UserController::class,'getUserData']);
Route::post('/view-trashed-users',[UserController::class,'getUserTrashedData']);

Route::resource('/login',LoginController::class);
Route::resource('/forget-password',ForgetPasswordController::class);

Route::resource('/dashboard',DashboardController::class);
Route::resource('/user-administration',UserController::class);
Route::delete('/mult-user-deletion',[UserController::class,'deleteMultiple']);
Route::delete('/mult-user-restoration',[UserController::class,'restoreMultiple']);

Route::post('users-import', [UserController::class, 'uploadUsers'])->name('users-import');
Route::get('users-export', [UserController::class, 'exportUsers'])->name('users-export');

//Socialite login with google accounts
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

//Start Education Background
Route::get('Education_Background',[Education_Background_Controller::class, 'view_education_background'])->name('Education-Background');
Route::post('Create_Education_Background', [Education_Background_Controller::class, 'store_education_background'])->name('Create-Education-Background');
Route::post('Update_Education_Background', [Education_Background_Controller::class, 'update_education_background'])->name('Update-Education-Background');
Route::get('Destroy_Education_Background/{trashid}', [Education_Background_Controller::class, 'destroy_education_background'])->name('Destroy-Education-Background');
Route::get('Restore_Education_Background/{restoreid}', [Education_Background_Controller::class, 'restore_education_background'])->name('Restore-Education-Background');
Route::get('Delete_Education_Background/{deleteid}', [Education_Background_Controller::class, 'delete_education_background'])->name('Delete-Education-Background');
//End Education Background

//Start Working Experience
Route::get('View_Working_Experience',[Working_Experience_Controller::class, 'view_working_experience'])->name('View-Working-Experience');
Route::post('Create_Working_Experience', [Working_Experience_Controller::class, 'store_working_experience'])->name('Create-Working-Experience');
Route::post('Update_Working_Experience', [Working_Experience_Controller::class, 'update_working_experience'])->name('Update-Working-Experience');
Route::get('Destroy_Working_Experience/{trashid}', [Working_Experience_Controller::class, 'destroy_working_experience'])->name('Destroy-Working-Experience');
Route::get('Restore_Working_Experience/{restoreid}', [Working_Experience_Controller::class, 'restore_working_experience'])->name('Restore-Working-Experience');
Route::get('Delete_Working_Experience/{deleteid}', [Working_Experience_Controller::class, 'delete_working_experience'])->name('Delete-Working-Experience');
//End Working Experience

//Start Personal Skills
Route::get('View_Personal_Skill',[Personal_Skill_Controller::class, 'view_personal_skill'])->name('View-Personal-Skill');
Route::post('Create_Personal_Skill', [Personal_Skill_Controller::class, 'store_personal_skill'])->name('Create-Personal-Skill');
Route::post('Update_Personal_Skill', [Personal_Skill_Controller::class, 'update_personal_skill'])->name('Update-Personal-Skill');
Route::get('Destroy_Personal_Skill/{trashid}', [Personal_Skill_Controller::class, 'destroy_personal_skill'])->name('Destroy-Personal-Skill');
Route::get('Restore_Personal_Skill/{restoreid}', [Personal_Skill_Controller::class, 'restore_personal_skill'])->name('Restore-Personal-Skill');
Route::get('Delete_Personal_Skill/{deleteid}', [Personal_Skill_Controller::class, 'delete_personal_skill'])->name('Delete-Personal-Skill');
//End Personal Skills

//Start Interested Area
Route::get('View_Interested_Area',[Interested_Area_Controller::class, 'view_interested_area'])->name('View-Interested_Area');
Route::post('Create_Interested_Area', [Interested_Area_Controller::class, 'store_interested_area'])->name('Create-Interested_Area');
Route::post('Update_Interested_Area', [Interested_Area_Controller::class, 'update_interested_area'])->name('Update-Interested_Area');
Route::get('Destroy_Interested_Area/{trashid}', [Interested_Area_Controller::class, 'destroy_interested_area'])->name('Destroy-Interested_Area');
Route::get('Restore_Interested_Area/{restoreid}', [Interested_Area_Controller::class, 'restore_interested_area'])->name('Restore-Interested_Area');
Route::get('Delete_Interested_Area/{deleteid}', [Interested_Area_Controller::class, 'delete_interested_area'])->name('Delete-Interested_Area');
//End Interested Area

//Start Success Story
Route::get('View_Success_Story',[Success_Story_Controller::class, 'view_success_story'])->name('View-Success-Story');
Route::post('Create_Success_Story', [Success_Story_Controller::class, 'store_success_story'])->name('Create-Success-Story');
Route::post('Update_Post_Image', [Success_Story_Controller::class, 'update_post_image'])->name('Update-Post-Image');
Route::post('Update_Success_Story', [Success_Story_Controller::class, 'update_success_story'])->name('Update-Success-Story');
Route::get('Destroy_Success_Story/{trashid}', [Success_Story_Controller::class, 'destroy_success_story'])->name('Destroy-Success-Story');
Route::get('Restore_Success_Story/{restoreid}', [Success_Story_Controller::class, 'restore_success_story'])->name('Restore-Success-Story');
Route::get('Delete_Success_Story/{deleteid}', [Success_Story_Controller::class, 'delete_success_story'])->name('Delete-Success-Story');
//End Success Story

//Start of Career Profile
Route::get('View_Career_Profile',[Career_Profile_Controller::class, 'view_career_profile'])->name('View-Career-Profile');
//End of Career Profile

//Start of Profile Details
Route::get('View_Profile_Details',[Profile_Details_Controller::class, 'view_profile_details'])->name('View-Profile-Details');
Route::post('Edit_Profile_Image',[Profile_Details_Controller::class, 'edit_profile_image'])->name('Edit-Profile-Image');
Route::post('Edit_Profile_Data',[Profile_Details_Controller::class, 'edit_profile_data'])->name('Edit-Profile-Data');
Route::post('Edit_Biography_Data',[Profile_Details_Controller::class, 'edit_biography_data'])->name('Edit-Biography-Data');
//End of Profile Details

//Implement logout session
Route::get('System_Shutdown',[System_Shutdown_Controller::class, 'system_shutdown'])->name('System-Shutdown');
//End Implement logout session

//Start User management panel
Route::get('User_Management',[UserController::class, 'user_management_view'])->name('User-Management');
Route::get('Suspend_Alumni_Account/{trashid}', [UserController::class, 'suspend_alumni_account'])->name('Suspend-Alumni-Account');
Route::get('Activate_Alumni_Account/{restoreid}', [UserController::class, 'activate_alumni_account'])->name('Activate-Alumni-Account');
Route::get('Delete_Alumni_Account/{deleteid}', [UserController::class, 'delete_alumni_account'])->name('Delete-Alumni-Account');
Route::post('Update_Alumni_Password', [UserController::class, 'update_alumni_password'])->name('Update-Alumni-Password');
//End User management panel

//Start public pages
Route::get('View_Alumin_Stories',[Public_Success_Story_Controller::class, 'view_alumin_stories'])->name('View-Alumin-Stories');
//End public pages

Route::post('users-import', [UserController::class, 'uploadUsers'])->name('users-import');
Route::get('users-export', [UserController::class, 'exportUsers'])->name('users-export');
