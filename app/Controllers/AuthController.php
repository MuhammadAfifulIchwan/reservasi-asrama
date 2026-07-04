<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Menampilkan halaman login
    public function login()
    {
        return view('auth/login');
    }

    // Menampilkan halaman register
    public function register()
    {
        return view('auth/register');
    }

    // Proses simpan register
    public function processRegister()
    {
        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'phone'    => $this->request->getPost('phone'),
            'role'     => 'user'
        ];

        $this->userModel->insert($data);

        return redirect()->to('/login');
    }

    // Proses login
    public function processLogin()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel
                     ->where('email', $email)
                     ->first();

        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user['password'])) {

                // Set session
                session()->set([
                    'id'        => $user['id'],
                    'name'      => $user['name'],
                    'role'      => $user['role'],
                    'logged_in' => true
                ]);

                // Redirect berdasarkan role
                if ($user['role'] == 'admin') {

    return redirect()->to('/admin/dashboard');

}
elseif ($user['role'] == 'user') {

    return redirect()->to('/user/dashboard');

}
elseif ($user['role'] == 'guest') {

    return redirect()->to('/guest/dashboard');

}
            }
        }

        // Jika login gagal
        return redirect()->back()->with('error', 'Email atau Password salah');
    }

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}