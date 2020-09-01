<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /**
     * login page
     *
     * @return \Illuminate\Http\Response
     */
    public function signIn()
    {
        return view('auth.login');
    }

    /**
     * register page
     *
     * @return \Illuminate\Http\Response
     */
    public function signUp()
    {
        return view('auth.register');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        return view('profile');
    }

    /**
     * Authenticate user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8000/api/login', [
            'email' => $request->email,
            'password' => $request->password
        ]);

        $res = $response->json();

        if ($res['success']) {

            $request->session()->flush();
            
            session(['miToken' => $res['token']]);
            session(['user' => $res['user']]);

            return redirect('home');

        } else {

            if ($res['message'] == 'input errors') {

                if (isset($res['errors']['email'][0])) {
                    $request->session()->flash('email', $res['errors']['email'][0]);
                }
                if (isset($res['errors']['password'][0])) {
                    $request->session()->flash('password', $res['errors']['password'][0]);
                }
                return $this->signIn();
                
            } else {
                $request->session()->flash('message', $res['message']);
                return $this->signIn();
            }
            
        }
    }

    /**
     * Register user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response or
     */
    public function register(Request $request)
    {
        $role = 'learner';
        if ($request->teacher_check) {
            $role = 'teacher';
        }
        
        $response = Http::post('http://127.0.0.1:8000/api/register', [
            'email' => $request->email,
            'password' => $request->password,
            'role' => $role,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'password_confirmation' => $request->password_confirmation
        ]);

        $res = $response->json();

        if ($res['success']) {

            $request->session()->flush();
            
            session(['miToken' => $res['token']]);
            session(['user' => $res['user']]);

            return redirect('home');

        } else {

            if ($res['message'] == 'input errors') {

                if (isset($res['errors']['email'][0])) {
                    $request->session()->flash('email', $res['errors']['email'][0]);
                }
                if (isset($res['errors']['password'][0])) {
                    $request->session()->flash('password', $res['errors']['password'][0]);
                }
                if (isset($res['errors']['first_name'][0])) {
                    $request->session()->flash('first_name', $res['errors']['email'][0]);
                }
                if (isset($res['errors']['last_name'][0])) {
                    $request->session()->flash('last_name', $res['errors']['password'][0]);
                }
                return $this->signUp();
                
            } else {
                $request->session()->flash('message', $res['message']);
                return $this->signUp();
            }
            
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

        if ($request->hasFile('avatar')) {

            $photo = fopen($request->avatar, 'r');
            $response = Http::attach('avatar', $photo)->withToken(session('miToken'))->post('http://127.0.0.1:8000/api/profile', [
                'gender' => $request->gender,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'birthday' => $request->birthday
            ]);

        } else {

            $response = Http::withToken(session('miToken'))->post('http://127.0.0.1:8000/api/profile', [
                'gender' => $request->gender,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'birthday' => $request->birthday
            ]);
        }
        $res = $response->json();
        
        if ($res['success']) {
            session(['user' => $res['user']]);
            $request->session()->flash('success', $res['message']);
            return view('profile');
        } else {
            $request->session()->flash('errors', $res['message']);
            return view('profile');
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
        $response = Http::withToken(session('miToken'))->get('http://127.0.0.1:8000/api/logout');
        $res = $response->json();
        
        if ($res['success']) {

            $request->session()->flush();

            return redirect('/');
        }
    }
}
