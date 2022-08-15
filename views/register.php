<?php $this->title='Sign Up'; ?>
<h1>Create An Account</h1>
<?php 
use \app\core\form\Form;
Form::begin('',"post");
$form=new Form();
?>
<div class="row">
    <div class="col"><?php echo $form->field($model,'firstname')?>
</div>
    <div class="col"><?php echo $form->field($model,'lastname')?>
</div>
</div>
<?php echo $form->field($model,'email')?>
<?php echo $form->field($model,'password')->passwordfield()?>
<?php echo $form->field($model,'confirmpassword')->passwordfield()?>
<button type="submit">SUBMIT FORM</button>
<?php echo \app\core\form\Form::end()?>

<style>
    form{
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }
</style>