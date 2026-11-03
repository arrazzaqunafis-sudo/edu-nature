<?php
class ArticleController extends Controller {
    public function index() {
        $model    = $this->model('Article');
        $category = $_GET['category'] ?? null;
        $q        = $_GET['q'] ?? null;

        $this->view('articles/index', [
            'title'      => 'Artikel',
            'active'     => 'articles',
            'articles'   => $model->search($category, $q),
            'categories' => $model->categories(),
            'category'   => $category,
            'q'          => $q,
        ]);
    }

    public function show($slug = null) {
        if (!$slug) redirect('articles');
        $model = $this->model('Article');
        $article = $model->findBySlug($slug);
        if (!$article) {
            http_response_code(404);
            return $this->view('errors/404', ['title' => 'Tidak Ditemukan', 'active' => '']);
        }
        $model->incrementViews($article['id']);
        $this->view('articles/show', [
            'title'   => $article['title'],
            'active'  => 'articles',
            'article' => $article,
            'related' => $model->related($article['category'], $article['id'], 3),
        ]);
    }
}