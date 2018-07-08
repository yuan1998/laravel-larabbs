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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



/*
$sms = app('easysms');
;
try {
    $sms->send(18592071704, [
        'content'  => '您的验证码是1234。如非本人操作，请忽略本短信',
    ]);
} catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
    $message = $exception->getException('qcloud')->getMessage();
    dd($message);
}

*/



