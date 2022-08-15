<?php
namespace app\core;
use app\core\Controller;
use app\core\db\Database;

class Application{
    public string $layout='main';
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public View $view;
    public Database $db;
    public ?UserModel $user;
    public $UserClass;
    public static Application $app;
    public static string $ROOT_DIR;
    public ?Controller $controller=null;
    public function __construct($rootpath,array $config)
    {
     $this->UserClass=new $config['userClass'];
     self::$ROOT_DIR=$rootpath;
     self::$app=$this;
     $this->request= new Request();   
     $this->response= new Response();  
     $this->session= new Session();  
     $this->router= new Router($this->request,$this->response);
    $this->view=new View();
    $this->db=new Database($config['db']);
    $primaryValue=$this->session->get('user');
 
    if($primaryValue){
        $primaryKey=$this->UserClass->primaryKey();
        $this->user=$this->UserClass->findOne([$primaryKey => $primaryValue]);
    }
    else{
        $this->user=null;
    }
    }
    public static function isGuest(){
        return !self::$app->user;
    }
    public function run(){
        try{
            echo  $this->router->resolve();
        }catch(\Exception $ex){
            $this->response->setStatusCode(403);

            echo $this->view->renderView('_error',[
                'exception'=> $ex
            ]);
        }
    }
    public function getController(){
        return $this->controller;
    }
    public function setController(\app\core\Controller $controller){
        $this->controller=$controller;
    }
    public function login(UserModel $user){
       $this->user=$user;
       $primaryKey=$user->primaryKey();
       $primaryValue=$user->{$primaryKey};
       $this->session->set('user',$primaryValue);
       return true;
    }
    public function logout(){
        $this->user=null;
        $this->session->remove('user');
    }
  
}
?>