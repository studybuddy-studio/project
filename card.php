<!DOCTYPE html>
<html>

<head>
    <title>study Buddy</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/column.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<div class="container">
    <div class="card shadow rounded-lg">
        <div class="row">
            <div class="col-1">
                <div class="m-3">
                    <a href="file:///C:/Users/user/Desktop/login%20page/profile.html">
                        <img src="assets/images/userimg.png" alt="Image avatar" class="avatar shadow" width="80%"/></a>
                </div>
                <div class="ml-4" style="margin-top: 4rem;">
                    <form>
                        <input type="hidden" name="resource_id">
                        <button class="upvote">
                            <i class="fa-solid fa-square-caret-up"></i>
                        </button>
                    </form>
                        // This is a PHP script that is executed when the upvote button is clicked. It updates the upvote
                        column in the resource table by 1.
                        <?php
                        if (isset ($_POST['upvote'])) {
                            $upvote = $_POST['upvote'];
                            $upvoteSQL = "UPDATE `resource` SET upvote = upvote + 1 WHERE resource_id = $upvote";
                            $upvoteStatement = $connection->prepare($upvoteSQL);
                            $upvoteStatement->execute();
                        } ?>
                    <p class="my-2 font-weight-bold">576</p>
                    <form>
                        <input type="hidden" name="resource_id">
                        <button class="downvote">
                            <i class="fa-solid fa-square-caret-down"></i>
                        </button>
                    </form>
                        <?php
                        if (isset ($_POST['downvote'])) {
                            $downvote = $_POST['downvote'];
                            $downvoteSQL = "UPDATE `resource` SET downvote = downvote + 1 WHERE resource_id = $downvote";
                            $downvoteStatement = $connection->prepare($downvoteSQL);
                            $downvoteStatement->execute();
                        } ?>

                </div>

            </div>
            <div class="col-11" style="padding:0;">
                <div class="card-body">
                    <a href="file:///C:/Users/user/Desktop/login%20page/profile.html"></a>
                        <div class="box"><h5 class="user">
                                //display username from resource table in sql
                                <?php
                                $resource_id = $_GET['resource_id'];
                                $resourceSQL = "SELECT * FROM `resource` WHERE resource_id = $resource_id";
                                $resourceStatement = $connection->prepare($resourceSQL);
                                $resourceStatement->execute();
                                $resource = $resourceStatement->fetch(PDO::FETCH_ASSOC);
                                $user_id = $resource['user_id'];
                                $userSQL = "SELECT * FROM `user` WHERE user_id = $user_id";
                                ?>
                            </h5> </div>
                    <p class="card-text"><small class="text-muted">
                            /* This is a SQL query that is executed when the user is logged in. It selects the date and time. */
                            <?php "SELECT DATE_FORMAT(`date_time`,'%d %b %Y %h:%i %p') as Date FROM resource WHERE resource_id=?"; ?>
                        </small></p>
                </div>

                <img class="card-img-top" src="assets/images/userimg.png" alt="Card image cap" width="200" height="300">
                <div class="card-body">
                    <h5 class="file-title">File title</h5>
                    <p class="card-text"><small class="text-muted">Authors</small></p>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                        additional
                        content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
    </div>
</div>
</html>