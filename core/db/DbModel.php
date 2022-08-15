<?php
namespace app\core\db;
use app\core\Model;
use app\core\Application;
abstract class DbModel extends Model{

    abstract public function tablename():string;
    abstract public function attributes():array;
    abstract public function primaryKey():string;
    public function save(){
        $tableName=$this->tablename();
        $attributes=$this->attributes();
        $params=array_map(fn($attr)=>":$attr",$attributes);
        $statement=self::prepare('INSERT INTO '.$tableName.'('.implode(',',$attributes).') VALUES('.implode(',',$params).')' );
        foreach($attributes as $attribute){
          $statement->bindValue(":$attribute",$this->{$attribute});  
        }
        $statement->execute();
        return true;
    }
    public function findOne($where){
        $tableName=static::tablename();
        $attributes=array_keys($where);
        $sql=implode("AND ",array_map(fn($attr)=>"$attr=:$attr",$attributes));
        $statement=self::prepare("SELECT * FROM  $tableName  WHERE  $sql ");
        foreach($where as $key =>$item){
            $statement->bindValue(":$key",$item);
        }
        $statement->execute();
    //    var_dump($statement->fetchObject(static::class)) ;

        return $statement->fetchObject(static::class);
    }
    public static function prepare($sql){
        return Application::$app->db->pdo->prepare($sql);

    }


    abstract public function getDisplayName(): string;
    
   
}
?>