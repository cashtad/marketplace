<?php

class Controller_Profile extends Controller
{

    function __construct()
    {
        $this->view = new View();
        $this->model = new Model_Profile();
    }

    function action_index()
    {
        if ($_SESSION["logged_in"] == true) {
            $data["login"] = $_SESSION["login"];
            $data["name"] = $_SESSION["name"];
            $data["role"] = $_SESSION["role"];
        } else {
            Route::ErrorPage404();
        }
        switch ($data["role"]) {
            case '3':
                $data["status"] = "";
                if (isset($_POST['user_id']) && isset($_POST['email'])
                    && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['role'])
                    && isset($_POST['verified']) && isset($_POST['address']) && isset($_POST['city'])
                    && isset($_POST['registration_date'])) {
                    $user_id = $_POST['user_id'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    //проверка на пароль
                    $user = $this->model->infoByLogin($email);
                    if ($password != $user['password']) {
                        $password = password_hash($password, PASSWORD_DEFAULT);
                    }
                    $name = $_POST['name'];
                    $role = $_POST['role'];
                    $verified = $_POST['verified'];
                    $address = $_POST['address'];
                    $city = $_POST['city'];
                    $registration_date = $_POST['registration_date'];
                    if ($this->model->updateUser($user_id, $email, $password, $name, $role,
                        $verified, $address, $city, $registration_date)) {
                        // $data["status"] = "success";
                    } else {
                        // $data["status"] = "false";
                    }

                }

                $data = $this->model->get_data();

                //TODO SUCCESS/FAIL

                $this->view->generate('admin_view.php', 'template_view.php', $data);

                break;

            case '1':
                $data = $this->model->get_data_buyer($_SESSION["user_id"]);

                $this->view->generate('buyer_view.php', 'template_view.php', $data);
                break;

            case '2':
                // if(isset($_FILES['product_image'])) {
                // 	echo implode(',',$_FILES['product_image']);
                // } else {
                // 	echo "no image";
                // }

                if (isset($_POST['name']) && isset($_POST['description'])
                    && isset($_POST['price']) && isset($_POST['available'])
                    && isset($_POST['category_id'])) {
                    // echo implode(',',$_POST);
                    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {


                        $name = $_POST['name'];
                        $description = $_POST['description'];
                        $price = $_POST['price'];
                        $available = $_POST['available'];
                        $category = $_POST['category_id'];

                        $uploadDirectory = 'application/uploads/';

                        $fileName = $_FILES['product_image']['name'];
                        $fileTmpName = $_FILES['product_image']['tmp_name'];

                        // Генерируем уникальное имя для файла
                        $uniqueName = uniqid() . '_' . $fileName;

                        // Определяем путь для сохранения файла
                        $uploadPath = $uploadDirectory . $uniqueName;

                        // Перемещаем файл в папку загрузки
                        // echo "<br>";
                        // echo "<br>";
                        // echo "<br>";
                        // echo "name = " . $name;
                        // echo " description = " . $description;
                        // echo " price = " . $price;
                        // echo " category = " . $category;
                        // echo " path = " . $uploadPath;
                        // echo " id = " . $_SESSION["user_id"];
                        if ($this->model->add_item($name, $description, $price, $available, $category, $uploadPath, $_SESSION["user_id"])) {
                            move_uploaded_file($fileTmpName, $uploadPath);
                            $data[2] = "success";
                        } else {
                            $data[2] = "failure";
                        }
                    }

                } else {
                    $data[2] = "";

                }
                $data = $this->model->get_data_seller($_SESSION["user_id"]);
                $dataCategories = $this->model->get_data_categories();
                $datafinal = array($data, $dataCategories);

                $this->view->generate('seller_view.php', 'template_view.php', $datafinal);
                break;

        }
    }
}
