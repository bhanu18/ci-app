<?php

namespace App\Models;

use CodeIgniter\Model;

class CalendarModel extends Model{

    protected $table = "calender";
    protected $allowedFields = ["datefield"] ;

    public function DailySales(){
        $db = \Config\Database::connect();
        $sql = "SELECT calendar.datefield AS date, IFNULL(SUM(item_sales.sale_price),0) AS total_sales FROM item_sales RIGHT JOIN calendar ON (DATE(item_sales.date) = calendar.datefield) WHERE (calendar.datefield BETWEEN (SELECT MIN(DATE(item_sales.date)) FROM item_sales) AND (SELECT MAX(DATE(item_sales.date)) FROM item_sales)) GROUP BY date";
        $result = $db->query($sql)->getResult();
        return $result;
    }
}
?>