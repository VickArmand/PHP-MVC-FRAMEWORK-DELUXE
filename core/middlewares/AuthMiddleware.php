<?php
namespace app\core\middlewares;

use app\core\Application;
use app\core\Exceptions\ForbiddenException;

class AuthMiddleware extends BaseMiddleware{
    public array $restrictedactions=[];
    public function __construct(array $actions=[])
    {
        $this->restrictedactions=$actions;
    }
    public function execute(){
        if(Application::isGuest()){
            if(empty($this->restrictedactions)|| in_array(Application::$app->controller->currentaction,$this->restrictedactions) ){
               throw new ForbiddenException(); 
            }
        }
    }
        
}

?>