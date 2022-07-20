<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ApiLoginRequest;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class ApiLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /* Login */
    public function login(ApiLoginRequest $request)
    {
        if ( Auth::attempt( $request->only(['email', 'password', 'remember'])) ) {
            $request->session()->regenerate();
            return response()->json([
                'message' => 'loggin success',
            ],200);
        }else{
            return response()->json([
                'message' => 'login failed',
            ],500);
        }
    }
    /* logout */
    public function logout(Request $request)
    {
        if ( Auth::id() ) {
            Session()->flush();
            Auth::logout();
            return response()->json([
                'message' => 'logout success',
            ],200);
        }else{
            return response()->json([
                'message' => 'no session exists',
            ],500);
        }
    }
}
