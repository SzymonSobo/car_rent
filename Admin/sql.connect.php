<?php 

$db=[
    'host'=>'localhost',
    'user'=> 'root',
    'password' => '',
    'database' => 'rental'
];
$mysqli = new mysqli($db['host'],$db['user'],$db['password'],$db['database']);
$mysqli ->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
$mysqli ->query("SET CHARSET UTF8");

IF($error=$mysqli->connect_errno){
    echo "Błąd połączone nr . $error";
}
?>