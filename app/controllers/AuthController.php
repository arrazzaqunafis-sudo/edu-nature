<?php
class AuthController extends Controller {
    public function login() {
        if (is_admin()) redirect('admin');

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
                redirect('admin');
            }
            $error = 'Email atau password salah.';
        }

        $this->view('auth/login', ['title' => 'Masuk', 'active' => '', 'error' => $error]);
    }

    public function logout() {
        session_destroy();
        redirect('');
    }
}