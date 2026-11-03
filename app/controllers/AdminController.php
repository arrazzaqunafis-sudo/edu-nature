<?php
class AdminController extends Controller {
    public function __construct() {
        if (!is_admin()) redirect('auth/login');
    }

    /* ============ DASHBOARD ============ */
    public function index() {
        $this->view('admin/dashboard', [
            'title'    => 'Dashboard',
            'active'   => 'dashboard',
            'articles' => $this->model('Article')->count(),
            'galleries'=> $this->model('Gallery')->count(),
            'questions'=> $this->model('Question')->count(),
            'quizzes'  => $this->model('QuizResult')->count(),
            'latest'   => $this->model('Article')->latest(5),
            'top'      => $this->model('QuizResult')->top(5),
        ]);
    }

    /* ============ ARTIKEL ============ */
    public function articles() {
        $this->view('admin/articles', [
            'title'    => 'Kelola Artikel',
            'active'   => 'articles',
            'articles' => $this->model('Article')->latest(100),
        ]);
    }

    public function articleForm($id = null) {
        $article = $id ? $this->model('Article')->find($id) : null;
        $this->view('admin/article_form', [
            'title'   => $id ? 'Edit Artikel' : 'Tulis Artikel',
            'active'  => 'articles',
            'article' => $article,
        ]);
    }

    public function articleSave() {
        $model = $this->model('Article');
        $id    = $_POST['id'] ?? null;
        $title = trim($_POST['title'] ?? '');
        if ($title === '') redirect('admin/articles');

        $slug = slugify($title);
        $base = $slug; $i = 1;
        while ($model->slugExists($slug, $id ?: 0)) { $slug = $base . '-' . (++$i); }

        $data = [
            'title'     => $title,
            'slug'      => $slug,
            'category'  => trim($_POST['category'] ?? 'Umum'),
            'excerpt'   => trim($_POST['excerpt'] ?? ''),
            'content'   => $_POST['content'] ?? '',
            'author_id' => $_SESSION['user']['id'],
        ];

        $image = $this->upload('image');
        if ($image) $data['image'] = $image;

        if ($id) $model->update($id, $data);
        else     $model->create($data);

        redirect('admin/articles');
    }

    public function articleDelete($id) {
        $this->model('Article')->delete($id);
        redirect('admin/articles');
    }

    /* ============ GALERI ============ */
    public function gallery() {
        $this->view('admin/gallery', [
            'title'     => 'Kelola Galeri',
            'active'    => 'gallery',
            'galleries' => $this->model('Gallery')->all(),
        ]);
    }

    public function gallerySave() {
        $image = $this->upload('image');
        if ($image || !empty($_POST['image_url'])) {
            $this->model('Gallery')->create([
                'title'       => trim($_POST['title'] ?? 'Tanpa Judul'),
                'description' => trim($_POST['description'] ?? ''),
                'image'       => $image ?: trim($_POST['image_url']),
                'location'    => trim($_POST['location'] ?? ''),
            ]);
        }
        redirect('admin/gallery');
    }

    public function galleryDelete($id) {
        $this->model('Gallery')->delete($id);
        redirect('admin/gallery');
    }

    /* ============ BANK SOAL ============ */
    public function questions() {
        $this->view('admin/questions', [
            'title'     => 'Bank Soal',
            'active'    => 'questions',
            'questions' => $this->model('Question')->all(),
        ]);
    }

    public function questionSave() {
        $this->model('Question')->create([
            'question'    => trim($_POST['question'] ?? ''),
            'option_a'    => trim($_POST['option_a'] ?? ''),
            'option_b'    => trim($_POST['option_b'] ?? ''),
            'option_c'    => trim($_POST['option_c'] ?? ''),
            'option_d'    => trim($_POST['option_d'] ?? ''),
            'correct'     => strtolower($_POST['correct'] ?? 'a'),
            'explanation' => trim($_POST['explanation'] ?? ''),
        ]);
        redirect('admin/questions');
    }

    public function questionDelete($id) {
        $this->model('Question')->delete($id);
        redirect('admin/questions');
    }

    /* ============ HASIL KUIS ============ */
    public function results() {
        $this->view('admin/results', [
            'title'   => 'Hasil Kuis',
            'active'  => 'results',
            'results' => $this->model('QuizResult')->all(),
        ]);
    }

    /* ============ UPLOAD HELPER ============ */
    private function upload($field) {
        if (empty($_FILES[$field]) || $_FILES[$field]['error'] !== UPLOAD_ERR_OK) return null;
        $allowed = ['jpg','jpeg','png','webp','gif'];
        $ext = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) return null;
        if ($_FILES[$field]['size'] > 5 * 1024 * 1024) return null;

        $dir = dirname(__DIR__, 2) . '/public/uploads/';
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $name = uniqid('img_') . '.' . $ext;
        return move_uploaded_file($_FILES[$field]['tmp_name'], $dir . $name) ? $name : null;
    }
}