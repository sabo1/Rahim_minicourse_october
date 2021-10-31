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
        
    // подготавлеваем запрос
    // $statement = $pdo->prepare($sql);
    // // выполнениям запрос
    // $statement->execute([
    //     "email" => $email, 
    //     "password" => $password
    // ]);

};

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