<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Entity\Cast\BaseCast;

class Register extends BaseController
{
    public function index()
    {
        $data = [];
        return view('auth/register', $data);
    }

    public function save()
    {
        $rules = [
            'username'      => 'required|min_length[3]|max_length[20]',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
            'password'      => 'required|min_length[5]|max_length[200]',
            'confpassword'  => 'matches[password]'
        ];

        if ($this->validate($rules)) {
            $model = new UserModel();
            $data = [
                'username'      => $this->request->getVar('username'),
                'email'         => $this->request->getVar('email'),
                'password'      => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $model->save($data);
            return redirect()->to('/login');
        } else {
            $data['validation'] = $this->validator;
            return view('auth/register', $data);
        }
    }
}
