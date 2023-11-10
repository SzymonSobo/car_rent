<?php

/**
 * OpenPayU Examples
 *
 * @copyright Copyright (c) PayU
 * http://www.payu.com
 * http://developers.payu.com
 */

require_once realpath(dirname(__FILE__)) . 'lib/openpayu.php';
require_once realpath(dirname(__FILE__)) . 'config.php';
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Order create unsuccessful</title>
    <link rel="stylesheet" href="<?php echo EXAMPLES_DIR;?>layout/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo EXAMPLES_DIR;?>layout/css/style.css">
</head>
<body>
<div class="container">
    <div class="page-header">
        <h1>Nie udało się zrealizować płatności</h1>
    </div>
    <a href="/index.php">Powrót do strony głównej</a>
</div>
</body>
</html>