<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CekLogin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session('id')) {
            session()->setFlashdata('pesan', '<div class="alert alert-primary" role="alert">
                Silahkan login terlebih dahulu
            </div>');
            return redirect()->to('/auth/login');
        }

    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
