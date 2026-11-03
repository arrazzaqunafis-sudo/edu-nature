<?php
function e($str) {
    return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
}

function url($path = '') {
    return BASEURL . '/' . ltrim($path, '/');
}

function asset($path) {
    return BASEURL . '/public/' . ltrim($path, '/');
}

function img_src($img) {
    if (!$img) {
        return 'https://images.unsplash.com/photo-1518495973542-4542c06a5843?w=800&q=80';
    }
    if (preg_match('#^https?://#', $img)) return $img;
    return asset('uploads/' . $img);
}

function slugify($text) {
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

function redirect($path = '') {
    header('Location: ' . url($path));
    exit;
}

function is_admin() {
    return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
}

function excerpt($text, $len = 130) {
    $text = strip_tags($text);
    return mb_strlen($text) > $len ? mb_substr($text, 0, $len) . '…' : $text;
}

function tgl($date) {
    $bulan = [1=>'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    $t = strtotime($date);
    return date('j', $t) . ' ' . $bulan[(int)date('n', $t)] . ' ' . date('Y', $t);
}