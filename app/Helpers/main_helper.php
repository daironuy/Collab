<?php

function pr($data){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function sendMail($to, $subject, $message){
    $email = \Config\Services::email();
    $email->setTo($to);
    $email->setFrom('test@gmail.com', 'Collab Application');

    $email->setSubject($subject);
    $email->setMessage($message);
    $email->send();
}

function getIP(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

function getRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function encrypt($text): string
{
    $encrypt = \Config\Services::encrypter();
    return bin2hex($encrypt->encrypt($text));
}

function decrypt($text): string
{
    $encrypt = \Config\Services::encrypter();
    return $encrypt->decrypt(hex2bin($text));;
}