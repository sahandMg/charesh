<?php

/**
 * Created by PhpStorm.
 * User: Sahand
 * Date: 6/29/18
 * Time: 12:26 PM
 */
class Recaptcha
{
public static function check(){
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array('secret' => '6LfjSj4UAAAAANwdj6e_ee8arRU9QHLWDmfkmdL6', 'response' => $request->input('g-recaptcha-response'));
//// use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if(json_decode($result)->success === false){
//
        return 400;
//
    }else{
        return 200;
    }
}
}