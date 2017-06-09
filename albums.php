<?php
$pageTitle = 'Albums';
require_once('header.php');
?>
    <main class="container">
    <h1>Albums</h1>

    <?php

        //Step1 - connect to the database
        require_once('db.php');
        //step 2 - create a SQL command
            $sql = "SELECT * FROM albums";
            //step 3 - prepare the SQL command
            $cmd = $conn->prepare($sql);
            //step 4 - execute and store the results
            $cmd->execute();
            $albums = $cmd->fetchAll();
            //step 5 - disconnect from the DB
            $conn = null;
            //create a table and display the results
            echo '<table class="table table-striped table-hover">
            <tr><th>Title</th>
                <th>Year</th>
                <th>Artist</th>
                <th>Genre</th>
                <th>Cover Image</th>';

            if(!empty($_SESSION['email'])) {

                echo '<th>Edit</th>
                <th>Delete</th></tr>';
            }
            foreach($albums as $album)
            {
                echo '<tr><td>'.$album['title'].'</td>
                      <td>'.$album['year'].'</td>
                      <td>'.$album['artist'].'</td>
                      <td>'.$album['genre'].'</td>
                      <td><img height="50" src='.$album['coverFile'].'</td>';
                            if(!empty($_SESSION['email'])) {

                                echo '<td><a href="AlbumDetails.php?albumID=' . $album['albumID'] . '"
                                class="btn btn-primary">Edit</a></td>
                                <td><a href="deleteAlbum.php?albumID=' . $album['albumID'] . '"
                                class="btn btn-danger confirmation">Delete</a></td></tr>';
                            }
        }
        echo '</table>';
            ?>
    </main>
     <?php require_once('footer.php'); ?>