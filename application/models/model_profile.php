<?php

class Model_Profile extends Model
{
    public function get_data()
    {
        $result = $this->mysql->query("SELECT * FROM `users`");
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }

        return $items;
    }

    public function infoByLogin($login)
    {
        $result = $this->mysql->query("SELECT * FROM `users` WHERE
		 `email` = '$login'");
        $user = $result->fetch_assoc();
        return $user;
    }

    public function get_data_buyer($user_id)
    {
        $result = $this->mysql->query("SELECT
    o.order_id,
    o.date_creation AS order_date,
    o.status AS order_status,
    i.name AS item_name,
    i.description AS item_description,
    i.price AS item_price,
    il.amount AS item_amount
FROM
    orders o
JOIN
    item_lists il ON o.order_id = il.orders_order_id
JOIN
    items i ON il.items_item_id = i.item_id
JOIN
    users u ON o.users_user_id = u.user_id
WHERE
    u.user_id = $user_id; -- Замените на реальный user_id");
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function get_data_seller($user_id)
    {
        $result = $this->mysql->query("SELECT
    i.name AS item_name,
    SUM(il.amount) AS total_sold
FROM
    items i
JOIN
    item_lists il ON i.item_id = il.items_item_id
JOIN
    orders o ON il.orders_order_id = o.order_id
WHERE
    o.status <> 'Pending' AND
    i.users_user_id = $user_id
GROUP BY
    i.item_id, i.name
ORDER BY
    total_sold DESC;
");
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function get_data_categories()
    {
        $result = $this->mysql->query("SELECT * FROM categories;");
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function add_item($name, $description, $price, $available, $category, $path, $users_user_id)
    {
        $this->mysql->query("INSERT INTO items (name, description, price, available, category_category_id, picture, users_user_id)
			VALUES ('$name', '$description', '$price', '$available', '$category', '$path', '$users_user_id');");


        return true;
    }

    public function updateUser($user_id, $email, $password, $name, $role,
                               $verified, $address, $city, $registration_date)
    {
        $result = $this->mysql->query("UPDATE users
              SET email = '$email',
                  password = '$password',
                  name = '$name',
                  role = '$role',
                  verified = '$verified',
                  address = '$address',
                  city = '$city',
                  registration_date = '$registration_date'
              WHERE user_id = '$user_id'");

        //TODO УСЛОВИЯ

    }
}
