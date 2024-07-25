<?php


class Router
{
    private $serveruri = [];
    private $server_method;
    private $matched = false;
    private $params = [];
    private $callbackfunc;
    public function __construct()
    {
        $uri = trim($_SERVER["REQUEST_URI"], '\/^$');
        $this->server_method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->serveruri = explode('/', $uri);
        array_shift($this->serveruri);
        $this->serveruri[0]="";
    }

    public function post($url ,$callback){
        $this->match("post",$url,$callback);
    }

    public function get($url ,$callback){
        $this->match("get",$url,$callback);
    }

    public function put($url ,$callback){
        $this->match("put",$url,$callback);
    }

    public function delete($url ,$callback){
        $this->match("delete",$url,$callback);
    }

    private function match($method, $uri, $callback)
    {

        $trimuri = trim($uri, '\/^$');
        $currenturi = explode('/', $trimuri);
        $urilength = count($currenturi);
        echo $this->server_method;
        if ($method != $this->server_method) {
            return;
        }
        print_r( $this->serveruri);
        if ($urilength != count($this->serveruri)) {
            return;
        }
        $match = true;
        

        for ($i = 0; $i < $urilength; $i++) {
            if ($currenturi[$i] == $this->serveruri[$i]) {
                continue;
            }
            if (isset($currenturi[$i][0]) && $currenturi[$i][0] == ':') {
                $this->params[substr($currenturi[$i], 1)] = $this->serveruri[$i];
                continue;
            }
            $match = false;
            break;
        }

        if ($match) {
           $callback();
        }
    }

}