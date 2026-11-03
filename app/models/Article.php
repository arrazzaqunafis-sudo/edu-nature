<?php
class Article {
    private $db;
    public function __construct() { $this->db = Database::getInstance()->conn(); }

    public function latest($limit = 6) {
        $stmt = $this->db->prepare("SELECT * FROM articles ORDER BY created_at DESC LIMIT ?");
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function search($category = null, $q = null) {
        $sql = "SELECT * FROM articles WHERE 1=1";
        $params = [];
        if ($category) { $sql .= " AND category = ?"; $params[] = $category; }
        if ($q)        { $sql .= " AND (title LIKE ? OR excerpt LIKE ?)"; $params[] = "%$q%"; $params[] = "%$q%"; }
        $sql .= " ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function findBySlug($slug) {
        $stmt = $this->db->prepare("SELECT * FROM articles WHERE slug = ?");
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM articles WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function related($category, $exceptId, $limit = 3) {
        $stmt = $this->db->prepare("SELECT * FROM articles WHERE category = ? AND id <> ? ORDER BY RAND() LIMIT ?");
        $stmt->bindValue(1, $category);
        $stmt->bindValue(2, (int)$exceptId, PDO::PARAM_INT);
        $stmt->bindValue(3, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function incrementViews($id) {
        $this->db->prepare("UPDATE articles SET views = views + 1 WHERE id = ?")->execute([$id]);
    }

    public function create($d) {
        $stmt = $this->db->prepare(
            "INSERT INTO articles (title, slug, category, excerpt, content, image, author_id)
             VALUES (?,?,?,?,?,?,?)"
        );
        return $stmt->execute([
            $d['title'], $d['slug'], $d['category'], $d['excerpt'],
            $d['content'], $d['image'] ?? null, $d['author_id'] ?? null
        ]);
    }

    public function update($id, $d) {
        $set = []; $vals = [];
        foreach ($d as $k => $v) { $set[] = "$k = ?"; $vals[] = $v; }
        $vals[] = $id;
        return $this->db->prepare("UPDATE articles SET " . implode(', ', $set) . " WHERE id = ?")->execute($vals);
    }

    public function delete($id) {
        return $this->db->prepare("DELETE FROM articles WHERE id = ?")->execute([$id]);
    }

    public function slugExists($slug, $exceptId = 0) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM articles WHERE slug = ? AND id <> ?");
        $stmt->execute([$slug, $exceptId]);
        return $stmt->fetchColumn() > 0;
    }

    public function count() { return (int)$this->db->query("SELECT COUNT(*) FROM articles")->fetchColumn(); }
    public function categories() {
        return $this->db->query("SELECT DISTINCT category FROM articles ORDER BY category")->fetchAll(PDO::FETCH_COLUMN);
    }
}