<?php
use \app\core\View;
$view=new View();
 $view->title='Sign In'; ?>
<h1>Login</h1>
<?php 
use \app\core\form\Form;
Form::begin('',"post");
$form=new Form();
?>

<?php echo $form->field($model,'email')?>
<?php echo $form->field($model,'password')->passwordfield()?>
<button type="submit">LOGIN</button>
<?php echo \app\core\form\Form::end()?>

<style>
    form{
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }
</style>