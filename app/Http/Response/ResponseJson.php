<?php

namespace App\Http\Response;
/**
 * Created by PhpStorm.
 * User: Hasee
 * Date: 2019/4/4
 * Time: 11:42
 */
trait ResponseJson
{
    //接口报错时调用
    public function jsonData($code, $message, $data=[])
    {
        return $this->jsonResponse($code, $message, $data);
    }

    //接口成功时调用
    public function jsonSuccessData($data = [])
    {
        return $this->jsonResponse(0, 'Success',$data);
    }

    private function jsonResponse($code, $message, $data)
    {
        $content = [
            'code' => $code,
            'msg' => $message,
            'data' => $data
        ];
        return json_encode($content);
    }
}