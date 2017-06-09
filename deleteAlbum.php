<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleting Album</title>
</head>
<body>
<?php

    //Step1 - Connect to DB
    $conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200361558', 'gc200361558',  'IWrvd53ZK3');

    //Step2 - Create SQl commnand
    $sql = "DELETE FROM albums WHERE albumID = :albumID";

    //Step3 - prepare and execute the SQL
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':albumID',$_GET['albumID'], PDO::PARAM_INT);
    $cmd->execute();

    //Step4 - disconnect from the DB
    $conn = null;

    //Step5 - redirect to the Album
    header('location:albums.php');

?>
</body>
</html>
<?php ob_flush(); ?>
