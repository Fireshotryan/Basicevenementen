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

if(isset($_POST['delete']))
{
    $evenementId = mysqli_real_escape_string($db, $_POST['evenementId']);

    $query = "DELETE FROM evenementen WHERE id='$evenementId' ";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $_SESSION['message'] = "employee Deleted Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "employee Not Deleted";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['update']))
{
    $evenementId = mysqli_real_escape_string($db, $_POST['evenementId']);

    $evname   = mysqli_escape_string($db, $_POST['evname']);
    $date = mysqli_real_escape_string($db, $_POST['date']);
    $description = mysqli_real_escape_string($db, $_POST['description']);

    $query = "UPDATE evenementen SET evname='$evname', date='$date', description='$description' WHERE id='$evenementId' ";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $_SESSION['message'] = "employee Updated Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "employee Not Updated";
        header("Location: update.php");
        exit(0);
    }

}