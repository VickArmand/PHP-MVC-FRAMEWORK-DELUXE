<?php
namespace app\models;

use app\core\Application;
use app\core\Model;

class LoginForm extends Model{
    public string $email='';
    public string $password='';
    public function rules():array{
        return [
            'email'=>[self::RULE_REQUIRED,self::RULE_EMAIL],
            'password'=>[self::RULE_REQUIRED]
        ];
    }
    public function labels():array{
        return [
            'email'=>'Email Address',
            'password'=>'Password'
        ];
    }
    public function login(){
        // $user= User::findOne(['email'=> $this->email]);
        $user= new User();
        $userdetails=$user->findOne(['email'=>$this->email]);
        // var_dump($userdetails);
        if(!$userdetails){
            $this->addError('email','User does not exist with this email address');
            return false;
        }
        if(!password_verify($this->password,$userdetails->password)){
            $this->addError('password','Incorrect password');
            return false;
        }
        // echo '<pre>';
        // var_dump($user);
        // echo '</pre>';
        return Application::$app->login($userdetails);
        
       

    }
}
?>