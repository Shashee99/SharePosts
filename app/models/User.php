<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

//  find user by email
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();
//        Check row
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
//    getPostByID

    public function getUserByID($id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();
//        Check row
        return $row;
    }
    public function register($data){
        $name = $data['name'];
        $email= $data['email'];
        $password = $data['password'];
        $this->db->query('INSERT INTO users(name,email,password) VALUES (:name,:email,:password)');
//        Bind values
        $this->db->bind(':name',$name);
        $this->db->bind(':email',$email);
        $this->db->bind(':password',$password);
//If we do an insert update delete we have to execute it with execute method in the Database library
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }
    public function login($email,$password){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email',$email);

        $row = $this->db->single();
        $hashed_password = $row->password;

        if(password_verify($password,$hashed_password)){
            return $row;
        }else{
            return false;
        }
    }
}
