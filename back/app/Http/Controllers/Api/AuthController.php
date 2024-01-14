<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Helpers\HelperNotify;
use Illuminate\Support\Facades\Cookie;
// use App\Http\Controllers\Api\Response;
use Illuminate\Http\Response;

class AuthController extends Controller
{

    public $info = ['result' => false, 'message' => ['title' => 'Error!', 'content' => 'Internal Server Error.']];

    public function helper () {
        return new HelperNotify();
    }
    public function logIn(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();
            // $token = $user->createToken(md5($user->email))->accessToken;
            $this->info['result'] = true;
            $this->info['token'] = auth()->user()->createToken('token')->plainTextToken;
            // $this->info['token'] = $token->name;
            $this->info['dataUser'] = $user;
            $this->info['message'] = $this->helper()->getNotify('success', 'Sesión iniciada');
        } else {
            $this->info['result'] = false;
            $this->info['message'] = $this->helper()->getNotify('error', 'Usuario o contraseña incorrectos');
        }
 
        return $this->info;
    }

    public function logOut()
    {
        if (Auth::check()) {
            $this->deleteAllCookies();
            Auth::logout();
            $this->info['result'] = true;
            $this->info['message'] = $this->helper()->getNotify('success', 'Sesión cerrada');
        } else {
            $this->info['result'] = false;
            $this->info['message'] = $this->helper()->getNotify('exception', 'Su cuenta no está autenticada');
        }
        
        return $this->info;
    }

    public function deleteAllCookies()
    {
        $cookies = request()->cookie();

        $response = new Response();

        foreach ($cookies as $nombreCookie => $valorCookie) {
            //var_dump($nombreCookie);
            //$cookie = Cookie::forget($nombreCookie);
            //$response->withCookie(cookie()->forget($nombreCookie));
            $cookie = cookie($nombreCookie, $valorCookie, -1);
            Cookie::forget($nombreCookie);
        }
        // $cookies = request()->cookie();
        // var_dump($cookies);
        // die();
    }
}
