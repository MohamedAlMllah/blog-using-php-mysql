<?php

// Don't display server errors 
ini_set("display_errors", "off");
// Initialize a database connection
$con = mysqli_connect("localhost", "root", "", "blog");

// Destroy if not possible to create a connection
if (!$con) {
    echo "<h3 class='container bg-dark p-3 text-center text-warning rounded-lg mt-5'>Not able to establish Database Connection<h3>";
}

// Get data to display on index page
$query = "SELECT * FROM posts";
$result = mysqli_query($con, $query);
$number_of_result = mysqli_num_rows($result);
//determine the total number of pages available  
$number_of_page = ceil($number_of_result / 3);

//determine which page number visitor is currently on  
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}
//determine the sql LIMIT starting number for the results on the displaying page  
$page_first_result = ($page - 1) * 3;

//retrieve the selected results from database   
$query = "SELECT *FROM posts LIMIT " . $page_first_result . ',' . 3;
$result = mysqli_query($con, $query);

// Get post data based on id
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $query = "SELECT * FROM posts WHERE id = $id";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
}

// Delete a post
if (isset($_REQUEST['delete'])) {
    $id = $_REQUEST['id'];

    $query = "DELETE FROM posts WHERE id = $id";
    mysqli_query($con, $query);

    header("Location: index.php");
    exit();
}

// Update a post
if (isset($_REQUEST['update'])) {
    $id = $_REQUEST['id'];
    $title = $_REQUEST['title'];
    $content = $_REQUEST['content'];

    $query = "UPDATE posts SET title = '$title', content = '$content' WHERE id = $id";
    mysqli_query($con, $query);

    header("Location: index.php");
    exit();
}

function check_login($con)
{
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    return 0;
}

function must_be_login($con)
{
    if (check_login($con))
        return check_login($con);
    else
        //redirect to login
        header("Location: login.php");
    die;
}


function random_num($length)
{
    $text = "";
    if ($length < 5) {
        $length = 5;
    }
    $len = rand(4, $length);

    for ($i = 0; $i < $len; $i++) {
        # code...

        $text .= rand(0, 9);
    }
    return $text;
}

// Create a new comment
if (isset($_REQUEST['new_comment'])) {
    session_start();
    $user_data = check_login($con);
    if (!$user_data)
        must_be_login($con);
    $name = $user_data['user_name'];
	$comment = $_REQUEST['comment'];
	$postId = $_REQUEST['postId'];

    $query = "INSERT INTO comments(comment, author_name) VALUES('$comment', '$name')";
    mysqli_query($con, $query);

    echo $query;

    header("Location: view.php?id=$postId");
    exit();
}

