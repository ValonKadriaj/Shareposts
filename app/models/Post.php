<?php

  class Post {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }


    public function getPosts(){
      $this->db->query('SELECT *,
                        posts.id as postId,
                        user.id as userId,
                        posts.created_at
                        FROM posts
                        INNER JOIN user
                        on posts.userId = user.id
                        ORDER BY posts.created_at DESC
                        ');
      $result = $this->db->resultSet();
      return $result;
    }



    public function addPost($data){
      $this->db->query('INSERT INTO posts (title, userId, body) VALUES (:title, :userId, :body)');
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':userId', $data['user_id']);
      $this->db->bind(':body', $data['body']);

      if ($this->db->execute()) {
        return true;
      }else {
        return false;
      }
    }
    public function updatePost($data){
      $this->db->query('UPDATE  posts SET title = :title, body = :body WHERE id = :id ');
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':body', $data['body']);

      if ($this->db->execute()) {
        return true;
      }else {
        return false;
      }
    }




    public function getPostById($id){
      $this->db->query('SELECT * FROM posts where id = :id');
      $this->db->bind(':id', $id);
      return  $this->db->single();
    }



    public function deletePost($id){
      $this->db->query('DELETE  FROM posts  WHERE id = :id ');
      $this->db->bind(':id', $id);

      if ($this->db->execute()) {
        return true;
      }else {
        return false;
      }
    }
  }
