<?php

namespace App\Tools;

use GuzzleHttp\Client;
use Overtrue\Pinyin\Pinyin;

class BaiduTranslate {



    public static function slugTranslate( $text ='' )
    {


        if(empty($text))
            return;



        $translateResult = self::translate($text);


        return ($translateResult == false)
                ? self::pinyin($text)
                : $translateResult;
    }


    public static function strQuery ($text ,$appid , $key )
    {

        $api = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';
        $salt = time();

        // 根据文档，生成 sign
        // http://api.fanyi.baidu.com/api/trans/product/apidoc
        // appid+q+salt+密钥 的MD5值
        $sign = md5($appid. $text . $salt . $key);



        // 构建请求参数
        $query = http_build_query([
            "q"     =>  $text,
            "from"  => "zh",
            "to"    => "en",
            "appid" => $appid,
            "salt"  => $salt,
            "sign"  => $sign,
        ]);


        return $api . $query;
    }

    public static function translate ($text)
    {

        $appid = config('services.baidu_translate.appid');
        $key   = config('services.baidu_translate.key');


        var_dump($appid , $key);

        if(empty($appid) || empty($key))
            return false;



        $http     = new Client;

        $response =  $http->get(self::strQuery($text,$appid,$key));

        $result   = json_decode($response->getBody(), true);

        $dst      = $result['trans_result'][0]['dst'];


        return isset($dst) ? str_slug($dst) : false;

    }


    public static function pinyin ($text)
    {

        return str_slug(app(Pinyin::class)->permalink($text));

    }


}