<?php
session_start();
include "logic.php";
$userData = check_login($con);
if (!$userData)
    must_be_login($con);

$query = "SELECT * FROM comments WHERE id = $id";
$comments = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Blog using PHP & MySQL</title>
</head>

<body>

    <div class="container mt-5">
        <?php foreach ($comments as $comment) { ?>
            <form method="POST">
                <input type="text" hidden value='<?php echo $comment['post_id'] ?>' name="postId">
                <input type="text" hidden value='<?php echo $comment['id'] ?>' name="id">
                <input type="text" placeholder="Comment" class="form-control my-3 text-center" name="comment" value="<?php echo $comment['comment'] ?>">
                <div class="text-center">
                    <button class="btn btn-success" name="update_comment">Update</button>
                </div>
            </form>
        <?php } ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>

</html>