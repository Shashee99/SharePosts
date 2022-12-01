<?php
class Post{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function getPosts(){
        $this->db->query('SELECT *,
       posts.id as postId,
       users.id as userId,
       posts.created_at as postCreated,
        users.created_at as userCreated
        FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC');

        $results = $this->db->resultSet();
        return $results;
    }
    public function addPost($data){
        $this->db->query('INSERT INTO posts(tittle,body,user_id) VALUES (:title,:body,:user_id)');
//        bind values
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':body',$data['body']);
        $this->db->bind(':user_id',$data['user_id']);

        $result = $this->db->execute();
        if($result){
            return true;
        }else{
            return false;
        }
    }
    public function getPostByID($id)
    {
        $this->db->query('SELECT * FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();
//        Check row
        return $row;
    }

    public function editPost($data){
        $this->db->query('UPDATE posts SET tittle = :title, body = :body WHERE id = :id');
//        bind values
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':body',$data['body']);
        $this->db->bind(':id',$data['id']);

        $result = $this->db->execute();
        if($result){
            return true;
        }else{
            return false;
        }
    }
    public function deletePost($id){
        $this->db->query('DELETE FROM posts WHERE id = :id ');

//        bind values

        $this->db->bind(':id',$id);

        $result = $this->db->execute();
        if($result){
            return true;
        }else{
            return false;
        }
    }
}
