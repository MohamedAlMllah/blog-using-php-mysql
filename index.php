<?php
session_start();

include "logic.php";

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Sport Blog using PHP & MySQL</title>
</head>

<body>

    <div class="container mt-5">

        <!-- Display any info -->
        <?php if (isset($_REQUEST['info'])) { ?>
            <?php if ($_REQUEST['info'] == "added") { ?>
                <div class="alert alert-success" role="alert">
                    Post has been added successfully
                </div>
            <?php } ?>
        <?php } ?>
        <a href="index.php">
            <h1>
                <img src="images/logo.JPG" width="100" height="50" title="Logo of a blog" alt="Logo of a blog" />
                Sport Blog
            </h1>
        </a>
        <br>
        <hr>
        <div class="row">
            <div class="col-4">
                <?php if (check_login($con)) {
                    echo  "Hello, " . $user_data['user_name'];
                } ?>
            </div>
            <div class="col-4 offset-4 text-right">
                <?php
                if (check_login($con)) {
                    echo "<a href='logout.php'>Logout</a>";
                } else {
                    echo "<a href='login.php'>Login</a>";
                }
                ?>
            </div>
        </div>
        <hr>
        <!-- Create a new Post button -->
        <div class="text-center">
            <a href="create.php" class="btn btn-outline-dark">+ Create a new post</a>
        </div>

        <!-- Display posts from database -->
        <div class="row">
            <?php foreach ($result as $q) { ?>
                <div class="card text-white bg-dark mt-5 col-12">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php
                            $created_at = date("d-m-y h:i a", strtotime($q['created_at']));
                            echo  $created_at . " - " . $q['title'];
                            ?>
                        </h5>
                        <div class="card-text row">
                            <div class="col-8">
                                <?php echo substr($q['content'], 0, 1000); ?>...
                            </div>
                            <div class="col-4">
                                <img class="col-12" src="uploads/<?= $q['image_url'] ?>" alt="article picture">
                            </div>
                        </div>
                        <a href="view.php?id=<?php echo $q['id'] ?>" class="btn btn-light">Read More <span class="text-danger">&rarr;</span></a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php
        //display the link of the pages in URL  
        for ($page = 1; $page <= $number_of_page; $page++) {
            echo '<a href = "index.php?page=' . $page . '">' . $page . ' </a>';
        }
        ?>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>

</html>