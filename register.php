<?php
require_once "config.php";
include_once "header.php";
include_once "navbar.php";
?>
<div class="container">

    <div class="row mt-2">
        <div class="col-5" style="padding:0;">
            <h1>Register</h1>
            <form action="form_handlers/register_handler.php" method="post">
                <div class="row">
                    <div class="col">
                        <div class="form-group mt-1">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" placeholder="First name" id="first_name"
                                   name="first_name">
                            <small class="text-danger">
                                <?php
                                if (isset($_GET['first_name_error'])) {
                                    echo $_GET['first_name_error'];
                                }
                                ?>
                            </small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mt-1">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" placeholder="Last name" id="last_name"
                                   name="last_name">
                            <small class="text-danger">
                                <?php
                                if (isset($_GET['last_name_error']))
                                {
                                    echo $_GET['last_name_error'];
                                }
                                ?>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-1">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" class="form-control">
                    <small class="text-danger">
                        <?php
                        if (isset($_GET['email_error']))
                        {
                            echo $_GET['email_error'];
                        }
                        ?>
                    </small>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group mt-1">
                            <label for="password1">Password</label>
                            <input type="password" id="password1" name="password" placeholder="********"
                                   class="form-control">
                            <small class="text-danger">
                                <?php
                                if (isset($_GET['password_error']))
                                {
                                    echo $_GET['password_error'];
                                }
                                ?>
                            </small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mt-1">
                            <label for="password2">Confirm Password</label>
                            <input type="password" id="password2" name="confirm_password" placeholder="********"
                                   class="form-control">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" class="form-control" name="date_of_birth"/>
                            <small class="text-danger">
                                <?php
                                if (isset($_GET['date_of_birth_error']))
                                {
                                    echo $_GET['date_of_birth_error'];
                                }
                                ?>
                            </small>
                        </div>
                    </div>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" name="tnc">
                    <label class="form-check-label" for="gridCheck">I accept your
                        <a href="file:///C:/Users/user/Desktop/login%20page/terms%26condition.html">Terms
                            and Conditions</a>
                    </label>
                    <small class="d-block text-danger">
                        <?php
                        if (isset($_GET['tnc_error']))
                        {
                            echo $_GET['tnc_error'];
                        }
                        ?>
                    </small>
                </div>
                <br>
                <input type="submit" name="register" value="Register" class="btn btn-primary btn-block"/>
            </form>
            <div>
                <p class="mt-3 text-center">
                        <span>Already have an account ? <a
                                href="login.php">Login Now!</a></span>
                </p>
            </div>
        </div>
    </div>
</div>
<?php include_once "footer.php"; ?>
