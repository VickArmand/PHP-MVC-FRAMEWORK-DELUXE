<?php
namespace app\core;
use app\core\Controller;
use app\core\Exceptions\NotFoundException;
class Router{
protected array $routes=[];
public Request $request;
public Response $response;
public Controller $controller;
// or
// use \app\core\Request;
// use \app\core\Response;
public function __construct( $request, $response)
{   
    $this->request=$request;
    $this->response=$response;
}
public function get($path, $callback){
    $this->routes['get'][$path]=$callback;
}
public function post($path, $callback){
    $this->routes['post'][$path]=$callback;
}
public function resolve(){
    $path=$this->request->getPath(); 
    $method=$this->request->getMethod();
    $callback=$this->routes[$method][$path] ?? false;
    // echo "<pre>";
    // var_dump($this->routes);
    // echo "</pre>";
    if($callback==false){
        $this->response->setStatusCode(404);
        // return $this->renderView("_404");
        throw new NotFoundException();
        exit;
    }
    else if(is_string($callback)){
        return Application::$app->view->renderView($callback);
    } 
    else if(is_array($callback)){
        // since the controller methods are not static we have to create instances of them
        Application::$app->controller=new $callback[0]();
        Application::$app->controller->currentaction=$callback[1];
        
        $callback[0]=Application::$app->controller;
        foreach(Application::$app->controller->getMiddlewares() as $middleware){
            $middleware->execute();
        }
        return call_user_func($callback,$this->request,$this->response);
    }
    else{
        return call_user_func($callback,$this->request,$this->response);
    }


    
}


}


?>