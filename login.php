<?php
include_once "header.php";
$_SESSION['login_error_message'] = "";
?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-6" style="padding:0;">
                <img src="https://resize.indiatvnews.com/en/resize/newbucket/715_-/2021/12/study-room-1639102725.jpg"
                     alt="Study Photo" class="img-fluid mt-5">
            </div>
            <div class="offset-1 col-5" style="padding:0;">
                <form action="form_handlers/login_handler.php" method="post">
                    <h1>Login Form</h1>
                    <div class="form-group mt-5">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter email here" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="********"
                               class="form-control">
                    </div>

                    <small class="text-danger">
                        <?php
                        echo $_SESSION['login_error_message'];
                        ?>
                    </small>

                    <input class="btn btn-primary btn-block mt-5" type="submit" name="submit"/>
                </form>
            </div>
        </div>
    </div>
<?php include_once "footer.php" ?>