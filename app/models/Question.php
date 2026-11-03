<?php
class Question {
    private $db;
    public function __construct() { $this->db = Database::getInstance()->conn(); }

    public function all() { return $this->db->query("SELECT * FROM questions ORDER BY id DESC")->fetchAll(); }

    public function random($limit = 5) {
        $stmt = $this->db->prepare("SELECT * FROM questions ORDER BY RAND() LIMIT ?");
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM questions WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($d) {
        $stmt = $this->db->prepare(
            "INSERT INTO questions (question, option_a, option_b, option_c, option_d, correct, explanation)
             VALUES (?,?,?,?,?,?,?)"
        );
        return $stmt->execute([
            $d['question'], $d['option_a'], $d['option_b'],
            $d['option_c'], $d['option_d'], $d['correct'], $d['explanation']
        ]);
    }

    public function delete($id) {
        return $this->db->prepare("DELETE FROM questions WHERE id = ?")->execute([$id]);
    }

    public function count() { return (int)$this->db->query("SELECT COUNT(*) FROM questions")->fetchColumn(); }
}