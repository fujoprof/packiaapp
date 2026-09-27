<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
      
            $user = Socialite::driver('google')->user();
       
            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser){
       
                Auth::login($finduser);
      
                return redirect()->intended('dashboard');
       
            }else{
                
				$user = Socialite::driver('google')->stateless()->user();

				// Extract the user's profile details
				$google_id = $user->getId();
				$first_name = $user->user['given_name'];
				$middle_name = "default";
				$password = "123";
				$last_name = $user->user['family_name'];
				$email = $user->getEmail();
				
				// Insert the user's profile details into your database
				$newUser = new User;
				$newUser->google_id = $google_id;
				$newUser->first_name = $first_name;
				$newUser->middle_name = $middle_name;
				$newUser->last_name = $last_name;
				$newUser->email = $email;
				$newUser->password = $password;
				$newUser->save();
      
                Auth::login($newUser);
      
                return redirect()->intended('dashboard');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}