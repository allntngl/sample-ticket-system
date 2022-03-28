<?php

namespace App\Http\Controllers\Auth;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class AuthController extends Controller

{
    public function apiLogin(Request $request)
    {


        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()){
            $errors = $validator->errors();
            return response()->json($errors, 400);
        }



        try{
            $user = User::where('email', $request->input('email'))->firstOrFail();

            if(!empty($user) && Hash::check($request->input('password'), $user->password)){
                $userData = [
                    'id' => $user->id,
                    'email' => $user->email
                ];

                $responseData = [
                    'status' => 'sucess',
                    'message' => 'Login Sucess'
                ];

                $secret = 'password123';

                $jwt = JWT::encode($userData, $secret,  "HS256");


                return response()->json($jwt,200);

            } else {
                return response()->json('unable to login 1', 404);
            }


        }catch (\Throwable $th){
            // dd($th);
        return response()->json(['unable to login'], 404);

    }

    }
}
