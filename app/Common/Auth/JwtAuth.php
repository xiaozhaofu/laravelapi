<?php
/**
 * Created by PhpStorm.
 * User: Hasee
 * Date: 2019/4/4
 * Time: 9:06
 */

namespace App\Common\Auth;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;

/**
 * 单例 一次请求中所有出现使用jwt的地方都是一个用户
 * Class JwtAuth
 * @package App\Common\Auth
 */
class JwtAuth
{
    /**
     * jwt token
     * @var
     */
    private $token;
    /**
     * decode
     * @var
     */
    private $decodeToken;

    private $iss='laravel.api.com';//签发者
    private $aud='laravel_api_vip';//接收方
    private $uid;
    private $secret='123';
    /**
     * 单例模式
     * @var
     */
    private static $instance;

    public static function getInstance(){
        if (is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 私有化构造函数
     * JwtAuth constructor.
     */
    private function __construct()
    {

    }

    /**
     * 私有化clone函数
     */
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public function getToken(){
        return (string)$this->token;
    }

    public function setToken($token){
        $this->token = $token;
        return $this;
    }

    public function setUid($uid){
        $this->uid = $uid;
        return $this;
    }

    /**
     * 编码jwt token
     * @return $this
     */
    public function encode(){
        $time=time();
        $this->token = (new Builder())->setHeader('alg','HS256')
            ->setIssuer($this->iss)
            ->setAudience($this->aud)
            ->setIssuedAt($time)
            ->setExpiration($time+3600)//过期时间
            ->set('uid',$this->uid)
            ->sign(new Sha256(),$this->secret)
            ->getToken();
        return $this;//链式调用
    }

    /**
     * parse string token
     * @return mixed
     */
    public function decode(){
        if(!$this->decodeToken){
            $this->decodeToken = (new Parser())->parse((string)$this->token);
            $this->uid = $this->decodeToken->getClaim('uid');
        }
        return $this->decodeToken;
    }

    public function verify(){
        $result = $this->decode()->verify(new Sha256(),$this->secret);
        return $result;
    }

    public function validate(){
        $data = new ValidationData();
        $data->setIssuer($this->iss);
        $data->setAudience($this->aud);

        return $this->decode()->validate($data);
    }
}