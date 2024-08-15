<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController{
    
    /**
     * User SignUp
     *
     * @param Request $request object
     *
     * @return string
     */
    public function signUp(Request $request){

        $validator = Validator::make($request->all(),[
            'name' =>  'required',
            'email' => 'required|email|unique:users',
            'password' =>  'required|min:8',
        ]);

        //if validation fails
        if($validator->fails()){
            return $this->sendError($validator->messages()->first());
        }
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $user = User::create($input);
        
        return $this->sendResponse('User register successfully',$user);
    }

    /**
     * User Login
     *
     * @param Request $request object
     *
     * @return string
     */
    public function login(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users',
            'password' =>  'required|min:8',
        ]);

        //if validation fails
        if($validator->fails()){
            return $this->sendError($validator->messages()->first());
        }
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $tokens = $user->tokens;
            foreach($tokens as $token){
                $token->revoke();
            }
            unset($user->tokens);
            $data['user'] = $user;
            $data['token'] = $user->createToken('access_token')->accessToken;
            return $this->sendResponse('User Login',$data);
        } else {
            return $this->sendError('unauthorized','',401);
        }   
    }

    /**
     * User Logout
     *
     * @param Request $request object
     *
     * @return string
    */
    public function logOut(){
        $user = Auth::user();
        $user->logout();
        return $this->sendResponse('User logout');
    }
}
