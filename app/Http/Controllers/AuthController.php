<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        /*$response = Http::post('http://127.0.0.1:8000/api/login', [
            'email' => $request->email,
            'password' => $request->password
        ]);

        $res = $response->json();
        return view('demo')->with('res', $res);*/

        //try session//

        //*keep*//: return redirect('demo');
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

                Storage::delete($user->avatar_url);
                $path = $r->avatar->store('public/user_avatars');
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
                'message' => 'internal errors'
            ]);
        }

        $user->avatar_url = Storage::url($user->avatar_url);
            
        return response()->json([
            'success' => true,
            'message' => $changes.' changes have been saved',
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
