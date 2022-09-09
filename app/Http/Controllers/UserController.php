<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller{

    public function createUser(Request $request){

        /*$this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|phone|unique:users,phone',
            'password' => 'required',
            'gender' => 'required|in:Male,Female,Others',
            'dob' => 'required',
            'confirmation' => 'required'
        ]);*/

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required',
            'gender' => 'required|in:Male,Female,Other',
            'dob' => 'required',
            'confirmation' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['status' => 'Failed' ,'state'=>'100' , 'message'=> $validator->errors()->first() ], 401);
        }

        $referral_code = $request->input('referral_code');
        if($referral_code){
            $referral  = User::where('referral_code', $referral_code)->first();
            if ($referral){
                $referral_id = $referral['id'];
            } else{
                return response()->json(['status' => 'Failed' ,'state'=>'100' , 'message'=> 'Referral Code is not valid.' ], 401);
            }
        } else{
            $referral_id = NULL; 
        }

        //Save to DB
        $request->merge([
            'referral_id' => $referral_id,
            'password' => Hash::make($request->password),
            'dob' => getCreatedAtAttribute($request->dob),
            'referral_code' => $this->generateUniqueCode()
        ]);
        $user = User::create($request->all());

        //Send mail to admin
        if(env('MAIL_ENABLE')){
            $this->mail($user);
        }

        return response()->json(['status' => 'Success' ,'state'=>'200' , 'message'=> 'Registered successfully.', 'data' => $user], 200);
    }

    public function viewUser($id){
        $user = User::find($id);

        return response()->json(['status' => 'Success' ,'state'=>'200' , 'message'=> 'User details', 'data' => $user], 200);
    }

    public function updateUser(Request $request, $id){
        $user = User::find($id);
        $user->make = $request->input('name');
        $user->model = $request->input('email');
        $user->year = $request->input('phone');
        $user->gender = $request->input('gender');
        $user->dob = $request->input('dob');
        $user->save();

        return response()->json(['status' => 'Success' ,'state'=>'200' , 'message'=> 'Updated successfully.', 'data' => $user], 200);
    }

    public function deleteUser($id){
        $user = User::find($id);
        $user->delete();

        return response()->json(['status' => 'Success' ,'state'=>'200' , 'message'=> 'Removed successfully.'], 200);
    }

    public function index(){
        $users  = User::all();

        return response()->json(['status' => 'Success' ,'state'=>'200' , 'message'=> 'Updated successfully.', 'data' => $users], 200);
    }

    public function verify_referral_code(Request $request){

        $validator = Validator::make($request->all(), [
            'referral_code' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['status' => 'Failed' ,'state'=>'100' , 'message'=> $validator->errors()->first() ], 401);
        }

        $referral_code = $request->referral_code;
        $user = User::where('referral_code', $referral_code)->first();
        if ($user === null){
            return response()->json(['status' => 'Failed' ,'state'=>'100' , 'message'=> 'Referral Code is not valid'], 401);
        } else{
            return response()->json(['status' => 'Success' ,'state'=>'200' , 'message'=> 'Referral Code applied successfully.', 'data' => $user], 200);
        }
    }

    private function mail($user) {
        $data = array('name' => "Admin", 'user' => $user);
        Mail::send('mail', $data, function($message) use ($user) {
            $message->to('tapanb@notebrains.com', 'Admin')->subject('New Registration');
            $message->from($user['email'], $user['name']);
        });
        //echo "Email Sent. Check your inbox.";
    }

    public function generateUniqueCode()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 6;

        $code = '';

        while (strlen($code) < 6) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }

        if (User::where('referral_code', $code)->exists()) {
            $this->generateUniqueCode();
        }

        return $code;
    }
}
?>
