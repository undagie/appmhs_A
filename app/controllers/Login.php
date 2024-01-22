<?php

class Login extends Controller
{
    public function index()
    {
        $data['title'] = 'Halaman Login';
        $this->view('login/login', $data);
    }

    public function prosesLogin()
    {
        $data = $_POST;
        $userModel = $this->model('LoginModel');
        $user = $userModel->checkLogin($data);

        if ($user) {
            $_SESSION['UserID'] = $user['UserID'];
            $_SESSION['NamaPengguna'] = $user['NamaPengguna'];
            $_SESSION['session_login'] = 'sudah_login';
            header('location: ' . base_url . '/home');
        } else {
            Flasher::setMessage('Username / Password', 'salah.', 'danger');
            header('location: ' . base_url . '/login');
            exit;
        }
    }
}
