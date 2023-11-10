<?php

/**
 * OpenPayU Examples
 *
 * @copyright Copyright (c) PayU
 * http://www.payu.com
 * http://developers.payu.com
 */

require_once realpath(dirname(__FILE__)) . '/../../../lib/openpayu.php';
require_once realpath(dirname(__FILE__)) . '/../../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = file_get_contents('php://input');
    $data = trim($body);

    try {
        if (!empty($data)) {
            $result = OpenPayU_Order::consumeNotification($data);
        }

        if ($result->getResponse()->order->orderId) {

            /* Check if OrderId exists in Merchant Service, update Order data by OrderRetrieveRequest */
            $order = OpenPayU_Order::retrieve($result->getResponse()->order->orderId);
            $orderId=$result->getResponse()->order->orderId;
            $status=$order->getStatus();
            $mysqli->query("UPDATE payments SET status = 'zrobione' WHERE id=46");
            if($status == 'SUCCESS'){
                $extOrderId = $result->getResponse() ->order->extOrderId;
                //the response should be status 200
                require_once("./Admin/sql.connect.php");
                if($mysqli->query("UPDATE payments SET status = $status WHERE id=$extOrderId AND order_id =$orderId ")){
                    $mysqli->query("UPDATE cars SET avalible = 0 WHERE id=(SELECT car_id FROM payments WHERE id= $extOrderId)");

                }
                
                header("HTTP/1.1 200 OK");
            }
        }
    } catch (OpenPayU_Exception $e) {
        echo $e->getMessage();
    }
}