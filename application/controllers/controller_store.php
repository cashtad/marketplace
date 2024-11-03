<?php

class Controller_Store extends Controller
{

    function __construct()
    {
        $this->model = new Model_Store();
        $this->view = new View();
    }

    function action_index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
            $productId = $_POST['product_id'];

            // Проверяем, существует ли массив корзины в сессии
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }

            // Проверяем, существует ли данный товар в корзине
            if (isset($_SESSION['cart'][$productId])) {
                // Товар уже в корзине, увеличиваем количество
                $_SESSION['cart'][$productId]['amount']++;
            } else {
                // Товара еще нет в корзине, добавляем его
                $_SESSION['cart'][$productId]['amount'] = 1;
            }

            // Ваш код может также возвращать информацию об успешном добавлении товара
            // Например, вы можете отправить JSON-ответ с информацией о количестве товаров в корзине

            $response = array('status' => 'success', 'cartCount' => count($_SESSION['cart']));
            echo json_encode($response);
        }
        $data = $this->model->get_data();
        $this->view->generate('store_view.php', 'template_view.php', $data);
    }
}