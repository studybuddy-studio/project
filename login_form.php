<?php include "login_script.php"; ?>
<?php include "header.php"; ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">

                <div class="registration-form">
                    <h4 class="text-center">Login Form</h4>
                    <p class="text-success text-center">
                        <?php echo $loginErrorMessage; ?>
                    </p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                          method="POST">




                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                            <p class="err-msg">

                                <?php if ($emailErrorMessage != 1) {
                                    echo $emailErrorMessage;
                                } ?>

                            </p>
                        </div>

                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" placeholder="Enter password" name="password">
                            <p class="err-msg">

                                <?php if ($passwordErrorMessage != 1) {
                                    echo $passwordErrorMessage;
                                } ?>

                            </p>
                        </div>


                        <button type="submit" class="btn btn-danger" value="login" name="register">Login</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-4">
            </div>
        </div>

    </div>

<?php include_once "footer.php" ?>