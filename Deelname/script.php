<?php
session_start();
/** @var mysqli $db */

//Require DB settings with connection variable
require_once "../includes/database.php";


//May I even visit this page?
if (!isset($_SESSION['loggedInUser'])) {
    header("Location: ../login.php");
    exit;
}

//Get email from session
$name = $_SESSION['loggedInUser']['name'];



if(isset($_POST['submit']))
{
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $userid = $_SESSION['loggedInUser']['id'];

    $query = "INSERT INTO userhasevenement (userid, id) SELECT users.userid, evenementen.id FROM users INNER JOIN evenementen ON users.userid = '$userid' AND evenementen.id = '$id'";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Updated Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Not Updated";
        header("Location: update.php");
        exit(0);
    }

}