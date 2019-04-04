<?php

namespace App\Http\Middleware;

use App\Common\Auth\JwtAuth;
use App\Common\Err\ApiErrDesc;
use App\Exceptions\ApiException;
use Closure;
use App\Http\Response\ResponseJson;

class JwtMiddleware
{
    use ResponseJson;

    public function handle($request, Closure $next)
    {
        $token = $request->input('token');
        if($token){
            $jwtAuth = JwtAuth::getInstance();
            $jwtAuth->setToken($token);

            if($jwtAuth->validate() && $jwtAuth->verify()){
                return $next($request);
            }else{
                //return $this->jsonData(ApiErrDesc::ERR_TOKEN[0],ApiErrDesc::ERR_TOKEN[1]);
                throw new ApiException(ApiErrDesc::ERR_TOKEN);
            }

        }else{
            //return $this->jsonData(ApiErrDesc::ERR_PARAMS[0],ApiErrDesc::ERR_PARAMS[1]);
            throw new ApiException(ApiErrDesc::ERR_PARAMS);
        }
    }
}
