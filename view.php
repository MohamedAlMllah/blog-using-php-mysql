<?php

include "logic.php";

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
        <div class="p-5 rounded-lg text-center">
            <h1><?php echo $row['title']; ?></h1>
            <div class="d-flex mt-2 justify-content-center align-items-center">
                <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary btn-sm" name="edit">Edit</a>
                <form method="POST">
                    <input type="text" hidden value='<?php echo $row['id'] ?>' name="id">
                    <button class="btn btn-danger btn-sm ml-2" name="delete">Delete</button>
                </form>
            </div>
        </div>

        <img class="col-12" style="height: 200px;" src="uploads/<?= $row['image_url'] ?>" alt="article picture">

        <p class="mt-5 border-left border-dark pl-3"><?php echo $row['content']; ?></p>

        <hr class="mt-5">
        <h5>Comments</h5>
        <ul class="list-group mb-3">
            <?php foreach ($comments as $comment) { ?>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-2 text-success"><b><?php echo $comment['author_name']; ?></b></div>
                        <div class="col-8"><?php echo $comment['comment']; ?></div>
                        <div class="col-2 row">
                            <a href="editComment.php?id=<?php echo $comment['id'] ?>" class="btn btn-secondary btn-sm" name="edit">Edit</a>
                            <form method="POST">
                                <input type="text" hidden value='<?php echo $comment['id'] ?>' name="id">
                                <input type="text" hidden value='<?php echo $comment['post_id'] ?>' name="postId">
                                <button class="btn btn-danger btn-sm ml-2" name="delete_comment">Delete</button>
                            </form>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>

        <form class="row mb-5" method="post">
            <div class="col-10">
                <input type=" text" placeholder="Comment" class="form-control text-center" name="comment">
            </div>
            <div class="col-2">
                <input type="number" hidden name="postId" value="<?php echo $row['id']; ?>">
                <button class="btn btn-success" name="new_comment">Add Comment</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>

</html>