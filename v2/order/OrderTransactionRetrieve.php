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

?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Order Retrieve - OpenPayU v2</title>
    <link rel="stylesheet" href="../../layout/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../layout/css/style.css">
</head>
<body>
<div class="container">
    <div class="page-header">
        <h1>Retrieve transaction's data - OpenPayU v2</h1>
    </div>
    <div id="message"></div>
    <div id="unregisteredCardData">
        <?php
        if (isset($_POST['orderId'])) {
            try {
                $response = OpenPayU_Order::retrieveTransaction(stripslashes($_POST['orderId']));

                echo '<div class="alert alert-success">SUCCESS</div>';

                echo '<pre>';
                echo '<br>';
                print_r($response->getResponse());
                echo '</pre>';

            } catch (OpenPayU_Exception $e) {
                echo '<pre>';
                echo 'Error code: '.$e->getCode();
                echo '<br>';
                echo 'Error message: '.$e->getMessage();
                echo '<br>';
                echo '</pre>';
            }
        }?>
        <form action="" method="post" class="form-horizontal">
            <div class="control-group">
                <label class="control-label" for="order">Order Id</label>

                <div class="controls">
                    <input class="span3" name="orderId" id="order" type="text" value="<?php echo htmlentities($_POST['orderId']) ?>"/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="pay-button"></label>

                <div class="controls">
                    <button class="btn btn-success" id="pay-button" type="submit">Retrieve transaction's data</button>
                </div>
            </div>
        </form>
    </div>
</div>
</html>