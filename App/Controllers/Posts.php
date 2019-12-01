<?php

namespace App\Controllers;
use Core\View;

class Posts extends \Core\Controller
{
    public function indexAction() {
        View::renderTemplate('Posts/index.php', array(
            'fullName' => 'Ahmet Altun',
            'age' => 29
        ));
    }

    public function addNew() {
        echo "Merhaba ".__CLASS__.' kontrolcüsünün '.__FUNCTION__.' metodundasınız.';
    }

    public function edit() {
        echo "Merhaba ".__CLASS__.' kontrolcüsünün '.__FUNCTION__.' metodundasınız.';
    }
}