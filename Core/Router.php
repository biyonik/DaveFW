<?php


class Router
{
    /**
     * Rota tablosunu saklayan dizi
     * @var array
     */
    protected $routes = [];

    /**
     * Eşleşen rotanın parametrelerini içeren dizi
     * @var array
     */
    protected $params = [];

    /**
     * Rota tablosuna bir rota ekler
     * @param $route
     * @param $params
     */
    public function add($route, $params) {
        $this->routes[$route] = $params;
    }

    /**
     * Rota tablosundaki tüm rotaları geri döndüren metod
     * @return array
     */
    public function getRoutes() {
        return $this->routes;
    }

    /**
     * Rota tablosundaki rotalar ile gönderilen url değişkenini karşılaştırır.
     * Eğer bir eşleşme var ise $params dizisine eşleşen rotanın params dizisini tayin eder
     * @param $url
     * @return bool
     */
    public function match($url) {
        foreach ($this->routes as $route => $params) {
            if($url == $route) {
                $this->params = $params;
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * $params dizisinin içeriğini döndüren metod
     * @return array
     */
    public function getParams() {
        return $this->params;
    }
}