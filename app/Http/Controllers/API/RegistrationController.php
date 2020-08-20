<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $is_email_exist = sizeOf(User::where('email', $request->email)->get()) === 1 ? true : false;

        if($is_email_exist) return response()->json(["message" => "Email already taken"], 400);

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json(["message" => "User successfully registered"], 201);
    }
}
