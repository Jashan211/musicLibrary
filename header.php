<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle ?></title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">

</head>
<body>

<nav class="nav navbar-inverse">
    <ul class="nav navbar-nav">
        <li><a href="default.php" class="navbar-brand">Music Library</a></li>
        <li><a href="albums.php">Albums</a></li>
        <?php
        session_start();
        if (empty($_SESSION['email']))
        {
            echo'<li><a href="registration.php">Register</a></li>
                 <li><a href="login.php">Login</a></li>';
        }
        else{
            echo'<li><a href="AlbumDetails.php">Add new album</a></li>
                 <li><a href="logout.php">Logout</a></li>';
        }
        //public (not logged in) links

        //private / logged in links
        ?>
        </ul>
</nav>
