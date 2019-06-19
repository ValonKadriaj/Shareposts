<?php
  class Pages extends Controller {
    public $postModel;
    public function __construct(){
    }
    public function index(){
      if (isLoggedIn()) {
        redirect('posts');
      }
      $data = [
        'title' => 'share posts',
        'description' => 'simple social network '
      ];
      $this->view('pages/index', $data);
    }
    public function about(){
      $data = [
        'title' => 'about us',
        'description' => 'App to share posts with other user'
      ];
      $this->view('pages/about', $data);
    }
  }
