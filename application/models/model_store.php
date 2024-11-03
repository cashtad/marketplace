<?php

class Model_Store extends Model
{
    public function get_data()
    {
        $result = $this->mysql->query("SELECT * FROM `items`");
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }

        return $items;
    }
}
