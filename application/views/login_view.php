<div class="container">
    <h1>Login Page</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="login">Email address:</label>
            <input type="email" class="form-control" name="login" id="login" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password"
                   required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </div>
    </form>

    <?php extract($data); ?>
    <?php if ($login_status == "access_granted") { ?>
        <p style="color: green">Login successful.</p>
    <?php } elseif ($login_status == "access_denied") { ?>
        <p style="color: red">Incorrect login and/or password.</p>
    <?php } ?>
</div>
