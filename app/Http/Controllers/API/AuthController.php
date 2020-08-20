<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        session_start();

        $login_attempt = isset($_SESSION["login_attempt"]) ? $_SESSION["login_attempt"] : 1;
        $_SESSION["login_attempt"] = $login_attempt + 1;
        if (isset($_SESSION["last_log_time"]) && time() - $_SESSION['last_log_time'] >= 300) {
            session_destroy();
        }

        if($login_attempt == 5) $_SESSION["last_log_time"] = time();
        if(isset($login_attempt) && $login_attempt >= 5) {
            return response()->json([
                'message' => 'Maximum login attempt reached, please try again after 5 minutes',
                'time_elapsed' => date('i:s', time() - $_SESSION['last_log_time'])
            ]);
        }

        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        // if(isset($login_attempt)) session_destroy();
        return response()->json(['access_token' => $token], 201);

    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
