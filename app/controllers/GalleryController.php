<?php
class GalleryController extends Controller {
    public function index() {
        $this->view('gallery/index', [
            'title'     => 'Galeri Alam',
            'active'    => 'gallery',
            'galleries' => $this->model('Gallery')->all(),
        ]);
    }
}