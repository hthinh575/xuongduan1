<?php
class HomeModel{
    public $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function getUsers(){
        $sql = "select * from users";
        $query = $this->db->pdo->query($sql);
        $result = $query->fetchAll();
        return $result;
    }

    public function checkLogin(){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "select * from users where email = '$email' and password = '$password'";
        $query = $this->db->pdo->query($sql);
        $result = $query->fetch();
        return $result;
    }
}