<?php

namespace App\Controllers;
use Core\View;
use App\Models\Post;
class Posts extends \Core\Controller
{
    public function indexAction() {
        $posts = Post::getAll();
        View::renderTemplate('Posts/index.php', ['posts' => $posts]);
    }

    public function addNew() {
        echo "Merhaba ".__CLASS__.' kontrolcüsünün '.__FUNCTION__.' metodundasınız.';
    }

    public function edit() {
        echo "Merhaba ".__CLASS__.' kontrolcüsünün '.__FUNCTION__.' metodundasınız.';
    }
}