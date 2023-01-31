<?php
    $title = "Login";
    require_once "includes/header.php";
?>
    <div class="cards animated ">
        <div class="card-pic wow slideInLeft">
            <img src="images/login.png" class="img-fluid rounded d-block login-photo" alt="">
        </div>
        <div class="login-card login wow slideInRight">
            <div class="card login-b">
                <div class="card-title ">
                    <h1 class="text-center">CCCWABCMS</h1>
                </div>
                <div class="card-body">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Student ID</label>
                            <input type="text" name="email" placeholder="Student Id" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" placeholder="Password" name="password" class="form-control" >
                        </div>
                        <div class="mb-5 d-flex btn-flex">
                            <button type="submit" name="submit" class="btn btn-lg btn-primary btn-login " onclick="this.blur();">LOGIN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    require_once "includes/footer.php";
?>