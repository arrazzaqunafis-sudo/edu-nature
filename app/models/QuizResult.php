<?php
class QuizResult {
    private $db;
    public function __construct() { $this->db = Database::getInstance()->conn(); }

    public function create($name, $score, $total) {
        $stmt = $this->db->prepare("INSERT INTO quiz_results (name, score, total) VALUES (?,?,?)");
        return $stmt->execute([$name, $score, $total]);
    }

    public function all($limit = 100) {
        $stmt = $this->db->prepare("SELECT * FROM quiz_results ORDER BY created_at DESC LIMIT ?");
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function top($limit = 5) {
        $stmt = $this->db->prepare("SELECT * FROM quiz_results ORDER BY (score/total) DESC, created_at DESC LIMIT ?");
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function count() { return (int)$this->db->query("SELECT COUNT(*) FROM quiz_results")->fetchColumn(); }
}