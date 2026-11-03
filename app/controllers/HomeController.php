<?php
class HomeController extends Controller {
    public function index() {
        $articleModel  = $this->model('Article');
        $galleryModel  = $this->model('Gallery');
        $questionModel = $this->model('Question');
        $resultModel   = $this->model('QuizResult');

        $this->view('home/index', [
            'title'     => 'Beranda',
            'active'    => 'home',
            'featured'  => $articleModel->latest(3),
            'galleries' => $galleryModel->latest(6),
            'stats'     => [
                'articles'  => $articleModel->count(),
                'galleries' => $galleryModel->count(),
                'questions' => $questionModel->count(),
                'quizzes'   => $resultModel->count(),
            ],
        ]);
    }
}