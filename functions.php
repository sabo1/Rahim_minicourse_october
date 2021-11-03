<?php

function get_user_by_email( $email ) {

    $email = $_POST["email"];
    $password = $_POST["password"];    

    $pdo = new PDO("mysql:host=localhost;dbname=minicourse-october", "root", "");

    $sql = "SELECT * FROM register WHERE email=:email";
    
    $statement = $pdo->prepare($sql);
    $statement->execute(["email" => $email]);
    $users = $statement->fetch(PDO::FETCH_ASSOC);
    
};

function add_user($email, $password) {
    
    $pdo = new PDO("mysql:host=localhost;dbname=minicourse-october", "root", "");

    $sql = "INSERT INTO register (email, password) VALUES (:email, :password)";   
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email, 'password'=> password_hash($password, PASSWORD_DEFAULT)]);   
  
};

function login($email, $password) {
    $user = get_user_by_email($email);
    if(empty($users)) {
        $_SESSION['danger'] = 'Login or password is not correct!';
        redirect_to('page_register.php');
        exit;
    }

    if(!password_verify($password, $users['password'])) {
        display_flash_message('danger');
        redirect_to('page_register.php');
        exit;
    }

    $_SESSION['user'] = $users;

    return true;
}

function set_flash_message($name, $message) {
    
    $_SESSION[$name] = $message;   
    
};

function display_flash_message($name) {
    if(isset($_SESSION[$name]))
    echo "<div class=\"alert alert-{$name} text-dark\" role=\"alert\">{$_SESSION[$name]}<div>" ;
    unset($_SESSION[$name]);
};

function redirect_to($path) {
    header("Location: {$path}");
    exit;
};

