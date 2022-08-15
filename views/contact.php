<?php $this->title='Contact'; ?>
<h1>Contact Us</h1>
<?php 
use app\models\ContactForm;
use app\core\View;
use app\core\form\Form;
use app\core\form\TextareaField;

Form::begin('','post');
$form=new Form();
echo $form->field($model,'subject');
echo $form->field($model,'email');
echo new TextareaField($model,'body');
?>
    <button type="submit">SUBMIT FORM</button>
<?php
Form::end();

?>


<style>
    form{
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }
</style>