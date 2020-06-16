<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

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
    	$creds = $request->only(['email','password']);

    	if (!$token = auth()->attempt($creds)) {
    		return response()->json([
    			'success' => false,
    			'message' => 'invalid credentials'
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
    	$encryptedPass = Hash::make($request->password);

    	$user = new User;

    	try {
    		$user->name = $request->name;
    		$user->email = $request->email;
    		$user->password = $encryptedPass;
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
