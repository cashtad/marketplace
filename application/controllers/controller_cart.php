<?php

class Controller_Cart extends Controller
{
    function __construct()
    {
        $this->view = new View();
        $this->model = new Model_Cart();
    }

    function action_index()
    {
        if (!isset($_SESSION)) {
            Route::ErrorPage404();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id']) && isset($_POST['action'])) {
            $productId = $_POST['product_id'];
            $action = $_POST['action'];

            // Проверяем, существует ли массив корзины в сессии
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }

            // Проверяем, существует ли данный товар в корзине
            if (isset($_SESSION['cart'][$productId])) {
                // Товар уже в корзине
                if ($action == 'increase') {
                    $_SESSION['cart'][$productId]['amount']++;
                } elseif ($action == 'decrease' && $_SESSION['cart'][$productId]['amount'] > 1) {
                    $_SESSION['cart'][$productId]['amount']--;
                } elseif ($action == 'decrease' && $_SESSION['cart'][$productId]['amount'] = 1) {
                  unset($_SESSION['cart'][$productId]);

                  $newCartCost = 0;

                  foreach ($_SESSION['cart'] as $key => $value) {
                    $itemPrice = $this->model->getPriceById($key);
                    $newItemCost123 = $itemPrice['price'] * $_SESSION['cart'][$key]['amount'];
                    $newCartCost = $newCartCost + $newItemCost123;
                  }

                  $newCartCost = number_format($newCartCost, 2, '.', ',');

                  $response = array('status' => 'remove', 'newCartCost' => $newCartCost);
                  echo json_encode($response);
                  exit();

                }

                $itemPrice = $this->model->getPriceById($_POST['product_id']);
                $newItemCost = $itemPrice['price'] * $_SESSION['cart'][$productId]['amount'];
                $newItemCost = number_format($newItemCost, 2, '.', ',');


                $newCartCost = 0;

                foreach ($_SESSION['cart'] as $key => $value) {
                  $itemPrice = $this->model->getPriceById($key);
                  $newItemCost123 = $itemPrice['price'] * $_SESSION['cart'][$key]['amount'];
                  $newCartCost = $newCartCost + $newItemCost123;
                }

                $newCartCost = number_format($newCartCost, 2, '.', ',');

                // Возвращаем новое количество товаров в корзине
                $response = array('status' => 'success', 'newQuantity' => $_SESSION['cart'][$productId]['amount'], 'newCost' => $newItemCost, 'newCartCost' => $newCartCost);
                echo json_encode($response);

                exit();
            }
        }
        elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear'])) {
            // Очистка корзины
            unset($_SESSION['cart']);

            // Перенаправление на страницу корзины
            header('Location: /cart'); // Укажите свой URL для страницы корзины
            exit;
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST'
            && isset($_POST['checkout'])) {

              $users_user_id = $_SESSION["user_id"];
              $total_cost = 0;
              $array = $_SESSION['cart'];


              foreach ($array as $index => $value) {
                  $price = $this->model->getPriceById($index);


                  $result = $value['amount'] * $price['price'];
                  $total_cost += $result;
              }
              // var_export($total_cost);
              // var_export($users_user_id);
              $this->model->makeAnOrder($total_cost, $users_user_id);
              $value = $this->model->getLastOrderId();
              foreach ($array as $index => $amount) {

                $this->model->createItemList($amount[ 'amount'],$value[ 'LAST_INSERT_ID()'],$index);
              }
              header('Location:/profile/');
        }

        if (isset($_SESSION['cart'])) {
            $data = $this->model->getCartItemsInfo($_SESSION['cart']);
        } else {
            $data = array();
        }

        $this->view->generate('cart_view.php', 'template_view.php', $data);
    }
}
