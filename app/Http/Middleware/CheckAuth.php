<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Http;
use Closure;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = Http::withToken(session('miToken'))->get('http://127.0.0.1:8000/api/check_auth');
        $res = $response->json();

        if ($res['success']) {

            return $next($request);

        } else {

            $request->session()->flush();
            $request->session()->flash('message', $res['message']);

            return redirect('login');
        }
        
    }
}
