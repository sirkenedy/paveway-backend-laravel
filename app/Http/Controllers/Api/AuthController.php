<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\User;
use App\Role;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Resources\User\User as UserResource;
use App\Http\Resources\User\UserCollection;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signup(UserStoreRequest $request) {
        
        
      $role_id = Role::where('title',"=", "student")->firstOrFail()->id;

         $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'unique_no' => $request->unique_no,
            'role_id' => $role_id,
          ]);
    
          $token = auth('api')->login($user);
          $status = 201;
          return $this->respondWithToken($token, $status);
    }


    public function signIn(Request $request) {
        // grab credentials from the request
        $credentials = $request->only(['email', 'password']);

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 404);
              }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        // return response()->json(compact('token'));
        $status = 200;
        return $this->respondWithToken($token, $status);
    }

    public function forgotPassword(Request $request) 
    {
      //when user want to get a new password 
    }

    
    
    
    protected function respondWithToken($token, $status)
    {
      return response()->json([ 
        'token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth('api')->factory()->getTTL() * 1,
        'email' => auth('api')->user()->email,
        'firstname' => auth('api')->user()->firstname,
        'lastname' => auth('api')->user()->lastname,
        'role' => auth('api')->user()->role->title,
      ], $status);
    }
}
