<?php

namespace App\Http\Controllers;

use App\Http\Response\ResponseJson;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    use ResponseJson;

   public function info()
   {
       return $this->jsonSuccessData(['id'=>1,'name'=>'wulekong']);
   }
}
