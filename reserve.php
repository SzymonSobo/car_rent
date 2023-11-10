<?php 
if(!empty($_POST))
{
    $name= trim($_POST['name']);
    $surname= trim($_POST['surname']);
    $phone_number= trim($_POST['phone']);
    $car_id= trim($_POST['car']);
    $term= trim($_POST['term']);
    $days= trim($_POST['days']);
    $hours= trim($_POST['hours']);
   
    foreach ($_POST as $p) 
    {
       if($p=='')
       {
            die("Uzupełnij wszystkie pola");
        }
    }
    $today = date('Y-m-d');
    $endDate = date('Y-m-d',strtotime($today.'+ 13 days'));
    if($term < $today || $term>$endDate)
        {
            echo $endDate;
            die("Niepoprawna data");
        }
    if($days<1 || $days>13)
        {
            die("Niepoprawna liczba dni");
        }
    if($hours < 0 || $hours > 23)
        {
            die("Niepoprawna liczba godzin");
        }
}
require("function.php");
reserve($name,$surname,$phone_number,$car_id,$term,$days,$hours);
?>