<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registering User</title>
</head>
<body>
<?php
 $email = $_POST['email'];
 $password = $_POST['password'];
 $confirm = $_POST['confirm'];
 $username = $_POST['username'];
 $ok = true;

 if ($password != $confirm)
 {
     echo 'The passwords do not match <br />';
     $ok =false;
 }

 if(strlen($password) <8)
 {
     echo 'The password is too short, must be 8 or more characters <br />';
     $ok = false;
 }
 if (empty($email)){
     echo 'You must enter an email address <br />';
     $ok = false;
 }

 //if the email and password are ok
if($ok)
{
    //connect to the DB and set up the new user
    //Step1 - connect to db
    require_once('db.php');

    //Step2 - create a sql command
    $sql = "INSERT INTO users VALUES (:email, :username, :password)";

    //Step2.5 - Hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //Step3 - prepare and execute sql comand
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':email',$email, PDO::PARAM_STR, 120);
    $cmd->bindParam(':username',$username, PDO::PARAM_STR, 100);
    $cmd->bindParam(':password',$password, PDO::PARAM_STR, 255);
    try {
        $cmd->execute();
    }
    catch (Exception $e)
    {
        if (strpos ($e->getMessage(), 'Integrity constraint violation: 1062') == true){
            header('location:registration.php?errorMessage=email-already exists');
        }
        else{
            header('location:AlbumDetails.php');
        }
    }


    //Step4 - disconnect from db
    $conn = null;
}
?>
</body>
</html>
