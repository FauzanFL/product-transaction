<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    private $userModel;
    private $validation;

    function __construct()
    {
        $this->userModel = new UserModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('product'));
        }
        return view('login');
    }

    public function login()
    {
        $rules = [
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username harus diisi'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('warning', $this->validation->getErrors());
            return redirect()->to(base_url('/'));
        }
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');


        $user = $this->userModel->getByUsername($username);

        if ($user) {
            if (!password_verify($password, $user['password'])) {
                $err[] = "Password salah";
                session()->setFlashdata('username', $username);
                session()->setFlashdata('warning', $err);
                return redirect()->to(base_url('/'));
            }
        } else {
            $err[] = "Username tidak ditemukan";
            session()->setFlashdata('password', $password);
            session()->setFlashdata('warning', $err);
            return redirect()->to(base_url('/'));
        }

        session()->set([
            'id' => $user['id'],
            'username' => $user['username'],
            'nama' => $user['nama'],
            'logged_in' => true
        ]);
        return redirect()->to(base_url('/product'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
