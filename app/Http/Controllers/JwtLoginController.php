<?php

namespace App\Http\Controllers;

use App\Common\Auth\JwtAuth;
use App\Http\Response\ResponseJson;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class JwtLoginController extends BaseController
{
    use ResponseJson;

   public function login(Request $request){
       $username = $request->input('user_name');
       $password =$request->input('pass_word');

        $jwtAuth = JwtAuth::getInstance();
        $token = $jwtAuth->setUid(1)->encode()->getToken();
        return $this->jsonSuccessData(['token'=>$token]);
   }
}
