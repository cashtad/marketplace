<div class="container mt-5">
    <h1>Admin Panel - User Table</h1>

    <table class="table">
        <thead>
        <tr>
            <th>User ID</th>
            <th>Email</th>
            <th>Password</th>
            <th>Name</th>
            <th>Role</th>
            <th>Verified</th>
            <th>Address</th>
            <th>City</th>
            <th>Registration Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $user): ?>
            <tr>
                <td><?php echo $user['user_id']; ?></td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                        <input type="text" class="form-control" name="email" value="<?php echo $user['email']; ?>">
                </td>
                <td>
                    <input type="text" class="form-control" name="password" value="<?php echo $user['password']; ?>">
                </td>
                <td>
                    <input type="text" class="form-control" name="name" value="<?php echo $user['name']; ?>">
                </td>
                <td>
                    <input type="text" class="form-control" name="role" value="<?php echo $user['role']; ?>">
                </td>
                <td>
                    <input type="text" class="form-control" name="verified" value="<?php echo $user['verified']; ?>">
                </td>
                <td>
                    <textarea class="form-control" name="address" rows="3"><?php echo $user['address']; ?></textarea>
                </td>
                <td>
                    <input type="text" class="form-control" name="city" value="<?php echo $user['city']; ?>">
                </td>
                <td>
                    <input type="text" class="form-control" name="registration_date"
                           value="<?php echo $user['registration_date']; ?>">
                </td>
                <td>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
