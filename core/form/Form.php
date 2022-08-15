<?php
namespace app\core\form;

use app\core\Model;

class Form {
   public static function begin($action, $method){
    // return '<form action ="'.$action.'" method="'.$method.'">';
    echo sprintf('<form action ="%s" method="%s">',$action,$method);

   } 
   public static function end(){
    echo '</form>';
   } 
   public function field(Model $model, $attribute){
    return new InputField($model, $attribute);
   }
   
}


?>