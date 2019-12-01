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
    public function add($route, $params = []) {
        // Gelen rota değeri bir düzenli ifadeye dönüştürülüyor (taksim işaretlerinden temizleniyor)
        $route = preg_replace('/\//', '\\/', $route);
        // Bir değişkene dönüştürülüyor (controller vb.)
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
        // Değişkenler tanımlanmış düzenli ifadelere dönüştürülüyor. Örn: {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        // Başlangıç ve bitiş ayraçları ekleniyor, ayrıca büyük küçük duyarsızlık bayrağı ekleniyor
        $route = '/^' . $route . '$/i';
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
//        foreach ($this->routes as $route => $params) {
//            if($url == $route) {
//                $this->params = $params;
//                return TRUE;
//            }
//        }
//        return FALSE;
//        $reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";

        foreach ($this->routes as $route => $params) {
            if(preg_match($route, $url, $matches)) {
                foreach($matches as $key => $match) {
                    if(is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return TRUE;
            }
        }
        return FALSE;
    }

    public function dispatch($url) {
        $url = $this->removeQueryStringVariables($url);
        if($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
//            $controller = "App\Controllers\\$controller";
            $controller = $this->getNamespace().$controller;
            if(class_exists($controller)) {
                $controller_object = new $controller($this->params);

                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);

                if(is_callable([$controller_object, $action])) {
                    $controller_object->$action();
                } else {
                    echo "$controller içerisinde $action metodu bulunamadı!";
                }
            } else {
                echo "$controller sınıfı bulunamadı!";
            }
        } else {
            echo "Eşleşen bir rota bulunamadı!";
        }
    }

    protected function convertToStudlyCaps($string) {
        return str_replace(' ','',ucwords(str_replace('-',' ', $string)));
    }

    protected function convertToCamelCase($string) {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    protected function removeQueryStringVariables($url) {
        if($url != '') {
            $parts = explode('&', $url,2);
            if (strpos($parts[0], '=') === FALSE) {
                $url = $parts[0];
            } else {
                $parts = '';
            }
        }
        return $url;
    }

    public function getNamespace() {
        $namespace = 'App\Controllers\\';
        if(array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'].'\\';
        }
        return $namespace;
    }

    /**
     * $params dizisinin içeriğini döndüren metod
     * @return array
     */
    public function getParams() {
        return $this->params;
    }
}