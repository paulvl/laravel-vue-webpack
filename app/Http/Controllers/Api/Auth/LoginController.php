<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Auth;
use Lang;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->only('logout');
    }

    public function login(LoginRequest $request)
    {
    	if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
            $user = auth()->user();
            $user->api_token = api_token();
            $user->save();
            return response()->json($user);
        }
        // Authentication failed...
        return response()->json([
            'email' => [Lang::get('auth.failed')],
        ], 422);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->api_token = null;
        $user->save();

        return response()->json(
            'logout successful'
        );
    }
}
