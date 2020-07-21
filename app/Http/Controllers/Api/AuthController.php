<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    /**
     * Authenticate user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false, 
                'errors'=> $validator->errors()
            ]);
        }

    	$creds = $request->only(['email','password']);

    	if (!$token = auth()->attempt($creds)) {
    		return response()->json([
    			'success' => false,
    			'message' => 'Email or password is invalid'
    		]);
    	}
    	return response()->json([
    		'success' => true,
    		'token' => $token,
    		'user' => Auth::user()
    	]);
    }

    /**
     * Register user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response or
     * @return \Illuminate\Http\Api\AuthController@login
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false, 
                'message'=> $validator->errors()
            ]);
        }


        $encryptedPass = Hash::make($request->password);

        $user = new User;

        try {
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = $encryptedPass;
            $user->role = $request->role;
            $user->save();
            return $this->login($request);
            
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    /**
     * Complete or edit profile.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response 
     */
    public function profile(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'birthday' => 'date',
            'first_name' => 'min:2',
            'last_name' => 'min:2',
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false, 
                'errors'=> $validator->errors()
            ]);
        }

        $user = Auth::user();

        try {

            $changes = 5;

            if ($request->hasfile('avatar')) {
                $path = $r->avatar->store('public/user_avatars');
                $user->avatar_url = $path;
            } else {
                $changes--;
            }

            ($request->first_name) ? $user->first_name = $request->first_name : $changes--;
            ($request->last_name) ? $user->last_name = $request->last_name : $changes--;
            ($request->birthday) ? $user->birthday = $request->birthday : $changes--;
            ($request->gender) ? $user->gender = $request->gender : $changes--;

            $user->save();
            
            return response()->json([
                'success' => true,
                'message' => $changes.' changes have been saved'
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    /**
     * Deauthenticate user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
    	try {

    		JWTAuth::invalidate(JWTAuth::parseToken($request->token));
    		return response()->json([
    			'success' => true,
    			'message' => 'logout success'
    		]);
    		
    	} catch (Exception $e) {
    		return response()->json([
    			'success' => false,
    			'message' => $e
    		]);
    	}
    }
}
