<?php

class Posts extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//            SANITIZE THE POST ARRAY
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => $_POST['title'],
                'body' => $_POST['body'],
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''

            ];
//VALIDATE DATA
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter a title';
            }
            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter a body';
            }

//            MAKE SURE NOT errors are not EMPTY
            if (empty($data['title_err']) && empty($data['body_err'])) {
//               validated
                if ($this->postModel->addPost($data)) {
                    flash('post_added', 'Post added');
                    redirect('posts');
                } else {
                    die('something went wrong');
                }
            } else {
//                load view with errors
                $this->view('posts/add', $data);
            }

        } else {
            $data = [
                'title' => '',
                'body' => ''
            ];
            $this->view('posts/add', $data);
        }

    }

    public function show($id)
    {
        $post = $this->postModel->getPostByID($id);
        $user = $this->userModel->getUserByID($post->user_id);

        $data = [
            'post' => $post,
            'user' => $user
        ];

        $this->view('posts/show', $data);
    }
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//            SANITIZE THE POST ARRAY
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id'=> $id,
                'title' => $_POST['title'],
                'body' => $_POST['body'],
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''

            ];
//VALIDATE DATA
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter a title';
            }
            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter a body';
            }

//            MAKE SURE NOT errors are not EMPTY
            if (empty($data['title_err']) && empty($data['body_err'])) {
//               validated
                if ($this->postModel->editPost($data)) {
                    flash('post_added', 'Post Edited');
                    redirect('posts');
                } else {
                    die('something went wrong');
                }
            } else {
//                load view with errors
                $this->view('posts/edit', $data);
            }

        } else {
//            get existing post from model
            $post = $this->postModel->getPostByID($id);
//            check owner
            if($_SESSION['user_id']!=$post->user_id){
                redirect('posts');
            }

            $data = [
                'id'=>$id,
                'title' => $post->tittle,
                'body' => $post->body
            ];
            $this->view('posts/edit', $data);
        }

    }
    public function delete($id){
        //            get existing post from model
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $post = $this->postModel->getPostByID($id);
//            check owner
            if($_SESSION['user_id']!=$post->user_id){
                redirect('posts');
            }
            $result = $this->postModel->deletePost($id);
            if ($result){
                flash('deleted','Delete succefuly','alert alert-danger');
                redirect('posts');
            }else{
                die('Something went wrong!');
            }
        }else{
            redirect('posts');
        }



    }




}
