<?php
class Controller {
    public function view($view, $data = []) {
        extract($data);
        $file = dirname(__DIR__) . '/views/' . $view . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            die("View <b>$view</b> tidak ditemukan.");
        }
    }

    public function model($model) {
        $file = dirname(__DIR__) . '/models/' . $model . '.php';
        require_once $file;
        return new $model();
    }

    public function json($data) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }
}