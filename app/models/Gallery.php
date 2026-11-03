<?php
class Gallery {
    private $db;
    public function __construct() { $this->db = Database::getInstance()->conn(); }

    public function all($limit = 100) {
        $stmt = $this->db->prepare("SELECT * FROM galleries ORDER BY created_at DESC LIMIT ?");
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function latest($limit = 6) { return $this->all($limit); }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM galleries WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($d) {
        $stmt = $this->db->prepare("INSERT INTO galleries (title, description, image, location) VALUES (?,?,?,?)");
        return $stmt->execute([$d['title'], $d['description'], $d['image'], $d['location']]);
    }

    public function delete($id) {
        return $this->db->prepare("DELETE FROM galleries WHERE id = ?")->execute([$id]);
    }

    public function count() { return (int)$this->db->query("SELECT COUNT(*) FROM galleries")->fetchColumn(); }
}