<?php

    require_once 'functions.php';
    destroySession();
    if(!$_SESSION['user']) header ("Location: login_form.php");


?>