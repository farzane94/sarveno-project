<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Item;

class ItemController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Item();
    }

    public function index()
    {
        $keyword = $_GET['keyword'] ?? '';

        $this->json($this->model->index($keyword));
    }

    public function store()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['name'])) return $this->json(['error' => 'Name required'], 422);
        $this->json($this->model->create($data['name']));
    }

    public function update()
    {
        $id = $_GET['id'] ?? null;
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$id || !isset($data['name'])) return $this->json(['error' => 'Invalid'], 422);
        $this->json($this->model->update($id, $data['name']));
    }

    public function destroy()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) return $this->json(['error' => 'Invalid'], 422);
        $this->json(['deleted' => $this->model->delete($id)]);
    }

    public function toggle()
    {
        $id = $_GET['id'] ?? null;
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$id || !isset($data['is_checked'])) return $this->json(['error' => 'Invalid'], 422);
        $this->json($this->model->toggleCheck($id, $data['is_checked']));
    }
}
