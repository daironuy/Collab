<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Home extends BaseController
{
    public function __construct()
    {

    }

    public function index(){
        $session = session();

        $data = [
            'auth'=>$session->get()
        ];

        return view('Home/index', $data);
    }
}
