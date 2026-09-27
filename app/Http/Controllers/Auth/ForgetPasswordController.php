<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Otp;
use DB;
use App\OtpVerify;

class ForgetPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		return view('auth/passwords/forget');
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
	 
	public function generateOTP(){
        $otp = mt_rand(1000,9999);
        return $otp;
    }
	 
    public function store(Request $request)
    {
        //
        $mobile = request('phone');
        $email = request('email');
        $authKey =  "5c9a51ce";
        $senderId =  "M5uHnD099JtklwWS";
        if($mobile==''){
            return json_encode(array('statusCode'=>400,'msg'=>"Mobile number not valid".$mobile));
        }
        else if($authKey==""){
			return json_encode(array('statusCode'=>400,'msg'=>"sms gateway not intigrated"));
        }
        else{
			
			$otp = $this->generateOTP();
            $text = 'Password reset code: '.$otp.'<br>'.'Do not share with anyone';
            $number = '255'.$mobile;
            //$route = "route=4";
			
            //put in session
			$basic  = new \Vonage\Client\Credentials\Basic($authKey, $senderId);
			$client = new \Vonage\Client($basic);
			
			$message = $client->message()->send([
            'to' => $number,
            'from' => 'MoCU',
            'text' => $text
			]);
			
			// adding OTP to database for verification
				/*
				$user = Otp::create([
				'phone' => $otp,
				'name' => "username",
				'email' => "email".$otp."@gmail.com",
				]);*/

			if ($message->getStatus() == 0) {
				return json_encode(array('statusCode'=>200,'msg'=>'otp sent successfully'));			
				//echo "The message was sent successfully\n";
			} else {
				return json_encode(array('statusCode'=>201,'msg'=>'otp sent successfully'.$message->getStatus() . '\n'));			
				//echo "The message failed with status: " . $message->getStatus() . "\n";
			}
			/*
			$postData = array(
			'authkey' => $authKey,
			'mobiles' => $mobile,
			'message' => $message,
			'sender' => $senderId,
			'route' => $route
			);
			$url="https://control.msg91.com/sendhttp.php";
			$ch = curl_init();
			curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData
			));
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$output = curl_exec($ch);
			if(curl_errno($ch))
			{
				echo 'error:' . curl_error($ch);
				curl_close($ch);
				exit;
			}
			curl_close($ch);

		   session(['mobile'=> $mobile]);
		   session(['email'=> $email]);
		   session(['otp' => $otp]);
		   
		   return json_encode(array('statusCode'=>200,'msg'=>'otp sent successfully'.$otp));			
        */
		
		}

    }
	
	public function submitOtp(){
        $otp = trim(request('otp'));
        if($otp==''){
            return json_encode(array('statusCode'=>400,'msg'=>"otp not valid"));
        }
        else{
            $user = new Otp;
            if($otp == session('otp')){
            $mobile = session('mobile');
            $email = session('email');
            $user->save();
            session()->flush();
            json_code(array('statusCode'=>200,'msg'=>'sucess'));

            }
            else{
                return json_encode(array('statusCode'=>400,'msg'=>"otp not valid"));
            }
        }
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
