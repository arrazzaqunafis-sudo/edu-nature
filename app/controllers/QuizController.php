<?php
class QuizController extends Controller {
    public function index() {
        $this->view('quiz/index', [
            'title'     => 'Kuis Alam',
            'active'    => 'quiz',
            'questions' => $this->model('Question')->random(5),
        ]);
    }

    public function submit() {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!is_array($input) || empty($input['answers'])) {
            return $this->json(['error' => 'Data tidak valid']);
        }

        $qModel = $this->model('Question');
        $score  = 0;
        $detail = [];

        foreach ($input['answers'] as $qid => $answer) {
            $q = $qModel->find((int)$qid);
            if (!$q) continue;
            $isCorrect = strtolower($answer) === strtolower($q['correct']);
            if ($isCorrect) $score++;
            $detail[] = [
                'question'    => $q['question'],
                'your'        => strtoupper($answer),
                'correct'     => strtoupper($q['correct']),
                'is_correct'  => $isCorrect,
                'explanation' => $q['explanation'],
            ];
        }

        $total = count($detail);
        $name  = trim($input['name'] ?? '') ?: 'Pengunjung';
        $this->model('QuizResult')->create($name, $score, $total);

        $this->json(['score' => $score, 'total' => $total, 'detail' => $detail]);
    }
}