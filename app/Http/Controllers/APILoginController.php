<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\ExceptionsDataAPI;

class APILoginController extends Controller
{
    //Please add this method
    public function login() {
        $credentials = request(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {

            return ExceptionsDataAPI::error('401', ['Unauthorized']);
        }
        return ExceptionsDataAPI::success('200', [
                'token' => $token,
                'type' => 'bearer', // you can ommit this
                'expires' => auth('api')->factory()->getTTL() * 60
            ]
        );
    }
}