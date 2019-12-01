<?php

namespace Core;

class View
{
    public static function render($view, $args = []) {
        extract($args, EXTR_SKIP);
        $file = '../App/Views/'.$view;
        if(is_readable($file)) {
            require $file;
        } else {
            echo "$file dosyası bulunamadı";
        }
    }

    public static function renderTemplate($template, $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            //$loader = new \Twig_Loader_Filesystem('../App/Views');
            $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/App/Views');
            $twig = new \Twig\Environment($loader);
        }

        echo $twig->render($template, $args);
    }
}