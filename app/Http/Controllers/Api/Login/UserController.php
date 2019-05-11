<?php

namespace App\Http\Controllers\Api\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use JWTAuth;
use Response;

class UserController extends Controller
{
    public function index()
    {
        $user = JWTAuth::parseToken()->toUser();

        return Response::json(compact('user'));
    }

    public function register(Request $request)
    {
         try{
             
              $data = $request->all();

               User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'permission'=>'USUARIO'
               ]);
               $credentials = $request->only('email', 'password');

               $token = JWTAuth::attempt($credentials);

               return response()->json(compact('token'),200);

         }catch(\Exception $e){
             return Response::json([
                 'result'=>[
                     'type'=>'error',
                     'msg'=>$e->getMessage()
                 ]
             ]);
         }

         
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }

}
