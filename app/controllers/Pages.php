<?php
  class Pages extends Controller {
    public function __construct(){
     
    }
    
    public function index(){
        if(isLoggedIn()){
            redirect('posts');
        }
      $data = [
        'title' => 'SharePosts',
          'description' => 'Simple Social network platform built on the php mvc framework'
      ];
     
      $this->view('pages/index', $data);
    }

    public function about(){
        $data = [
            'title' => 'SharePosts',
            'description' => 'App to share posts with other users'
        ];
      $this->view('pages/about', $data);
    }

  }