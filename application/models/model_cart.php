<?php

class Model_Cart extends Model
{
    public function getCartItemsInfo($itemsIdAndTheirAmount)
    {
        if (empty($itemsIdAndTheirAmount)) {
            return array();
        }
        $itemIds = array_keys($itemsIdAndTheirAmount);

        // $result123 = array_count_values($_SESSION['cart']);

        $ids = implode(',', $itemIds);
        // echo $ids;
        $result = $this->mysql->query("SELECT item_id, name, price, description, picture FROM items WHERE item_id IN ($ids)");

        if (!$result) {
            // Обработка ошибок запроса к базе данных
            return array();
        }

        $itemsInfo = array();
        while ($row = $result->fetch_assoc()) {
            $itemInfo = $row;
            $itemInfo['amount'] = $itemsIdAndTheirAmount[$row['item_id']]['amount'];
            $itemsInfo[$row['item_id']] = $itemInfo;
        }

        return $itemsInfo;
    }
    public function getPriceById($item_id){
        $result = $this->mysql->query("SELECT price FROM `items` WHERE
       item_id = '$item_id'");
        $item = $result->fetch_assoc();
        return $item;
    }
    public function makeAnOrder($total_cost, $users_user_id)
    {
      $date = date("Y-m-d");
      $status = "Processing";
      $this->mysql->query("INSERT INTO orders (date_creation, status, total_cost, users_user_id)
        VALUES ('$date', '$status', '$total_cost', '$users_user_id');");
      return true;
    }
    public function createItemList($amount,$orders_order_id,$items_item_id) {
      $this->mysql->query("INSERT INTO item_lists (amount, orders_order_id, items_item_id)
VALUES ('$amount', '$orders_order_id', '$items_item_id');");
    }
    public function getLastOrderId() {
      $result = $this->mysql->query("SELECT LAST_INSERT_ID();");
      $value = $result->fetch_assoc();
      return $value;

    }

    public function get_data()
    {

    }
}
