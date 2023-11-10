<?php

/**
 * OpenPayU Examples
 *
 * @copyright Copyright (c) PayU
 * http://www.payu.com
 * http://developers.payu.com
 */

require_once'lib/openpayu.php';
require_once'config.php';

if(isset($_GET['error']))
    header('Location: ' . EXAMPLES_DIR . './error.php?error=' . $_GET['error']);

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Order create successful</title>
    <link rel="stylesheet" href="<?php echo EXAMPLES_DIR;?>layout/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo EXAMPLES_DIR;?>layout/css/style.css">
</head>
<body>
<div class="container">
    <div class="page-header">
        <h1>Dziękuję za płatność</h1>
        <a href="./index.php">Powrót do strony głównej</a>
</div>
</body>
</html>