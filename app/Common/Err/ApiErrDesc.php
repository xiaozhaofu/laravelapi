<?php
/**
 * Created by PhpStorm.
 * User: Hasee
 * Date: 2019/4/4
 * Time: 15:18
 */
namespace  App\Common\Err;

class ApiErrDesc
{
    /**
     * code<1000 系统级别
     */
    const SUCCESS = [0,'Success'];
    const UNKNOWN_ERR = [1,'未知错误'];
    const ERR_URL = [2,'访问的接口不存在'];
    const ERR_PARAMS = [3,'参数错误'];
    const ERR_TOKEN = [4,'token过期'];

    /**
     * code>1000 业务逻辑错误
     * code 1000-1100 用户登录相关的错误码
     */
    const ERR_PASSWORD = [1001,'密码错误'];
}