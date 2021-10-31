<?php

session_start();

require 'functions.php';

$email = $_POST['email'];
$password = $_POST['$password'];

$users = get_user_by_email($email);

if(!$users){
    set_flash_message('error_login', 'That person is not found');
    redirect_to('page_login.php');
}    

login($email, $password);
redirect_to('users.php');