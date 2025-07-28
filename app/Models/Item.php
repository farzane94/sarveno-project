<?php

namespace App\Models;

use App\Core\Database;

class Item
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function index($keyword)
    {
        if (empty($keyword)) {
            return $this->all();
        }

        return $this->search($keyword);
    }

    public function search($keyword)
    {
        $stmt = $this->db->prepare("SELECT * FROM items WHERE name LIKE ? ORDER BY created_at DESC");
        $stmt->execute(['%' . $keyword . '%']);
        return $stmt->fetchAll();
    }

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM items ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM items WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($name)
    {
        $stmt = $this->db->prepare("INSERT INTO items (name) VALUES (?)");
        $stmt->execute([$name]);
        return $this->find($this->db->lastInsertId());
    }

    public function update($id, $name)
    {
        $stmt = $this->db->prepare("UPDATE items SET name = ? WHERE id = ?");
        $stmt->execute([$name, $id]);
        return $this->find($id);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM items WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function toggleCheck($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE items SET is_checked = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
        return $this->find($id);
    }
}
