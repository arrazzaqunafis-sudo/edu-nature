<?php
class AuthController extends Controller {
    public function login() {
        if (is_admin()) redirect('admin');
        if (is_user()) redirect('');

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $user = $this->model('User')->findByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id'    => $user['id'],
                    'name'  => $user['name'],
                    'email' => $user['email'],
                    'role'  => $user['role'],
                ];

                if ($user['role'] === 'admin') {
                    redirect('admin');
                }
                redirect('');
            }
            $error = 'Email atau password salah.';
        }

        $this->view('auth/login', ['title' => 'Masuk', 'active' => '', 'error' => $error]);
    }

    public function register() {
        if (is_logged_in()) {
            redirect(is_admin() ? 'admin' : '');
        }

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($name === '' || $email === '' || $password === '') {
                $error = 'Semua field harus diisi.';
            } else {
                $userModel = $this->model('User');
                if ($userModel->findByEmail($email)) {
                    $error = 'Email sudah terdaftar.';
                } else {
                    $userModel->create($name, $email, $password, 'user');
                    $user = $userModel->findByEmail($email);
                    $_SESSION['user'] = [
                        'id'    => $user['id'],
                        'name'  => $user['name'],
                        'email' => $user['email'],
                        'role'  => $user['role'],
                    ];
                    redirect('');
                }
            }
        }

        $this->view('auth/register', ['title' => 'Daftar', 'active' => '', 'error' => $error]);
    }

    public function logout() {
        session_destroy();
        redirect('');
    }
}