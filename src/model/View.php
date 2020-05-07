<?php

namespace Blog\src\model;
use Blog\config\Request;

class View
{
    private $file;
    private $title;
    private $request;
    private $session;
    private $post;


    public function __construct()
    {
        $this->request = new Request();
        $this->session = $this->request->getSession();
        $this->post = $this->request->getPost();
    }

    public function render($template, $data = [])
    {
        $this->file = '../templates/'.$template.'.php';
        $content  = $this->renderFile($this->file, $data);
        $view = $this->renderFile('../templates/base.php', [
            'title' => $this->title,
            'content' => $content,
            'session' => $this->session,
            'post'=> $this->post
        ]);
        echo $view;
    }

    private function renderFile($file, $data)
    {
        if(file_exists($file)){
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        }
        header('Location: index.php?route=notFound');
    }
}