<?php

$email = $_POST['email'];
$password = $_POST['password'];

//Step1 - connect to db
require_once('db.php');

//Step2 - build the sql command
$sql = "SELECT * FROM users WHERE email = :email; ";

//Step3 - bind the parameters and execute the command
$cmd = $conn->prepare($sql);
$cmd->bindParam(':email',$email,PDO::PARAM_STR, 120);
$cmd->execute();
$user = $cmd->fetch();

//Step4 - validate user
if(password_verify($password, $user['password'])){
    //excellent we have a valid password
    session_start();
    $_SESSION['email'] = $user['email'];
    $_SESSION['username'] = $user['username'];
    header('location:albums.php');
}
else{
    //user was not found or did not have a valid password
    header('location:login.php?invalid=true');
    exit();
}

//Step5 - disconnect from db
$conn = null;
?>