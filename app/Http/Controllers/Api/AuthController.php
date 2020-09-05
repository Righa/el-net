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
                'message' => 'input errors',
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

        $user = Auth::user();

        if ($user->avatar_url != null) {
            $user->avatar_url = Storage::url($user->avatar_url);
        }

    	return response()->json([
    		'success' => true,
    		'token' => $token,
    		'user' => $user
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
            'role' => 'required|min:2',
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false, 
                'message'=> 'input errors',
                'errors' => $validator->errors()
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
            //'birthday' => 'date',
            'first_name' => 'min:2',
            'last_name' => 'min:2',
        ]);

        if ($validator->fails()) {
            return response([
                'success' => false, 
                'message' => 'input errors',
                'errors'=> $validator->errors()
            ]);
        }

        $user = Auth::user();

        try {

            $changes = 5;

            if ($request->hasfile('avatar')) {

                Storage::delete($user->avatar_url);
                $path = $request->avatar->store('public/user_avatars');
                $user->avatar_url = $path;

            } elseif ($request->drop_avatar) {

                Storage::delete($user->avatar_url);
                $user->avatar_url = null;

            } else {
                $changes--;
            }

            ($request->first_name) ? $user->first_name = $request->first_name : $changes--;
            ($request->last_name) ? $user->last_name = $request->last_name : $changes--;
            ($request->birthday) ? $user->birthday = $request->birthday : $changes--;
            ($request->gender) ? $user->gender = $request->gender : $changes--;

            $user->save();
            
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }

        if ($user->avatar_url != null) {
            $user->avatar_url = Storage::url($user->avatar_url);
        }
            
        return response()->json([
            'success' => true,
            'message' => $changes.' changes have been saved',
            'user' => $user
        ]);
    }

    /**
     * Refresh token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function refresh(Request $request)
    {
        try {

            $newToken = auth()->refresh(JWTAuth::parseToken($request->token));

            // Pass true as the first param to force the token to be blacklisted "forever".
            // The second parameter will reset the claims for the new token
            $newToken = auth()->refresh(true, true);

            $user = Auth::user();

            $user->avatar_url = Storage::url($user->avatar_url);

            return response()->json([
                'success' => true,
                'token' => $newToken,
                'user' => $user
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    /**
     * Check if user is authenticated.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkAuth()
    {
        $user = Auth::user();

        $user->avatar_url = Storage::url($user->avatar_url);

        return response()->json([
            'success' => true,
            'user' => $user
        ]);
    }

    /**
     * Deauthenticate user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        JWTAuth::invalidate(JWTAuth::parseToken($request->token));
        return response()->json([
            'success' => true,
            'message' => 'logout success'
        ]);
    }
}
