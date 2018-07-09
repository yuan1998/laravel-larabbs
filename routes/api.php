<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


$api = app('Dingo\Api\Routing\Router');


$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api'
], function($api) {
    $api->group([
        'middleware' => 'api.throttle',
		'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function($api) {
        // 短信验证码
        $api->post('verificationCodes', 'VerificationCodesController@store')
            ->name('api.verificationCodes.store');
        // 用户注册
        $api->post('users', 'UsersController@store')
            ->name('api.users.store');

        // 图片验证码
		$api->post('captchas', 'CaptchasController@store')
		    ->name('api.captchas.store');


    });

});

/*

{
	"access_token":"11_Tem722Qt7PI8sIlodGz9VLiz3Rg28BoG5qzYQkDS96e7IanikhgnIztTvnSHBngzJR5LKZ627SAEQ5MNTDeM-A",
	"expires_in":7200,
	"refresh_token":"11_JjR_HqhdXxgBENUKYgedNd9UOXDR1kLnyCos2jsU8Vha--GQYWhsk6J1s6JptSppiY7Obb7eRC3Tknipw-tmTQ",
	"openid":"oA6Cp1SXstzmfEnUWarqjO3__MCY",
	"scope":"snsapi_userinfo"	
}


https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx212073a1377d68b5&redirect_uri=http://larabbs.test&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect


https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx212073a1377d68b5&secret=2916577106585a45dd0002eef8369c30&code=081TznVK1Btpj50kC8SK1BriVK1TznVC&grant_type=authorization_code


https://api.weixin.qq.com/sns/userinfo?access_token=11_Tem722Qt7PI8sIlodGz9VLiz3Rg28BoG5qzYQkDS96e7IanikhgnIztTvnSHBngzJR5LKZ627SAEQ5MNTDeM-A&openid=oA6Cp1SXstzmfEnUWarqjO3__MCY&lang=zh_CN


$accessToken = '11_Tem722Qt7PI8sIlodGz9VLiz3Rg28BoG5qzYQkDS96e7IanikhgnIztTvnSHBngzJR5LKZ627SAEQ5MNTDeM';

$code = '081ZdZud0utVxt1bOwvd0JJHud0ZdZuh';
$driver = Socialite::driver('weixin');
$response = $driver->getAccessTokenResponse($code);
$driver->setOpenId($response['openid']);
$oauthUser = $driver->userFromToken($response['access_token']);

*/



