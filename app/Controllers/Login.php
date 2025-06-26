<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        $session = session();
        $session->destroy();
        return view('auth/login');
    }

    public function auth()
    {
        $session                    = session();
        $model                      = new UserModel();
        $username                   = $this->request->getVar('username');
        $password                   = $this->request->getVar('password');
        $data                       = $model->where('username', $username)->first();

        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'user_id'       => $data['user_id'],
                    'username'      => $data['username'],
                    'email'         => $data['email'],
                    'role'          => $data['role'],  // Store the user role in session
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);

                // Redirect based on user role
                if ($data['role'] == 1) {
                    return redirect()->to('/dashboard');  // Redirect to admin dashboard
                } elseif ($data['role'] == 0) {
                    return redirect()->to('/customer/dashboard');  // Redirect to customer dashboard
                }
            } else {
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Username not Found');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}