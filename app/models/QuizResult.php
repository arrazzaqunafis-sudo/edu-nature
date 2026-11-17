<?php
class QuizResult {
    private $db;
    public function __construct() { $this->db = Database::getInstance()->conn(); }

    public function create($name, $score, $total, $userId = null) {
        $stmt = $this->db->prepare("INSERT INTO quiz_results (name, user_id, score, total) VALUES (?,?,?,?)");
        return $stmt->execute([$name, $userId, $score, $total]);
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

    public function byUser($userId, $limit = 20) {
        $stmt = $this->db->prepare("SELECT * FROM quiz_results WHERE user_id = ? ORDER BY created_at DESC LIMIT ?");
        $stmt->bindValue(1, (int)$userId, PDO::PARAM_INT);
        $stmt->bindValue(2, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function count() { return (int)$this->db->query("SELECT COUNT(*) FROM quiz_results")->fetchColumn(); }
}