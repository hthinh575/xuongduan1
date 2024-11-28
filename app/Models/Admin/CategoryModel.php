<?php
class CategoryModel {
    public $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function allCategory(){
        $sql = "SELECT * FROM categories";
        $query = $this->db->pdo->query($sql);
        $result = $query->fetchAll();
        return $result;
    }

    public function addCategory(){
        $name = $_POST['name'];
        $sql = "INSERT INTO categories(name) VALUES (:name)";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    public function deleteCategory(){
        $id = $_GET['id'];
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getCategoryByID(){
        $id = $_GET['id'];
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        if($stmt->execute()){
            return $stmt->fetch();
        }
        return false;
    }

    public function updateCategoryToDB(){
        $id = $_GET['id'];
        $name = $_POST['name'];
        $sql = "UPDATE categories SET name = :name WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}