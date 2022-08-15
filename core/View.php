<?php
namespace app\core;
use app\core\Exceptions\NotFoundException;

class View{
   public string $title= ''; 

   
public function renderView($view,$params=[]){
    
    if(file_exists(Application::$ROOT_DIR.'/views/'.$view.'.php')){
        $viewContent=$this->renderOnlyView($view,$params);
        $layoutContent=$this->layoutContent();
        return str_replace("{{content}}",$viewContent,$layoutContent);
    }
    else{
        $this->response->setStatusCode(404);
        // return $this->renderView("_404");
        throw new NotFoundException();
    } 
}
protected function layoutContent(){
$layout=Application::$app->layout;
if(Application::$app->controller){
    $layout=Application::$app->controller->layout;  
}
ob_start();
include_once Application::$ROOT_DIR.'/views/layouts/'.$layout.'.php';
return ob_get_clean();
}
public function renderOnlyView($view,$params){

foreach($params as $key=>$value){
    $$key=$value;
}
ob_start();
include_once Application::$ROOT_DIR.'/views/'.$view.'.php';
return ob_get_clean();  
}
}
?>