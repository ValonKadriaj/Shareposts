<?php

  class Posts extends Controller{
    public function __construct(){
      if (!isLoggedIn()) {
        redirect('users/login');
      }

      $this->postModel =  $this->model('Post');
      $this->userModel =  $this->model('User');
    }
    public function index(){
      $posts = $this->postModel->getPosts();
      $data = [
          'post' => $posts
      ] ;
      $this->view('posts/index', $data);
    }

    public function add(){

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
            'title' => trim($_POST['title']),
            'body' => trim($_POST['body']),
            'user_id' =>$_SESSION['user_id'],
            'title_err' => '',
            'body_err' => ''

        ];
        if (empty($data['title'])) {
          $data['title_err'] = 'Please enter title';
        }
        if (empty($data['body'])) {
          $data['body_err'] = 'Please enter body text';
        }
        if (empty($data['title_err']) && empty($data['body_err'])) {
            if ($this->postModel->addPost($data)) {
              flash('post_message', 'post add');
              redirect('post');
            }else {
              die('something wrong');
            }
        }else {
          $this->view('posts/add', $data);
        }
      }else {
        $data = [
          'title' => "",
          'body' => ""
        ];
      }
      $this->view('posts/add', $data);
    }

    public function edit($id){

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
            'id' => $id,
            'title' => trim($_POST['title']),
            'body' => trim($_POST['body']),
            'user_id' =>$_SESSION['user_id'],
            'title_err' => '',
            'body_err' => ''

        ];
        if (empty($data['title'])) {
          $data['title_err'] = 'Please enter title';
        }
        if (empty($data['body'])) {
          $data['body_err'] = 'Please enter body text';
        }
        if (empty($data['title_err']) && empty($data['body_err'])) {
            if ($this->postModel->updatePost($data)) {

              redirect('posts');
            }else {
              die('something wrong');
            }
        }else {
          $this->view('posts/edit', $data);
        }
      }else {
        $post = $this->postModel->getPostById($id);

        if ($post->userId != $_SESSION['user_id']) {
          redirect('posts');
        }
        $data = [
          'id' => $id,
          'title' => $post->title,
          'body' => $post->body
        ];
      }
      $this->view('posts/edit', $data);
    }


    public function show($id){
      $post = $this->postModel->getPostById($id);
      $user = $this->userModel->findUserById($post->userId);
      $data = [
        'post' => $post,
        'user' => $user
      ];
      $this->view('posts/show', $data);
    }


    public function delete($id){
      $post = $this->postModel->getPostById($id);

      if ($post->userId != $_SESSION['user_id']) {
        redirect('posts');
      }
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($this->postModel->deletePost($id)) {
          redirect('posts');
        }else {
          die('somtheing wrong');
        }
      }else {
        redirect('posts');
      }
    }
  }
