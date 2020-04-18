<?php

namespace Zlh\Geetest;


class Geetest
{
    public static function StartCaptchaServlet($captchaId,$privateKey,$ip,$userId){
        $GtSdk = new GeetestLib($captchaId, $privateKey);
        session_start();
        $data = [
            "user_id" => $userId, # 网站用户id
            "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
            "ip_address" => "$ip" # 请在此处传输用户请求验证时所携带的IP
        ];

        $status = $GtSdk->pre_process($data, 1);
        $_SESSION['gtserver'] = $status;
        $_SESSION['user_id'] = $data['user_id'];
        return $GtSdk->get_response_str();
    }

    public static function VerifyLoginServlet($captchaId,$privateKey,$ip,$userId){
        session_start();
        $GtSdk = new GeetestLib($captchaId, $privateKey);

        $data = [
            "user_id" => $userId, # 网站用户id
            "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
            "ip_address" => "$ip" # 请在此处传输用户请求验证时所携带的IP
        ];

        if ($_SESSION['gtserver'] == 1) {   //服务器正常
            $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $data);
            if ($result) {
                return true;
            } else{
                return false;
            }
        }else{  //服务器宕机,走failback模式
            if ($GtSdk->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode'])) {
                return true;
            }else{
                return false;
            }
        }
    }
}
