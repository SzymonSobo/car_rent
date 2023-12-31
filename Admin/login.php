<?php
declare(strict_types=1);


if(!empty($_POST)){

    session_start();

    if(isset($_SESSION['isLogged']) && $_SESSION['isLogged']===true){
        header("Location:dashboard.php");
    }
    require('sql.connect.php');


    $login = trim($_POST['login']);
$password = hash('whirlpool',trim($_POST['password']));

if($login =='' || $password=='' ){
    die("Login lub hasło są puste");
}

$sql="SELECT password from users WHERE login = ?";

if($statement = $mysqli->prepare($sql)){
    if($statement->bind_param('s',$login))
    {
        $statement->execute();
        $result=$statement->get_result();
        $row=$result->fetch_row();
        $user_password=$row[0];
        if($user_password== $password){
            session_start();
            $_SESSION['isLogged'] = true;
            header("Location:dashboard.php");
        } else {
die("Niepoprawne hasło");

        }
    }
    $mysqli->close();
} else{
    die("Zapytanie niepoprawne");
}

}else {
    die('Nic nie przesłano');
}

