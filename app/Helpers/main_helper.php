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