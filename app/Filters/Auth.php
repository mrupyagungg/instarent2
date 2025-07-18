<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
  // app/Filters/Auth.php

    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if ($arguments) {
            $requiredRole = $arguments[0]; // contoh: '1' untuk admin
            if (session()->get('role') != $requiredRole) {
                return redirect()->to('/unauthorized')->with('error', 'Anda tidak memiliki akses.');
            }
        }
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Kosongkan atau tambahkan logika after
    }

        public function unauthorized()
    {
        return view('errors/unauthorized');
    }

}