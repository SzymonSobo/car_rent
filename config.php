<?php

/**
 * OpenPayU Examples
 *
 * @copyright Copyright (c) PayU
 * http://www.payu.com
 * http://developers.payu.com
 */

//set Environment
OpenPayU_Configuration::setEnvironment('sandbox');

//set POS ID and Second MD5 Key (from merchant admin panel)
OpenPayU_Configuration::setMerchantPosId('472692'); // POS ID (pos_id) / OAuth protocol - client_id
OpenPayU_Configuration::setSignatureKey('cf61524e919d9df5162ab92a5c13e5db'); // Second key (MD5)

//set Oauth Client Id and Oauth Client Secret (from merchant admin panel)
OpenPayU_Configuration::setOauthClientId('472692
'); // OAuth protocol - client_id / POS ID (pos_id)
OpenPayU_Configuration::setOauthClientSecret('afba921ccf575ee0acbc42db8752280f'); // Key (MD5) / OAuth protocol - client_secret

/* path for example files*/
$dir = explode(basename(dirname(__FILE__)) . '/', $_SERVER['SCRIPT_NAME']);
$directory = $dir[0] . basename(dirname(__FILE__));
$url = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://') . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $dir[0];

define('HOME_DIR', $url);
define('EXAMPLES_DIR', HOME_DIR . 'examples/');