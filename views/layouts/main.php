<?php
use app\core\Application;
?>
<html>
    <head>
        <title><?php echo $this->title?></title>
    </head>
    <body>
    <?php
    // echo '<pre>';
    // var_dump(Application::$app->user);
    // echo '</pre>';
     if(Application::isGuest()):?>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item-active"><a class="nav-link" href="/login">Login</a> </li>
            <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>    
        </ul>
        <?php else: ?>
            <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="/profile">Profile</a></li>    
            <li class="nav-item-active"><a class="nav-link" href="/logout">Welcome <?php echo Application::$app->user->getDisplayName()?> (Logout)</a> </li>
        </ul>
        <?php endif;?>
        <div class="container">
        <?php if(Application::$app->session->getFlash('success')):?>

        <div class="alert alert-success">
            <?php echo Application::$app->session->getFlash('success') ?>
        </div>
        <?php endif;?>
        {{content}}
        </div>
       
       
    </body>
</html>