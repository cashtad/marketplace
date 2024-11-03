<div class="container">
    <h1>Registration</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="name">Full name:</label>
            <input type="text" class="form-control" name="name-reg" id="name-reg" placeholder="Enter your full name">
        </div>
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" name="email-reg" id="email-reg" placeholder="Enter your email">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password-reg" id="password-reg"
                   placeholder="Enter your password">
        </div>

        <div class="form-group">
            <label for="role">Role:</label>
            <select class="form-control" name="role-reg" id="role-reg">
                <option>Buyer</option>
                <option>Seller</option>
            </select>
        </div>

        <div class="form-group">
            <input type="submit" value="Submit" class="btn btn-success">
            <button type="reset" class="btn btn-default">Reset</button>
        </div>

    </form>
    <?php extract($data); ?>
    <?php if ($register_status == "access_granted") { ?>
        <p style="color:green">Авторизация прошла успешно.</p>
    <?php } elseif ($register_status == "access_denied") { ?>
        <p style="color:red">Логин и/или пароль введены неверно.</p>
    <?php } ?>


</div>
