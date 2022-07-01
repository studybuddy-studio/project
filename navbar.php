<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand brand" href="#">Study Buddy</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <form action="form_handlers/logout_handler.php" method="POST">
            <button class="btn btn-outline-danger my-2 my-sm-0" type="submit" name="logout">Logout</button>
        </form>
    </div>
</nav>