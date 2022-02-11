<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $auth = session()->get('auth');
        $loginSecurityKey = session()->get('loginSecurityKey');
        if (!$auth) {
            if($loginSecurityKey['is_verified']=='')
                return redirect()->to('/users/verify');
            return redirect()->to('/users/login');
        }
    }

//--------------------------------------------------------------------
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
// Do something here
    }
}