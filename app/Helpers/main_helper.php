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